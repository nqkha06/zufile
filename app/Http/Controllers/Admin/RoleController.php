<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use Illuminate\Support\Facades\DB;
use App\Models\PermissionGroup;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository) 
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepository->pagination();

        return view('backend.admin.role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'description' => ['string', 'max:255']
        ]);

        $this->roleRepository->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Thêm vai trò '.$request->name.' thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Chỉnh sửa role';
        $data['content'] = 'role.edit';

        $data['role'] = $this->roleRepository->findById($id);

        return view('backend.tabler.layout', compact('data'));
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
                'unique:roles,name,'.$id
            ]
        ]);

        $this->roleRepository->update($id, [
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Cập nhật vai trò '.$request->name.' thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->roleRepository->findById($id);

        $this->roleRepository->delete($id);

        return redirect()->back()->with('success', 'Vai trò '.$role->name.' được xoá thành công!' );
    }

    public function add($id)
    {

        $permissions = $this->permissionRepository->getAll();
        $role = $this->roleRepository->findById($id);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
                                $permission_groups = PermissionGroup::with('permissions')->get();

        return view('backend.admin.role.add', compact('permissions', 'role', 'rolePermissions', 'permission_groups'));
    }

    public function give(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = $this->roleRepository->findById($id);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'Vai trò '.$role->name.' đã được cập nhật thành công!');
    }
}
