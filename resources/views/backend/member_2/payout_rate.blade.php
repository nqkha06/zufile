@extends('layouts.member_2')

@section('title', __('member/payout_rate.title'))

@php
    use App\Models\Country;
    $countries = Country::all();
@endphp

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('member/payout_rate.earnings_table.title') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="d-grid">
                                <ul class="nav nav-tabs border-0">
                                    @foreach ($dataLevels as $level)
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-active-primary btn-color-gray-600 btn-active-color-light"
                                               data-bs-toggle="tab" href="#tab_level_{{ $level->id }}">
                                                {{ $level?->translation()?->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            @foreach ($dataLevels as $level)
                                <div class="tab-pane fade" id="tab_level_{{ $level->id }}" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">{{ __('member/payout_rate.earnings_table.package_country') }}</th>
                                                    <th colspan="2" class="text-center">{{ __('member/payout_rate.earnings_table.earnings_per_1000') }}</th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('member/payout_rate.earnings_table.desktop') }}</th>
                                                    <th>{{ __('member/payout_rate.earnings_table.mobile_tablet') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($level->rates->count())
                                                    @foreach ($level->rates as $payoutRate)
                                                        <tr>
                                                            <td class="text-nowrap language-header d-flex align-items-center gap-1">
                                                                <img class="rounded-1" 
                                                                     src="/backend/media/flags/{{ $payoutRate->country_code == 'ALL' ? 'all' : $countries->where('abv', '=', $payoutRate->country_code)->first()?->slug }}.svg"
                                                                     style="height: 16px" loading="lazy" alt="flag">
                                                                {{ $payoutRate->country_code == 'ALL' ? __('member/payout_rate.earnings_table.all_countries') : $countries->where('abv', '=', $payoutRate->country_code)->first()?->name }}
                                                            </td>
                                                            <td>{{ formatCurrency($payoutRate->rate[0]) }}</td>
                                                            <td>{{ formatCurrency($payoutRate->rate[1]) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('member/payout_rate.levels_table.title') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered gy-7 gs-7">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th>{{ __('member/payout_rate.levels_table.level') }}</th>
                                        <th>{{ __('member/payout_rate.levels_table.view_per_ip') }}</th>
                                        <th>{{ __('member/payout_rate.levels_table.description') }}</th>
                                        <th>{{ __('member/payout_rate.levels_table.test_link') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataLevels as $level)
                                        <tr>
                                            <td><span class="level two">{{ $level?->translation()?->name }}</span></td>
                                            <td>{{ $level['click_limit'] }} lượt xem</td>
                                            <td>{{ $level?->translation()?->description }}</td>
                                            <td><a href="{{ $level['test_link'] }}" target="_blank">{{ __('member/payout_rate.test_link') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
