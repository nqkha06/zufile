<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::allFiles(resource_path());
        return view('backend.admin.file_editor.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($file)
    {
        $filePath = base64_decode($file); // Encode đường dẫn để đảm bảo an toàn
        if (!File::exists($filePath)) {
            abort(404, "File không tồn tại.");
        }

        $content = File::get($filePath);
        return view('backend.admin.file_editor.edit', compact('filePath', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $filePath = $request->input('file_path');
        $content = $request->input('content');

        if (!File::exists($filePath)) {
            return redirect()->back()->with('error', 'File không tồn tại.');
        }

        File::put($filePath, $content);
        return redirect()->route('file_editor.index')->with('success', 'File đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
