
@extends('layouts.admin')

@section('title', __('Admin: Phương thức thanh toán'))
@section('page-header-right')
    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 5l0 14"></path>
            <path d="M5 12l14 0"></path>
        </svg>
        Thêm mới
    </a>
@endsection

@section('content')
<div class="card">

  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap datatable">
      <thead>
        <tr>
          <th>Tên phương thức</th>
          <th>Phí rút</th>
          <th>Tối thiểu</th>
          <th>SLTV Sử dụng</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if (count($methods))
        @forEach($methods as $method)
        <tr>
          <td>{{ $method->name }}</td>
          <td>{{ $method->withdraw_fee }}%</td>
          <td>{{ $method->min_withdraw_amount }}</td>
          <td>0</td>
          <td>
            {!! $method->status == 'publish' ? '<span class="badge bg-green text-green-fg">Công khai</span>' : '<span class="badge bg-red text-red-fg">Riêng tư</span>' !!}
          </td>

          <td class="text-end">
            <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
            </a>

            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
            </a>
           
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
    {{ $methods->links('pagination.tabler') }}
  </div>
</div>
@endsection