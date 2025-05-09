@extends('layouts.member_2')

@section('title', __('Thông tin tài khoản'))

@section('content')

    <div id="kt_app_content_container" class="app-container">
  

        <div class="row mb-10">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin cá nhân</h3>
                    </div>
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>   
                            <!--end::Label-->  
                            
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('backend/media/svg/avatars/blank.svg')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(backend/media/avatars/300-1.jpg)"></div>
                                    <!--end::Preview existing avatar-->
        
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="avatar_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
        
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                    <!--end::Cancel-->
        
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
        
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types:  png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                            <!--end::Label-->
        
                            <!--begin::Row-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="company" class="form-control form-control-lg" placeholder="Enter a full name..." value="{{ Auth::user()?->address?->fullname ?? '' }}">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Row-->
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                            <!--end::Label-->
        
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Email address" value="{{ Auth::user()?->email ?? '' }}">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Contact Phone</span>
        
                                
        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                            <!--end::Label-->
                            
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Phone number"
                                value="{{ Auth::user()?->address?->number_phone ?? '' }}">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">address_1</label>
                            <!--end::Label-->
        
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address_1" class="form-control form-control-lg" placeholder="Company website" value="{{ Auth::user()?->address?->address_1 ?? '' }}">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">address_2</label>
                            <!--end::Label-->
        
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address_2" class="form-control form-control-lg" placeholder="Company website" value="{{ Auth::user()?->address?->address_2 ?? '' }}">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">city</label>
                            <!--end::Label-->
        
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="city" class="form-control form-control-lg" placeholder="Company website" value="{{ Auth::user()?->address?->city ?? '' }}">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="row mb-6" data-select2-id="select2-data-134-hipo">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Country</span>
        
                                
        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Country of origination" data-bs-original-title="Country of origination" data-kt-initialized="1">
            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                            <!--end::Label-->
        
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-lg fw-semibold select2-hidden-accessible">
                                    <option value="" >Select a Country...</option>
                                    @foreach (config('app.countries') as $key=>$val)
                                    <option value="{{ $key }}" @selected($key == Auth::user()?->address?->country)>{{ $val }}</option>
                                    
                                    @endforeach
                                </select>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
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
