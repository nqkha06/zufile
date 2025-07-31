@extends('layouts.admin')

@section('title', __('Config Email'))

@section('content')

    <form method="POST" action="{{ route('admin.system.email_save') }}" accept-charset="UTF-8" id="botble-setting-forms-email-setting-form"
        class="js-base-form dirty-check" section_title="Email"
        section_description="View and update your email settings and email templates" novalidate="novalidate">

        @csrf
        @method('PUT')

        <div class="row mb-5 d-block d-md-flex">
            <div class="col-12 col-md-3">
                <h2>
                    E-mail
                </h2>

                <p class="text-muted">
                    Xem và cập nhật cài đặt email và mẫu email của bạn
                </p>


            </div>

            <div class="col-12 col-md-9">
                @php
                    $index = 0;
                    $emailConfigs = [];
                @endphp
                <div id="email-config-list">
                    {{-- @foreach ($emailConfigs as $index => $config)
            @include('admin.settings.partials.email_config', ['index' => $index, 'config' => $config])
        @endforeach
        @if ($emailConfigs->isEmpty())
            @include('admin.settings.partials.email_config', ['index' => 0, 'config' => []])
        @endif --}}
                    @include('backend.admin.system.partials.email_config', ['index' => 0, 'config' => []])

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-9 offset-md-3">
                <button class="btn btn-primary" type="submit" form="botble-setting-forms-email-setting-form">
                    <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M14 4l0 4l-6 0l0 -4"></path>
                    </svg>
                    Lưu cài đặt
                </button>

                <button class="btn btn-success" type="button" id="add-email-config">
                    Thêm cấu hình email
                </button>
            </div>
        </div>


    </form>

    <div class="mt-5">
        <div class="row mb-5 d-block d-md-flex">
            <div class="col-12 col-md-3">
                <h2>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Trạng thái mẫu email</font>
                    </font>
                </h2>

                <p class="text-muted">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Bật/tắt mẫu email</font>
                    </font>
                </p>


            </div>

            <div class="col-12 col-md-9">
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Mẫu cơ sở
                                    </font>
                                </font>
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="w-25">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Bản mẫu
                                            </font>
                                        </font>
                                    </th>

                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Sự miêu tả
                                            </font>
                                        </font>
                                    </th>

                                    <th class="text-end">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Hoạt động
                                            </font>
                                        </font>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Tiêu đề mẫu email
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu tiêu đề email
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="core_base_header_status" type="hidden" value="0">
                                            <input class="form-check-input" name="core_base_header_status" type="checkbox"
                                                value="1" id="core_base_header_status" disabled="disabled"
                                                readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Chân trang mẫu email
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu cho phần chân trang của email
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="core_base_footer_status" type="hidden" value="0">
                                            <input class="form-check-input" name="core_base_footer_status" type="checkbox"
                                                value="1" id="core_base_footer_status" disabled="disabled"
                                                readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">
                                Rút tiền
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="w-25">
                                        Template
                                    </th>

                                    <th>
                                        Mô tả
                                    </th>

                                    <th class="text-end">
                                        Status
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            Gửi thông báo cho quản trị viên - Pending
                                        </span>
                                    </td>

                                    <td>
                                        #
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="core_acl_password-reminder_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="core_acl_password-reminder_status"
                                                type="checkbox" value="1" id="core_acl_password-reminder_status"
                                                disabled="disabled" readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            Gửi thông báo cho thành viên - Pending
                                        </span>
                                    </td>

                                    <td>
                                        #
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="core_acl_password-reminder_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="core_acl_password-reminder_status"
                                                type="checkbox" value="1" id="core_acl_password-reminder_status"
                                                disabled="disabled" readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Liên hệ
                                    </font>
                                </font>
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="w-25">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Bản mẫu
                                            </font>
                                        </font>
                                    </th>

                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Sự miêu tả
                                            </font>
                                        </font>
                                    </th>

                                    <th class="text-end">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Hoạt động
                                            </font>
                                        </font>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Gửi thông báo cho người quản lý
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu email để gửi thông báo cho người quản trị khi hệ thống có liên hệ
                                                mới
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để tắt mẫu email này"
                                        data-bs-original-title="Click to turn off this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_contact_notice_status" type="hidden" value="0">
                                            <input class="form-check-input" name="plugins_contact_notice_status"
                                                type="checkbox" value="1" id="plugins_contact_notice_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/contact/notice/status"
                                                checked="">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="text-muted text-decoration-line-through" data-bs-toggle="tooltip"
                                            data-bs-original-title="This email template is turned off.">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Gửi xác nhận cho người gửi
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu email để xác nhận người gửi rằng tin nhắn đã được gửi thành công
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để bật mẫu email này"
                                        data-bs-original-title="Click to turn on this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_contact_sender-confirmation_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input"
                                                name="plugins_contact_sender-confirmation_status" type="checkbox"
                                                value="1" id="plugins_contact_sender-confirmation_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/contact/sender-confirmation/status">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Trả lời của quản trị viên liên hệ
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu email để quản trị viên trả lời tin nhắn liên hệ
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để tắt mẫu email này"
                                        data-bs-original-title="Click to turn off this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_contact_admin-reply_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="plugins_contact_admin-reply_status"
                                                type="checkbox" value="1" id="plugins_contact_admin-reply_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/contact/admin-reply/status"
                                                checked="">

                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Thành viên
                                    </font>
                                </font>
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="w-25">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Bản mẫu
                                            </font>
                                        </font>
                                    </th>

                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Sự miêu tả
                                            </font>
                                        </font>
                                    </th>

                                    <th class="text-end">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Hoạt động
                                            </font>
                                        </font>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Xác nhận email
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Gửi email cho người dùng khi họ đăng ký tài khoản để xác minh email của
                                                họ
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_member_confirm-email_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="plugins_member_confirm-email_status"
                                                type="checkbox" value="1" id="plugins_member_confirm-email_status"
                                                disabled="disabled" readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Đặt lại mật khẩu
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Gửi email cho người dùng khi yêu cầu đặt lại mật khẩu
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip"
                                        aria-label="Không thể vô hiệu hóa mẫu email này!"
                                        data-bs-original-title="Cannot disable this email template!">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_member_password-reminder_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="plugins_member_password-reminder_status"
                                                type="checkbox" value="1"
                                                id="plugins_member_password-reminder_status" disabled="disabled"
                                                readonly="readonly" checked="">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Bài đăng mới đang chờ xử lý
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Gửi email cho quản trị viên khi có bài viết mới được tạo
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để tắt mẫu email này"
                                        data-bs-original-title="Click to turn off this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_member_new-pending-post_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="plugins_member_new-pending-post_status"
                                                type="checkbox" value="1"
                                                id="plugins_member_new-pending-post_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/member/new-pending-post/status"
                                                checked="">

                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Bản tin
                                    </font>
                                </font>
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="w-25">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Bản mẫu
                                            </font>
                                        </font>
                                    </th>

                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Sự miêu tả
                                            </font>
                                        </font>
                                    </th>

                                    <th class="text-end">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Hoạt động
                                            </font>
                                        </font>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="text-muted text-decoration-line-through" data-bs-toggle="tooltip"
                                            data-bs-original-title="This email template is turned off.">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Email gửi đến người dùng
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu gửi email cho người đăng ký
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để bật mẫu email này"
                                        data-bs-original-title="Click to turn on this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_newsletter_subscriber_email_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input"
                                                name="plugins_newsletter_subscriber_email_status" type="checkbox"
                                                value="1" id="plugins_newsletter_subscriber_email_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/newsletter/subscriber_email/status">

                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="template-name w-25">
                                        <span class="text-muted text-decoration-line-through" data-bs-toggle="tooltip"
                                            data-bs-original-title="This email template is turned off.">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Gửi email đến quản trị viên
                                                </font>
                                            </font>
                                        </span>
                                    </td>

                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                Mẫu gửi email cho admin
                                            </font>
                                        </font>
                                    </td>

                                    <td class="text-end" data-bs-toggle="tooltip" aria-label="Nhấp để bật mẫu email này"
                                        data-bs-original-title="Click to turn on this email template">
                                        <label class="form-check form-switch d-inline-block mb-0 d-inline-block">
                                            <input name="plugins_newsletter_admin_email_status" type="hidden"
                                                value="0">
                                            <input class="form-check-input" name="plugins_newsletter_admin_email_status"
                                                type="checkbox" value="1" id="plugins_newsletter_admin_email_status"
                                                data-bb-toggle="email-status-toggle"
                                                data-change-url="https://athena.botble.com/admin/settings/email/templates/plugins/newsletter/admin_email/status">

                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/template" id="email-config-template">
    @include('backend.admin.system.partials.email_config', ['index' => '__INDEX__', 'config' => []])
</script>
    <script>
        let emailConfigIndex = {{ $index + 1 }};

        // Thêm mới
        document.getElementById('add-email-config').addEventListener('click', () => {
            const tpl = document.getElementById('email-config-template').innerHTML
                .replace(/__INDEX__/g, emailConfigIndex);
            document.getElementById('email-config-list').insertAdjacentHTML('beforeend', tpl);
            emailConfigIndex++;
        });

        // Xoá cấu hình
        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove-config')) {
                e.target.closest('.email-config-item').remove();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function toggleEmailDriverFields(select) {
                const wrapper = select.closest('.email-config-item');
                const driver = select.value;

                wrapper.querySelectorAll('.email-driver-fields').forEach(div => {
                    div.style.display = 'none';
                });

                const show = wrapper.querySelector(`.email-driver-fields[data-driver="${driver}"]`);
                if (show) show.style.display = '';
            }

            function bindSelectEvents(select) {
                toggleEmailDriverFields(select);
                select.addEventListener('change', function() {
                    toggleEmailDriverFields(this);
                });
            }

            // Gán sự kiện cho các select hiện có
            document.querySelectorAll('.email-config-item select[name^="email_configs"][name$="[email_driver]"]')
                .forEach(bindSelectEvents);

            // Khi thêm config mới
            document.getElementById('add-email-config')?.addEventListener('click', () => {
                setTimeout(() => {
                    const last = document.querySelector(
                        '.email-config-item:last-of-type select[name^="email_configs"][name$="[email_driver]"]'
                        );
                    if (last) bindSelectEvents(last);
                }, 100);
            });
        });
    </script>
@endpush
