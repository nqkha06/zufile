<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <base href="../" />
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ URL('/') }}/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL('/') }}/backend/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL('/') }}/backend/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL('/') }}/backend/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ Setting::get('web_favicon') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Setting::get('web_favicon') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Setting::get('web_favicon') }}">
    <link rel="shortcut icon" href="{{ Setting::get('web_favicon') }}">
    <link href="{{ URL('/') }}/css/stu.css?v={{time()}}" rel="stylesheet">
    <link href="{{ URL('/') }}/css/notyf.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/ckeditor.css" rel="stylesheet">
    @stack('styles')

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="false"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('partials.member_2.header')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('partials.member_2.sidebar')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        @include('partials.member_2.toolbar')
                        @include('partials.member_2.alert')

                        @yield('content')
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('partials.member_2.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->
    @stack('modals')

    <!--begin::Modal - Create App-->
    <div class="modal fade" id="qk_modal_create_short_link" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <!--begin::Modal content-->
            <form class="modal-content" id="qk_create_link_form" class="form">
                <div class="modal-header justify-content-end border-0 pb-0">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>                </div>
                    <!--end::Close-->
                </div>
              
                <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Tạo mới</h1>
    
                        <div class="text-muted fw-semibold fs-5">
                            Tạo liên kết không giới hạn thôi nào <a href="#" class="link-primary fw-bold">Link4Subbb</a>.
                        </div>
                    </div>
                    <!--end::Heading-->
    
                    <!--begin::Plans-->
                    <div class="d-flex flex-column">
                        <!--begin::Nav group-->
                        <div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true" data-kt-initialized="1">
                            <button class="btn btn-color-gray-500 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">
                                STU
                            </button>
                            <button class="btn btn-color-gray-500 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">
                                NOTE
                            </button>
                        </div>
                        <!--end::Nav group-->
    
                        <!--begin::Row-->                             
                        <div class="row mt-10">
                            <div id="CREATE_STU"></div>

                        </div> 
                        <!--end::Row-->
                    </div>   
                    <!--end::Plans-->                 
    
                    <!--begin::Actions-->
                 
                    <!--end::Actions-->      
                </div>

            </form>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create App-->

    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "backend/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->

    <script src="{{ URL('/') }}/backend/plugins/global/plugins.bundle.js"></script>
    <script src="{{ URL('/') }}/backend/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    <script src="{{ URL('/') }}/backend/plugins/custom/datatables/datatables.bundle.js"></script>

    @include('partials.stu.config')

<script src="{{ asset("backend/dist/libs/sweetalert2/dist/sweetalert2.all.min.js")}}"></script>

<!-- SCRIPT !-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById('darkModeToggle');
        
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute("data-bs-theme", "dark");
            toggle.checked = true;
        }
    
        toggle.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.setAttribute("data-bs-theme", "dark");
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute("data-bs-theme", "light");
                localStorage.setItem('theme', 'light');
            }
        });
    });
    </script>
<script>
    
    const STULv = [
        @forEach($levels as $key=>$value)
        {
            id: '{{ $value['id'] }}',
            name: '{{ $value?->translation()?->name }}',
            minimumPages: '{{ $value['minimum_pages'] }}',
        },
        @endforEach
    ];
    const NOTELv = [
        @forEach($note_levels as $key=>$value)
        {
            id: '{{ $value['id'] }}',
            name: '{{ $value['name'] }}',
        },
        @endforEach
    ];
    document.addEventListener("DOMContentLoaded", function () {
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/notyf.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/create-link.js?v={{time()}}` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/ckeditor/ckeditor.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/ckeditor/translations/{{ Lang::getLocale() }}.js` }));

        const CREATE_NEW_BTN = document.getElementById('CREATE_NEW');
        if (CREATE_NEW_BTN) {
            CREATE_NEW_BTN.addEventListener('click', function () {
                const CREATE_STU = new STU({
                    select: '#CREATE_STU',
                    type: 'create',
                });
                // const CREATE_NOTE = new NOTE({
                //     select: '#CREATE_NOTE',
                //     type: 'create',
                // });
            }, { once: true })
        }
        
        const labelsCreate = document.querySelectorAll('[for="forCreate"]');
        if (labelsCreate.length) {
            labelsCreate.forEach((label) => {
                label.addEventListener('click', function () {
                    document.body.classList.toggle('no-scroll')
                })
            })
        }
    });
    
    function logout() {
        Swal.fire({title: "Bạn có chắc không?", text: "Bạn có chắc chắn muốn đăng xuất tài khoản này không?", icon: 'warning', showCancelButton: true, confirmButtonColor: "#195afe", confirmButtonText: "Chắc chắn!",cancelButtonText: "Huỷ"}).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{route('auth.logout')}}'
            }
        })
    }
</script>
    <!--end::Custom Javascript-->
    @stack('scripts')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
