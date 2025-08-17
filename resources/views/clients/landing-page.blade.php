@extends('layouts.clients.home_layout')

@section('content')
    <main>
        <div class="overflow-hidden py-20 sm:py-32 lg:pb-32 xl:pb-36 bg-blue-600">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-8 lg:gap-y-20">
                    <div class="relative z-10 mx-auto max-w-2xl lg:col-span-7 lg:max-w-none lg:pt-6 xl:col-span-6">
                        <h1 class="text-4xl font-medium tracking-tight text-white">{{ __('landing/index.hero.title') }}</h1>
                        <p class="mt-6 text-lg text-blue-50">{{ __('landing/index.hero.subtitle') }}</p>
                        <div class="mt-8 space-y-4">
                            <a href="{{ route('auth.register') }}" rel="nofollow"
                                class="flex items-center gap-1 text-white border w-fit rounded py-2 px-6 hover:bg-white hover:text-blue-600 transition-colors mx-auto lg:mx-0">
                                <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <span>{{ __('landing/index.hero.start_uploading') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="relative mt-10 sm:mt-20 lg:col-span-5 lg:row-span-2 lg:mt-0 xl:col-span-6">
                        <div
                            class="absolute left-1/2 top-4 h-[1026px] w-[1026px] -translate-x-1/3 stroke-gray-300/70 [mask-image:linear-gradient(to_bottom,white_20%,transparent_75%)] sm:top-16 sm:-translate-x-1/2 lg:-top-16 lg:ml-12 xl:-top-14 xl:ml-0">
                            <svg viewBox="0 0 1026 1026" fill="none" aria-hidden="true"
                                class="absolute inset-0 h-full w-full">
                                <path
                                    d="M1025 513c0 282.77-229.23 512-512 512S1 795.77 1 513 230.23 1 513 1s512 229.23 512 512Z"
                                    stroke="#D4D4D4" stroke-opacity="0.7"></path>
                            </svg>
                            <svg viewBox="0 0 1026 1026" fill="none" aria-hidden="true"
                                class="absolute inset-0 h-full w-full">
                                <path
                                    d="M913 513c0 220.914-179.086 400-400 400S113 733.914 113 513s179.086-400 400-400 400 179.086 400 400Z"
                                    stroke="#D4D4D4" stroke-opacity="0.7"></path>
                            </svg>
                        </div>

                        <div
                            class="w-full [mask-image:linear-gradient(to_bottom,white_60%,transparent)] lg:absolute left-1/2 top-4 lg:-translate-x-1/2 lg:-top-16 lg:ml-12 xl:-top-14 xl:ml-0">
                            <img src="{{ asset("core/img/landing/hero.svg") }}" class="pointer-events-none"
                                alt="hero" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
                <div class="mx-auto max-w-2xl sm:text-center">
                    <h2 class="text-3xl font-medium tracking-tight text-gray-900">{{ __('landing/index.benefits.title') }}</h2>
                    <p class="mt-2 text-lg text-gray-600">{{ __('landing/index.benefits.subtitle') }}</p>
                </div>
                <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
                    <div class="relative lg:row-span-2">
                        <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                            <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
                                <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">
                                    {{ __('landing/index.benefits.mobile.title') }}</p>
                                <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">{{ __('landing/index.benefits.mobile.description') }}</p>
                            </div>
                            <div
                                class="relative min-h-[30rem] w-full grow [container-type:inline-size] max-lg:mx-auto max-lg:max-w-sm">
                                <div
                                    class="absolute inset-x-10 bottom-0 top-10 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
                                    <img class="size-full object-cover object-top"
                                        src="{{ asset("core/img/landing/mobile-preview.webp") }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div
                            class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-l-[2rem]">
                        </div>
                    </div>
                    <div class="relative max-lg:row-start-1">
                        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                            <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">
                                    {{ __('landing/index.benefits.speed.title') }}</p>
                                <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">{{ __('landing/index.benefits.speed.description') }}</p>
                            </div>
                            <div
                                class="flex flex-1 items-center justify-center px-8 max-lg:pb-12 max-lg:pt-10 sm:px-10 lg:pb-2">
                                <img class="w-full max-lg:max-w-xs"
                                    src="{{ asset("core/img/landing/bento-performance.webp") }}" alt="">
                            </div>
                        </div>
                        <div
                            class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-t-[2rem]">
                        </div>
                    </div>
                    <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                        <div class="absolute inset-px rounded-lg bg-white"></div>
                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)]">
                            <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">
                                    {{ __('landing/index.benefits.earning.title') }}</p>
                                <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">{{ __('landing/index.benefits.earning.description') }}</p>
                            </div>
                            <div
                                class="flex flex-1 items-center justify-center [container-type:inline-size] max-lg:py-6 lg:pb-2">
                                <img class="h-[min(152px,40cqw)] object-cover"
                                    src="{{ asset("core/img/landing/bento-earning.svg") }}" alt="">
                            </div>
                        </div>
                        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5"></div>
                    </div>
                    <div class="relative lg:row-span-2">
                        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]">
                        </div>
                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
                            <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
                                <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">
                                    {{ __('landing/index.benefits.security.title') }}</p>
                                <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">{{ __('landing/index.benefits.security.description') }}</p>
                            </div>
                            <div class="relative min-h-[30rem] w-full grow mt-4">
                                <img class="size-full object-cover object-top"
                                    src="{{ asset("core/img/landing/bento-security.svg") }}" alt="">
                            </div>
                        </div>
                        <div
                            class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="py-20 sm:py-32 bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl sm:text-center">
                    <h2 class="text-3xl font-medium tracking-tight text-gray-900">{{ __('landing/index.pricing.title') }}</h2>
                    <p class="mt-2 text-lg text-gray-600">{{ __('landing/index.pricing.subtitle') }}</p>
                </div>
                <div class="isolate mx-auto mt-10 flex justify-center gap-6 flex-wrap">
                    @foreach ($plans as $plan)
    <div class="w-full md:w-64 rounded-2xl bg-white shadow-lg p-4 lg:p-6 {{ $loop->first ? 'ring-2 ring-blue-600' : 'ring-1 ring-gray-200' }}">
        <div class="flex items-center justify-between gap-x-4">
            <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
        </div>
        <p class="flex items-baseline gap-x-1 mb-6">
            <span class="text-xl font-semibold tracking-tight">${{ number_format($plan->price, 2) }}</span>
            <span class="text-sm/6 font-semibold text-gray-600">/{{ __('landing/index.pricing.month') }}</span>
        </p>
        <a href="{{ $plan->price == 0 ? '/register' : '/u/upgrade' }}" class="button {{ $plan->price == 0 ? '' : 'outline' }}">
            {{ $plan->price == 0 ? __('landing/index.pricing.get_started_today') : __('landing/index.pricing.buy_plan') }}
        </a>
        <ul role="list" class="mt-6 space-y-2 text-sm/6 text-gray-600">
            <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
</svg>
                {{ formatBytes($plan->storage_limit) }} {{ __('landing/index.pricing.of_storage') }}
            </li>
            <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
</svg>
                {{ formatBytes($plan->file_size_limit) }} {{ __('landing/index.pricing.per_file') }}
            </li>
            <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
</svg>
            {{ $plan->file_keep_forever ? __('landing/index.pricing.file_stored_forever') : __('landing/index.pricing.file_stored_days', ['days' => $plan->file_keep_days]) }}
            </li>
            @if ($plan->ads_reduced)
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
</svg>
                    {{ __('landing/index.pricing.ads_reduced') }}
                </li>
            @endif
        </ul>
    </div>
@endforeach

                </div>
            </div>
        </section>

        <section id="get-started-free" class="relative overflow-hidden bg-blue-600 py-20 sm:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="mx-auto max-w-md sm:text-center">
                    <h2 class="text-3xl font-medium tracking-tight text-white sm:text-4xl">{{ __('landing/index.get_started.title') }}</h2>
                    <p class="mt-4 text-lg text-blue-50">{{ __('landing/index.get_started.subtitle') }}</p>
                    <div class="mt-8 flex justify-center">
                        <a class="rounded-lg px-8 py-4 text-blue-600 bg-white font-semibold transition-all hover:shadow-lg hover:-translate-y-2"
                            href="{{ route('auth.register') }}">{{ __('landing/index.get_started.register_free') }}</a>
                    </div>
                </div>
            </div>
            <ul class="circles z-0" aria-hidden="true">
                <li>
                    <svg viewBox="0 0 20 20" fill="#ffffff78">
                        <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"></path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                        </path>
                    </svg>
                </li>
                <li>
                    <svg fill="none" viewBox="0 0 24 24" stroke="#ffffff78">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                        </path>
                    </svg>
                </li>
            </ul>
        </section>

        <section class="py-20 sm:py-32 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl sm:text-center">
                    <h2 class="text-3xl font-medium tracking-tight text-gray-900">{{ __('landing/index.payment.title') }}</h2>
                    <p class="mt-2 text-lg text-gray-600">{{ __('landing/index.payment.subtitle') }}</p>
                </div>
                <div class="mx-auto space-y-6 mt-16 max-w-2xl sm:mt-20 md:gap-y-10 lg:max-w-none">
                    <div class="flex justify-center gap-6 flex-wrap">
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M29.4419 13H36.266C38.188 13 40.4675 13.0625 41.9925 14.4073C43.0111 15.3057 43.5457 16.7371 43.4221 18.2737C43.0037 23.4845 39.8868 26.4031 35.7072 26.4031H32.3415C31.7688 26.4031 31.3891 26.7826 31.2275 27.8107L30.2883 33.7851C30.2274 34.1727 30.0594 34.4011 29.7527 34.4288H25.5489C25.0825 34.4288 24.9167 34.0719 25.0386 33.2991L28.0658 14.1337C28.187 13.3656 28.6072 13 29.4419 13Z"
                                fill="#1B3D92" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M33.8306 19H40.6479C44.3077 19 45.6858 20.8526 45.4731 23.5791C45.1222 28.0735 42.4048 30.5587 38.8005 30.5587H36.9806C36.4867 30.5587 36.1543 30.8853 36.0197 31.7728L35.2392 36.9251C35.1885 37.2598 35.0125 37.4563 34.7481 37.4803H30.4734C30.0712 37.4803 29.9281 37.1725 30.0333 36.506L32.6438 19.9778C32.7483 19.3153 33.1106 19 33.8306 19Z"
                                fill="#00A2D3" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M31 27.5204L32.1916 19.9777C32.2963 19.3154 32.6587 19.0001 33.3787 19.0001H40.196C41.3245 19.0001 42.2362 19.1762 42.9507 19.5007C42.2657 24.1383 39.2662 26.715 35.3385 26.715H31.9727C31.5298 26.715 31.1988 26.9415 31 27.5204Z"
                                fill="#1B2E7F" />
                        </svg>
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="white" />
                            <path
                                d="M7.3418 29.2166V19.9319H10.3463C11.4849 19.9319 12.2269 19.9785 12.5726 20.0713C13.104 20.2107 13.5489 20.5136 13.9073 20.9802C14.2656 21.4469 14.4448 22.0495 14.4448 22.7885C14.4448 23.3585 14.3414 23.8377 14.1349 24.226C13.9282 24.6146 13.6658 24.9194 13.3474 25.1411C13.0291 25.3629 12.7054 25.5095 12.3764 25.5812C11.9295 25.6699 11.2823 25.7142 10.4346 25.7142H9.21374V29.2168L7.3418 29.2166ZM9.21392 21.5026V24.1373H10.2388C10.9767 24.1373 11.4701 24.0889 11.719 23.9916C11.9677 23.8945 12.1628 23.7426 12.3041 23.5357C12.4451 23.3287 12.5158 23.0882 12.5158 22.8135C12.5158 22.4758 12.4169 22.1973 12.2186 21.9777C12.0204 21.7583 11.7696 21.6208 11.466 21.5661C11.2426 21.5238 10.7934 21.5026 10.1187 21.5026H9.21392Z"
                                fill="black" />
                            <path
                                d="M23.3858 29.2166H21.3489L20.5394 27.1075H16.8328L16.0675 29.2166H14.0813L17.693 19.9319H19.6728L23.3858 29.2166ZM19.9386 25.5433L18.6609 22.0979L17.4084 25.5433H19.9386Z"
                                fill="black" />
                            <path
                                d="M25.6349 29.2166V25.3089L22.2382 19.9319H24.4331L26.6154 23.6052L28.7535 19.9319H30.9104L27.5011 25.3216V29.2166H25.6349Z"
                                fill="black" />
                            <path
                                d="M31.8267 29.2166V19.9319H38.7024V21.5026H33.6991V23.5609H38.3545V25.1254H33.6991V27.6525H38.8795V29.2168L31.8267 29.2166Z"
                                fill="#64B3DF" />
                            <path
                                d="M40.467 29.2166V19.9319H47.3427V21.5026H42.3394V23.5609H46.9949V25.1254H42.3394V27.6525H47.5197V29.2168L40.467 29.2166Z"
                                fill="#64B3DF" />
                            <path
                                d="M49.1137 29.2166V19.9319H53.0542C54.0454 19.9319 54.7654 20.0152 55.2144 20.1821C55.6634 20.349 56.0228 20.6456 56.2929 21.072C56.5627 21.4986 56.6978 21.9863 56.6978 22.535C56.6978 23.2316 56.4931 23.807 56.0843 24.2609C55.675 24.7148 55.0637 25.001 54.25 25.1191C54.6549 25.3556 54.9888 25.6153 55.2528 25.8981C55.5163 26.181 55.8716 26.6836 56.3184 27.4054L57.4508 29.2168H55.2113L53.8577 27.1965C53.377 26.4744 53.048 26.0194 52.871 25.8315C52.6935 25.6437 52.5063 25.5149 52.3078 25.4452C52.1099 25.3754 51.7956 25.3406 51.3653 25.3406H50.9859V29.2168L49.1137 29.2166ZM50.9859 23.8586H52.3712C53.2696 23.8586 53.83 23.8206 54.0538 23.7446C54.2772 23.6687 54.452 23.538 54.5791 23.352C54.7052 23.1662 54.7685 22.9341 54.7685 22.6553C54.7685 22.3428 54.6856 22.0906 54.5189 21.8984C54.3521 21.7063 54.1171 21.585 53.8135 21.5342C53.6619 21.5131 53.2063 21.5026 52.4474 21.5026H50.9863L50.9859 23.8586Z"
                                fill="#64B3DF" />
                            <path
                                d="M62.8225 26.2766C62.8225 26.9639 62.5804 27.5502 62.0962 28.0362C61.612 28.5223 61.0275 28.7656 60.3404 28.7656C59.6538 28.7656 59.0702 28.5223 58.5882 28.0362C58.1084 27.552 57.869 26.9654 57.869 26.2766C57.869 25.5943 58.1111 25.0121 58.5949 24.5281C59.0773 24.0465 59.6587 23.8057 60.3404 23.8057C61.0275 23.8057 61.612 24.0465 62.0962 24.5281C62.5804 25.0097 62.8225 25.5931 62.8225 26.2766ZM60.3409 24.143C59.7532 24.143 59.2516 24.3524 58.8347 24.771C58.4205 25.1878 58.2137 25.6903 58.2137 26.2804C58.2137 26.8747 58.4197 27.3811 58.8312 27.8C59.2463 28.2184 59.7483 28.4278 60.3409 28.4278C60.933 28.4278 61.4354 28.2184 61.8501 27.8C62.2647 27.3811 62.4712 26.8747 62.4712 26.2804C62.4712 25.6903 62.2647 25.1878 61.8501 24.771C61.4341 24.3523 60.9303 24.143 60.3409 24.143ZM60.2932 24.9095C60.6311 24.9095 60.879 24.942 61.036 25.0072C61.3177 25.1245 61.4582 25.3543 61.4582 25.6972C61.4582 25.94 61.3699 26.1199 61.1929 26.2345C61.0993 26.2954 60.9682 26.3385 60.7988 26.3655C61.0128 26.3993 61.1679 26.4886 61.2665 26.6331C61.365 26.7764 61.4145 26.9165 61.4145 27.0542V27.2528C61.4145 27.3162 61.4163 27.3838 61.4207 27.4555C61.4256 27.5268 61.4341 27.5745 61.4444 27.5974L61.4613 27.631H61.0128C61.0097 27.6216 61.0083 27.6127 61.0056 27.604C61.003 27.5945 61.0016 27.585 60.9989 27.5729L60.9887 27.4858V27.2704C60.9887 26.9566 60.9031 26.7492 60.7319 26.6481C60.6311 26.59 60.4532 26.5601 60.1986 26.5601H59.8205V27.6312H59.3412V24.9095H60.2932ZM60.9923 25.7364C60.9923 25.5394 60.9316 25.4053 60.8112 25.3383C60.6904 25.2708 60.4965 25.2368 60.2307 25.2368H59.8205V26.2223H60.2539C60.4572 26.2223 60.6102 26.202 60.7114 26.1614C60.8986 26.0875 60.9923 25.9455 60.9923 25.7364Z"
                                fill="black" />
                        </svg>
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="#50AF95" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M24.8628 11.1422L19.0257 23.4697C18.9786 23.5646 18.9974 23.6784 19.0729 23.7447L34.8303 38.936C34.9246 39.0213 35.066 39.0213 35.1603 38.936L50.9271 23.7447C51.0026 23.6689 51.0214 23.5646 50.9743 23.4697L45.1372 11.1422C45.0994 11.0569 45.0146 11 44.9203 11H25.0797C24.9854 11 24.9005 11.0569 24.8628 11.1422Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M36.8239 24.671C36.7216 24.6802 36.1932 24.7172 35.017 24.7172C34.0795 24.7172 33.4148 24.6895 33.1847 24.671C29.5625 24.4951 26.8608 23.8103 26.8608 22.9959C26.8608 22.1722 29.5625 21.4874 33.1847 21.3208V23.9954C33.4233 24.0139 34.0966 24.0602 35.0341 24.0602C36.1591 24.0602 36.7216 24.0046 36.8239 23.9954V21.3208C40.4375 21.4967 43.1392 22.1815 43.1392 22.9959C43.1392 23.8103 40.4375 24.4951 36.8239 24.671ZM36.8239 21.0432V18.6463H41.8693V15H28.1392V18.6463H33.1847V21.0432C29.0852 21.2468 26 22.126 26 23.1902C26 24.2545 29.0852 25.1244 33.1847 25.3373V33H36.8324V25.328C40.9233 25.1244 44 24.2452 44 23.1902C44 22.1352 40.9233 21.2468 36.8239 21.0432Z"
                                fill="#50AF95" />
                        </svg>
                    </div>
                    <div class="flex justify-center gap-6 flex-wrap">
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="#108EE9" />
                            <path
                                d="M14.8762 17H15.1095C16.7463 17.0303 18.3703 17.5682 19.6828 18.5482C21.2275 19.6822 22.3428 21.3797 22.785 23.2428C23.3123 25.4023 22.9472 27.7707 21.7595 29.6537C20.3712 31.9252 17.8022 33.4197 15.1328 33.45H14.9042C12.929 33.4173 10.983 32.6182 9.56317 31.2462C7.96017 29.7342 7.03967 27.5583 7 25.3603V25.1515C7.021 22.9068 7.96833 20.6797 9.61917 19.1513C11.0273 17.8167 12.9372 17.0408 14.8762 17ZM13.776 23.5333C13.0422 23.7702 12.2383 23.9043 11.4847 23.6838C11.0833 23.58 10.7473 23.3268 10.3728 23.16C10.2725 24.5647 10.3565 25.9798 10.3262 27.388C10.3483 27.6703 10.2643 28.0005 10.4405 28.2443C11.0518 28.6982 11.8393 28.8767 12.593 28.8242C14.4445 28.6772 16.0743 27.4557 17.9632 27.5595C18.5838 27.5712 19.1228 27.8815 19.677 28.1172C19.7283 26.6285 19.6817 25.1375 19.7015 23.6477C19.691 23.426 19.7353 23.1612 19.558 22.9908C18.8393 22.3958 17.8313 22.2267 16.9342 22.4367C15.8492 22.705 14.8342 23.1845 13.776 23.5333ZM26.0633 21.0973C27.1413 21.1102 28.2205 21.0717 29.2985 21.116C31.1337 21.2385 32.7133 22.775 32.9653 24.5833C33.2698 26.3205 32.3493 28.1942 30.7603 28.9735C30.163 29.2827 29.4875 29.411 28.819 29.4098C27.8997 29.4087 26.9815 29.4098 26.0622 29.4087C26.0633 26.6378 26.0622 23.867 26.0633 21.0973ZM27.7947 22.8847C27.8087 24.462 27.8017 26.0393 27.7982 27.6167C28.5005 27.5898 29.2483 27.7217 29.9075 27.4102C30.8035 27.0135 31.367 26.0113 31.2655 25.0407C31.1978 24.0653 30.4593 23.1728 29.5015 22.9535C28.9415 22.8322 28.3628 22.9022 27.7947 22.8847ZM36.0523 24.4585C36.1083 22.656 37.7312 21.0367 39.5558 21.0985C41.3443 21.0798 42.9147 22.6642 42.9858 24.4317C43.0162 26.0895 42.9893 27.7485 42.9987 29.4063C42.4188 29.4075 41.8402 29.4087 41.2615 29.4063C41.2557 28.8113 41.2627 28.2163 41.2568 27.6225C40.0972 27.6283 38.9387 27.6225 37.7802 27.6248C37.7755 28.221 37.7895 28.8183 37.772 29.4145C37.1945 29.4005 36.6182 29.4098 36.0418 29.4075C36.0477 27.7578 36.0255 26.107 36.0523 24.4585ZM38.2247 23.4808C37.6308 24.1225 37.8035 25.0453 37.7802 25.8398C38.9387 25.841 40.0983 25.8375 41.2568 25.841C41.2358 25.0605 41.405 24.1598 40.8438 23.517C40.222 22.7003 38.8687 22.6817 38.2247 23.4808ZM46.0378 24.4772C46.0892 22.8905 47.3293 21.4182 48.9032 21.151C50.0745 20.9258 51.3298 21.3867 52.0928 22.299C52.6832 22.9488 52.9842 23.8285 52.9842 24.7012C52.9877 26.2703 52.9842 27.8383 52.9842 29.4075C52.4078 29.411 51.8303 29.3982 51.254 29.4168C51.2318 27.8442 51.2552 26.2703 51.2435 24.6977C51.2528 24.063 50.9133 23.4307 50.358 23.1157C49.7817 22.7703 49.0012 22.8217 48.4727 23.237C48.0153 23.5788 47.7598 24.1482 47.768 24.7152C47.7633 26.2797 47.768 27.843 47.7657 29.4075C47.1835 29.4052 46.6013 29.4122 46.0192 29.4028C46.0448 27.7613 46.0075 26.1187 46.0378 24.4772ZM56.5798 22.7085C57.2507 21.6632 58.4897 20.9888 59.7415 21.1078C61.1567 21.1953 62.412 22.2733 62.804 23.6208C63.0315 24.336 62.9183 25.1013 63 25.8363V29.3982C62.4073 29.4145 61.8147 29.4063 61.222 29.4063C61.2197 28.8102 61.2278 28.2128 61.2138 27.6167C60.0577 27.6342 58.9003 27.619 57.743 27.6248C57.7418 28.2187 57.743 28.8125 57.7418 29.4075C57.162 29.4075 56.5833 29.4075 56.0035 29.4075C56.0023 27.8757 56.0035 26.345 56.0023 24.8143C55.9942 24.077 56.1703 23.328 56.5798 22.7085ZM58.1782 23.4925C57.5948 24.133 57.7663 25.05 57.743 25.8398C58.9027 25.841 60.0623 25.8398 61.2208 25.8398C61.1963 25.0582 61.3702 24.1563 60.8043 23.5135C60.1767 22.6957 58.8175 22.6852 58.1782 23.4925Z"
                                fill="white" />
                        </svg>
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="white" />
                            <path
                                d="M13.2986 19.1184C13.917 19.2461 14.5409 19.3888 15.1083 19.6748C16.2566 20.2227 17.234 21.1107 17.8853 22.2041C18.4253 23.2144 18.7968 24.3478 18.7412 25.5054C18.7569 27.8818 17.2512 30.1462 15.1185 31.1565C13.7359 31.8141 12.1276 31.9042 10.6502 31.5437C9.65086 31.2364 8.68681 30.7395 7.95867 29.9761C7.26503 29.3326 6.74146 28.5128 6.40913 27.6303C5.9757 26.5447 5.93651 25.3377 6.1207 24.1941C6.45773 22.4957 7.50721 20.9383 8.99248 20.0354C9.68378 19.58 10.4785 19.3096 11.2866 19.1474C11.9505 19.0392 12.6316 19.0517 13.2986 19.1184ZM10.3994 22.1971C9.89932 22.248 9.35303 22.4236 9.07635 22.875C8.74559 23.343 8.7354 23.9378 8.70092 24.4881C8.68211 24.8792 8.6147 25.2687 8.64527 25.6622C8.69857 26.2837 8.697 26.9123 8.83259 27.5244C8.95251 28.0754 9.44865 28.5026 9.99573 28.6029C11.1087 28.8036 12.2444 28.766 13.3699 28.7503C13.7924 28.7268 14.2148 28.6837 14.6326 28.617C15.2581 28.5355 15.8106 28.0261 15.9133 27.399C16.0928 26.6301 16.1249 25.837 16.0716 25.0524C15.9713 24.5492 15.6155 24.0954 15.1319 23.9112C14.9183 23.808 14.6818 23.8066 14.4493 23.8072L14.3105 23.807C13.0282 23.8085 11.7459 23.8038 10.4644 23.8101C10.3359 23.8124 10.2191 23.7513 10.1 23.7145C10.0976 23.5389 10.1039 23.2763 10.3398 23.2716C11.7632 23.2395 13.1896 23.3038 14.6114 23.2411C14.5236 22.8335 14.2752 22.4079 13.8472 22.295C13.4608 22.1916 13.0611 22.1391 12.6637 22.1022C11.9082 22.0928 11.1448 22.0497 10.3994 22.1971ZM14.776 25.6206C14.9053 25.6998 15.0018 25.8338 15.0402 25.9804C14.9798 26.2696 14.8818 26.5518 14.8685 26.8504C14.7831 26.8872 14.7008 26.9295 14.6201 26.9766C14.573 26.9491 14.479 26.8951 14.4319 26.8676C14.3598 26.5353 14.1866 26.2061 14.2509 25.8589C14.323 25.6465 14.5699 25.565 14.776 25.6206Z"
                                fill="#01ACD7" />
                            <path
                                d="M24.8852 20.9689C25.5185 20.8905 26.1894 20.8638 26.7937 21.1005C27.1958 21.2361 27.5571 21.4721 27.884 21.7393C27.8902 21.4666 27.8863 21.1938 27.8855 20.9211C28.518 20.925 29.1506 20.9187 29.7831 20.9265C29.7823 23.263 29.7823 25.5987 29.7831 27.9351C29.7846 28.3999 29.7956 28.878 29.6404 29.324C29.4037 30.1713 28.8002 30.8978 28.0337 31.3234C27.13 31.8446 26.0389 31.9066 25.0247 31.7788C23.987 31.6416 23.03 31.1259 22.2744 30.4111C22.6616 29.9526 23.1342 29.5748 23.5543 29.1469C24.2762 29.8115 25.303 30.1431 26.2741 29.9651C26.7232 29.8962 27.1676 29.7073 27.4615 29.3483C27.9184 28.8937 27.8832 28.2032 27.8706 27.6083C27.652 27.7345 27.4701 27.9124 27.2491 28.0347C26.3736 28.5481 25.2795 28.5386 24.3311 28.2518C22.9932 27.8231 21.939 26.5925 21.7752 25.1911C21.7266 24.6432 21.7226 24.0766 21.9068 23.5514C22.3128 22.2261 23.5152 21.1805 24.8852 20.9689ZM25.5248 22.6908C25.118 22.7512 24.701 22.8578 24.3867 23.1368C23.4164 23.8783 23.436 25.5469 24.411 26.2782C25.0616 26.7963 25.9809 26.7775 26.7263 26.4969C27.3432 26.2618 27.8816 25.652 27.8134 24.9607C27.7938 24.5265 27.8855 24.0601 27.6598 23.6635C27.2452 22.9385 26.3344 22.5678 25.5248 22.6908ZM41.2067 21.744C41.7906 21.1593 42.6356 20.9171 43.446 20.9226C44.5049 20.885 45.5771 21.3286 46.2755 22.1312C47.6024 23.5734 47.5232 26.036 46.1453 27.4178C44.8795 28.7009 42.6387 28.8239 41.231 27.7055C41.2326 28.9086 41.2451 30.1117 41.2255 31.314C40.5679 31.3078 39.9088 31.3328 39.252 31.2905C39.2512 27.9054 39.2527 24.5202 39.2512 21.135C39.8892 21.1248 40.5272 21.1272 41.1652 21.135C41.1809 21.3372 41.1926 21.5402 41.2067 21.744ZM42.7719 22.7206C42.1598 22.8421 41.5296 23.2121 41.3235 23.832C41.1738 24.1894 41.2545 24.5837 41.2334 24.9599C41.2044 25.3972 41.3776 25.855 41.7083 26.1473C42.4851 26.9037 43.8677 26.9178 44.6491 26.1614C45.4282 25.3753 45.4219 23.9324 44.5958 23.1815C44.1083 22.752 43.4029 22.5929 42.7719 22.7206ZM33.528 21.019C34.6417 20.7949 35.8605 20.9297 36.8301 21.5496C37.5676 21.9948 38.1288 22.7167 38.3796 23.5405C38.7237 24.6229 38.5693 25.8612 37.925 26.8034C37.2847 27.7525 36.1913 28.3341 35.0626 28.443C34.3674 28.4901 33.6487 28.4665 32.9911 28.2134C31.9016 27.8474 30.9877 26.9484 30.6664 25.8377C30.3215 24.7969 30.4814 23.6055 31.0724 22.6838C31.6195 21.8216 32.5365 21.233 33.528 21.019ZM33.9943 22.7308C33.7169 22.81 33.4575 22.9479 33.2302 23.1243C32.4432 23.7442 32.2512 24.9701 32.8116 25.8001C33.452 26.8559 35.1042 27.0644 35.971 26.1802C36.3951 25.7907 36.5965 25.2091 36.5401 24.6393C36.5879 23.3759 35.1865 22.3577 33.9943 22.7308ZM48.8666 21.6758C49.8127 20.9791 51.0479 20.8199 52.1883 20.9696C52.9831 21.0998 53.7998 21.4407 54.281 22.1163C54.5773 22.5599 54.774 23.0843 54.767 23.6228C54.7654 25.1715 54.7685 26.7203 54.7654 28.2698C54.1674 28.2604 53.5701 28.2659 52.9737 28.2667C52.969 28.0018 52.9737 27.7376 52.969 27.4735C52.5543 28.0088 51.8999 28.2902 51.2501 28.4117C50.3112 28.5363 49.257 28.4626 48.5084 27.8191C47.6016 27.0698 47.6055 25.456 48.586 24.7702C49.4333 24.1949 50.4812 24.0781 51.4704 23.9363C51.8772 23.8501 52.327 23.7881 52.6468 23.4966C52.7989 23.1345 52.5347 22.7543 52.1875 22.6415C51.7902 22.5208 51.3653 22.4996 50.957 22.5701C50.326 22.672 49.7884 23.165 49.634 23.785C49.003 23.6972 48.3877 23.5248 47.7607 23.4174C47.8532 22.7073 48.3203 22.1101 48.8666 21.6758ZM50.0172 25.7256C49.8174 25.8464 49.6175 26.0885 49.721 26.3339C49.7899 26.6826 50.192 26.7885 50.4977 26.8065C51.2337 26.8535 52.0668 26.7532 52.6139 26.2077C52.9807 25.8346 52.8514 25.2671 52.8702 24.7961C52.041 25.4231 50.906 25.2358 50.0172 25.7256ZM54.9222 21.1303C55.6597 21.1303 56.3972 21.1256 57.1348 21.1327C57.2523 21.4964 57.4522 21.8248 57.6074 22.1728C58.1584 23.3884 58.7353 24.5931 59.2965 25.8048C60.0191 24.2521 60.7378 22.6963 61.4479 21.1374C62.1878 21.1248 62.9277 21.1217 63.6684 21.1405C62.0201 24.5265 60.3702 27.9108 58.7188 31.2952C57.9891 31.3328 57.2578 31.3078 56.5281 31.3109C57.0517 30.1454 57.6756 29.0262 58.2046 27.863C57.1238 25.612 55.9999 23.3821 54.9222 21.1303Z"
                                fill="#010101" />
                        </svg>
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="#4C3494" />
                            <path
                                d="M16.9807 17.0782C18.6319 16.8591 20.3589 17.1162 21.843 17.8854C23.4599 18.7031 24.7702 20.1015 25.4979 21.7594C26.1117 23.148 26.3351 24.7031 26.1545 26.2092C25.9679 27.8242 25.3032 29.3867 24.2359 30.6168C23.1166 31.9191 21.5633 32.842 19.8816 33.1921C18.1313 33.5599 16.2567 33.3787 14.6307 32.6223C12.9887 31.8628 11.6264 30.5183 10.8424 28.8885C9.98868 27.1437 9.78304 25.1003 10.2292 23.2135C10.5988 21.6241 11.4538 20.1462 12.6717 19.0568C13.8589 17.9736 15.3889 17.2832 16.9807 17.0782ZM17.4728 19.7098C16.6729 19.8126 15.8963 20.1101 15.2414 20.5831C14.3699 21.2037 13.7225 22.1143 13.3699 23.1205C12.9556 24.3016 12.9158 25.6088 13.2329 26.8181C13.5542 28.0427 14.2977 29.1706 15.3571 29.8775C16.3828 30.5801 17.6821 30.8451 18.9061 30.6523C19.9054 30.4974 20.8528 30.0183 21.5652 29.2992C22.3938 28.4913 22.9122 27.3965 23.1025 26.2618C23.3087 25.0183 23.16 23.7031 22.6129 22.5623C22.1313 21.5391 21.313 20.6682 20.2934 20.1706C19.4275 19.738 18.4305 19.5862 17.4728 19.7098ZM51.1043 17.0366C53.2794 16.8291 55.5407 17.5078 57.1851 18.9601C58.9373 20.4644 59.9471 22.7582 59.9593 25.0593C60.007 27.1339 59.2592 29.2294 57.8534 30.7649C57.0835 31.6174 56.1233 32.2979 55.0646 32.7435C52.9875 33.6131 50.5511 33.5856 48.4923 32.6737C46.6796 31.8708 45.201 30.3567 44.4275 28.5323C43.3859 26.1107 43.5474 23.1957 44.8969 20.9246C45.9006 19.2025 47.5817 17.8891 49.4985 17.3377C50.0217 17.1829 50.5609 17.0862 51.1043 17.0366ZM51.1955 19.7135C49.8155 19.8848 48.5407 20.6884 47.7677 21.8408C46.5083 23.6963 46.444 26.2753 47.5591 28.2129C48.0578 29.0758 48.81 29.793 49.7096 30.2257C50.8504 30.7783 52.2065 30.8628 53.411 30.4705C54.3699 30.1608 55.2145 29.5329 55.8161 28.7276C57.0848 27.0274 57.2733 24.6382 56.433 22.7104C56.0076 21.7441 55.2959 20.8965 54.3852 20.3561C53.4373 19.7826 52.2898 19.5648 51.1955 19.7135ZM26.8926 17.4436C29.0554 17.4429 31.2176 17.4424 33.3797 17.4436C33.3797 18.3206 33.3797 19.197 33.3797 20.0739C32.8528 20.0758 32.3259 20.0733 31.7996 20.0752C33.0438 23.0213 34.2873 25.9675 35.5315 28.9136C36.742 25.9711 37.936 23.0213 39.1386 20.0752C38.6166 20.0739 38.0946 20.0752 37.5725 20.0746C37.5713 19.1976 37.5719 18.3206 37.5725 17.4429C39.2855 17.4429 40.9991 17.4429 42.7121 17.4429C42.6998 17.9558 42.7384 18.4736 42.6931 18.9834C40.6594 23.7814 38.608 28.5727 36.5713 33.3701C36.1766 33.364 35.7745 33.4007 35.3883 33.2998C34.5786 33.1119 33.8828 32.5189 33.5517 31.7588C31.8602 27.8646 30.171 23.9687 28.4783 20.0746C27.9495 20.0746 27.4214 20.0752 26.8926 20.0739C26.8926 19.197 26.892 18.32 26.8926 17.4436Z"
                                fill="white" />
                        </svg>
                        <svg class="shadow rounded shrink-0 w-36 rounded-lg" viewBox="0 0 70 50" fill="none"
                            aria-hidden="true">
                            <path
                                d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                fill="#F0592C" />
                            <path
                                d="M36.7916 9.71414C37.8529 10.7449 38.255 12.2767 38.3295 13.7126C39.5297 13.7177 40.7308 13.7034 41.931 13.7177C42.2575 13.7003 42.579 13.9381 42.6208 14.2677C42.6688 14.7137 42.5923 15.1617 42.5718 15.6077C42.3616 18.4274 42.1565 21.2481 41.9514 24.0678C41.9003 24.6934 41.6728 25.3486 41.1656 25.7486C40.8349 26.0129 40.4053 26.1099 39.9889 26.0987C36.6201 26.0946 33.2514 26.0995 29.8837 26.0966C29.306 26.116 28.7213 25.8343 28.4213 25.3323C28.0202 24.7138 28.0498 23.9515 27.9957 23.2463C27.7875 20.4276 27.5865 17.6089 27.3752 14.7913C27.3609 14.5075 27.3252 14.1779 27.5344 13.9514C27.7344 13.7085 28.0753 13.7146 28.3621 13.7105C29.4622 13.7146 30.5613 13.7126 31.6604 13.7126C31.7298 12.3195 32.0625 10.8306 33.0524 9.79068C34.0147 8.7773 35.7945 8.72322 36.7916 9.71414ZM37.0804 16.3843C36.3375 15.873 35.3731 15.6975 34.4903 15.8526C33.6535 15.9945 32.9207 16.6782 32.7911 17.5273C32.7034 18.0957 32.9626 18.6733 33.3912 19.0428C33.9484 19.5571 34.6975 19.7551 35.4006 19.9816C36.0027 20.197 36.6395 20.496 36.9804 21.0665C37.2549 21.5237 37.1906 22.1482 36.8314 22.5411C36.4436 22.9708 35.8507 23.1545 35.2884 23.1932C34.4423 23.2228 33.6229 22.9054 32.933 22.4319C32.7422 22.2615 32.5911 22.5187 32.4687 22.634C32.9503 23.1912 33.6678 23.4769 34.3699 23.6382C35.2516 23.827 36.2477 23.7474 36.9916 23.2014C37.6978 22.685 37.8948 21.6635 37.5703 20.8766C37.3059 20.2786 36.7222 19.902 36.1405 19.6561C35.268 19.2714 34.1913 19.1591 33.5708 18.3559C33.134 17.8028 33.4259 16.9844 33.9719 16.6251C34.626 16.1679 35.4904 16.2659 36.1976 16.5364C36.4875 16.6292 36.7385 16.8323 37.0437 16.8741C37.2549 16.7935 37.2804 16.4914 37.0804 16.3843ZM33.4035 10.7469C32.8003 11.6082 32.6166 12.6818 32.5401 13.7095C34.177 13.7146 35.8139 13.7146 37.4498 13.7095C37.36 12.7798 37.1855 11.8338 36.7242 11.0112C36.4375 10.502 35.9844 10.0489 35.4006 9.91315C34.6413 9.71823 33.8331 10.1183 33.4035 10.7469Z"
                                fill="white" />
                            <path
                                d="M8.11613 33.0379C9.14205 34.0175 10.7394 33.9729 11.756 34.958C12.2198 35.3495 12.2717 36.0637 12.0083 36.5832C11.667 37.1639 10.949 37.3846 10.3127 37.4106C9.26078 37.4143 8.34803 36.8244 7.51134 36.2548C7.24419 36.4774 6.76184 36.8058 7.13844 37.1657C8.50757 38.4217 10.8618 38.943 12.396 37.6944C13.4925 36.8132 13.4461 35.0304 12.3868 34.1399C11.4518 33.1641 9.97131 33.1938 8.94169 32.3849C8.16807 31.8506 8.52612 30.5019 9.40734 30.3034C10.3034 30.0028 11.2254 30.3331 12.0306 30.7301C12.5704 31.0325 12.9174 30.077 12.4313 29.8303C11.3831 29.1346 9.93978 28.9194 8.77843 29.4518C7.45382 30.0195 7.00487 32.0547 8.11613 33.0379ZM13.9637 37.303C13.9674 37.6072 13.9637 37.9171 14.0249 38.2176C14.229 38.4773 14.7354 38.5089 14.9043 38.1972C15.2605 36.932 14.5295 35.3903 15.4664 34.2939C16.0971 33.4572 17.7186 33.524 18.0636 34.587C18.2807 35.7799 18.0228 37.0099 18.1935 38.2083C18.4681 38.5942 19.2417 38.418 19.1545 37.8967C19.1638 36.8949 19.1712 35.8931 19.1638 34.8913C19.173 33.6835 18.0043 32.6558 16.8188 32.7003C16.1454 32.6353 15.5406 32.9619 14.9803 33.2884C14.9785 32.0899 15.0248 30.8878 14.9673 29.6893C14.9803 29.3795 14.7354 29.0956 14.4071 29.1773C14.0138 29.142 13.9674 29.6003 13.9692 29.8897C13.9618 32.3608 13.9785 34.8319 13.9637 37.303ZM56.1989 33.5667C56.5773 33.96 56.6386 34.5555 56.5514 35.0731C56.364 36.2585 56.1377 37.4366 55.9243 38.6183C55.5236 38.6165 55.1229 38.6146 54.724 38.6146C54.7593 38.4532 54.8298 38.1304 54.865 37.969C54.0914 38.7463 52.802 39.1155 51.8299 38.4885C50.9135 37.8725 51.112 36.4607 51.8726 35.8003C52.8095 34.9209 54.225 34.9877 55.377 35.3272C55.3214 34.9413 55.4197 34.4182 55.0097 34.1974C54.2398 33.6909 53.2899 34.1139 52.6592 34.6445C52.4124 34.4275 52.1657 34.2104 51.919 33.9933C52.5367 33.4498 53.2788 33.0045 54.1211 32.9526C54.8427 32.9099 55.6924 32.9823 56.1989 33.5667ZM46.9044 30.8989C47.8876 30.923 48.8709 30.8785 49.8541 30.9156C50.7391 30.9564 51.611 31.5946 51.739 32.5073C51.9728 33.9785 50.7316 35.3625 49.3143 35.5795C48.6427 35.6723 47.9637 35.6463 47.2884 35.6574C47.1214 36.6407 46.9359 37.6202 46.7819 38.6072L45.5278 38.622C45.9898 36.047 46.4387 33.472 46.9044 30.8989ZM52.8948 36.2864C52.4236 36.585 52.2455 37.4032 52.8336 37.6815C53.8558 38.1267 54.9114 37.2752 55.2026 36.3105C54.481 36.0211 53.5886 35.8244 52.8948 36.2864ZM47.934 32.0862C47.7875 32.8784 47.6502 33.6743 47.4999 34.4683C48.3607 34.4126 49.3978 34.7039 50.0842 34.0249C50.5962 33.5574 50.6982 32.5073 49.9803 32.1882C49.3198 31.9897 48.613 32.1122 47.934 32.0862ZM22.2935 32.8283C23.7312 32.409 25.3582 33.3793 25.7831 34.7911C25.9872 35.5907 25.9 36.4941 25.4176 37.1806C24.4418 38.7204 21.9132 38.8558 20.7704 37.4403C20.032 36.5721 19.8372 35.2419 20.4216 34.2401C20.8149 33.5351 21.5273 33.0509 22.2935 32.8283ZM24.7739 36.1862C25.31 34.8987 23.9186 33.4628 22.607 33.8319C21.3084 34.0008 20.6015 35.7224 21.505 36.7093C22.3399 37.8707 24.3379 37.5368 24.7739 36.1862ZM27.8646 33.4628C28.7236 32.7708 29.9554 32.4739 30.9702 33.0027C32.4914 33.613 33.1927 35.6315 32.3041 37.0303C31.434 38.6146 29.1428 38.815 27.7867 37.7501C27.7848 38.8447 27.846 39.9429 27.7718 41.0356C27.7681 41.4735 27.2004 41.4289 26.911 41.3121C26.7823 41.1242 26.7609 40.903 26.7579 40.6802L26.7575 40.4141L26.7533 40.2843C26.7756 37.9894 26.7422 35.6964 26.7682 33.4034C26.7033 33.0657 27.0595 32.6539 27.4045 32.7986C27.744 32.8209 27.7403 33.2346 27.8646 33.4628ZM31.4525 34.7632C31.011 33.8728 29.8626 33.5815 28.9814 33.9525C28.1781 34.3106 27.6327 35.305 27.9926 36.1565C28.3117 37.1546 29.5473 37.7334 30.5064 37.2752C31.4637 36.9208 32.0425 35.6612 31.4525 34.7632ZM34.7715 33.1919C35.9829 32.3274 37.9772 32.7392 38.5765 34.151C38.7842 34.6612 38.9197 35.2586 38.7193 35.7929C38.5022 35.945 38.224 35.9135 37.9754 35.9302C36.8437 35.9357 35.7102 35.9098 34.5785 35.9431C34.7733 36.4255 34.9106 37.0266 35.4393 37.2585C36.2556 37.6406 37.1943 37.4125 37.9921 37.0915C38.4651 36.8262 38.8826 37.7111 38.4169 37.9467C37.3186 38.6295 35.7937 38.7222 34.6861 38.0043C33.1816 36.88 33.2391 34.2642 34.7715 33.1919ZM37.0738 33.9525C36.6155 33.7633 36.0886 33.7596 35.6156 33.8913C35.1295 34.0267 34.9236 34.5332 34.6898 34.9265C35.725 34.9432 36.7621 34.9413 37.7991 34.9265C37.6099 34.5703 37.4708 34.1288 37.0738 33.9525ZM40.8342 33.2865C41.8546 32.4702 43.4649 32.5964 44.3702 33.524C44.8693 34.1306 45.1457 34.9822 44.9379 35.7576C44.7079 35.9598 44.3813 35.9135 44.0993 35.932L41.8731 35.9261L40.76 35.9413C40.9641 36.4496 41.1348 37.073 41.7006 37.2937C42.4816 37.6073 43.361 37.4254 44.1142 37.1138C44.6281 36.7483 45.0789 37.7167 44.5706 37.9783C43.4259 38.6443 41.8249 38.7389 40.7433 37.8985C39.4206 36.7483 39.4818 34.3866 40.8342 33.2865ZM42.5667 33.791L42.4278 33.8023C41.6746 33.7095 41.144 34.2957 40.8862 34.9302C41.9176 34.9395 42.9491 34.9413 43.9806 34.9284C43.7895 34.229 43.1773 33.7039 42.4278 33.8023L42.5667 33.791ZM57.2062 33.1307C57.6645 34.8467 58.1023 36.5721 58.5847 38.2825C58.0429 39.1804 57.466 40.0561 56.9076 40.9429C57.3287 40.9466 57.7498 40.9484 58.1709 40.954C59.8054 38.3623 61.3878 35.7391 63 33.1344C62.5529 33.1325 62.1077 33.1307 61.6624 33.1307C60.924 34.3607 60.2488 35.6278 59.4603 36.8281C59.1468 35.5981 58.8703 34.3607 58.5624 33.1307C58.1097 33.1307 57.6571 33.1307 57.2062 33.1307Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
