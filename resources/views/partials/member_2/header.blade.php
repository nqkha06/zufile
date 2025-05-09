<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2 fs-md-1"></i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <button class="btn btn-primary ps-4" data-bs-toggle="modal" id="CREATE_NEW"
                data-bs-target="#qk_modal_create_short_link">
                <i class="ki-outline ki-plus fs-1 me-0"></i>
                {{ __('member/partials/header.create_new') }}
            </button>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="
                        menu 
                        menu-rounded  
                        menu-column 
                        menu-lg-row 
                        my-5 
                        my-lg-0 
                        align-items-stretch 
                        fw-semibold
                        px-2 px-lg-0
                    "
                    id="kt_app_header_menu" data-kt-menu="true">
                </div>

                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">

                <!--begin::Chat-->
                <div class="app-navbar-item ms-1 ms-md-4">

                    <!--begin::Menu wrapper-->
                    <span class="d-none d-sm-block">{{ __('member/partials/header.balance') }}</span>
                    <div
                        class="btn btn-icon btn-custom btn-icon-muted w-auto h-35px position-relative btn-outline rounded-4 px-3 ms-3">
                        {{ currencyFormat(Auth::user()?->balance ?? 0) }}
                        <span
                            class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 end-0 animation-blink"></span>
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Chat-->

                <!--begin::Theme mode-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <!--begin::Menu toggle-->
                    <a href="#"
                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                        data-kt-menu-trigger="{default:'click', lg: 'click'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-notification fs-1"></i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-md-400px w-100%" data-kt-menu="true"
                        data-kt-element="theme-mode-menu">
                        <style>

                        </style>
                        <!--begin::Menu item-->
                        <div class="card message">
                            <div class="card-header d-flex justify-content-between align-items-center p-4"
                                style="min-height: 40px">
                                <h3 class="card-title">Thông báo</h3>
                                {{-- <button class="btn btn-sm btn-outline-primary">Đánh dấu đã đọc</button> --}}
                            </div>
                            @php
                                $notifications = [
                                    [
                                        'id' => 1,
                                        'title' => 'Your 133.74 USD USDC payment has been processed and paid',
                                        'content' => '<p><p>Dear Publisher,</p>
                        <p>Please be advised that your requested payment has been processed and paid.
                        </p><p>Payment request details</p><ul><li>Amount: <b>133.74 USD</b></li><li>ID: <b>95662</b></li><li>Date of request: <b>2025-03-03 12:12:06</b></li><li>Payment method: <b>USDC</b></li><li>Payment account: <b>1234</b></li></ul><p></p>
                        
                        <p>If you have any further questions or need any assistance, then please don’t hesitate to <strong><a href="#">contact us.</a></strong></p>

Kind regards,<br>The Link4Sub Team</p>',
                                    ],
                                    [
                                        'id' => 2,
                                        'title' => 'Thông báo 2',
                                        'content' => 'Nội dung thông báo thứ hai: Chi tiết thông báo 2.',
                                        'time' => '2021-09-01 12:00:00',
                                    ],
                                    [
                                        'id' => 3,
                                        'title' => 'Thông báo 3',
                                        'content' => 'Nội dung thông báo thứ ba: Chi tiết thông báo 3.',
                                    ],
                                ];
                            @endphp
                            <style>
                                .NotificationList__messages {
                                    cursor: default;
                                    flex: 1 1 100%;
                                    overflow-y: auto;
                                    padding: 0;
                                    text-align: left;
                                    height: 100%;
                                    max-height: 500px;
                                    margin-bottom: 0;
                                }

                                .NotificationList__messages:last-child {
                                    border-bottom: none;
                                }

                                .NotificationList__message {
                                    box-shadow: inset 0 -1px 0 0 #f2f2f2;
                                    font-size: 14px;
                                    line-height: 20px;
                                    transition: background-color .25s linear;
                                    display: block;
                                }

                                .NotificationList__message:hover {
                                    background-color: #f2f2f2;
                                }

                                .NotificationList__message-title {
                                    color: #000;
                                    font-weight: 700;
                                    cursor: pointer;
                                    padding-top: 10px !important;
                                }

                                .NotificationList__message-date {
                                    color: gray;
                                    font-size: 12px;
                                    line-height: 12px;
                                    margin-top: 0;
                                    padding-bottom: 10px !important;

                                }

                                .NotificationList__message-body {
                                    background: #cecece22;
                                    padding: 10px 15px !important;

                                }

                                .NotificationList__message>div {
                                    padding: 10px 15px;

                                }
                            </style>
                            <div class="card-body p-0">
                                <ul class="NotificationList__messages list-group-flush">
                                    @foreach ($notifications as $notification)
                                        <li class="NotificationList__message">
                                            <div class="NotificationList__message-title" data-bs-toggle="collapse"
                                                data-bs-target="#{{ 'notif_' . $notification['id'] }}"
                                                aria-expanded="true"
                                                aria-controls="{{ 'notif_' . $notification['id'] }}">
                                                {{ $notification['title'] }}
                                            </div>

                                            <div class="NotificationList__message-date">27 Feb at 8:04 am</div>
                                            <div class="NotificationList__message-body collapse mt-2"
                                                id="{{ 'notif_' . $notification['id'] }}" class="collapse show">
                                                {!! $notification['content'] !!}
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="card-footer text-center p-2">
                                {{ __('partials/member/header.view_all_notifications') }}
                            </div>
                        </div>

                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Theme mode-->
                <!--begin::Theme mode-->

                <!--end::Theme mode-->
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px"
                        data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('backend/media/avatars/blank.png') }}" class="rounded-3" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <style>
                        .app-navbar .menu .menu-item .menu-link .menu-title {
                            color: var(--bs-app-sidebar-light-menu-link-color);
                        }
                    </style>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true"
                        >
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-40px me-5">
                                    <img alt="Logo" src="{{ asset('backend/media/avatars/blank.png') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                        <span
                                            class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Member</span>
                                    </div>
                                    <a
                                        class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>

                        <div class="menu-item px-4">
                            <a class="menu-link px-2">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-profile-circle fs-2">

                                    </i>
                                </span>

                                <span class="menu-title">
                                    Hồ sơ
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-4" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">

                            <a class="menu-link px-2">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-icon fs-2"></i>
                                </span>
                                @php
                                    $languages = Language::getSupportedLanguages();
                                    $lang = $languages->where('code', App::currentLocale())->first();
                                @endphp
                                <span class="menu-title position-relative">Ngôn ngữ
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ $lang->name }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('backend/media/flags/' . $lang->flag . '.svg') }}"
                                            alt="{{ $lang->name }}" /></span>
                                </span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                @foreach ($languages as $lang)
                                    <div class="menu-item px-3">
                                        <a href="{{ route('lang.switcher', $lang->code) }}"
                                            class="menu-link d-flex px-5 {{ App::currentLocale() == $lang->code ? 'active' : '' }}">
                                            <span class="menu-icon symbol symbol-20px me-4">
                                                <img class="rounded-1"
                                                    src="{{ asset('/backend/media/flags/' . $lang->flag . '.svg') }}"
                                                    alt="{{ $lang->name }}" />
                                            </span>
                                            <span class="menu-title">{{ $lang->name }}</span>
                                        </a>
                                    </div>
                                @endforeach


                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>

                        <div class="separator my-2"></div>

                        <div class="menu-item px-4">
                            <a class="menu-link px-2">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-moon fs-2"></i>
                                </span>
                                <span class="menu-title position-relative">Chế độ
                                    <span class=" position-absolute translate-middle-y top-50 end-0 d-flex">

                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input h-20px" type="checkbox" role="switch"
                                                id="darkModeToggle">
                                        </div>

                                    </span>
                                </span>
                            </a>
                            <!--begin::Menu sub-->

                            <!--end::Menu sub-->
                        </div>


                        <!--begin::Menu item-->
                        <div class="menu-item px-4 mt-2">
                            <a href="{{ route('auth.logout') }}"
                                class="menu-link px-5 btn btn-outline justify-content-center">
                                {{ __('partials/member/header.logout') }}
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--begin::Aside toggle-->
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
