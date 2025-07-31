@extends('layouts.admin')
@section('title', __('BLog: Bài viết'))
@section('page-header-right')
<div class="col-auto ms-auto d-print-none">
  <div class="btn-list">

    <a class="btn btn-primary d-none d-sm-inline-block" href="{{ route('admin.posts.create') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
      Tạo bài viết
    </a>
    <a class="btn btn-primary d-sm-none btn-icon" href="{{ route('admin.posts.create') }}" aria-label="Tạo nhóm quyền">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
    </a>
  </div>
</div>
@endsection

@section('content')
<style>
td img {
    width: 75px; /* Chiều rộng ảnh là 75px */
    height: auto; /* Chiều cao tự động điều chỉnh theo tỷ lệ */
    text-align: center; /* Căn chỉnh ảnh sang giữa */
    vertical-align: middle; /* Căn chỉnh ảnh theo chiều dọc */
    border: 2px solid #ddd; /* Thêm viền 2px màu xám nhạt */
    border-radius: 10px; /* Làm tròn các góc 10px */
    box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ */
    transition: transform 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    scale: 1.3;
}

td img:hover {
    transform: scale(1.1); /* Phóng to ảnh khi di chuột */
}
</style>
<div class="row row-deck">
    <div class="col-12 mb-4">
        <div class="card p-3">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="keyword">Tìm kiếm</label>
                        <input type="text" id="keyword" name="keyword" value="{{ old('keyword', request('keyword')) }}" placeholder="Tìm kiếm.." class="form-control">
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="date">Ngày giờ</label>
                        <input type="text" id="start_date" name="start_date" value="{{ old('start_date', request('start_date')) }}" hidden>
                        <input type="text" id="end_date" name="end_date" value="{{ old('end_date', request('end_date')) }}" hidden>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                            </span>
                            <input class="form-control" placeholder="" id="datepicker-filter"/>
                        </div>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">[-- Trạng thái --]</option>
                            @foreach ($baseStatus as $status)
                                <option value="{{ $status->value }}" @selected(old('status', request('status')) == $status->value)>{{ $status->label() }}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="col-sm-2 d-flex align-items-end gap-1 mb-2">
                        <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                        <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default" onclick="(location.href = location.pathname)">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý bài đăng</h3>
            </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th style="white-space: nowrap">#ID</th>
                    <th style="white-space: nowrap">#Ảnh</th>
                    <th style="white-space: nowrap">#Tiêu đề</th>
                    <th style="white-space: nowrap">#Ngày đăng</th>
                    <th style="white-space: nowrap">{{ __('links.views') }}</th>
                    <th style="white-space: nowrap">#Trạng thái</th>
                    <th class="w-1">#Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @if(!$posts->isEmpty())
                    @foreach($posts as $key=>$value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td><img alt="{{ $value->title }}" src="{{ $value->image }}"/></td>
                            <td style="overflow: hidden;text-overflow: ellipsis;"><a href="{{ route('admin.posts.edit', $value->id) }}">{{ $value->title }}</a></td>
                            <td style="white-space: nowrap">{{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                            <td> <span class="badge bg-blue text-blue-fg badge-pill">{{ $value->views->sum('views') }}</span> views</td>
                            <td>{!! $value->status->html() !!}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.posts.edit', $value->id) }}" class="btn">Chỉnh sửa</a>

                                    <form action="{{ route('admin.posts.destroy', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                            Xoá
                                        </button>
                                    </form>

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
            {{ $posts->links('pagination.tabler') }}
        </div>
        </div>
    </div>
</div>

@endsection
