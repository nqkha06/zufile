@extends('layouts.admin')

@section('title', __('Admin: TOP USERS'))

@section('content')
    <div class="card px-3 pt-3 mb-4">
        <form action="" method="GET">
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label class="form-label" for="keyword">Tìm kiếm</label>
                    <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                        placeholder="Nhập từ khoá" class="form-control">
                </div>

                <div class="col-sm-2 mb-3">
                    <label class="form-label" for="sort_column">Sort column</label>
                    <select name="sort_column" id="sort_column" class="form-control" value="">
                        <option value="-1">[-- Chọn cột --]</option>
                        <option value="id" @selected(request('id') == 'id')>Id</option>
                        <option value="name" @selected(request('sort_column') == 'name')>Tên đăng nhập</option>
                        <option value="email" @selected(request('sort_column') == 'email')>Địa chỉ Email</option>
                        <option value="balance" selected>Số dư</option>
                        <option value="total_revenue" @selected(request('sort_column') == 'total_revenue')>Tổng doanh thu</option>
                        <option value="total_amount" @selected(request('sort_column') == 'total_amount')>Tổng thanh toán</option>
                        <option value="total_clicks" @selected(request('sort_column') == 'total_clicks')>Tổng lượt xem</option>
                    </select>
                </div>
                <div class="col-sm-2 mb-3">
                    <label class="form-label" for="sort_direction">Sort direction</label>
                    <select name="sort_direction" id="sort_direction" class="form-control" value="">
                        <option value="-1">[-- Chọn direction --]</option>
                        <option value="desc" selected>Giảm dần (DESC)</option>
                        <option value="asc" @selected(request('sort_direction') == 'asc')>Tăng dần (ASC)</option>
                    </select>
                </div>
                <div class="col-sm-2 d-flex align-items-end gap-1 mb-3">
                    <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                    <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default"
                        onclick="(location.href = location.pathname)">
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Top users</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Tên</th>
                        <th>Tổng lượt xem</th>
                        <th>Tổng doanh thu</th>
                        <th>Tổng thanh toán</th>
                        <th class="w-1">Số dư hiện tại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td data-label="Id."><span>#{{ $user['data_user']['id'] }}</span></td>
                            <td data-label="Tên đăng nhập">
                                <div class="d-flex py-1 align-items-center">
                                    <span class="avatar me-2">{{ substr($user['data_user']['name'], 0, 1) }}</span>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $user['data_user']['name'] }} <a
                                                href="{{ route('admin.users.show', $user['data_user']['id']) }}"
                                                target="_blank" class="ms-1" aria-label="Open website">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M9 15l6 -6"></path>
                                                    <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                                                    <path
                                                        d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                                                    </path>
                                                </svg>
                                            </a></div>
                                        <div class="text-secondary"><a
                                                class="text-reset">{{ $user['data_user']['email'] }}</a></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Tổng lượt xem">
                                {{ $user['data_metric']['total_clicks'] }}
                            </td>
                            <td data-label="Tổng doanh thu">
                                ${{ $user['data_metric']['total_revenue'] }}
                            </td>
                            <td data-label="Tổng thanh toán">
                                ${{ $user['data_metric']['total_withdraw'] }}
                            </td>
                            <td data-label="Số dư">
                                ${{ $user['data_metric']['balance'] }}
                            </td>
                        </tr>
                    @endforEach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $users->links('pagination.tabler') }}
        </div>
    </div>

@endsection
