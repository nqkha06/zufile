@extends('layouts.admin')

@section('title', __('Admin: Người dùng'))

@section('page-header-right')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
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

    <div class="card px-3 pt-3 mb-4">
        <form action="" method="GET">
            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label" for="keyword">Tìm kiếm</label>
                    <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                        placeholder="Nhập từ khoá" class="form-control">
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label" for="date">Ngày giờ</label>
                    <input type="text" id="start_date" name="start_date" value="{{ old('start_date', request('start_date')) }}" hidden>
                    <input type="text" id="end_date" name="end_date" value="{{ old('end_date', request('end_date')) }}" hidden>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                        </span>
                        <input class="form-control" placeholder="Ngày giờ" id="datepicker-filter"/>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label" for="role">Vai trò</label>
                    <select name="role" id="role" class="form-control" value="">
                        <option value="">[-- Chọn vai trò --]</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label" for="sort_by">Sort by</label>
                    <select name="sort_by" id="sort_by" class="form-control" value="">
                        <option value="">[-- Chọn cột --]</option>
                        <option value="id" selected>Id</option>
                        <option value="name" @selected(request('sort_by') == 'name')>Tên đăng nhập</option>
                        <option value="email" @selected(request('sort_by') == 'email')>Địa chỉ Email</option>
                        <option value="created_at" @selected(request('sort_by') == 'created_at')>Ngày tham gia</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label" for="sort_direction">Sort direction</label>
                    <select name="sort_direction" id="sort_direction" class="form-control" value="">
                        <option value="">[-- Chọn method --]</option>
                        <option value="desc" selected>Giảm dần (DESC)</option>
                        <option value="asc" @selected(request('sort_direction') == 'asc')>Tăng dần (ASC)</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-end gap-1 mb-3">
                    <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                    <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default"
                        onclick="(location.href = location.pathname)">
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý người dùng</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Tên đăng nhập</th>
                        <th>Tham gia</th>
                        <th>Số dư</th>
                        <th>Vai trò</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($users) && $users->count())
                    @foreach ($users as $user)
                        <tr>
                            <td data-label="Id."><span>#{{ $user->id }}</span></td>
                            <td data-label="Tên đăng nhập">
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2">{{ substr($user->name, 0, 1) }}</span>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $user->name }}</div>
                                        <div class="text-secondary"><a class="text-reset">{{ $user->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Tham gia">{{ date('H:i, d/m/Y', strtotime($user->created_at)) }}</td>
                            <td data-label="Số dư">{{ formatCurrency($user->balance) }}</td>
                            <td class="text-secondary" data-label="Vai trò">
                                @if (count($user->roles))
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-red text-red-fg">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-blue text-blue-fg">Member</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn">
                                        Edit
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.users.show', $user->id) }}">
                                                Statistic
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforEach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $users->links('pagination.tabler') }}
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