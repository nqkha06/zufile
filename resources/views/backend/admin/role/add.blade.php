@extends('layouts.admin')
@section('title', __('Thêm quyền cho: '. $role->name))
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.roles.add', $role) }}
@endsection
@section('content')
    <form class="card rounded-3" action="{{ route('admin.roles.give', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="table-responsive rounded-3">
            <table class="table card-table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>NHÓM QUYỀN</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($permission_groups->count())
                        @foreach ($permission_groups as $permission_group)
                            <tr>
                                <td data-label="NHÓM QUYỀN">
                                    {{ $permission_group->name }}
                                </td>
                                <td>
                                    <div class="d-flex flex-nowap gap-3">
                                        @php
                                            $permissions = $permission_group->permissions;
                                        @endphp

                                        @foreach ($permissions as $permission)
                                            <label class="form-check mb-0">
                                                <input class="form-check-input" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                    type="checkbox">
                                                <span class="form-check-label">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="card-footer rounded-3 text-end">
            <input value="Cập nhật" type="submit" class="btn btn-primary">
        </div>
    </form>
@endsection
