<div id="EJVeVi" class="sticky top-0 lg:top-0 z-20 shrink-0 bg-blue-600 dark:bg-zinc-900 transition-[top]">
    <style>
        @media (max-width: 640px) {
            .sub-dropdown-menu {
                position: fixed !important;
                right: 0.5rem !important;
                left: auto !important;
                top: 4rem !important;
                transform: none !important;
                max-width: calc(100vw - 1rem) !important;
                min-width: 250px !important;
                width: auto !important;
                z-index: 9999 !important;
            }

            .dropdown.dropend .sub-dropdown-menu {
                position: absolute !important;
                right: 30% !important;
                top: 35% !important;
                left: auto !important;
                max-width: calc(100vw - 2rem) !important;
                min-width: 200px !important;
                width: auto !important;
                transform: none !important;
            }

            /* Fix dropdown menu width on mobile */
            .sub-dropdown-menu {
                box-sizing: border-box;
            }

            .sub-dropdown-menu .dropdown-item {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        /* @media (min-width: 641px) {
            .dropdown.dropend .dropdown-menu {
                left: 100% !important;
                top: 0 !important;
            }
        } */
    </style>
    <div class="py-2 lg:hidden">
    <a href="/" class="flex items-center h-7 justify-center gap-x-2 text-white dark:text-white">
        <img
            src="{{ asset(Setting::get("web_favicon", "")) }}"
            alt="logo"
            class="h-7 w-auto"
        >
        <span class="text-xl font-bold">{{ Setting::get("web_name", config("app.name")) }}</span>
    </a>
</div>

    <div class="flex h-16 gap-x-6 px-4 sm:px-6 lg:px-8 text-white dark:border-b border-zinc-700">
        <div class="flex items-center lg:hidden">
            <button type="button" data-toggle="sidebar" class="-m-2.5 p-2.5 text-white hover:bg-white/10 rounded-md">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
            <form class="flex flex-1" action="/u/drive/search" method="GET">
                <label for="search-field" class="sr-only">Search</label>
                <div class="relative w-full">
                    <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-blue-200 dark:text-zinc-700"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                    {{-- <style>
                                #search-field:-webkit-autofill {
                        -webkit-box-shadow:0 0 0 50px transparent inset;
                        -webkit-text-fill-color: #999;
                        }
                        #search-field:-webkit-autofill:focus {
                            -webkit-box-shadow:0 0 0 50px transparent inset;
                            -webkit-text-fill-color: #999;
                        }
                            </style> --}}
                    <input id="search-field"
                        class="autofill:shadow-[0_0_0_50px_#2563eb_inset] dark:autofill:shadow-[0_0_0_50px_#18181b_inset] autofill:[-webkit-text-fill-color:white] block h-full w-full border-0 bg-transparent py-0 pl-8 pr-0 focus:ring-0 sm:text-sm outline-none placeholder:text-blue-400 dark:placeholder:text-zinc-700"
                        placeholder="Search..." type="search" name="q" value="">
                </div>
            </form>
        </div>

        <div class="flex items-center justify-end gap-x-8">
            @if (in_array(Route::currentRouteName(), ['u.files.home', 'u.files.show']))
            <button type="button" data-bs-toggle="modal" data-bs-target="#upload" aria-expanded="false">
                <span class="sr-only">Upload</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                </svg>
            </button>
            @else
            <a id="upload-link" class="!text-white" href="{{ route('u.files.home') }}#upload">
                <span class="sr-only">Upload</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path>
                </svg>
            </a>
            @endif


            <div class="dropdown">
                <button type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" class="dropdown-toggle">
                    <span class="sr-only">Your profile</span>
                    <img class="rounded-full z-10 size-8 bg-blue-800 relative"
                        src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220,0,20,20%22%20width=%2296%22%20height=%2296%22%3E%3Crect%20height=%2220%22%20width=%2220%22%20fill=%22hsl%28285,25%25,50%25%29%22/%3E%3Ctext%20fill=%22white%22%20x=%2210%22%20y=%2214.4%22%20font-size=%2212%22%20font-family=%22-apple-system,BlinkMacSystemFont,Trebuchet%20MS,Roboto,Ubuntu,sans-serif%22%20text-anchor=%22middle%22%3E{{ Auth::user()?->name[0] ?? '' }}%3C/text%3E%3C/svg%3E"
                        alt="profile">
                </button>
                <div class="dropdown-menu" role="menu" aria-orientation="vertical" tabindex="-1">
                    <div class="px-4 py-3" role="none">
                        <p class="tm-sm" role="none">Signed in as</p>
                        <p class="truncate text-sm font-medium text-black dark:text-white" role="none">
                            {{ Auth::user()?->name ?? '' }}</p>
                    </div>
                    <div class="py-1" role="none">
                        <a href="/u/account" class="dropdown-item" role="menuitem" tabindex="-1">Account
                            settings</a>
                        <button id="theme-switch" class="dropdown-item flex justify-between" role="menuitem" tabindex="-1">
                            <div>Theme</div>
                            <div id="current-theme" class="tm capitalize"></div>
                        </button>
                        <div class="dropdown dropend">
                            <button class="dropdown-item flex justify-between w-full" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Language</span>
                                <span id="current-language" class="tm capitalize">{{ str_replace('_', '-', app()->getLocale()) }}</span>
                            </button>
                            <div class="dropdown-menu sub-dropdown-menu" role="menu" aria-orientation="vertical" tabindex="-1">
                                <div class="py-1" role="none">
                                    @foreach (Language::getSupportedLanguages() as $lang)
                                    <a href="{{ route('lang.switcher', $lang->code) }}" class="dropdown-item" role="menuitem" tabindex="-1">{{ $lang->name }}</a>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#feedback"
                            class="dropdown-item" role="menuitem" tabindex="-1">Feedback</button>
                    </div>
                    <div class="py-1" role="none">
                        <a href="{{ route("auth.logout") }}" class="dropdown-item" role="menuitem"
                            tabindex="-1">Log out</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @hasSection('nav')
        @yield('nav')
    @endif
</div>
