
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
        <h3 class="card-title">Quản lý thanh toán</h3>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
                <th>Tên phương thức</th>
                <th>Phí rút</th>
                <th>Tối thiểu</th>
                <th>SLTV Sử dụng</th>
                <th>Trạng thái</th>
                <th class="text-nowrap language-header text-center sorting_disabled">
                    @foreach (Language::getSupportedLanguages() as $lang)
                        <img src="{{ asset('/core/img/flags/' . $lang->flag . '.svg') }}" title="{{ $lang->name }}"
                            class="flag" style="height: 16px" loading="lazy" alt="English flag">
                    @endforeach
                </th>
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
              <td>{{ 0 }}</td>
              <td>
                {!! $method->status->html() !!}
              </td>
              <td>
                @foreach (getAllLanguages() as $lang)
                <a data-bs-toggle="tooltip"
                href=""
                aria-label="Sửa bản ngôn ngữ khác của bản ghi này"
                data-bs-original-title="Sửa bản ngôn ngữ khác của bản ghi này">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path
                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                        </path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                </a>
                @endforeach
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
  </div>
</div>
@endsection
