@extends('layouts.admin')

@section('title', __('Quản trị Hệ thống'))

@section('content')
<style>
  .panel-section .panel-section-item .panel-section-item-icon {
    background-color: #f6f8fb;
    border-radius: 4px;
    height: 40px;
    padding: 4px;
    width: 40px;
}
</style>
    <div class="card mb-4 panel-section panel-section-system panel-section-priority-99999" id="panel-section-system-system"
        data-priority="99999" data-id="system" data-group-id="system">
        <div class="card-header">
            <div>
                <h4 class="card-title">
                    Hệ thống
                </h4>

            </div>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <div id="panel-section-item-system-users" data-priority="-9999" data-id="users" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-users panel-section-item-priority--9999">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/users">

                                    Quản trị viên

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và cập nhật người dùng hệ thống của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-roles" data-priority="-9980" data-id="roles" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-roles panel-section-item-priority--9980">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/roles">

                                    Nhóm và phân quyền

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và cập nhật vai trò và quyền của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-request-logs" data-priority="10" data-id="request-logs"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-request-logs panel-section-item-priority-10">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M13 20l7 -7"></path>
                                    <path
                                        d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/request-logs">

                                    Lịch sử lỗi

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và xóa nhật ký yêu cầu hệ thống của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-audit-logs" data-priority="10" data-id="audit-logs"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-audit-logs panel-section-item-priority-10">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M13 20l7 -7"></path>
                                    <path
                                        d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/audit-logs">

                                    Lịch sử hoạt động

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và xóa nhật ký hoạt động hệ thống của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-backup" data-priority="30" data-id="backup" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-backup panel-section-item-priority-30">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3"></path>
                                    <path d="M4 6v6c0 1.657 3.582 3 8 3c.361 0 .716 -.009 1.065 -.026"></path>
                                    <path d="M20 13v-7"></path>
                                    <path d="M4 12v6c0 1.657 3.582 3 8 3"></path>
                                    <path d="M16 22l5 -5"></path>
                                    <path d="M21 21.5v-4.5h-4.5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/backups">

                                    Sao lưu

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Sao lưu cơ sở dữ liệu và thư mục /uploads</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-cronjob" data-priority="50" data-id="cronjob" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-cronjob panel-section-item-priority-50">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M16 3l0 4"></path>
                                    <path d="M8 3l0 4"></path>
                                    <path d="M4 11l16 0"></path>
                                    <path d="M8 15h2v2h-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/settings/cronjob">

                                    Công việc lương thấp

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Cronjob cho phép bạn tự động hóa các lệnh hoặc tập lệnh cụ
                                thể trên trang web của bạn.</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-cache_management" data-priority="1000" data-id="cache_management"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-cache_management panel-section-item-priority-1000">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                    <path d="M12 12l8 -4.5"></path>
                                    <path d="M12 12l0 9"></path>
                                    <path d="M12 12l-8 -4.5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/cache">

                                    Quản lý bộ nhớ đệm

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xóa bộ nhớ đệm để cập nhật trang web của bạn.</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-system_cleanup" data-priority="2000" data-id="system_cleanup"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-system_cleanup panel-section-item-priority-2000">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17l-2 2l2 2"></path>
                                    <path d="M10 19h9a2 2 0 0 0 1.75 -2.75l-.55 -1"></path>
                                    <path d="M8.536 11l-.732 -2.732l-2.732 .732"></path>
                                    <path d="M7.804 8.268l-4.5 7.794a2 2 0 0 0 1.506 2.89l1.141 .024"></path>
                                    <path d="M15.464 11l2.732 .732l.732 -2.732"></path>
                                    <path d="M18.196 11.732l-4.5 -7.794a2 2 0 0 0 -3.256 -.14l-.591 .976"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/cleanup">

                                    Hệ thống dọn dẹp

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Dọn dẹp dữ liệu không sử dụng của bạn trong cơ sở dữ liệu
                            </div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-information" data-priority="9990" data-id="information"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-information panel-section-item-priority-9990">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 9h.01"></path>
                                    <path d="M11 12h1v4h1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/info">

                                    Thông tin hệ thống

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Tất cả thông tin về cấu hình hệ thống hiện tại.</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-updater" data-priority="9999" data-id="updater"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-updater panel-section-item-priority-9999">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/updater">

                                    Cập nhật Hệ thống

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Cập nhật hệ thống của bạn lên phiên bản mới nhất</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card mb-4 panel-section panel-section-system panel-section-priority-99999" id="panel-section-system-system"
        data-priority="99999" data-id="system" data-group-id="system">
        <div class="card-header">
            <div>
                <h4 class="card-title">
                    Phân quyền
                </h4>

            </div>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <div id="panel-section-item-system-users" data-priority="-9999" data-id="users" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-users panel-section-item-priority--9999">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/users">

                                    Vai trò

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và cập nhật người dùng hệ thống của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-roles" data-priority="-9980" data-id="roles" data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-roles panel-section-item-priority--9980">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/system/roles">

                                    Nhóm và phân quyền

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và cập nhật vai trò và quyền của bạn</div>
                        </div>
                    </div>
                </div>
                <div id="panel-section-item-system-request-logs" data-priority="10" data-id="request-logs"
                    data-group-id="system"
                    class="col-12 col-sm-6 col-md-4 panel-section-item panel-section-item-request-logs panel-section-item-priority-10">
                    <div class="row g-3 align-items-start">
                        <div class="col-auto">
                            <div class="d-flex align-items-center justify-content-center panel-section-item-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M13 20l7 -7"></path>
                                    <path
                                        d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-block mb-1 panel-section-item-title">
                                <a class="text-decoration-none text-primary fw-bold"
                                    href="https://qkcms.qkt/admin/request-logs">

                                    Lịch sử lỗi

                                </a>
                            </div>

                            <div class="text-secondary mt-n1">Xem và xóa nhật ký yêu cầu hệ thống của bạn</div>
                        </div>
                    </div>
                </div>
               

            </div>
        </div>
    </div>
@endsection
