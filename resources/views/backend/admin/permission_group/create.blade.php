@extends('layouts.admin')
@section('title', __('Thêm nhóm quyền'))

@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.permission-groups.store') }}" method="POST">
            <div class="card rounded-3">
                @csrf

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required" for="name">Tên</label>
                        <input class="form-control" name="name" value="{{ old('name') }}" id="name"
                            placeholder="Nhập tên nhóm quyền..." required>
                    </div>
                    <div>
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea class="form-control" name="description" value="{{ old('description') }}" id="description" rows="5"
                            placeholder="Nhập mô tả nhóm quyền..."></textarea>
                    </div>
                </div>

            </div>
            <div class="mt-3">
              <input value="Tạo nhóm quyền" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
