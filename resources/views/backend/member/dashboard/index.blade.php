@extends('layouts.member')

@section('title', __('overview.title'))

@section('content')

    <style>
</style>
    <div data-cgroup="g_lnk3" class="grp grp--a">
        <div class="grp__item" data-group="g_lnk3" style="--clr:#00cd4d">
            <label class="grp__label" for="i_lnk3">Link #1</label>
            <div class="grp__input-wrapper">
                <input class="grp__input grp__input--text stu_fi" id="i_lnk3t" type="text" name="lnk3t" placeholder="Nhập tên nút #3.. (tùy chọn)" data-in="file">
                <span class="grp__icon grp__icon--left"><svg fill="currentColor" viewBox="0 0 24 24"><path d="M5,4V7H10.5V19H13.5V7H19V4H5Z"></path></svg></span>
                <span class="grp__icon grp__icon--right"><svg fill="currentColor" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"></path></svg></i>
            </div>
        </div>
        <div class="grp__item" data-group="g_lnk3" style="--clr:#00cd4d">
            <label class="grp__label" for="i_lnk3">Link #2</label>
            <div class="grp__input-wrapper">
                <input class="grp__input grp__input--url stu_fi" id="i_lnk3" type="url" name="lnk3" placeholder="Liên kết URL cần chuyển đến #3.." data-req="true" data-in="file" data-link="true" required="">
                <span class="grp__icon grp__icon--left"><svg fill="currentColor" viewBox="0 0 640 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z"></path><path class="fa-secondary" d="M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z"></path></svg></span>
                <span class="grp__icon grp__icon--right"><svg fill="currentColor" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"></path></svg></i>    
            </div>
        </div>
    </div>



    <p class="note">Theo dõi kênh <b>Telegram</b> chính thức của <b>Link4Sub</b> để cập nhật thông tin mới nhất về những
        thay đổi trên trang web trong
        thời gian sắp tới! <a style="color: red" href='https://t.me/link4sub_official' target="_blank">[Tham gia]</a></p>

    <div class="container-anal">
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-eye-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">{{ $statistic['total_clicks'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.view') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-wallet-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">${{ $statistic['total_revenue'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.revenue') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-percent"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">${{ $statistic['cpm'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.cpm') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">0</div>
                    <div class="box-anal-tilte">{{ __('overview.ref_income') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-megaphone"></i></div>
                <div class="title">{{ __('overview.notification') }}</div>
            </div>
        </div>
        <div class="box-container">
            <div class="content">

                {{ __('overview.notifcontent') }}
            </div>
        </div>
    </div>


    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="title">{{ __('overview.report') }}</div>
            </div>
            <div class="top-right">
                <select class="select-month" id="month">
                    @foreach ($statistic['options'] as $option)
                        <option value="{{ $option['value'] }}" {{ $option['selected'] ? 'selected' : '' }}>
                            {{ $option['text'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="box-container">
            <div class="content">

                <div class="dataTable">
                    @php
                        $time = $statistic['time'];
                        $paginatedReport = $statistic['paginatedReport'];
                    @endphp
                    <div class="dataTable-table" style="max-height: 450px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('overview.dates') }}</th>
                                    <th>{{ __('overview.views') }}</th>
                                    <th>{{ __('overview.incomes') }}</th>
                                    <th>{{ __('overview.ref_incomes') }}</th>
                                    <th>{{ __('overview.cpms') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($paginatedReport))
                                    @foreach ($paginatedReport as $key=>$val)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $key }}</td>
                                        <td>{{ $val['clicks'] }}</td>
                                        <td>${{ $val['revenue'] }}</td>
                                        <td>$0</td>
                                        <td>{{ $val['cpm'] }}</td>
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
                    {{ $paginatedReport->links('pagination.default') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const s = document.getElementById("month");
        s.addEventListener("change", function() {
            window.location.href = s.value;
        });
    </script>
@endsection
