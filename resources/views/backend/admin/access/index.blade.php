@extends('layouts.admin')

@section('title', __('Admin: Thống kê Truy cập'))

@section('content')
<div class="row row-deck row-cards">
  <div class="col-12 mb-3">
    <div class="card">

      <form action="" class="card-body" method="GET">
        <input type="text" name="user" value="{{ request('user') }}" hidden>
        <input type="text" name="link" value="{{ request('link') }}" hidden>
          <div class="row">
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
            <div class="col-sm-2 mb-3">
              <label class="form-label" for="order_by">Sắp sếp theo: </label>
              <select name="order_by" id="order_by" class="form-control" value="{{ request('order_by') }}" autoselection="true">
                  <option value="">[-- Chọn cột --]</option>
                  <option value="clicks">Lượt xem</option>
                  <option value="revenue">Doanh thu</option>
                  <option value="cpm">CPM</option>
                  <option value="label">Label</option>
              </select>
            </div>
            <div class="col-sm-2 mb-3">
              <label class="form-label" for="order_direction">Kiểu sắp xếp: </label>
              <select name="order_direction" id="order_direction" class="form-control" value="{{ request('order_direction') }}" autoselection="true">
                  <option value="">[-- Chọn kiểu --]</option>
                  <option value="asc">Tăng dần</option>
                  <option value="desc">Giảm dần</option>

              </select>
            </div>

            <div class="col-sm-2 mb-3">
              <label class="form-label" for="group_by">Nhóm theo: </label>
              <select name="group_by" id="group_by" class="form-control" value="{{ request('group_by') }}" autoselection>
                  <option value="">[-- Root --]</option>
                  <option value="referral">URL GIỚI THIỆU</option>
                  <option value="country">QUỐC GIA</option>
                  <option value="browser">TRÌNH DUYỆT</option>
                  <option value="device">THIẾT BỊ</option>
                  <option value="platform">HỆ ĐIỀU HÀNH</option>
                  <option value="detection">VPN/PROXY</option>
              </select>
            </div>

            <div class="col-sm-2 mb-3">
              <label class="form-label" for="parent">Nhóm chính: </label>
              <select name="parent" id="parent" class="form-control" value="" autoselection="">
                  <option value="">[-- Root --]</option>
                  <option value="created_at" @selected(request('parent') == "created_at")>NGÀY</option>
                  <option value="user_id" @selected(request('parent') == "user_id")>NGƯỜI DÙNG</option>
                  <option value="link_id" @selected(request('parent') == "link_id")>LIÊN KẾT</option>
              </select>
            </div>

            <div class="col-sm-2 d-flex align-items-end gap-1 mb-3">
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
        <h3 class="card-title">Số liệu</h3>
      </div>
      @if ($accessData->count())
      @php
      $keys = array_keys($accessData[0]->toArray());
      @endphp
      <div class="table-responsive">

        <table class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th>
                <a href="{{ sortable_url('admin.access.index', 'label') }}" class="table-sort {{ request('sort_by') == 'label' ? request('sort_order') : '' }}" data-sort="sort-name">{{$keys[0]}}</a>
              </th>
              <th>
                <a href="{{ sortable_url('admin.access.index', 'clicks') }}" class="table-sort {{ request('sort_by') == 'clicks' ? request('sort_order') : '' }}" data-sort="sort-name">Lượt xem</a>
              </th>
              <th>
                <a href="{{ sortable_url('admin.access.index', 'revenue') }}" class="table-sort {{ request('sort_by') == 'revenue' ? request('sort_order') : '' }}" data-sort="sort-name">Lượt xem</a>
              </th>
              <th>
                <a href="{{ sortable_url('admin.access.index', 'cpm') }}" class="table-sort {{ request('sort_by') == 'cpm' ? request('sort_order') : '' }}" data-sort="sort-name">Lượt xem</a>
              </th>
              <th class="text-end">Label</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accessData as $key=>$val)
            <tr>
              <td>
                <span class="badge badge-outline text-blue">{{ $val->{$keys[0]} }}</span>
              </td>
                {{-- <span class="badge badge-outline text-blue">{{ $val->user->name ?? 'anonymous' }}</span>
              </td> --}}

                {{-- <span class="badge badge-outline text-blue">{{ $val->link->alias ?? 'anonymous' }}</span>
              </td> --}}
                {{-- <span class="badge badge-outline text-blue">{{ $val->{$keys[0]} }}</span></td> --}}
              <td>{{ $val->clicks }}</td>
              <td>${{ round($val->revenue, 3) }}</td>
              <td>${{ round($val->revenue/$val->clicks*1000, 3) }}</td>
              <td class="text-end">{{ $val->label }}</td>
            </tr>
            @endforeach
          
          </tbody>
        </table>

      </div>

      <div class="card-footer d-flex align-items-center">
        {{ $accessData->links('pagination.tabler') }}
      </div>
      @else
      <p>Không có dữ liệu</p>
      @endif
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
      function dateYYYYMMDD(date) {
        return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
      }
  
      const today = new Date();
      const startDateElt = document.getElementById('start_date').value;
      const endDateElt = document.getElementById('end_date').value;
  
      const startDate = startDateElt || dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 1));
      const endDate = endDateElt || dateYYYYMMDD(today);
      
      window.Litepicker && (new Litepicker({
        element: document.getElementById('datepicker-filter'),
        autoApply: false,
        singleMode: false,
        buttonText: {
          apply: "Áp dụng",
          cancel: "Huỷ",
          previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
          nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
        },
        plugins: ['keyboardnav', 'mobilefriendly', 'ranges'],
        ranges: {
          customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước", "Toàn thời gian"],
        },
        startDate: startDate,
        endDate: endDate,
        format: 'YYYY/M/D',
        setup: (picker) => {
          picker.on('button:apply', (start, end) => {
            const startDateSelected = start.format('YYYY-MM-DD');
            const endDateSelected = end.format('YYYY-MM-DD');
  
            document.getElementById('start_date').value = startDateSelected;
            document.getElementById('end_date').value = endDateSelected;
  
          });
        },
        lang: 'vi'
      }));
    });
    // @formatter:on
</script>
@endpush