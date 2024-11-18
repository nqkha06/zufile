
@extends('layouts.admin')
@section('title', __('Sửa nhóm quyền: '. $permission_group->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.permission-groups.edit', $permission_group) }}
@endsection

@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.permission-groups.update', $permission_group->id) }}" method="POST">

            <div class="card rounded-3">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required" for="name">Tên</label>
                        <input class="form-control" name="name" value="{{ old('name', $permission_group->name) }}" id="name"
                            placeholder="Nhập tên nhóm quyền..." required>
                    </div>
                    <div>
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea class="form-control" name="description" value="{{ old('description', $permission_group->description) }}" id="description" rows="5"
                            placeholder="Nhập mô tả nhóm quyền..."></textarea>
                    </div>
                </div>

            </div>
            <div class="mt-3">
              <input value="Cập nhật" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection

