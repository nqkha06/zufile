@extends('layouts.admin')

@section('title', __('Admin: Tiện ích'))

@section('page-header-right')
<a href="{{ route('admin.widgets.create') }}" class="btn btn-primary">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M12 5l0 14"></path>
      <path d="M5 12l14 0"></path>
  </svg>
  Thêm mới
</a>
@endsection

@section('content')
<div class="card mb-4">
  <form class="card-body" action="" method="GET">
      <div class="row">
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="keyword">Tìm kiếm</label>
              <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khoá..." class="form-control">
          </div>
          <div class="col-sm-2 mb-3">
              <label class="form-label" for="type">Kiểu rút</label>
              <select name="type" id="type" class="form-control" value="{{ request('type') ?: old('type') }}" autoselection>
                  <option value="">[-- Chọn kiểu rút --]</option>
                  <option value="0">Thường</option>
                  <option value="1">Nhanh</option>
              </select>
          </div>
          <div class="col-sm-2 mb-3">
              <label class="form-label" for="method">Phương thức thanh toán</label>
              <select name="method" id="method" class="form-control" value="{{ request('method') ?: old('method') }}" autoselection>
                <option value="">[-- Chọn --]</option>
                <option value="momo">Momo</option>
                <option value="banking">Banking</option>
            </select>
          </div>
          <div class="col-sm-2 mb-3">
              <label class="form-label" for="status">Trạng thái</label>
              <select name="status" id="status" class="form-control" value="{{ request('status') ?: old('status') }}" autoselection>
                <option value="">[-- Chọn trạng thái --]</option>
                <option value="pending">Đang xử lý</option>
                <option value="approved">Đã xem xét</option>
                <option value="completed">Thành công</option>
                <option value="cancelled">Từ chối</option>
                <option value="hold">Liên hệ</option>
            </select>
          </div>
          <div class="col-sm-2 d-flex align-items-end gap-1 mb-3">
              <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
              <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default" onclick="(location.href = location.pathname)">
          </div>
      </div>
    </form>
</div>
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter table-mobile-md card-table">
      <thead>
        <tr>
          <th>Id.</th>
          <th>Tên</th>
          <th>Mô tả</th>
          <th>Canonical</th>
          <th>Ngày tạo</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @if($widgets->isEmpty())
        <tr>
            <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
        </tr>
        @else
        @forEach($widgets as $widget)
        <tr>
          <td data-label="Id."><span class="text-secondary">{{ $widget->id }}</span></td>
          <td data-label="Name">{{ $widget->name }}</td>
          <td data-label="Name">{{ $widget->description }}</td>
          <td data-label="Name">{{ $widget->canonical }}</td>
          <td data-label="Name">{{ $widget->created_at }}</td>

          <td data-label="">
              <div class="btn-list flex-nowrap">
                  <a class="btn" href="{{ route('admin.widgets.edit', $widget->id) }}">
                    Chỉnh sửa
                  </a>
              </div>
          </td>
        </tr>
        @endforEach
        @endif
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex align-items-center">
    {{ $widgets->links('pagination.tabler') }}
  </div>
</div>

@endsection