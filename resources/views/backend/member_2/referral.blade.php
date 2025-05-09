@extends('layouts.member_2')

@section('title', __('Giới thiệu'))

@section('content')

    <div id="kt_app_content_container" class="app-container">
        <div class="row mb-6">
            <div class="col-12">
                <span class="fs-6 text-gray-500">{{ __('member/referral.desc_referral', ['percent' => Setting::get('ref_percent', 0)."%"]) }}
                </span>
            </div>
        </div>
        <!--begin::Row-->
        <div class="row gy-10 gx-xl-3">
            <!-- Step 1 -->
            <div class="col-sm-6 col-xl-4 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="d-flex flex-column">
                            <span class="fw-bold fs-3 mb-5">{{ __('member/referral.step1_title') }}</span>
                            <div class="m-0">
                                <span class="fs-6 text-gray-500">
                                    {{ __('member/referral.step1_subtitle') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Step 2 -->
            <div class="col-sm-6 col-xl-4 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="d-flex flex-column">
                            <span class="fw-bold fs-3 mb-5">{{ __('member/referral.step2_title', ['name' => Setting::get("web_name")]) }}</span>
                            <div class="m-0">
                                <span class="fs-6 text-gray-500">
                                    {{ __('member/referral.step2_subtitle') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Step 3 -->
            <div class="col-sm-6 col-xl-4 mb-xl-10 mb-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="d-flex flex-column">
                            <span class="fw-bold fs-3 mb-5">{{ __('member/referral.step3_title') }}</span>
                            <div class="m-0">
                                <span class="fs-6 text-gray-500">
                                    {{ __('member/referral.step3_subtitle') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('member/referral.share_link_title') }}</h3>
                    </div>
                    <div class="card-body">
                        <p>            {{ __('member/referral.share_link_paragraph', ['name' => Setting::get("web_name")]) }}

                        </p>
                        <div class="d-flex mb-4">
                            <input id="kt_referral_link_input" type="text"
                                class="form-control form-control-solid me-3 flex-grow-1" name="search"
                                value="{{ route('ref', Auth::user()?->id ?? 0) }}" readonly>

                            <button id="kt_referral_program_link_copy_btn"
                                class="btn btn-light btn-active-light-primary fw-bold flex-shrink-0"
                                data-clipboard-target="#kt_referral_link_input">{{ __('member/referral.copy_link_button') }}
                            </button>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('member/referral.account') }}</th>
                                    <th>{{ __('member/referral.joined') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->referrals as $user)
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ formatTime($user->created_at) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
