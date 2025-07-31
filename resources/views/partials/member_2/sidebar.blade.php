<div class="sidebar menu-list -left-full">
    <div
        class="flex justify-between h-16 shrink-0 items-center bg-blue-600 dark:bg-zinc-900 dark:border-b border-zinc-700 px-6">
        <a href="/" class="flex items-center h-8 justify-center gap-x-2 text-white dark:text-white">
        <img
            src="{{ asset(Setting::get("web_favicon", "")) }}"
            alt="logo"
            class="h-8"
        >
        <span class="text-xl font-bold">{{ Setting::get("web_name", config("app.name")) }}</span>
    </a>
        <button type="button" data-toggle="sidebar"
            class="-m-2.5 p-2.5 text-white hover:bg-white/10 rounded-md lg:hidden">
            <span class="sr-only">Close sidebar</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path
                    d="M15.0001 19.9201L8.48009 13.4001C7.71009 12.6301 7.71009 11.3701 8.48009 10.6001L15.0001 4.08008"
                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    <div
        class="flex grow flex-col gap-y-5 overflow-y-auto p-6 lg:border-r border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900">
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <li>
                            <a href="/u/drive/1/home" {{-- class="active" --}}>
                                <svg class="size-6 shrink-0" aria-hidden="true" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M19.32 10H4.69002C3.21002 10 2.01001 8.79002 2.01001 7.32002V4.69002C2.01001 3.21002 3.22002 2.01001 4.69002 2.01001H19.32C20.8 2.01001 22 3.22002 22 4.69002V7.32002C22 8.79002 20.79 10 19.32 10Z" />
                                    <path
                                        d="M19.32 22H4.69002C3.21002 22 2.01001 20.79 2.01001 19.32V16.69C2.01001 15.21 3.22002 14.01 4.69002 14.01H19.32C20.8 14.01 22 15.22 22 16.69V19.32C22 20.79 20.79 22 19.32 22Z" />
                                    <path d="M6 5V7" />
                                    <path d="M10 5V7" />
                                    <path d="M6 17V19" />
                                    <path d="M10 17V19" />
                                    <path d="M14 6H18" />
                                    <path d="M14 18H18" />
                                </svg>
                                <div class="w-full text-xs font-semibold">
                                    @php
                                        $user = auth()->user();
                                        $storagePercent = $user->getStorageUsagePercentage();
                                        $activePlan = $user->getActivePlan(); // For limits
                                        $displayName = $user->getDisplayPlanName(); // For display
                                    @endphp
                                    <span class="leading-6">{{ $displayName }} Drive</span>
                                    <div class="h-2 w-full rounded-md bg-blue-200 overflow-hidden">
                                        <div class="h-2 bg-blue-600" style="width:{{ $storagePercent }}%"></div>
                                    </div>
                                    <span class="leading-6">{{ $user->used_storage_formatted ?? '0 B' }} / {{ $activePlan->formatted_storage_limit ?? 'Unlimited' }}</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('plans.index') }}"
                                class="justify-center !text-xs border border-dashed border-zinc-300 dark:border-zinc-700">Get
                                more storage</a>
                        </li>
                    </ul>
                </li>
                @foreach (config('member.sidebar') as $section)
                    <li>
                        @if ($section['section'])
                            <div class="text-xs font-semibold leading-6 text-gray-400">{{ $section['section'] }}</div>
                        @endif
                        <ul role="list" class="-mx-2 {{ $section['section'] ? 'mb-2' : '' }} space-y-1">
                            @foreach ($section['items'] as $item)
                                <li>
                                    @php
                                        $isActive = request()->url() === url($item['href']);
                                    @endphp
                                    <a href="{{ $item['href'] }}"
                                        class="{{ ($item['class'] ?? '') . ($isActive ? ' active bg-blue-100 text-blue-700 dark:bg-zinc-800' : '') }}">

                                        @if (isset($item['icon_svg']))
                                            {{-- Gộp icon inline theo key --}}
                                            @switch($item['icon_svg'])
                                                @case('drive')
                                                    <svg class="size-6 shrink-0" aria-hidden="true" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M19.32 10H4.69C3.21 10 2.01 8.79 2.01 7.32V4.69C2.01 3.21 3.22 2.01 4.69 2.01H19.32C20.8 2.01 22 3.22 22 4.69V7.32C22 8.79 20.79 10 19.32 10Z" />
                                                        <path
                                                            d="M19.32 22H4.69C3.21 22 2.01 20.79 2.01 19.32V16.69C2.01 15.21 3.22 14.01 4.69 14.01H19.32C20.8 14.01 22 15.22 22 16.69V19.32C22 20.79 20.79 22 19.32 22Z" />
                                                        <path d="M6 5V7" />
                                                        <path d="M10 5V7" />
                                                        <path d="M6 17V19" />
                                                        <path d="M10 17V19" />
                                                        <path d="M14 6H18" />
                                                        <path d="M14 18H18" />
                                                    </svg>
                                                @break

                                                @case('trash')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M21 5.98C17.67 5.65 14.32 5.48 10.98 5.48C9 5.48 7.02 5.58 5.04 5.78L3 5.98"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M18.85 9.14L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79C6 22 5.91 20.78 5.8 19.21L5.15 9.14"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M10.33 16.5H13.66M9.5 12.5H14.5" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                @break

                                                @case('statistics')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M7.33 14.49L9.71 11.4C10.05 10.96 10.68 10.88 11.12 11.22L12.95 12.66C13.39 13 14.02 12.92 14.36 12.49L16.67 9.51"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                @break

                                                @case('referrals')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M9.16 10.87C9.06 10.86 8.94 10.86 8.83 10.87C6.45 10.79 4.56 8.84 4.56 6.44C4.56 3.99 6.54 2 9 2C11.45 2 13.44 3.99 13.44 6.44C13.43 8.84 11.54 10.79 9.16 10.87Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M4.16 14.56C1.74 16.18 1.74 18.82 4.16 20.43C6.91 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.92 12.73 4.16 14.56Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M18.34 20C19.06 19.85 19.74 19.56 20.3 19.13C21.86 17.96 21.86 16.03 20.3 14.86C19.75 14.44 19.08 14.16 18.37 14"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                @break

                                                @case('revenue')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M8 11.4C8 12.17 8.6 12.8 9.33 12.8H10.83C11.47 12.8 11.99 12.25 11.99 11.58C11.99 10.85 11.67 10.59 11.2 10.42L8.8 9.58C8.32 9.41 8 9.15 8 8.42C8 7.75 8.52 7.2 9.16 7.2H10.66C11.4 7.21 12 7.83 12 8.6"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M10 12.85V13.59M10 6.41V7.19" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.99 17.98C14.4 17.98 17.98 14.4 17.98 9.99C17.98 5.58 14.4 2 9.99 2C5.58 2 2 5.58 2 9.99C2 14.4 5.58 17.98 9.99 17.98Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M12.98 19.88C13.88 21.15 15.35 21.98 17.03 21.98C19.76 21.98 21.98 19.76 21.98 17.03C21.98 15.37 21.16 13.9 19.91 13"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                @break

                                                @case('credit-card')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                                        <line x1="1" y1="10" x2="23" y2="10"/>
                                                    </svg>
                                                @break

                                                @case('dashboard')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="3" y="3" width="7" height="7"/>
                                                        <rect x="14" y="3" width="7" height="7"/>
                                                        <rect x="14" y="14" width="7" height="7"/>
                                                        <rect x="3" y="14" width="7" height="7"/>
                                                    </svg>
                                                @break

                                                @case('chart')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>
                                                    </svg>
                                                @break

                                                @case('users')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                                        <circle cx="9" cy="7" r="4"/>
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                    </svg>
                                                @break

                                                @case('user')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                                        <circle cx="12" cy="7" r="4"/>
                                                    </svg>
                                                @break

                                                @case('help')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"/>
                                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                                                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                                                    </svg>
                                                @break

                                                @case('upgrade')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="12" y1="19" x2="12" y2="5"/>
                                                        <polyline points="5,12 12,5 19,12"/>
                                                    </svg>
                                                @break

                                                @case('support')
                                                    <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.49 2 11.97 2C6.45 2 1.97 6.48 1.97 12C1.97 17.52 6.45 22 11.97 22Z" />
                                                        <path
                                                            d="M12 16.5C14.49 16.5 16.5 14.49 16.5 12C16.5 9.51 14.49 7.5 12 7.5C9.51 7.5 7.5 9.51 7.5 12C7.5 14.49 9.51 16.5 12 16.5Z" />
                                                        <path
                                                            d="M4.9 4.93L8.44 8.46M4.9 19.07L8.44 15.54M19.05 19.07L15.51 15.54M19.05 4.93L15.51 8.46" />
                                                    </svg>
                                                @break
                                            @endswitch
                                        @elseif(isset($item['icon_img']))
                                            <img src="{{ $item['icon_img'] }}" class="size-6 shrink-0"
                                                />
                                        @endif

                                        <span class="truncate">{{ $item['title'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

            <div class="flex gap-2 text-xs">
                <a href="/terms" class="text-gray-400 hover:text-gray-600">Terms of Use</a>
                <span class="text-gray-400">&bull;</span>
                <a href="/privacy" class="text-gray-400 hover:text-gray-600">Privacy Policy</a>
            </div>
        </nav>
    </div>
</div>
