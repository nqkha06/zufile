<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="300px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('member.index')}} ">
            <div class="app-sidebar-logo-default theme-light-show">
                <div class="d-flex justify-content-center align-items-center">
                    <img alt="Logo" class="" src="{{ Setting::get('web_favicon') }}"
                    style="width:35px;height:35px !important;border-radius:6px" />
                    <h1 class="m-0 fs-2 ms-2">{{ Setting::get('web_name', env('APP_NAME')) }}</h1>
                </div>
            </div>
            <div class="app-sidebar-logo-default theme-dark-show">
                <div class="d-flex justify-content-center align-items-center">
                    <img alt="Logo" class="" src="{{ Setting::get('web_favicon') }}"
                    style="width:35px;height:35px !important;border-radius:6px" />
                    <h1 class="m-0 fs-2 ms-2">{{ Setting::get('web_name', env('APP_NAME')) }}</h1>
                </div>
            </div>
            <div class="app-sidebar-logo-minimize theme-light-show">
                <img alt="Logo" src="{{ Setting::get('web_favicon') }}"
                    style="width:35px;height:35px !important;border-radius:6px" />
            </div>
            <div class="app-sidebar-logo-minimize theme-dark-show">
                <img alt="Logo" src="{{ Setting::get('web_favicon') }}"
                    style="width:35px;height:35px !important;border-radius:6px" />
            </div>

        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
                if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                    1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                    2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                    3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                    4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
                }
        -->
 
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-black-left-line fs-3 rotate-180"></i>
        </div>

  
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                     data-kt-menu="true" data-kt-menu-expand="false">
                     
                    @foreach (config('member.sidebar') as $item)
                        @if (!isset($item['children']))
                            @php
                                $activeRoutes = $item['active'] ?? [$item['url']];
                                $active = false;
                                foreach ($activeRoutes as $pattern) {
                                    if (request()->routeIs($pattern)) {
                                        $active = true;
                                        break;
                                    }
                                }
                            @endphp
                            <div class="menu-item">
                                <a class="menu-link {{ $active ? 'active' : '' }}" href="{{ route($item['url']) }}">
                                    <span class="menu-icon">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </span>
                                    <span class="menu-title">
                                        {{ __($item['title']) }}
                                        @if (isset($item['badge']))
                                            <span class="{{ $item['badge_class'] ?? 'badge badge-secondary' }}">
                                                {{ $item['badge'] }}
                                            </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                        @else
                            @php
                                $parentActive = false;
                                foreach ($item['children'] as $child) {
                                    $activeRoutes = $child['active'] ?? [$child['url']];
                                    foreach ($activeRoutes as $pattern) {
                                        if (request()->routeIs($pattern)) {
                                            $parentActive = true;
                                            break 2;
                                        }
                                    }
                                }
                            @endphp
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $parentActive ? 'show' : '' }}">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </span>
                                    <span class="menu-title">
                                        {{ __($item['title']) }}
                                        @if (isset($item['badge']))
                                            <span class="ms-2 {{ $item['badge_class'] ?? 'badge badge-secondary' }}">
                                                {{ $item['badge'] }}
                                            </span>
                                        @endif
                                    </span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    @foreach ($item['children'] as $child)
                                        @php
                                            $activeRoutes = $child['active'] ?? [$child['url']];
                                            $childActive = false;
                                            foreach ($activeRoutes as $pattern) {
                                                if (request()->routeIs($pattern)) {
                                                    $childActive = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class="menu-item">
                                            <a class="menu-link {{ $childActive ? 'active' : '' }}" href="{{ route($child['url']) }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">
                                                    {{ __($child['title']) }}
                                                    @if (isset($child['badge']))
                                                        <span class="{{ $child['badge_class'] ?? 'badge badge-secondary' }}">
                                                            {{ $child['badge'] }}
                                                        </span>
                                                    @endif
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
        
                    <!-- Các mục menu khác ở đây ... -->
                    
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        @if (auth()->user()->hasRole('super-admin'))
        <a href="{{ route('admin.index') }}" target="_blank" class="mb-10 btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip"
        data-bs-trigger="hover" data-bs-dismiss-="click" title="Khu vực Admin">
            <span class="btn-label">Khu vực Admin</span>
            <i class="ki-outline ki-document btn-icon fs-2 m-0"></i>
        </a>
        
        @endif

        <a href="https://t.me/qckha06" target="_blank" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Có thắc hãy liên hệ với chúng tôi ngay">
            <span class="btn-label">Liên hệ Telegram</span>
            <i class="ki-outline ki-document btn-icon fs-2 m-0"></i>
        </a>
    </div>
    <!--end::Footer-->
</div>
