@extends('layouts.admin')

@section('title', __('Admin: Thống kê Truy cập'))
@section('content')
<div class="row row-deck row-cards">

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lọc</h3>
        </div>
        <form action="" class="card-body" method="GET">
            <div class="row">
              <div class="col-sm-3">
                <label class="form-label">Khoảng ngày:</label>
  
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                  </span>
                  <input class="form-control" name="date_range" placeholder="" id="datepicker-icon-prepend"/>
                  </div>
              </div>
              <div class="col-sm-2 mb-3">
                <label class="form-label" for="type">Sắp sếp theo: </label>
                <select name="type" id="type" class="form-control" value="" autoselection="">
                    <option value="">[-- Chọn cột --]</option>
                    <option value="views">Lượt xem</option>
                    <option value="revenue">Doanh thu</option>
                    <option value="cpm">CPM</option>
                    <option value="label">Label</option>
                </select>
              </div>
              <div class="col-sm-2 mb-3">
                <label class="form-label" for="type">Kiểu sắp xếp: </label>
                <select name="type" id="type" class="form-control" value="" autoselection="">
                    <option value="">[-- Chọn kiểu --]</option>
                    <option value="asc">Tăng dần</option>
                    <option value="desc">Giảm dần</option>
  
                </select>
              </div>
  
              <div class="col-sm-2 mb-3">
                <label class="form-label" for="group_by">Nhóm theo: </label>
                <select name="group_by" id="group_by" class="form-control" value="" autoselection="">
                    <option value="">[-- Root --]</option>
                    <option value="date">NGÀY</option>
                    <option value="user">NGƯỜI DÙNG</option>
                    <option value="referral">URL GIỚI THIỆU</option>
                    <option value="country">QUỐC GIA</option>
                    <option value="browser">TRÌNH DUYỆT</option>
                    <option value="device">THIẾT BỊ</option>
                    <option value="platform">HỆ ĐIỀU HÀNH</option>
                    <option value="detection">VPN/PROXY</option>
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
        <div class="card-body">
          <div class="d-flex">
            <h3 class="card-title">Số liệu thống kê</h3>
            {{-- <td>{{ dd($accessData) }}</td> --}}
  
          </div>
        </div>
        <div class="table-responsive border-top">
          <table class="table table-vcenter card-table table-striped">
            <thead>
   
              <tr>
                <th>Tên.</th>
                <th>Lượt xem</th>
                <th>Thu nhập</th>
                <th>CRM</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($levelStat as $key=>$val)
              <tr>
   
                <td>{{ $val->level_name }}</td>
                <td>${{ round($val->total_revenue, 3) }}</td>
                <td>${{ round($val->total_revenue, 3) }}</td>
                <td class="text-end">{{ $val->total_revenue }}</td>
              </tr>
              @endforeach
            
            </tbody>
          </table>
        </div>
  
        {{-- <div class="card-footer d-flex align-items-center">
          {{ $accessData->links('pagination.tabler') }}
        </div> --}}
      </div>
    </div>
  
  </div>
  
  <script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
      const today = new Date();
  
      function dateYYYYMMDD(date) {
        return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
      }
      // function paramExists(name) {
      //     const searchParams = new URLSearchParams(window.location.search);
      //     return searchParams.has(name);
      // }
      function getQueryParams() {
            const params = {};
            window.location.search.substring(1).split('&').forEach(param => {
                const [key, value] = param.split('=');
                params[key] = decodeURIComponent(value);
            });
            return params;
        }
  
      const queryParams = getQueryParams();
      const startDate = queryParams.startDate || dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 1));
      const endDate = queryParams.endDate || dateYYYYMMDD(today);
  
      window.Litepicker && (new Litepicker({
        element: document.getElementById('datepicker-icon-prepend'),
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
          customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước"]
        },
        startDate: startDate,
        endDate: endDate,
        format: 'YYYY/M/D',
        setup: (picker) => {
          picker.on('button:apply', (start, end) => {
            const startDateSelected = start.format('YYYY-MM-DD');
            const endDateSelected = end.format('YYYY-MM-DD');
            const search = new URLSearchParams(window.location.search);
          });
        },
        lang: 'vi'
      }));
    });
    // @formatter:on
  </script>
  
@endsection