@extends('layouts.admin')

@section('title', __('Admin: STU'))

@php
    $user = is_numeric(request('user')) ? \App\Models\User::find(request('user')) : null;
@endphp

@if ($user)
@section('note')
    Bạn đang xem liên kết của người dùng "<strong>{{ $user->name }}</strong>".
@endsection
@endif


@section('content')

<div class="row row-deck">
    <div class="col-12 mb-4">
        <div class="card p-3">
            <form action="" method="GET">
                <input type="text" name="user" value="{{ request('user') }}" hidden>
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="keyword">Tìm kiếm</label>
                        <input type="text" id="keyword" name="keyword"
                            value="{{ old('keyword', request('keyword')) }}" placeholder="Bí danh (alias).."
                            class="form-control">
                    </div>
                    <div class="col-sm-3 mb-2">
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

                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="level">Cấp độ</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">[-- Chọn cấp độ --]</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}" @selected(old('level', request('level')) == $level->id)>{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="view">Lượt xem</label>
                        <input type="text" id="view" name="view" value="{{ old('view', request('view')) }}"
                            placeholder="e.g. >10" class="form-control">
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="revenue">Thu nhập</label>
                        <input type="text" id="revenue" name="revenue"
                            value="{{ old('revenue', request('revenue')) }}" placeholder="e.g. =10"
                            class="form-control">
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control"
                            value="{{ old('status', request('status')) }}" autoselection>
                            <option value="">[-- Chọn trạng thái --]</option>
                            <option value="deleted">Xoá mềm</option>
                            <option value="active">Kích hoạt</option>
                        </select>
                    </div>
                    <div class="col-sm-3 d-flex align-items-end gap-1 mb-2">
                        <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                        <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default"
                            onclick="(location.href = location.pathname)">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý liên kết</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th style="white-space: nowrap">{{ __('#ID') }}</th>
                            <th style="white-space: nowrap"><a href="#" class="table-sort" data-sort="sort-name">#Người dùng</a></th>
                            <th style="white-space: nowrap">
                                <a href="{{ sortable_url('admin.popular.stu', 'alias') }}" class="table-sort" data-sort="sort-name">{{ __('links.link') }}</a>
                            </th>
                            <th style="white-space: nowrap"> <a href="{{ sortable_url('admin.popular.stu', 'created_at') }}" class="table-sort" data-sort="sort-name">{{ __('links.date_created') }}</a></th>
                            <th style="white-space: nowrap">{{ __('links.views') }}</th>
                            <th style="white-space: nowrap">{{ __('links.income') }}</th>
                            <th style="white-space: nowrap">{{ __('links.levels') }}</th>
                            <th style="white-space: nowrap">{{ __('Trạng thái') }}</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$links->isEmpty())
                            @foreach ($links as $key => $link)
                                <tr>
                                    <td>{{ $link->id }}</td>
                                    @if (isset($link->user))
                                        <td style="white-space: nowrap">
                                            <a class="badge badge-outline text-blue" target="_blank"
                                                href="{{ route('admin.users.show', $link->user->id) }}">{{ $link->user->name }}</a>
                                        </td>
                                    @else
                                        <td style="white-space: nowrap"><span class="badge badge-outline text-red">Ẩn
                                                danh</span></td>
                                    @endif
                                    <td style="white-space: nowrap"><a
                                            href="{{ Setting::get('stu_url', '') . '/' . $link->alias }}"
                                            target="__blank">{{ Setting::get('stu_url', '') . '/' . $link->alias }}</a>
                                    </td>
                                    <td style="white-space: nowrap">
                                        {{ date('H:i, d/m/Y', strtotime($link->created_at)) }}</td>
                                    <td>{{ $link->stats->sum('clicks') }}</td>
                                    <td>${{ round($link->stats->sum('revenue'), 3) }}</td>
                                    <td><span class="badge bg-azure-lt">{{ $link->level->name }}</span></td>
                                    <td>@if ($link->status == 'deleted')
                                        <span class="badge bg-danger-lt">{{ __('Đã xoá') }}</span>
                                        @else
                                        <span class="badge bg-success-lt">{{ __('Hoạt động') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <button onclick="editSTU(this)" data-alias="{{ $link->alias }}"
                                                data-param="{{ $link->data }}" class="btn"
                                                data-bs-toggle="modal" data-bs-target="#modal-large">
                                                Edit
                                            </button>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    data-alias="{{ $link->alias }}">
                                                    Hành động
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    @if ($link->status == 'active')
                                                    <form action="{{ route('admin.stu.softDelete', $link->alias) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <button  class="dropdown-item" type="submit">Xoá mềm</button>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('admin.stu.restore', $link->alias) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button  class="dropdown-item" type="submit">Khôi phục</button>
                                                    </form>
                                                    @endif

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.access.index').'?link='.$link->id }}">
                                                        Thống kê truy cập
                                                    </a>
                                                </div>
                                            </div>
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
                {{ $links->withQueryString()->links('pagination.tabler') }}
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa liên kết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body stu_cnt" id="eSCtn"></div>
        </div>
    </div>
</div>
<script>
    function editSTU(e) {
        const alias = e.dataset.alias;
        const data = JSON.parse(e.dataset.param || '{}');
        const btn_STU = {};
        const input_STU = {};

        for (let category of ['btn', 'lnk', 'oth']) {
            for (let key in data[category]) {
                btn_STU['g_' + key] = true;
                input_STU[key] = decodeURIComponent(atob(data[category][key]));
            }
        }
        const editSTU2 = new STU({
            select: '#eSCtn',
            type: 'edit',
            data: {
                inp: input_STU,
                outp: btn_STU,
                alias: alias
            }
        });
    }

    function cpLink(element) {
        const link = 'https://link4sub.com/' + element.dataset['alias'];
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = link;
        tempInput.select();
        document.execCommand('copy');
        tempInput.remove();
        Swal.fire({
            title: 'Sao chép liên kết thành công!',
            icon: 'success',
            confirmButtonText: 'Truy cập link',
            showCancelButton: true,
            cancelButtonText: 'Đóng'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(link, '_blank');
            };
        })
    }
</script>

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
