@extends('layouts.member_2')

@section('title', __('member/plans/index.title'))

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">

        <!-- Current Plan Status -->
        @if($currentPlan && $user->plan_id !== 1)
            <div>
                <h2 class="t-lg">{{ __('member/plans/index.your_subscription') }}</h2>
                <div class="bcard {{ $user->hasPlanExpired() ? 'border-red-300 bg-red-50' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-medium">{{ $currentPlan->name }}</h3>
                        <div class="badge {{ $user->hasPlanExpired() ? 'red' : ($user->isPlanExpiringSoon() ? 'yellow' : 'green') }}">
                            {{ $user->getExpirationStatus() }}
                        </div>
                    </div>

                    @if($user->hasPlanExpired())
                        <div class="bg-red-100 border border-red-300 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium text-red-800">{{ __('member/plans/index.plan_expired_banner.title') }}</span>
                            </div>
                            <p class="text-red-700 text-sm mt-1">
                                {{ __('member/plans/index.plan_expired_banner.text') }}
                            </p>
                        </div>
                    @endif

                    <div class="space-y-2 tm-sm">
                        <div class="flex justify-between">
                            <span>{{ __('member/plans/index.plan_price') }}</span>
                            <span class="font-semibold">${{ number_format($currentPlan->price ?? 0, 2) }}{{ __('member/plans/index.price.per_month') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>{{ $user->hasPlanExpired() ? __('member/plans/index.expired_on') : __('member/plans/index.ends_on') }}</span>
                            <span class="font-semibold {{ $user->hasPlanExpired() ? 'text-red-600' : '' }}">
                                {{ $user->plan_expires_at?->format('M d, Y') ?? __('member/plans/index.unlimited') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>{{ __('member/plans/index.storage_used') }}</span>
                            <span class="font-semibold">{{ $user->used_storage_formatted }} / {{ $user->getEffectivePlan()->formatted_storage_limit }}</span>
                        </div>

                        @if($user->hasPlanExpired())
                            <div class="flex justify-between">
                                <span>{{ __('member/plans/index.current_limits') }}</span>
                                <span class="font-semibold text-orange-600">{{ __('member/plans/index.free_plan_limits') }}</span>
                            </div>
                        @endif


                    </div>
                </div>

                <!-- Alerts -->
                @if($user->hasPlanExpired())
                    <div class="bcard bg-red-50 border-red-200">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-medium text-red-800">{{ __('member/plans/index.alerts.expired.title') }}</h4>
                                <p class="text-red-700 text-sm">{{ __('member/plans/index.alerts.expired.message', ['days' => abs($user->getDaysUntilExpiration())]) }}</p>
                            </div>
                        </div>
                    </div>
                @elseif($user->isPlanExpiringSoon())
                    <div class="bcard bg-yellow-50 border-yellow-200">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-medium text-yellow-800">{{ __('member/plans/index.alerts.expiring_soon.title') }}</h4>
                                <p class="text-yellow-700 text-sm">{{ __('member/plans/index.alerts.expiring_soon.message', ['days' => $user->getDaysUntilExpiration()]) }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                @if(!$currentPlan->isFree())

                    <div class="bcard">
                        <h4 class="font-medium mb-3">
                            {{ $user->hasPlanExpired() ? __('member/plans/index.quick_actions.plan_options') : __('member/plans/index.quick_actions.title') }}
                        </h4>

                        @if($user->hasPlanExpired())
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <button class="button green" data-bs-toggle="modal" data-bs-target="#renewModal">
                                    <svg class="size-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('member/plans/index.buttons.renew_current') }}
                                </button>


                            </div>
                            <p class="text-sm text-gray-600 mt-3">
                                {{ __('member/plans/index.plan_options_hint') }}
                            </p>
                        @else
                            <div class="flex gap-3">
                                 <button class="button green" data-bs-toggle="modal" data-bs-target="#renewModal">
                                        <svg class="size-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('member/plans/index.buttons.renew') }}
                                    </button>

                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div class="bcard bg-blue-50 border-blue-200">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h4 class="font-medium text-blue-800">{{ __('member/plans/index.no_active_plan.title') }}</h4>
                        <p class="text-blue-700 text-sm">{{ __('member/plans/index.no_active_plan.message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <h2 class="t-lg">{{ __('member/plans/index.available_plans') }}</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach ($plans as $plan)
                <div class="bcard {{ $currentPlan && $user->plan_id == $plan->id ? 'ring-2 ring-green-500' : '' }}">
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                        @if($currentPlan && $user->plan_id == $plan->id)
                            <div class="badge green">{{ __('member/plans/index.badges.current') }}</div>
                        @endif
                    </div>
                    <p class="flex items-baseline gap-x-1 mb-6">
                        @if($plan->isFree())
                            <span class="text-xl font-semibold tracking-tight text-green-600">{{ __('member/plans/index.price.free') }}</span>
                        @else
                            <span class="text-xl font-semibold tracking-tight">${{ number_format($plan->price, 2) }}</span>
                            <span class="text-sm/6 font-semibold tm">{{ __('member/plans/index.price.per_month') }}</span>
                        @endif
                    </p>

                    @if ($plan->id == $user->plan_id)
                        <button class="button outline" disabled>{{ __('member/plans/index.buttons.current_plan') }}</button>
                    @else
                        @if($plan->isFree())
                            <button type="button" class="button outline" data-bs-toggle="modal" data-bs-target="#downgrade{{ $plan->id }}">
                                {{ __('member/plans/index.buttons.downgrade_to_free') }}
                            </button>
                        @elseif($currentPlan && $plan->price < $currentPlan->price)
                            <button type="button" class="button outline" data-bs-toggle="modal" data-bs-target="#downgrade{{ $plan->id }}">
                                {{ __('member/plans/index.buttons.downgrade') }}
                            </button>
                        @elseif($currentPlan && $plan->price > $currentPlan->price)
                            <button type="button" class="button outline" data-bs-toggle="modal" data-bs-target="#upgrade{{ $plan->id }}">
                                {{ __('member/plans/index.buttons.upgrade') }}
                            </button>
                        @else
                            <button type="button" class="button outline" data-bs-toggle="modal" data-bs-target="#upgrade{{ $plan->id }}">
                                {{ __('member/plans/index.buttons.choose') }}
                            </button>
                        @endif
                    @endif

                    <ul class="mt-6 space-y-2 text-sm/6 tm">
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                            </svg>
                            {{ $plan->formatted_storage_limit }} {{ __('member/plans/index.features.storage_suffix') }}
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                            </svg>
                            {{ $plan->formatted_file_size_limit }} {{ __('member/plans/index.features.per_file') }}
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                            </svg>
                            {{ $plan->file_keep_forever ? __('member/plans/index.features.file_stored_forever') : __('member/plans/index.features.file_stored_days', ['days' => $plan->file_keep_days]) }}
                        </li>
                        @if ($plan->ads_reduced)
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                                {{ __('member/plans/index.features.ads_reduced') }}
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Upgrade Modal -->
                @if (!$plan->isFree() && ($user->plan_id != $plan->id))
                    <div class="modal fade upgrade" tabindex="-1" aria-hidden="true" id="upgrade{{ $plan->id }}">
                        <div class="modal-dialog">
                            <div class="content">
                                <div class="panel">
                                    <div class="flex items-center justify-between gap-x-4">
                                        <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                                    </div>
                                    <p class="flex items-baseline gap-x-1 mb-6">
                                        <span class="text-xl font-semibold tracking-tight">${{ number_format($plan->price, 2) }}</span>
                                        <span class="text-sm/6 font-semibold tm">{{ __('member/plans/index.price.per_month') }}</span>
                                    </p>
                                    <p class="tm-sm">{{ __('member/plans/index.modals.upgrade.payment_method_30') }}</p>
                                    <ul class="menu-list mb-6" role="list">
                                        <li>
                                            <button class="w-full" data-id="{{ $plan->id }}" data-method="balance" data-duration="30">
                                                <svg class="size-6 shrink-0 tm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M22 12V17C22 20 20 22 17 22H7C4 22 2 20 2 17V12C2 9.28 3.64 7.38 6.19 7.06C6.45 7.02 6.72 7 7 7H17C17.26 7 17.51 7.00999 17.75 7.04999C20.33 7.34999 22 9.26 22 12Z"></path>
                                                    <path d="M17.7514 7.05C17.5114 7.01 17.2614 7.00001 17.0014 7.00001H7.00141C6.72141 7.00001 6.45141 7.02001 6.19141 7.06001C6.33141 6.78001 6.53141 6.52001 6.77141 6.28001L10.0214 3.02C11.3914 1.66 13.6114 1.66 14.9814 3.02L16.7314 4.79002C17.3714 5.42002 17.7114 6.22 17.7514 7.05Z"></path>
                                                    <path d="M22 12.5H19C17.9 12.5 17 13.4 17 14.5C17 15.6 17.9 16.5 19 16.5H22"></path>
                                                </svg>
                                                <span>{{ __('member/plans/index.payment_methods.balance', ['balance' => currencyFormat($user->balance)]) }}</span>
                                            </button>
                                        </li>

                                    </ul>
                                    <button type="button" class="button secondary" data-bs-dismiss="modal">{{ __('member/plans/index.buttons.cancel') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Downgrade Modal (for both free plan and paid plans) -->
                @if (($plan->isFree() && $currentPlan && !$currentPlan->isFree()) ||
                     (!$plan->isFree() && $currentPlan && $plan->price < $currentPlan->price))
                    <div class="modal fade" tabindex="-1" aria-hidden="true" id="downgrade{{ $plan->id }}">
                        <div class="modal-dialog">
                            <div class="content">
                                <div class="panel">
                                    <h3 class="text-lg font-semibold mb-4">
                                        @if($plan->isFree())
                                            {{ __('member/plans/index.modals.downgrade.title_free') }}
                                        @else
                                            {{ __('member/plans/index.modals.downgrade.title', ['plan' => $plan->name]) }}
                                        @endif
                                    </h3>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium text-yellow-800">{{ __('member/plans/index.modals.downgrade.warning') }}</span>
                                        </div>
                                        <p class="text-yellow-700 text-sm mt-2">
                                            @if($plan->isFree())
                                                {{ __('member/plans/index.modals.downgrade.free_warning') }}
                                            @else
                                                {{ __('member/plans/index.modals.downgrade.paid_warning', ['plan' => $plan->name, 'price' => number_format($plan->price, 2)]) }}
                                            @endif
                                        </p>
                                    </div>
                                    <p class="tm-sm mb-4">{{ __('member/plans/index.modals.downgrade.confirm') }}</p>
                                    <div class="flex gap-3">
                                        <button type="button" class="button secondary" data-bs-dismiss="modal">{{ __('member/plans/index.buttons.cancel') }}</button>
                                        <form action="{{ route('plans.downgrade') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <button type="submit" class="button orange">
                                                @if($plan->isFree())
                                                    {{ __('member/plans/index.buttons.yes_switch_to_free') }}
                                                @else
                                                    {{ __('member/plans/index.buttons.yes_downgrade') }}
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Renew Modal -->
        @if($currentPlan && !$currentPlan->isFree())
            @php
                $userAutoRenew = \Setting::get("user_{$user->id}_auto_renew", false);
            @endphp
            @if(!$userAutoRenew)
                <div class="modal fade renew" tabindex="-1" aria-hidden="true" id="renewModal">
                    <div class="modal-dialog">
                        <div class="content">
                            <div class="panel">
                                <h3 class="text-lg font-semibold mb-4">{{ __('member/plans/index.modals.renew.title', ['plan' => $currentPlan->name]) }}</h3>

                                <!-- Plan Status Info -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="font-medium text-blue-800">{{ __('member/plans/index.modals.renew.plan_extension') }}</span>
                                    </div>
                                    <p class="text-blue-700 text-sm mt-2">
                                        @if($user->hasPlanExpired())
                                            {{ __('member/plans/index.modals.renew.expired_message', ['days' => abs($user->getDaysUntilExpiration())]) }}
                                        @else
                                            {{ __('member/plans/index.modals.renew.active_message', ['date' => $user->plan_expires_at->format('M d, Y')]) }}
                                        @endif
                                    </p>
                                </div>

                                <p class="tm-sm mb-4">{{ __('member/plans/index.modals.renew.choose_payment', ['price' => number_format($currentPlan->price, 2)]) }}</p>
                                <ul class="menu-list mb-6" role="list">
                                    <li>
                                        <form action="{{ route("plans.renew") }}" method="POST">
                                            @csrf
                                        <button type="submit" class="w-full" data-id="{{ $currentPlan->id }}" data-method="balance" data-duration="30">
                                            <svg class="size-6 shrink-0 tm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M22 12V17C22 20 20 22 17 22H7C4 22 2 20 2 17V12C2 9.28 3.64 7.38 6.19 7.06C6.45 7.02 6.72 7 7 7H17C17.26 7 17.51 7.00999 17.75 7.04999C20.33 7.34999 22 9.26 22 12Z"></path>
                                                    <path d="M17.7514 7.05C17.5114 7.01 17.2614 7.00001 17.0014 7.00001H7.00141C6.72141 7.00001 6.45141 7.02001 6.19141 7.06001C6.33141 6.78001 6.53141 6.52001 6.77141 6.28001L10.0214 3.02C11.3914 1.66 13.6114 1.66 14.9814 3.02L16.7314 4.79002C17.3714 5.42002 17.7114 6.22 17.7514 7.05Z"></path>
                                                    <path d="M22 12.5H19C17.9 12.5 17 13.4 17 14.5C17 15.6 17.9 16.5 19 16.5H22"></path>
                                                </svg>

                                                <span>{{ __('member/plans/index.payment_methods.balance_label', ['balance' => currencyFormat($user->balance)]) }}</span>
                                        </button>
                                        </form>
                                    </li>

                                </ul>
                                <button type="button" class="button secondary" data-bs-dismiss="modal">{{ __('member/plans/index.buttons.cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

    </div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('backend/member/js/DDzrBGya.js') }}"></script>
<script type="module">

    const r = htmlToElement(`<div class="p-8">
    <svg class="animate-spin size-8 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
</div>`);
[...document.querySelectorAll(".upgrade [data-method")].map(t => t.addEventListener("click", () => {
    const e = t.closest("ul");
    e.after(r),
    e.classList.add("hidden"),
    http.post("/u/plans/" + t.dataset.id + "/upgrade", t.dataset).then( ({data: a}) => {
        typeof a.url == "string" ? location.href = a.url : location.reload()
    }
    ).catch(a => {
        errorHandler(a),
        r.remove(),
        e.classList.remove("hidden")
    }
    )
}
));

</script>
@endpush
@push('styles')
<style>
    .storage-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #00d4aa, #00b894);
        border-radius: 10px;
        transition: width 0.5s ease;
        position: relative;
    }

    .storage-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .alert-modern {
        border: none;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border-left: 4px solid;
    }

    .alert-warning-modern {
        background: linear-gradient(135deg, rgba(255, 243, 205, 0.9), rgba(255, 234, 167, 0.9));
        border-left-color: #ffc107;
    }

    .alert-danger-modern {
        background: linear-gradient(135deg, rgba(248, 215, 218, 0.9), rgba(255, 118, 117, 0.9));
        border-left-color: #dc3545;
    }

    .alert-info-modern {
        background: linear-gradient(135deg, rgba(209, 237, 255, 0.9), rgba(168, 230, 207, 0.9));
        border-left-color: #17a2b8;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .modal-premium {
        backdrop-filter: blur(10px);
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-content-premium {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 20px;
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .floating-elements::before,
    .floating-elements::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-elements::before {
        width: 100px;
        height: 100px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-elements::after {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 10%;
        animation-delay: 3s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
</style>
@endpush
