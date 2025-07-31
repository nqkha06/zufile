@extends('layouts.member_2')

@section('title', __('Statistics'))
@section('subTitle', __('The data will be updated every hour.'))

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">


        <div class="lg:flex gap-6 justify-center">
            <div class="space-y-4 shrink-0 mb-6">
                <div class="bcard sm">
                    <div class="tm-sm">Total Download</div>
                    <div class="t-xl" id="slVJfk">
                        <span role="status">
                            <span class="sr-only">Loading...</span>
                            <svg class="animate-spin h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="bcard sm">
                    <div class="tm-sm">Paid download</div>
                    <div class="t-xl" id="PSMtgh">
                        <span role="status">
                            <span class="sr-only">Loading...</span>
                            <svg class="animate-spin h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="bcard sm">
                    <div class="tm-sm">Earn</div>
                    <div class="t-xl" id="rbKtqV">
                        <span role="status">
                            <span class="sr-only">Loading...</span>
                            <svg class="animate-spin h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="bcard sm">
                    <div class="tm-sm">CPM</div>
                    <div class="t-xl" id="PqKTBs">
                        <span role="status">
                            <span class="sr-only">Loading...</span>
                            <svg class="animate-spin h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:max-w-4xl space-y-6 flex-1">
                <div class="bcard !py-4 flex gap-4 items-center justify-between">
                    <div class="t-lg">Month</div>
                    <div id="VxJMvS">
                        <span role="status">
                            <span class="sr-only">Loading...</span>
                            <svg class="animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </div>
                    <select name="month" id="WXYcqZ"
                        class="text-right bg-transparent w-auto ring-0 focus:ring-0 hidden -my-1.5 -mx-3 dark:text-zinc-100 dark:bg-zinc-900">
                        <option value="2025-07">July 2025</option>
                    </select>
                </div>

                <section class="bcard">
                    <h2 class="t-lg">Chart</h2>
                    <div class="w-full relative aspect-[4/3] md:aspect-[16/9]">
                        <canvas id="chart"></canvas>
                    </div>
                </section>

                <section class="bcard !p-0">
                    <h2 class="t-lg mb-2 pt-4 px-4 lg:px-6">Daily</h2>
                    <ul class="px-4 lg:px-6 divide-y divide-zinc-100 dark:divide-zinc-800 overflow-y-auto max-h-80"
                        id="psJPhX">
                        <li>
                            <div class="space-y-8 text-center mx-auto p-4 sm:p-6 lg:p-8 min-h-full">
                                <div role="status" class="inline-block">
                                    <span class="sr-only">Loading...</span>
                                    <svg class="animate-spin h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>

                <section class="bcard !p-0">
                    <h2 class="t-lg mb-2 pt-4 px-4 lg:px-6">Top 10 Files</h2>
                    <ul class="px-4 lg:px-6 divide-y divide-zinc-100 dark:divide-zinc-800" id="vLrPWu">
                        <li>
                            <div class="space-y-8 text-center mx-auto p-4 sm:p-6 lg:p-8 min-h-full">
                                <div role="status" class="inline-block">
                                    <span class="sr-only">Loading...</span>
                                    <svg class="animate-spin h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
        {{-- <script src="{{ asset('backend/member/js/statistics.js') }}"></script> --}}

@endsection


@push('scripts')
    <script>stag('r', '2025-07');</script>

    {{-- <script src="{{ asset('backend/member/js/DDzrBGya.js') }}"></script> --}}

    <script type="module" src="{{ asset('backend/member/js/DDzrBGya.js') }}"></script>
    <script type="module" src="{{ asset('backend/member/js/statistics.js') }}"></script>
@endpush
