@extends('layouts.admin')
@section('title', __('Admin: Nhóm quyền'))
@section('page-header-right')
<div class="col-auto ms-auto d-print-none">
  <div class="btn-list">

    <a class="btn btn-primary d-none d-sm-inline-block" href="{{ route('admin.permission-groups.create') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
      Tạo nhóm quyền
    </a>
    <a class="btn btn-primary d-sm-none btn-icon" href="{{ route('admin.permission-groups.create') }}" aria-label="Tạo nhóm quyền">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
    </a>
  </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card rounded-3">
        <div class="table-responsive rounded-3">
          <table class="table table-vcenter card-table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Count</th>
                <th>Ngày tạo</th>
                <th class="w-1"></th>
              </tr>
            </thead>
            <tbody>
              @if(count($permission_groups))
                  @foreach($permission_groups as $key=>$value)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->description }}</td>
                          <td>{{ $value->permissions->count() }}</td>

                          <td>{{ $value->created_at }}</td>
                          <td style="white-space: nowrap">
                              <div class="btn-list flex-nowrap">
                                  <a class="btn btn-primary" href="{{ route('admin.permission-groups.edit', $value->id) }}" >
                                    Edit
                                  </a>
                                  <a class="btn btn-red" href="{{ route('admin.permission-groups.destroy', $value->id) }}" >
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
        <div class="card-footer d-flex align-items-center rounded-3">
          {{ $permission_groups->links('pagination.tabler') }}
        </div>
      </div>
    </div>
</div>
@endsection