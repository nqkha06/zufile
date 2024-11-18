@extends('layouts.admin')

@section('title', __('Permissions'))

@section('content')
<div class="row">
    <div class="col-12 col-md-4">
        <form class="card" action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Thêm mới quyền</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required" for="name">Tên</label>
                <input class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Nhập tên quyền..." required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="description">Mô tả</label>
                <textarea class="form-control" name="description" value="{{ old('description') }}" id="description" rows="5" placeholder="Nhập mô tả quyền..."></textarea>
              </div>
            </div>
            <div class="card-footer text-end">
              <input value="Thêm quyền" type="submit" class="btn btn-primary">
            </div>
        </form>
      </div>
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Quản lý quyền</h3>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
              <thead>
                <tr>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th class="w-1"></th>
                </tr>
              </thead>
              <tbody>
                @if(count($permissions))
                    @foreach($permissions as $key=>$value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td style="white-space: nowrap">
                                <div class="btn-list flex-nowrap">
                                    <a class="btn btn-primary" href="{{ route('admin.permissions.edit', $value->id) }}" >
                                      Edit
                                    </a>
                                    <a class="btn btn-red" href="{{ route('admin.permissions.destroy', $value->id) }}" >
                                      Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
                </tr>
                @endif
                
          
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {{ $permissions->links('pagination.tabler') }}
          </div>
        </div>
      </div>
</div>
@endsection