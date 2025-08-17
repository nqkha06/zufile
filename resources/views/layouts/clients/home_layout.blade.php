<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @hasSection('meta_seo')
    @yield('meta_seo')
    @else
    <meta name="description"
        content="{{ Setting::get('web_description', 'Free simple file sharing and storage. Upload your image, video, music, document, config, and app share with everyone.') }}" />
    <meta name="keywords" content="{{ Setting::get('web_keywords', strtolower(Setting::get('web_name', config('app.name'))).', file, cloud, storage') }}" />
    <meta property="og:title" content="@yield('title', '')" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ Setting::get('web_name', config('app.name')) }}" />
    <meta property="og:url" content="{{ Setting::get('web_url', config('app.url', url('/'))) }}" />
    <meta property="og:image" content="{{ asset('icon-250.png') }}" />
    @endif

    <title>@yield('title', config("app.name"))</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    {{-- <link rel="stylesheet" href="{{ asset('backend/member/css/style.css') }}" /> --}}
    <style>
       .circles{position:absolute;top:0;left:0;width:100%;height:100%;overflow:hidden}.circles li{border-radius:8px;position:absolute;display:block;list-style:none;width:20px;height:20px;background:rgba(255,255,255,.2);animation:25s linear infinite animate;bottom:-150px;display:flex;justify-content:center;align-items:center}.circles li:first-child{left:25%;width:80px;height:80px;animation-delay:0s}.circles li:nth-child(2){left:10%;width:20px;height:20px;animation-delay:2s;animation-duration:12s}.circles li:nth-child(3){left:70%;width:20px;height:20px;animation-delay:4s}.circles li:nth-child(4){left:40%;width:60px;height:60px;animation-delay:0s;animation-duration:18s}.circles li:nth-child(5){left:65%;width:20px;height:20px;animation-delay:0s}.circles li:nth-child(6){left:75%;width:110px;height:110px;animation-delay:3s}.circles li:nth-child(7){left:35%;width:150px;height:150px;animation-delay:7s}.circles li:nth-child(8){left:50%;width:25px;height:25px;animation-delay:15s;animation-duration:45s}.circles li:nth-child(9){left:20%;width:15px;height:15px;animation-delay:2s;animation-duration:35s}.circles li:nth-child(10){left:85%;width:150px;height:150px;animation-delay:0s;animation-duration:11s}@keyframes animate{0%{transform:translateY(0) rotate(0);opacity:1}100%{transform:translateY(-1000px) rotate(720deg);opacity:0}}
    </style>
    @vite(['resources/css/app.css'])

</head>

<body class="flex h-full flex-col">
    <header class="bg-blue-600">
        <nav>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-50 flex justify-between py-8">
                <div class="relative z-10 flex items-center gap-16">
                    <a aria-label="Home" href="/" class="flex items-center gap-3">
                        <img
                src="{{ asset(Setting::get('site_logo', '')) }}"
                alt="Logo Upload"
                class="h-10 md:h-12 w-auto"
                width="170" height="53"
                loading="lazy" decoding="async"
                />
                <span class="text-white text-xl md:text-2xl font-semibold tracking-tight">
                    {{ Setting::get('web_name', config('app.name')) }}
                </span>

                    </a>

                    @if ($menus->where('slug', 'home-header-menu')->first())
                        <div class="hidden lg:flex lg:gap-4" id="navbar-menu">
                            @foreach ($menus->where('slug', 'home-header-menu')->first()->items->sortBy('order') as $item)
                                <a href="{{ $item->url }}"
                                    class="relative rounded-lg px-3 py-2 text-sm text-blue-200 transition-colors delay-150 hover:text-white hover:bg-white/10 hover:delay-[0ms]">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="flex items-center gap-6">
                    @guest
                        <a href="{{ route('auth.login') }}"
                            class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden !text-white hidden lg:block border border-white">Log
                            in</a>
                        <a href="{{ route('auth.register') }}"
                            class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden bg-white !text-blue-600 hidden lg:block border border-white">Register</a>
                    @else
                        <a href="/u/drive/1/home"
                            class="relative rounded-lg px-3 py-2 text-sm text-blue-200 transition-colors delay-150 hover:text-white hover:bg-white/10 hover:delay-[0ms] hidden lg:inline-block">File
                            Manager</a>
                        <div class="dropdown">
                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Your profile</span>
                                <img class="rounded-full z-10 size-8 bg-blue-800 relative"
                                    src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220,0,20,20%22%20width=%2296%22%20height=%2296%22%3E%3Crect%20height=%2220%22%20width=%2220%22%20fill=%22hsl%28285,25%25,50%25%29%22/%3E%3Ctext%20fill=%22white%22%20x=%2210%22%20y=%2214.4%22%20font-size=%2212%22%20font-family=%22-apple-system,BlinkMacSystemFont,Trebuchet%20MS,Roboto,Ubuntu,sans-serif%22%20text-anchor=%22middle%22%3E{{ Auth::user()?->name[0] ?? '' }}%3C/text%3E%3C/svg%3E"
                                    alt="profile">
                            </button>
                            <div class="dropdown-menu" role="menu" aria-orientation="vertical" tabindex="-1">
                                <div class="px-4 py-3" role="none">
                                    <p class="tm-sm" role="none">Signed in as</p>
                                    <p class="truncate text-sm font-medium text-black dark:text-white" role="none">{{ Auth::user()?->name ?? '' }}</p>
                                </div>
                                <div class="py-1" role="none">
                                    <a href="/u/account" class="dropdown-item" role="menuitem" tabindex="-1">Account
                                        settings</a>
                                    <button id="theme-switch" class="dropdown-item flex justify-between" role="menuitem">
                                        <div>Theme</div>
                                        <div id="current-theme" class="tm capitalize"></div>
                                    </button>
                                    <a href="/u/support" class="dropdown-item" role="menuitem"
                                        tabindex="-1">Support</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#feedback"
                                        class="dropdown-item" role="menuitem" tabindex="-1">Feedback</button>
                                </div>
                                <div class="py-1" role="none">
                                    <a href="{{ route('auth.logout') }}" class="dropdown-item" role="menuitem"
                                        tabindex="-1">Log out</a>
                                </div>
                            </div>
                        @endguest
                            </div>

                        <div class="lg:hidden leading-[0]">
                            <button
                                class="relative z-10 -m-2 inline-flex items-center rounded-lg stroke-white p-2 hover:bg-white/10 active:stroke-gray-300 [&amp;:not(:focus-visible)]:focus:outline-none"
                                aria-label="Toggle site navigation" type="button" aria-expanded="false"
                                aria-controls="menu-mobile-dropdown-content">
                                <span class="sr-only">Menu</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                                    <path d="M5 6h14M5 18h14M5 12h14" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div class="hidden fixed inset-0 z-0 backdrop-blur transition-opacity animate-fade-in"
                                aria-hidden="true"></div>
                            <div class="hidden absolute inset-x-0 top-0 z-0 origin-top rounded-b-2xl bg-blue-600 px-6 pb-6 pt-32 shadow-2xl shadow-gray-900/20 animate-slide-in-top"
                                id="menu-mobile-dropdown-content" tabindex="-1">
                                @if ($menus->where('slug', 'home-header-menu')->first())
                                    <div class="space-y-1 -mx-6">
                                        @foreach ($menus->where('slug', 'home-header-menu')->first()->items->sortBy('order') as $item)
                                            <a href="{{ $item->url }}"
                                                class="block py-1.5 px-6 text-base leading-7 tracking-tight text-blue-200 hover:text-white transition-colors hover:bg-white/10 delay-150 hover:delay-[0ms]">{{ $item->name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="mt-8 flex flex-col gap-4 text-center">

                                @guest
                                    <a href="{{ route('auth.login') }}"
                                        class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden !text-white border border-white">Log
                                        in</a>
                                    <a href="{{ route('auth.register') }}"
                                        class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden bg-white !text-blue-600 border border-white">Register</a>
                                @else
                                <a href="{{ route('u.files.home') }}" class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden !text-white border border-white">File Manager</a>
                                @endguest
                                                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </nav>
    </header>
    @yield('content')

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
            @if ($menus->where('slug', 'home-foot-menu')->first())
                <nav class="-mb-6 flex justify-center gap-x-12 flex-wrap" aria-label="Footer">

                @foreach ($menus->where('slug', 'home-foot-menu')->first()->items->sortBy('order') as $item)
                    <div class="pb-6">
                        <a href="{{ $item->url }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ $item->name }}</a>
                    </div>
                @endforeach
                </nav>
            @endif


            <div class="mt-10 text-center text-xs gap-6 columns-2 flex justify-center">
                <a href="/terms" class="leading-6 text-gray-500 hover:text-gray-900">Terms of Use</a>
                <a href="/privacy" class="leading-6 text-gray-500 hover:text-gray-900">Privacy Policy</a>
            </div>

            <p class="mt-4 text-center text-xs leading-5 text-gray-500">© 2023 {{ Setting::get('web_name', config('app.name')) }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Google tag (gtag.js) -->
    <script type="module" src={{ asset("js/script.js") }}></script>
    <script type="module" src={{ asset("backend/member/js/DDzrBGya.js") }}></script>
        @vite(['resources/js/app.js'])

</body>

</html>
