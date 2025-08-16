<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="{{ Setting::get('web_description', 'Free simple file sharing and storage. Upload your image, video, music, document, config, and app share with everyone.') }}" />
    <meta property="og:site_name" content="{{ Setting::get('web_name', config('app.name')) }}" />
    <meta property="og:title"
        content="{{ $file->name . '.' . pathinfo($file->path, PATHINFO_EXTENSION) }} - {{ Setting::get('web_name', config('app.name')) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('icon-250.png') }}" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="250" />
    <meta property="og:image:height" content="250" />
    <meta property="og:image:alt" content="{{ Setting::get('web_name', config('app.name')) }}" />

    <meta property="og:description"
        content="{{ Setting::get("web_description") }}" />
    <title>{{ $file->name . '.' . pathinfo($file->path, PATHINFO_EXTENSION) }} - {{ Setting::get('web_name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="canonical" href="{{ route('download.index', $file->id) }}" />
    <link rel="preconnect" href="https://www.gstatic.com" />
    @vite(['resources/css/app.css'])
    <style>
        html {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-family: Poppins,sans-serif;
    font-weight: 400;
    font-style: normal
}

#sidebar>div {
    transition-property: all;
    transition-timing-function: cubic-bezier(.4,0,.2,1);
    transition-duration: .3s
}

#sidebar>div:first-child {
    opacity: 0
}

#sidebar>div:last-child {
    left: -100%
}

#sidebar.active>div:first-child {
    opacity: 1
}

#sidebar.active>div:last-child {
    left: 0
}

.btn-share {
    margin-right: .5rem;
    display: flex;
    width: -moz-fit-content;
    width: fit-content;
    align-items: center;
    border-radius: .375rem;
    padding: .25rem .75rem;
    font-size: .875rem;
    line-height: 1.25rem;
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity, 1))
}

.RYSf {
    border-radius: 1rem;
    border-width: 1px;
    --tw-border-opacity: 1;
    border-color: rgb(229 231 235 / var(--tw-border-opacity, 1));
    padding: 1rem
}

@media (min-width: 1024px) {
    .RYSf {
        padding:1.5rem
    }
}

[role=tooltip] {
    display: none;
    border-radius: .375rem;
    --tw-bg-opacity: 1;
    background-color: rgb(63 63 70 / var(--tw-bg-opacity, 1));
    padding: .25rem .75rem;
    font-size: .875rem;
    line-height: 1.25rem;
    --tw-text-opacity: 1;
    color: rgb(255 255 255 / var(--tw-text-opacity, 1))
}

[data-popper-arrow],[data-popper-arrow]:before {
    position: absolute;
    height: .5rem;
    width: .5rem;
    background-color: inherit
}

[data-popper-arrow] {
    visibility: hidden
}

[data-popper-arrow]:before {
    content: "";
    visibility: visible;
    --tw-rotate: 45deg;
    transform: translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
}

.cHNI {
    text-align: center;
    --tw-text-opacity: 1;
    color: rgb(156 163 175 / var(--tw-text-opacity, 1))
}

.cHNI iframe {
    display: inline-block
}

.cHNI small {
    display: block
}

.hover\:text-blue-600:hover {
    --tw-text-opacity: 1;
    color: rgb(37 99 235 / var(--tw-text-opacity, 1))
}

.hover\:text-gray-900:hover {
    --tw-text-opacity: 1;
    color: rgb(17 24 39 / var(--tw-text-opacity, 1))
}

.hover\:underline:hover {
    text-decoration-line: underline
}

.group:hover .group-hover\:block {
    display: block
}



    </style>
    <script>
        var uid = '1223';
    </script>
    {{-- <script data-cfasync="false" async type="text/javascript" src="//sysoutvariola.com/1clkn/70243"></script>
    <script data-cfasync="false" async type="text/javascript" src="//yv.fulcrumflambee.com/rDr9IzI6qN5/70242"></script> --}}



    {{-- <style>
        .g-recaptcha {
            display: inline-block;
            min-height: 71px;
        }
    </style>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>
    <script type="text/javascript">
        const _t = 'BBfBJsrUryUHdjcg7XW99fGzVKjiUC1TKXuQt4Wt';
        const _cv = true;
    </script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> --}}

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>
    <script type="text/javascript">
        const _t = '{{ csrf_token() }}';
        const _cv = true;
    </script>
</head>

<body>
    <header class="bg-white border-b border-gray-200">
        <nav class="mx-auto flex max-w-6xl items-center justify-between py-6 px-4 lg:p-6" aria-label="Global">
            <a href="{{ Setting::get("web_url", config("app.url")) }}" class="-m-1.5 p-1.5 flex gap-2 items-center">
                <img class="rounded-lg" src="{{ asset(Setting::get("site_logo")) }}" alt="logo" width="40px" height="40px" />
                <span class="text-xl font-bold">{{ Setting::get("web_name", config("app.name", "")) }}</span>

            </a>

            <a href="{{ route("auth.register") }}" type="submit"
                class="bg-blue-600 text-white font-semibold px-4 py-2 text-sm rounded-md flex items-center gap-2">

                <span>Sign up</span>
            </a>
        </nav>
    </header>

    <div class="mx-auto max-w-6xl py-6 px-4 lg:p-6">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 space-y-4">
                <section class="RYSf space-y-6">
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="shrink-0">
                                <img src="https://cdn.safefileku.com/icons/{{ pathinfo($file->path, PATHINFO_EXTENSION) }}.svg" alt="icon" width="64"
                                    height="64" />
                            </div>
                            <div class="min-w-0">
                                <h1 class="md:text-lg lg:text-xl font-semibold break-words">
                                    {{ $file->name . '.' . pathinfo($file->path, PATHINFO_EXTENSION) }}</h1>
                                <div>{{ $file->mime_type }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 text-green-400 text-sm bg-green-100 p-2 rounded-lg">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M10.49 2.23006L5.50003 4.11006C4.35003 4.54006 3.41003 5.90006 3.41003 7.12006V14.5501C3.41003 15.7301 4.19003 17.2801 5.14003 17.9901L9.44003 21.2001C10.85 22.2601 13.17 22.2601 14.58 21.2001L18.88 17.9901C19.83 17.2801 20.61 15.7301 20.61 14.5501V7.12006C20.61 5.89006 19.67 4.53006 18.52 4.10006L13.53 2.23006C12.68 1.92006 11.32 1.92006 10.49 2.23006Z" />
                                <path d="M9.05005 11.8701L10.66 13.4801L14.96 9.18005" />
                            </svg>
                            <p>No threats were detected, and the file is safe for use.</p>
                        </div>

                        <div>

                            <div class="flex">
                                <a class="btn-share" target="_blank" rel="noreferrer"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"
                                    style="background:#1877F2">
                                    <svg class="mr-1" width="16" height="16" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                    <span>Share</span>
                                </a>
                                <a class="btn-share" target="_blank" rel="noreferrer"
                                    href="https://twitter.com/intent/tweet?url={{ url()->full() }}"
                                    style="background:#000000">
                                    <svg class="mr-1" width="16" height="16" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                                    </svg>
                                    <span>Tweet</span>
                                </a>
                                <a class="btn-share" target="_blank" rel="noreferrer"
                                    href="https://pinterest.com/pin/create/button/?url={{ url()->full() }}"&description=Download+laravel+%281%29%60.log"
                                    style="background:#BD081C">
                                    <svg class="mr-1" width="16" height="16" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z" />
                                    </svg>
                                    <span>Pin</span>
                                </a>
                                <a id="btn-share-link" class="btn-share bg-blue-600 md:!hidden" href="#"
                                    aria-label="Share">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span class="sr-only">Share</span>
                                </a>
                            </div>
                        </div>

                        <script>
                            document.getElementById('btn-share-link').addEventListener('click', function() {
                                navigator.share({
                                    title: 'Download {{ $file->name . '.' . pathinfo($file->path, PATHINFO_EXTENSION) }} - {{ Setting::get('web_name', config('app.name')) }}',
                                    url: '{{ url()->full() }}',
                                });
                            });
                        </script>
                    </div>
                </section>


                {{-- <div class="cHNI">
                    <small><em>advertisement</em></small>
                    <div style="width:300px;height:100px;margin:0 auto;">

                    </div>
                </div> --}}

                <div class="hidden lg:block space-y-4">
                    <a href="{{ url('/') }}" aria-label="{{ Setting::get('web_name', config('app.name')) }}">
                        <img src="{{ asset('core/img/download/zufile.png') }}" alt=""
                            class="rounded-2xl w-full h-auto" loading="lazy" />
                    </a>
                    {{-- <section>
                        <h3 class="text-xl leading-6 font-medium mb-4">Related Files</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <a href="/download/MiubTjD58svFUo3M"
                                class="border rounded-2xl p-6 flex gap-2 items-center">
                                <div class="shrink-0">
                                    <img src="{{ asset('core/img/icons/png.svg') }}" alt="icon" width="64"
                                        height="64">
                                </div>
                                <div class="overflow-hidden">
                                    <div class="truncate font-medium mb-1 text-md">IMG_5133.png</div>
                                    <div class="text-xs">17/07/25 08:26 AM</div>
                                    <div class="flex items-center">
                                        <span class="mr-1">4.35 MB,</span>
                                        <svg class="mr-1 size-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        1
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section> --}}
                </div>
            </div>
            <div class="space-y-4">
                <section class="RYSf">
                    <h2 class="text-lg font-bold mb-4">Download</h2>
                    @if (Cookie::get('captcha_verified_' . $file->alias))
                        <div class="text-center space-y-1">
                            <button
                                id="download"
                                class="bg-blue-400 text-white font-semibold px-6 py-2 rounded-md"
                                        onclick="window.open('{{ Setting::get('direct_link_onclick_btn', '#') }}', '_blank')"
                                                >Getting...
                            </button>
                        <div>
                            @if (!empty(Setting::get('direct_link_fake_btn', null)))
                            <div class="text-gray-400">
                                <small><em>advertisement</em></small>
                            </div>
                            <a href="{{ Setting::get('direct_link_fake_btn', '#') }}" rel="nofollow" target="_blank" class="bg-blue-600 text-white font-semibold px-3 py-1.5 rounded-md text-xs">Fast Download</a>
                            @endif

                        <div class="adsbygoogle" style="height: 5px; width: 5px; position: absolute;"></div>

                    @else
                        <form method="POST" action="{{ route('download.verify-captcha', $file->alias) }}" class="text-center space-y-4">
                            @csrf
                            <div>
                                <div class="g-recaptcha" data-sitekey="{{ config('services.turnstile.site_key') }}" data-size="flexible"
                                    data-theme="light" id="recaptcha-element"></div>

                            </div>
                            <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md">I'm a
                                Human</button>
                        </form>
                    @endif
                </section>


                {{-- <div class="cHNI">
                    <small><em>advertisement</em></small>
                    <div style="width:300px;height:250px;margin:0 auto;">

                    </div>
                </div> --}}

                <section class="RYSf space-y-4">
                    <h2 class="text-lg font-bold">Information</h2>

                    <div>
                        <div class="font-semibold">Download</div>
                        <div class="text-gray-600">{{ $file->download_count }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Size</div>
                        <div class="text-gray-600">{{ formatBytes($file->size) }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Type</div>
                        <div class="text-gray-600">{{ $file->mime_type }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Uploaded date</div>
                        <div class="text-gray-600">{{ $file->created_at->format('d M Y, h:i A') }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Uploader</div>
                        <div class="text-gray-600">{{ $file->user->name }}</div>
                    </div>
                    <hr>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 9V14" stroke-width="1.5" />
                            <path
                                d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z"
                                stroke-width="1.5" />
                            <path d="M11.9945 17H12.0035" stroke-width="2" />
                        </svg>
                        <a href="{{ route("report.alias", $file->alias) }}" rel="noopener nofollow ugc"
                            target="_blank" class="hover:underline">Report file</a>
                    </div>
                </section>
            </div>

            <div class="block lg:hidden space-y-4">
                <a href="{{ url('/') }}" aria-label="{{ Setting::get('web_name', config('app.name')) }}">
                    <img src="{{ asset('core/img/download/zufile.png') }}" alt=""
                        class="rounded-2xl w-full h-auto" loading="lazy" />
                </a>
                {{-- <section>
                    <h3 class="text-xl leading-6 font-medium mb-4">Related Files</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="/download/MiubTjD58svFUo3M" class="border rounded-2xl p-6 flex gap-2 items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('core/img/icons/png.svg') }}" alt="icon" width="64"
                                    height="64">
                            </div>
                            <div class="overflow-hidden">
                                <div class="truncate font-medium mb-1 text-md">IMG_5133.png</div>
                                <div class="text-xs">17/07/25 08:26 AM</div>
                                <div class="flex items-center">
                                    <span class="mr-1">4.35 MB,</span>
                                    <svg class="mr-1 size-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    1
                                </div>
                            </div>
                        </a>
                    </div>
                </section> --}}
            </div>
        </div>


    </div>




    <footer class="my-8 px-6">
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
            <a href="{{ url('/terms') }}" class="leading-6 text-gray-500 hover:text-gray-900">Terms of Use</a>
            <a href="{{ url('/privacy') }}" class="leading-6 text-gray-500 hover:text-gray-900">Privacy Policy</a>
        </div>
        <p class="mt-4 text-center text-xs leading-5 text-gray-500">© 2025 {{ Setting::get("web_name") }}. All rights reserved.</p>
    </footer>

    <script type="module" src="{{ asset("backend/member/js/dwl.js") }}"></script>
</body>

</html>
