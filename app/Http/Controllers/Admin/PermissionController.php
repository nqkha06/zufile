<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Models\PermissionGroup;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository = null) {
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionRepository->getAllPaginated();

        return view('backend.admin.permission.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
            'description' => ['string', 'max:255']
        ]);

        $this->permissionRepository->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Thêm quyền '.$request->name.' thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = $this->permissionRepository->findOrFail($id);
        $permission_groups = PermissionGroup::with('permissions')->get();

        return view('backend.admin.permission.edit', compact('permission', 'permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$id
            ]
        ]);
  
        $this->permissionRepository->update($id, [
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->permission_group
        ]);

        return redirect()->back()->with('success', 'Cập nhật quyền '.$request->name.' thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->permissionRepository->findOrFail($id);

        $this->permissionRepository->delete($id);

        return redirect()->back()->with('success', 'Vai trò '.$role->name.' được xoá thành công!' );
    }
}
