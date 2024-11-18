@php
    extract($data)
@endphp

@extends('layouts.admin')

@section('title', __('Admin: Dashboard'))

@section('page-header-right')
<div class="input-icon">
  <span class="input-icon-addon">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
  </span>
  <input class="form-control" placeholder="" id="datepicker-icon-prepend"/>
  </div>
@endsection

@section('content')
<div class="row row-deck row-cards">
  @php
  $STURevenue = $data['stats']['STU']->sum('revenue');
  $NOTERevenue = $data['stats']['NOTE']->sum('revenue');

  $STUViews = $data['stats']['STU']->sum('clicks');
  $NOTEViews = $data['stats']['NOTE']->sum('clicks');

  $STUCpm = $STUViews > 0 ? ($STURevenue/$STUViews)*1000 : 0;
  $NOTECpm = $NOTERevenue > 0 ? ($NOTERevenue/$NOTEViews)*1000 : 0;
  @endphp
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        <div class="d-flex align-items-center">
          <div class="subheader">DOANH THU</div>
        </div>
        <div class="h1 mb-0">${{ round($STURevenue + $NOTERevenue, 3) }}</div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-blue me-2"></span>
              <div class="text-secondary">STU</div>
            </div>
            <div class="fw-bold">${{ round($STURevenue, 3) }}</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-green me-2"></span>
              <div class="text-secondary">NOTE</div>
            </div>
            <div class="fw-bold">${{ round($NOTERevenue, 3) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        <div class="d-flex align-items-center">
          <div class="subheader">LƯỢT XEM</div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-0 me-2">{{ $NOTEViews + $STUViews }}</div>

        </div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-blue me-2"></span>
              <div class="text-secondary">STU</div>
            </div>
            <div class="fw-bold">{{ $STUViews }}</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-green me-2"></span>
              <div class="text-secondary">NOTE</div>
            </div>
            <div class="fw-bold">{{ $NOTEViews }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        <div class="d-flex align-items-center">
          <div class="subheader">CPM</div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-0 me-2">${{ round(($STUCpm + $NOTECpm > 0) ? ($STUCpm + $NOTECpm)/2 : 0, 3)  }}</div>
        </div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-blue me-2"></span>
              <div class="text-secondary">STU</div>
            </div>
            <div class="fw-bold">${{ round($STUCpm, 3) }}</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-green me-2"></span>
              <div class="text-secondary">NOTE</div>
            </div>
            <div class="fw-bold">${{ round($NOTECpm, 3) }}</div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        <div class="d-flex align-items-center">
          <div class="subheader">Liên kết mới</div>
        </div>
        @php
            $STUCount = $data['links']['STU']->count();
            $NOTECount = $data['links']['NOTE']->count();
        @endphp
        <div class="h1 mb-0">{{ $STUCount + $NOTECount }}</div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-blue me-2"></span>
              <div class="text-secondary">STU</div>
            </div>
            <div class="fw-bold">{{ $STUCount }}</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-green me-2"></span>
              <div class="text-secondary">NOTE</div>
            </div>
            <div class="fw-bold">{{ $NOTECount }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        <div class="d-flex align-items-center">
          <div class="subheader">NGƯỜI DÙNG</div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-0 me-2">{{ $data['users']['new'] }}</div>
        </div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-blue me-2"></span>
              <div class="text-secondary">Giới thiệu</div>
            </div>
            <div class="fw-bold">- -</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-green me-2"></span>
              <div class="text-secondary">Trực tiếp</div>
            </div>
            <div class="fw-bold">- -</div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2">
    <div class="card">
      <div class="card-body py-3">
        @php
          $WDCountD = $data['wd']->where('type', 0)->count();
          $WDCountF = $data['wd']->where('type', 1)->count();
        @endphp
        <div class="d-flex align-items-center">
          <div class="subheader">ĐƠN RÚT</div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-0 me-2">{{ $WDCountD + $WDCountF }}</div>
        </div>
        <div class="d-flex mt-3 justify-content-between flex-column">
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-red me-2"></span>
              <div class="text-secondary">Nhanh</div>
            </div>
            <div class="fw-bold">{{ $WDCountF }}</div>
          </div>
          <div class="d-flex justify-content-between fs-5">
            <div class="d-flex align-items-center">
              <span class="bullet bg-cyan me-2"></span>
              <div class="text-secondary">Bình thường</div>
            </div>
            <div class="fw-bold">{{ $WDCountD }}</div>
          </div>
        </div>
      </div>
      {{-- <div id="chart-revenue-bg" class="chart-sm"></div> --}}
    </div>
  </div>

  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs flex-row-reverse" data-bs-toggle="tabs">
          <li class="nav-item">
            <a href="#tabs-home-ex4" class="nav-link" data-bs-toggle="tab">
              <svg class="icon" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-notes"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M9 7l6 0" /><path d="M9 11l6 0" /><path d="M9 15l4 0" /></svg>
              </a>
          </li>
          <li class="nav-item">
            <a href="#tabs-profile-ex4" class="nav-link active" data-bs-toggle="tab">
              <svg class="icon" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-square-rounded"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" /><path d="M10 11v-2a2 2 0 1 1 4 0v2" /></svg>
              </a>
          </li>
          <li class="nav-item me-auto" role="presentation">
            <h3 class="card-title">Liên kết phổ biến</h3>
          </li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane" id="tabs-home-ex4">
          <div class="table-responsive">
            <table class="table table-vcenter">
              <thead>
                <tr>
                  <th>#Người dùng</th>
                  <th>#Liên kết</th>
                  <th>#Lượt xem</th>
                  <th>#Thu nhập</th>
                  <th>#Cấp độ</th>
                </tr>
              </thead>
              @foreach ($data['links']['popNOTE'] as $key=>$val)
              <tr>
                <td class="text-secondary"><a href="{{ route('admin.users.show', $val->user->id) }}">{{ $val->user->name }}</a></td>
                <td class="text-secondary">{{ $val->total_clicks }}</td>

                <td>
                  {{ Setting::get('note_url', '') }}/{{ $val->alias }}
                  <a href="{{ route('note.show', $val->alias) }}" target="_blank" class="ms-1" aria-label="Open website">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                  </a>
                </td>
                <td class="text-secondary">{{ $val->total_clicks }}</td>
                <td class="text-secondary">${{ round($val->total_revenue, 3) }}</td>
                <td class="text-secondary">{{ isset($val->level->name) ? $val->level->name : '' }}</td>

              </tr>
              @endforeach
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {{ $data['links']['popNOTE']->links('pagination.tabler') }}
          </div>
        </div>
        <div class="tab-pane active show" id="tabs-profile-ex4">
          <div class="table-responsive">
            <table class="table table-vcenter">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Người tạo</th>
                  <th>Bí danh</th>
                  <th>Cấp độ</th>
                  <th>Lượt xem</th>
                  <th>Thu nhập</th>
                </tr>
              </thead>
              @if ($data['links']['popSTU']->count() > 0)
              @foreach ($data['links']['popSTU'] as $key=>$val)
              <tr>
                <td class="text-secondary">{{ ++$key }}</td>
                <td class="text-secondary"><a target="_blank" href="{{ route('admin.users.show', $val->user->id) }}">{{ $val->user->name }}</a></td>

                <td>
                  <a href="{{ route('admin.stu.show', $val->id) }}">{{ route('stu.show', $val->alias) }}</a>
                  <a href="{{ route('stu.show', $val->alias) }}" target="_blank" class="ms-1" aria-label="Open website">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                  </a>
                </td>
                <td class="text-secondary">{{ $val->level->name }}</td>
                <td class="text-secondary">{{ $val->total_clicks }}</td>
                <td class="text-secondary">${{ round($val->total_revenue, 3) }}</td>
              </tr>
              @endforeach 
              @else
              <tr>
                <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
              </tr>
              @endif
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {{ $data['links']['popSTU']->links('pagination.tabler') }}
          </div>

        </div>
      </div>
    </div>

  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex">
          <h3 class="card-title">Số liệu thống kê</h3>

        </div>
        <div id="chart-statistics"></div>
      </div>
      <div class="table-responsive border-top">
        <table class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th>Ngày</th>
              <th>Lượt xem</th>
              <th>Thu nhập</th>
              <th>CPM</th>
              <th class="w-1"></th>
            </tr>
          </thead>
          <tbody>
            @php
            $__labels = $data['dataChart']['stats']['labels'];
            $__data = $data['dataChart']['stats']['data'];
            @endphp

            @for ($i = 0; $i < count($__labels); $i++)
            <tr>
              <td style="white-space: nowrap">{{ $__labels[$i] }}</td>
              <td>{{ array_sum([$__data['visits']['STU'][$i], $__data['visits']['NOTE'][$i]]) }}</td>
              <td>${{ array_sum([$__data['revenue']['STU'][$i], $__data['revenue']['NOTE'][$i]]) }}</td>
              <td>${{ ($__data['cpm']['STU'][$i] + $__data['cpm']['NOTE'][$i])/2 }}</td>
              <td>
                <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Báo cáo chi tiết" data-bs-original-title="Báo cáo chi tiết">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path><path d="M18 14v4h4"></path><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M8 11h4"></path><path d="M8 15h3"></path></svg>
                </a>
              </td>
            </tr>
            @endfor
          
          </tbody>
        </table>
      </div>

      <div class="card-footer d-flex align-items-center">

      </div>
    </div>
  </div>

</div>
@php
$dataChart = $data['dataChart']['stats'];
@endphp
@endsection
@push('scripts')
<script>
  // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
    const chartStatsLabels = JSON.parse('{!! json_encode($dataChart['labels']) !!}');
    const chartStatsData = JSON.parse('{!! json_encode($dataChart['data']) !!}');
    console.log(chartStatsData);
    window.ApexCharts && (new ApexCharts(document.getElementById('chart-statistics'), {
      chart: {
        type: "line",
        fontFamily: 'inherit',
        height: 350,
        parentHeightOffset: 0,
        toolbar: {
          show: false,
        },
        animations: {
          enabled: true
        },
      },
      fill: {
        opacity: 1,
      },
      stroke: {
        width: 2,
        lineCap: "round",
        curve: "smooth",
      },
      series: [{
        name: "Thu nhập STU",
        data: chartStatsData.revenue.STU
      },{
        name: "Lượt xem STU",
        data: chartStatsData.visits.STU
      },{
        name: "CPM STU",
        data: chartStatsData.cpm.STU
      },{
        name: "Thu nhập NOTE",
        data: chartStatsData.revenue.NOTE
      },{
        name: "Lượt xem NOTE",
        data: chartStatsData.visits.NOTE
      },{
        name: "CPM NOTE",
        data: chartStatsData.cpm.NOTE
      }],
      tooltip: {
        theme: 'dark'
      },
      grid: {
        padding: {
          top: -20,
          right: 0,
          left: -4,
          bottom: -4
        },
        strokeDashArray: 4,
        xaxis: {
          lines: {
            show: true
          }
        },
      },
      xaxis: {
        labels: {
          padding: 0,
        },
        tooltip: {
          enabled: false
        },
        type: 'datetime',
      },
      yaxis: {
        labels: {
          padding: 4
        },
      },
      labels: chartStatsLabels,
      colors: [tabler.getColor("facebook"), tabler.getColor("twitter"), tabler.getColor("dribbble")],
      legend: {
        show: true,
        position: 'bottom',
        offsetY: 12,
        markers: {
          width: 10,
          height: 10,
          radius: 100,
        },
        itemMargin: {
          horizontal: 8,
          vertical: 8
        },
      },
    })).render();
  });
  // @formatter:on
</script>
<script>
  // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();

    function dateYYYYMMDD(date) {
      return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
    }
    function paramExists(name) {
        const searchParams = new URLSearchParams(window.location.search);
        return searchParams.has(name);
    }
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

          if (paramExists('startDate')) {
              search.set('startDate', startDateSelected);
          } else {
              search.append('startDate', startDateSelected);
          }

          if (paramExists('endDate')) {
              search.set('endDate', endDateSelected);
          } else {
              search.append('endDate', endDateSelected);
          }

          window.location.href = `${window.location.pathname}?${search.toString()}`;
        });
      },
      lang: 'vi'
    }));
  });
  // @formatter:on
</script>
@endpush