@extends('layouts.admin')

@section('title', __('Admin: Invoices'))

@section('page-header-right')
<a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M12 5l0 14"></path>
      <path d="M5 12l14 0"></path>
  </svg>
  Thêm mới
</a>
@endsection
@php
    $user = is_numeric(request('user')) ? \App\Models\User::find(request('user')) : null;
@endphp
@if ($user)
@section('note')
    Bạn đang xem danh sách các hoá đơn của người dùng "<strong>{{ $user->name }}</strong>". 
@endsection
@endif
@section('content')
<div class="card mb-4">
  <form class="card-body" action="" method="GET">
    <input type="text" name="user" value="{{ request('user') }}" hidden>
      <div class="row">
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="keyword">Tìm kiếm</label>
              <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khoá..." class="form-control">
          </div>
          <div class="col-sm-2 mb-3">
              <label class="form-label" for="type">Kiểu rút</label>
              <select name="type" id="type" class="form-control" value="{{ request('type') ?: old('type') }}" autoselection>
                  <option value="">[-- Chọn kiểu rút --]</option>
                  <option value="normal">Thường</option>
                  <option value="fast">Nhanh</option>
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
  <div class="card-header">
    <h3 class="card-title">Quản lí hoá đơn</h3>
  </div>

  <div class="table-responsive">
    <table class="table table-vcenter table-mobile-md card-table">
      <thead>
        <tr>
          <th>Id.</th>
          <th>Người dùng</th>
          <th>Số tiền</th>
          <th>Phí rút</th>
          <th>Kiểu rút</th>
          <th>Ngày rút</th>
          <th>Ngày thanh toán</th>
          <th>Tài khoản rút</th>
          <th>Trạng thái</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @if($invoices->count())
        @forEach($invoices as $invoice)
        <tr>
          <td data-label="Id."><span class="text-secondary">{{ $invoice->id }}</span></td>
          <td data-label="Người dùng"> <a href="{{ route('admin.users.show', $invoice->user_id) }}">{{ $invoice->user->name }}</a></td>
          <td data-label="Số tiền">${{ $invoice->amount}}</td>
          <td data-label="Phí rút">${{ $invoice->amount*$invoice->costs/100 }}</td>
          <td data-label="Kiểu rút">{!! $invoice->type == 0 ? '<span class="badge bg-muted text-muted-fg">Bình thường</span>' : '<span class="badge bg-blue text-blue-fg">Nhanh</span>' !!}</td>
          <td data-label="Ngày rút">{{ $invoice->created_at }}</td>
          <td data-label="Ngày thanh toán">{{ $invoice->status == 'completed' ? $invoice->paid_at : date('Y-m-d H:i:s', strtotime($invoice->created_at . ($invoice->type == 0 ? ' +7 days' : ' +3 hours'))). ' (Dự kiến)' }}</td>
          <td data-label="Tài khoản rút">
              @php
                  $payment_details = json_decode($invoice->payment_details, true);
              @endphp
              @if ($payment_details)
              <a onclick="return alert('*Phương thức thanh toán: {{ $invoice->payment_method }}\n*Chi tiết: {{ implode(' - ', $payment_details) }}')" class="text-secondary">
                Xem chi tiết
              </a>
                  
              @endif
          </td>
          <td data-label="Trạng thái">
            @if ($invoice->status == 'approved')
            <span class="badge bg-blue text-blue-fg">Đã xem xét</span>
            @elseif ($invoice->status == 'completed')
            <span class="badge bg-green text-green-fg">Thành công</span>
            @elseif ($invoice->status == 'cancelled')
            <span class="badge bg-red text-red-fg">Từ chối</span>
            @elseif ($invoice->status == 'hold')
            <span class="badge bg-dark text-dark-fg">Liên hệ</span>
            @elseif ($invoice->status == 'pending')
            <span class="badge bg-yellow text-yellow-fg">Đang xử lý</span>
            @endif
          </td>
          <td data-label="">
              <div class="btn-list flex-nowrap">
                  <a class="btn" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                    Chỉnh sửa
                  </a>
                  <div class="dropdown">
                  <button class="btn dropdown-toggle align-text-top" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                      Actions
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                      
                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                          Trạng thái
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('admin.invoices.pending', $invoice->id) }}"> Đang xử lý</a>
                            <a class="dropdown-item" href="{{ route('admin.invoices.watched', $invoice->id) }}"> Đã xem xét</a>
                            <a class="dropdown-item" href="{{ route('admin.invoices.success', $invoice->id) }}"> Thành công</a>
                            <a class="dropdown-item" href="{{ route('admin.invoices.refuse', $invoice->id) }}"> Từ chối</a>
                            <a class="dropdown-item" href="{{ route('admin.invoices.contact', $invoice->id) }}"> Liên hệ</a>
                        </div>
                        @if ($invoice->status == 'approved')
                        <a class="dropdown-item" href="{{ route('admin.invoices.pay', $invoice->id)}}">
                          Thanh toán
                        </a>
                        @endif
                      </div>
                      
                  </div>
              </div>
          </td>
        </tr>
        @endforEach
        @else
        <tr>
          <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex align-items-center">
    {{ $invoices->links('pagination.tabler') }}
  </div>
</div>

@endsection