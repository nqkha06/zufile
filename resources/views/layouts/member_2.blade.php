<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="member">

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
    @vite(['resources/css/app.css'])
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

    @stack('modals')

    <div id="toast"></div>
    @stack('scripts')
</body>

</html>
