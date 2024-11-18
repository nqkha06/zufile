<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function index()
    {
        $permission_groups = PermissionGroup::with('permissions')->orderBy('created_at', 'DESC')->paginate();
        return view('backend.admin.permission_group.index', compact('permission_groups'));
    }

    public function create()
    {
        return view('backend.admin.permission_group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permission_groups|max:255',
            'description' => 'nullable|max:255',

        ]);

        PermissionGroup::create($request->only(['name', 'description']));

        return redirect()->route('admin.permission-groups.index')->with('success', 'Nhóm quyền được tạo thành công.');
    }

    public function edit($id)
    {
        $permission_group = PermissionGroup::find($id);

        return view('backend.admin.permission_group.edit', compact('permission_group'));
    }

    public function update(Request $request, PermissionGroup $permissionGroup)
    {
        $request->validate([
            'name' => 'required|unique:permission_groups,name,' . $permissionGroup->id . '|max:255',
            'description' => 'nullable|max:255',
        ]);

        $permissionGroup->update($request->only('name', 'description'));

        return redirect()->route('admin.permission-groups.index')->with('success', 'Nhóm quyền được cập nhật thành công.');
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        $permissionGroup->delete();

        return redirect()->route('permission-groups.index')->with('success', 'Permission Group deleted successfully.');
    }
}
