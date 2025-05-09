@extends('layouts.member_2')

@section('title', __('Thay đổi mật khẩu'))

@section('content')

    <div id="kt_app_content_container" class="app-container">
        <div class="row mb-10">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Đổi mật khẩu</h3>
                    </div>
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Mật khẩu hiện tại</label>
                            <!--end::Label-->

                            <!--begin::Row-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="old_password" class="form-control form-control-lg"
                                    placeholder="Enter a mật khẩu cũ...">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Mật khẩu mới</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="new_password" class="form-control form-control-lg"
                                    placeholder="Email address">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Xác nhận mật khẩu mới</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="new_password_confirmation" class="form-control form-control-lg"
                                    placeholder="Phone number">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <div class="card-footer">
                        <div class="btn btn-primary">
                            Lưu thay đổi
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
