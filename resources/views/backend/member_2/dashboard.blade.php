@extends('layouts.member_2')

@section('title', __('member/dashboard.title'))

@section('actions')
<div id="datepicker" class="btn btn-outline btn-light d-flex align-items-center px-4">
    <div class="text-gray-600 fw-bold" id="date-range-display">{{ __('member/dashboard.loading_date') }}</div>
    <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
        <span class="path4"></span>
        <span class="path5"></span>
        <span class="path6"></span>
    </i>
</div>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="row gy-5 gx-xl-10">
            {{-- Tổng lượt xem --}}
            <div class="col-sm-6 col-xl-3 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <i class="ki-duotone ki-compass fs-2hx text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $statistic['total_clicks'] }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-500">{{ __('member/dashboard.view') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Doanh thu --}}
            <div class="col-sm-6 col-xl-3 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <i class="ki-duotone ki-dollar fs-2hx text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ formatCurrency($statistic['total_revenue']) }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-500">{{ __('member/dashboard.revenue') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CPM --}}
            <div class="col-sm-6 col-xl-3 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <i class="ki-duotone ki-percentage fs-2hx text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ formatCurrency($statistic['cpm']) }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-500">{{ __('member/dashboard.cpm') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Thu nhập giới thiệu --}}
            <div class="col-sm-6 col-xl-3 mb-xl-10 mb-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <i class="ki-duotone ki-percentage fs-2hx text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ currencyFormat($statistic['total_referral']) }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-500">{{ __('member/dashboard.ref_income') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Thông báo --}}
        <div class="row mb-10">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('member/dashboard.announcement') }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ __('member/dashboard.announcement_content') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Thống kê --}}
        <div class="row g-5">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('member/dashboard.statistics') }}</h3>
                        @php $paginatedReport = $statistic['paginatedReport']; @endphp
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>{{ __('member/dashboard.dates') }}</th>
                                    <th>{{ __('member/dashboard.views') }}</th>
                                    <th>{{ __('member/dashboard.incomes') }}</th>
                                    <th>{{ __('member/dashboard.ref_incomes') }}</th>
                                    <th>{{ __('member/dashboard.cpms') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($paginatedReport->count())
                                    @foreach ($paginatedReport as $key=>$val)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $key }}</td>
                                            <td>{{ $val['clicks'] }}</td>
                                            <td>${{ $val['revenue'] }}</td>
                                            <td>${{ $val['referral'] }}</td>
                                            <td>${{ $val['cpm'] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="20">{{ __('member/dashboard.no_data') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $paginatedReport->links('pagination.metronic') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const langDatePicker = @json(__('plugins/daterangepicker'));

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
    
    $('#datepicker').daterangepicker({
        startDate: startDate,
        endDate: endDate,
        locale: {
        applyLabel: langDatePicker.applyLabel,
        cancelLabel: langDatePicker.cancelLabel,
        fromLabel: langDatePicker.fromLabel,
        toLabel: langDatePicker.toLabel,
        format: langDatePicker.format,
        weekLabel: langDatePicker.weekLabel,
        daysOfWeek: langDatePicker.daysOfWeek,
        monthNames: langDatePicker.monthNames,
        customRangeLabel: langDatePicker.customRangeLabel,
        firstDay: langDatePicker.firstDay,
    },
    ranges: {
        [langDatePicker.ranges.today]: [moment(), moment()],
        [langDatePicker.ranges.yesterday]: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        [langDatePicker.ranges.last_7_days]: [moment().subtract(6, 'days'), moment()],
        [langDatePicker.ranges.last_30_days]: [moment().subtract(29, 'days'), moment()],
        [langDatePicker.ranges.this_month]: [moment().startOf('month'), moment().endOf('month')],
        [langDatePicker.ranges.last_month]: [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    },
    }, function(start, end) {
    const search = new URLSearchParams(window.location.search);
    const startDateSelected = start.format('YYYY-MM-DD');
    const endDateSelected = end.format('YYYY-MM-DD');

    // Cập nhật tham số trong URL
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

    let initialDisplayText = langDatePicker.display.this_month;

    const firstDayOfMonth = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 1));
    const yesterdayDate = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1));
    const sevenDaysAgo = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), today.getDate() - 6));
    const thirtyDaysAgo = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), today.getDate() - 29));
    const firstDayOfLastMonth = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth() - 1, 1));
    const lastDayOfLastMonth = dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 0));

    if (startDate === dateYYYYMMDD(today)) {
        initialDisplayText = langDatePicker.display.today;
    } else if (startDate === yesterdayDate) {
        initialDisplayText = langDatePicker.display.yesterday;
    } else if (startDate === sevenDaysAgo && endDate === dateYYYYMMDD(today)) {
        initialDisplayText = langDatePicker.display.last_7_days;
    } else if (startDate === thirtyDaysAgo && endDate === dateYYYYMMDD(today)) {
        initialDisplayText = langDatePicker.display.last_30_days;
    } else if (startDate === firstDayOfMonth) {
        initialDisplayText = langDatePicker.display.this_month;
    } else if (startDate === firstDayOfLastMonth && endDate === lastDayOfLastMonth) {
        initialDisplayText = langDatePicker.display.last_month;
    } else {
        initialDisplayText = langDatePicker.display.custom;
    }

document.getElementById('date-range-display').innerText = initialDisplayText;

  </script>
  
@endpush
