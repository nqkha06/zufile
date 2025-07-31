<!DOCTYPE html>
<html lang="en" class="member">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Free Drive') - {{ Setting::get('web_name', config("app.name", '')) }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('backend/member/css/style.css') }}" />
    <style>
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
    <script>
        const options = {};
    </script>

        <script>
        window.dataTag = window.dataTag || {};
        function stag(){for(let i=0;i<arguments.length;i+=2){dataTag[arguments[i]] = arguments[i+1];}}
    </script>

</head>

<body>
    @include('partials.member_2.sidebar')
    <div class="fixed inset-0 bg-zinc-500 dark:bg-zinc-800 bg-opacity-75 z-20 hidden"></div>
    <div class="relative lg:pl-72">
        @include('partials.member_2.headerr')

        <main>
            @include('partials.member_2.header')

            @include('partials.member_2.alert')

            @yield('content')
        </main>
    </div>

    <script type="module" src="{{ asset("backend/member/js/CmT8QYmq.js") }}"></script>

    <div>
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="feedback">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div class="overflow-hidden">
                            <div class="flex flex-nowrap relative left-0 transition-all duration-300">
                                <div class="shrink-0 w-full text-center space-y-6">

                                    <p>Let&#039;s send your feedback</p>
                                    <p class="tm-sm">Make this service even better with your feedback.</p>
                                    <form id="FCdOBm" class="text-left space-y-4">
                                        <div class="field space-y-1">
                                            <label for="feedback-type">Type</label>
                                            <select class="" name="type" id="feedback-type"
                                                required="required">
                                                <option value="suggestion">Suggestion</option>
                                                <option value="issue">Issue</option>
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="feedback-message">Feedback</label>
                                            <textarea name="message" id="feedback-message" rows="4" required></textarea>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            <button type="submit" class="button">Send</button>
                                            <button type="button" class="button secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="shrink-0 w-full text-center space-y-4 hidden">
                                    <svg class="h-48 mx-auto" viewBox="0 0 83 98" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M82.7985 41.7368C82.7985 19.0979 64.4174 0.716797 41.7785 0.716797C19.1396 0.716797 0.758503 19.0979 0.758503 41.7368C0.758503 64.3758 19.1396 82.7568 41.7785 82.7568C64.4174 82.7568 82.7985 64.3758 82.7985 41.7368Z"
                                            fill="#00D06C" />
                                        <path
                                            d="M57.9567 26.4C57.5514 26.1167 57.0942 25.9161 56.6113 25.8094C56.1284 25.7027 55.6291 25.692 55.142 25.778C54.6549 25.8641 54.1896 26.0451 53.7726 26.3108C53.3556 26.5765 52.9951 26.9216 52.7117 27.3265L38.3934 47.7489L29.0051 41.3442C28.2522 40.8298 27.3254 40.6351 26.4288 40.8032C25.5322 40.9713 24.7391 41.4881 24.2241 42.2401C23.709 42.992 23.5142 43.9177 23.6824 44.8131C23.8507 45.7086 24.3681 46.5006 25.1211 47.015L37.7055 55.5997C38.093 55.8639 38.5311 56.0454 38.9921 56.1328C39.4531 56.2203 39.9273 56.2117 40.3849 56.1078C40.8729 56.0225 41.3394 55.8419 41.7574 55.5764C42.1755 55.3108 42.5369 54.9654 42.8211 54.56L58.8849 31.6411C59.4574 30.8227 59.6812 29.8108 59.507 28.8277C59.3328 27.8446 58.775 26.9708 57.9561 26.3983"
                                            fill="white" />
                                        <path
                                            d="M41.0185 90.331C53.1824 90.331 63.0585 92.0338 63.0585 94.131C63.0585 96.2282 53.1824 97.931 41.0185 97.931C28.8546 97.931 18.9785 96.2282 18.9785 94.131C18.9785 92.0338 28.8546 90.331 41.0185 90.331Z"
                                            fill="#E3E3E3" />
                                    </svg>
                                    <div>
                                        <p>Thank you</p>
                                        <p class="tm-sm">Your feedback has been sent</p>
                                    </div>
                                    <button type="button" class="button secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="dYnF">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div class="prose dark:prose-invert mx-auto">
                            <h2 class="text-center">Important Notice</h2>
                            <p>Updates to Our Service</p>
                            <ul>
                                <li>Storage for subscriptions is now separated.</li>
                                <li>Free storage now increased to 10TB.</li>
                            </ul>
                            <button class="button mt-6" data-bs-dismiss="modal">I Understand</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <input type="file" id="file" class="hidden" multiple />
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="upload">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div class="flex justify-between items-center gap-4 mb-4">
                            <div class="t-lg">Upload</div>
                        </div>
                        <ul class="menu-list mb-4" role="list">
                            <li>
                                <label for="file" class="flex items-center cursor-pointer">
                                    <svg class="size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path
                                            d="M6.44 2H17.55C21.11 2 22 2.89 22 6.44V12.77C22 16.33 21.11 17.21 17.56 17.21H6.44C2.89 17.22 2 16.33 2 12.78V6.44C2 2.89 2.89 2 6.44 2Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 17.22V22" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M2 13H22" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.5 22H16.5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>From my device</span>
                                </label>
                            </li>
                            <li>
                                <button class="w-full" data-bs-toggle="modal" data-bs-target="#FsDyTn">
                                    <svg class="size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path
                                            d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>From URL</span>

                                </button>
                            </li>
                        </ul>

                        <div class="tm-sm">Uploads are <b>{{ UserSetting::get('private_upload', 0) == 0 ? 'public' : 'private' }}</b> by default. <a href="/u/account#upload-section"
                                class="leading-6">Change</a></div>
                        <button type="button" class="hidden" data-bs-dismiss="modal" aria-hidden="true" id="upload-dismiss-btn"></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="WvEsUY" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-2">
                                <span class="t-lg">Upload</span>
                                <button class="-m-1.5 p-1.5 rounded-md hover:bg-gray-100" data-bs-dismiss="modal">
                                    <span class="sr-only">Minimize</span>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M6 12H18" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div id="XkZctI" class="space-y-4"></div>
                            <button class="flex items-center gap-1 tm-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#upload">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M8 12H16" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 16V8" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Add file</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="FsDyTn">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <form id="url" class="space-y-4">
                            <div class="t-lg">Upload from URL</div>
                            <div class="field space-y-1">
                                <input class="" type="url" name="url" placeholder="URL"
                                    required="required" />
                                <p class="tm-xs">Support: MediaFire and any direct url</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <button type="submit" class="button">Upload</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="mhSRMa" class="fixed bottom-8 right-8 animate-slide-in-bottom hidden" data-bs-toggle="tooltip"
            title="Uploading">
            <button class="bg-blue-600 text-white shadow-lg rounded-full p-4" data-bs-toggle="modal"
                data-bs-target="#WvEsUY">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
            </button>
        </div>

        <template id="sDRcxC">
            <div class="upld pending">
                <div class="upld-container">
                    <div class="upld-name">{name}</div>
                    <div class="upld-bar">
                        <div style="width:0%"></div>
                    </div>
                    <div class="flex justify-between text-xs">
                        <div>In Queue</div>
                        <div>
                            <span>0 B</span>
                            <span>/</span>
                            <span>{size}</span>
                        </div>
                    </div>
                </div>
                <button class="upld-share hidden" data-bs-toggle="modal" data-bs-target="#file-share">
                    <span class="sr-only">Share</span>
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M16.1391 2.95907L7.10914 5.95907C1.03914 7.98907 1.03914 11.2991 7.10914 13.3191L9.78914 14.2091L10.6791 16.8891C12.6991 22.9591 16.0191 22.9591 18.0391 16.8891L21.0491 7.86907C22.3891 3.81907 20.1891 1.60907 16.1391 2.95907ZM16.4591 8.33907L12.6591 12.1591C12.5091 12.3091 12.3191 12.3791 12.1291 12.3791C11.9391 12.3791 11.7491 12.3091 11.5991 12.1591C11.3091 11.8691 11.3091 11.3891 11.5991 11.0991L15.3991 7.27907C15.6891 6.98907 16.1691 6.98907 16.4591 7.27907C16.7491 7.56907 16.7491 8.04907 16.4591 8.33907Z"
                            fill="currentColor" />
                    </svg>
                </button>
                <button class="upld-close hidden">
                    <span class="sr-only">Close</span>
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M9.16998 14.83L14.83 9.17004" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.83 14.83L9.16998 9.17004" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </template>

        <script>
            options.upload_private = Boolean({{ UserSetting::get('private_upload', 0) }});
        </script>

        <script type="module" src="{{ asset("backend/member/js/B31wQSGk.js") }}"></script>
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="file-share">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div id="share-public" class="space-y-4 hidden">
                            <div class="t-lg">Share</div>
                            <p class="tm-sm">Share this file via</p>
                            <div class="flex gap-4">
                                <a id="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u={url}"
                                    target="_blank" rel="nofollow noreferrer"
                                    class="rounded-full p-4 shrink-0 !text-[#0866FF] bg-[#0866FF]/10">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a id="share-twitter" href="https://twitter.com/intent/tweet?text={url}"
                                    target="_blank" rel="nofollow noreferrer"
                                    class="rounded-full p-4 shrink-0 !text-[#000000] bg-[#000000]/10 dark:bg-[#666]/10">
                                    <span class="sr-only">X</span>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                                    </svg>
                                </a>
                                <a id="share-whatsapp" href="https://wa.me/send?text={url}" target="_blank"
                                    rel="nofollow noreferrer"
                                    class="rounded-full p-4 shrink-0 !text-[#25D366] bg-[#25D366]/10">
                                    <span class="sr-only">WhatsApp</span>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                </a>
                                <a id="share-telegram" href="https://t.me/share/url?url={url}" target="_blank"
                                    rel="nofollow noreferrer"
                                    class="rounded-full p-4 shrink-0 !text-[#26A5E4] bg-[#26A5E4]/10">
                                    <span class="sr-only">Telegram</span>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                                    </svg>
                                </a>
                            </div>
                            <p class="tm-sm">Or copy link</p>
                            <div>
                                <div class="relative rounded-md">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <input type="text" class="!pl-10 !pr-14" id="download-link">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-1.5">
                                        <button
                                            class="bg-blue-600 text-white rounded text-xs font-medium py-1 px-2">Copy</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tm-sm">File is publicly accessible. <button type="button"
                                    class="text-blue-600 hover:text-blue-500 leading-6" id="set-private">Set to
                                    private</button></div>
                        </div>
                        <div id="share-private" class="space-y-4 hidden">
                            <div class="t-lg">File is private</div>
                            <p class="tm-sm">While this item is private, it cannot be shared, and any previous sharing
                                links will be disabled. Click the button below to enable sharing.</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" class="button" id="set-public">Make public</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-move">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div loading>
                            <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                        <form class="hidden space-y-4">
                            {{-- <input type="hidden" name="drive" value=""> --}}
                            <div class="t-lg break-words" title></div>
                            <ul class="list overflow-y-auto max-h-96"></ul>
                            <svg id="kkyp" class="animate-spin h-8 w-8 text-blue-600 mx-auto" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="submit" class="button" disabled="disabled">Move</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-rename">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <form class="space-y-4">
                            <div class="t-lg">Rename</div>
                            <div class="field space-y-1">
                                <input class="" type="text" name="name" placeholder="File name"
                                    autocomplete="off" />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="submit" class="button">Rename</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-folder">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <form id="form-new-folder" class="space-y-4">
                            <div class="t-lg">New folder</div>
                            <div class="field space-y-1">
                                <input class="" type="text" name="name" placeholder="Name"
                                    autocomplete="off" />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="submit" class="button">Create</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @stack('modals')
        @stack('scripts')
    </div>
    <div id="toast"></div>
</body>

</html>
