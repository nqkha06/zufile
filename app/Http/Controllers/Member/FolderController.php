<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function store(Request $request)
    {
        // Logic to create a new folder
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        // Create the folder
        $folder = new Folder();
        $folder->user_id = auth()->id();
        $folder->name = $request->input('name');
        $folder->parent_id = $request->input('parent_id');
        $folder->path = ''; // Set the path as needed
        $folder->save();

        // Check if it's an AJAX request
        if ($request->expectsJson() || $request->header('Content-Type') === 'application/json') {
            return response()->json([
                'status' => 'success',
                'message' => 'Folder created successfully.',
                'folder' => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'parent_id' => $folder->parent_id
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Folder created successfully.');
    }


    public function destroy($id)
    {
        // Logic to delete a folder
        $folder = Folder::where('user_id', auth()->id())->findOrFail($id);
        $folder->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Folder deleted successfully.'
        ]);
    }

    public function update(Request $request, $id)
    {
        // Logic to update a folder
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder = Folder::where('user_id', auth()->id())->findOrFail($id);
        $folder->name = $request->input('name');
        $folder->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Folder updated successfully.',
            'folder' => [
                'id' => $folder->id,
                'name' => $folder->name,
                'parent_id' => $folder->parent_id
            ]
        ]);
    }

    public function getFolders(Request $request)
    {
        // Logic to get folders for the user
        $user = auth()->user();
        $parentId = $request->input('parent_id', null); // null = root

        $folders = Folder::where('user_id', $user->id)
            ->where('parent_id', $parentId)
            ->withCount(['files', 'children'])
            ->orderBy('name')
            ->get();

        return response()->json($folders);
    }

    public function move(Request $request)
    {
        // Logic to move a folder
        $request->validate([
            'target_folder_id' => 'required|exists:folders,id',
            'folder_id' => 'required|exists:folders,id',
        ]);

        $folder = Folder::where('user_id', auth()->id())->findOrFail($request->input('folder_id'));
        $folder->parent_id = $request->input('target_folder_id');
        $folder->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Folder moved successfully.',
            'folder' => [
                'id' => $folder->id,
                'name' => $folder->name,
                'parent_id' => $folder->parent_id
            ]
        ]);
    }
}
