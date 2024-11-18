
@extends('layouts.admin')
@section('title', __('Sửa quyền: '. $permission->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.permissions.edit', $permission) }}
@endsection

@section('content')
<form class="card" action="{{ route('admin.permissions.update',  $permission->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-header">
      <h3 class="card-title">Chỉnh sủa quyền: {{ $permission->name }}</h3>
      <div class="card-actions">
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-primary">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
          Quay lại
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label required" for="name">Tên</label>
        <input class="form-control" name="name" value="{{ old('name') ?: $permission->name }}" id="name" placeholder="Nhập tên quyền..." required>
      </div>
      <div class="mb-3">
        <label class="form-label required" for="permission_group">Nhóm quyền</label>
        <select class="form-control" name="permission_group" id="permission_group" placeholder="Nhập tên quyền..." required>
          <option value="">[--Chọn nhóm--]</option>
          @foreach ($permission_groups as $permission_group)
          <option value="{{ $permission_group->id }}" @selected($permission_group->id == $permission->group_id)>{{ $permission_group->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Mô tả</label>
        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Nhập mô tả quyền...">{{ old('description') ?: $permission->description }}</textarea>
      </div>
    </div>
    <div class="card-footer text-end">
      <input value="Cập nhật" type="submit" class="btn btn-primary">
    </div>
</form>
@endsection