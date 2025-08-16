@extends('layouts.member_2')

@section('title', __('member/files/index.title'))

@section('nav')
    <nav id="file-tool">
        <ul id="tools" role="list">
            <li data-bs-toggle="tooltip" title="Move" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-move" data-bs-toggle="modal" data-bs-target="#modal-move" disabled>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M11 17L13 15L11 13L13 15H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M22 10V15C22 20 20 22 15 22H9C4 22 2 20 2 15V9C2 4 4 2 9 2H14" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 10H18C15 10 14 9 14 6V2L22 10Z" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
            <li data-bs-toggle="tooltip" title="Rename" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-rename" data-bs-toggle="modal" data-bs-target="#modal-rename" disabled>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M16.04 3.02001L8.16 10.9C7.86 11.2 7.56 11.79 7.5 12.22L7.07 15.23C6.91 16.32 7.68 17.08 8.77 16.93L11.78 16.5C12.2 16.44 12.79 16.14 13.1 15.84L20.98 7.96001C22.34 6.60001 22.98 5.02001 20.98 3.02001C18.98 1.02001 17.4 1.66001 16.04 3.02001Z"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14.91 4.1499C15.58 6.5399 17.45 8.4099 19.85 9.0899" stroke="currentColor"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
            <li data-bs-toggle="tooltip" title="Move to trash" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-trash" disabled>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M18.85 9.13989L18.2 19.2099C18.09 20.7799 18 21.9999 15.21 21.9999H8.79C6 21.9999 5.91 20.7799 5.8 19.2099L5.15 9.13989"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10.33 16.5H13.66" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.5 12.5H14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
            <li data-bs-toggle="tooltip" title="Share" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-share" data-bs-toggle="modal" data-bs-target="#file-share" disabled>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M14.99 17.5H16.5C19.52 17.5 22 15.03 22 12C22 8.98 19.53 6.5 16.5 6.5H14.99"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 6.5H7.5C4.47 6.5 2 8.97 2 12C2 15.02 4.47 17.5 7.5 17.5H9" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
            <li data-bs-toggle="tooltip" title="Download" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-download" disabled>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M9.31995 11.6799L11.8799 14.2399L14.4399 11.6799" stroke="currentColor"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.88 4V14.17" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20 12.1799C20 16.5999 17 20.1799 12 20.1799C7 20.1799 4 16.5999 4 12.1799"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
        </ul>

        <ul role="list">
            <li data-bs-toggle="tooltip" title="Create folder" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-folder" data-bs-toggle="modal" data-bs-target="#modal-folder">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12.0601 16.5V11.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.5 14H9.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                    </svg>
                </button>
            </li>
            <li data-bs-toggle="tooltip" title="Layout" data-bs-placement="bottom" data-bs-trigger="hover">
                <button id="tool-layout">
                    <svg id="tool-layout-card" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none"
                        aria-hidden="true">
                        <path
                            d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg id="tool-layout-list" class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M19.9 13.5H4.1C2.6 13.5 2 14.14 2 15.73V19.77C2 21.36 2.6 22 4.1 22H19.9C21.4 22 22 21.36 22 19.77V15.73C22 14.14 21.4 13.5 19.9 13.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M19.9 2H4.1C2.6 2 2 2.64 2 4.23V8.27C2 9.86 2.6 10.5 4.1 10.5H19.9C21.4 10.5 22 9.86 22 8.27V4.23C22 2.64 21.4 2 19.9 2Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
        </ul>
    </nav>
    <div id="upload-alert" class="bg-yellow-50 p-4 hidden">
        <div class="flex items-center leading-[normal]">
            <div class="shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <span class="text-sm font-medium text-yellow-800">Your browser does not seem to support the
                    features necessary to upload file.</span>
            </div>
        </div>
    </div>
@endsection

@section('customHeader')
    <header class="border-b border-zinc-200 dark:border-zinc-700">
        <div class="px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 lg:gap-4">
                <a href="{{ $currentFolder->parent == null ? route("u.files.home") : route("u.files.show", $currentFolder->parent->alias) }}" class="b-h flex items-center gap-0.5">
                    <svg class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    <span class="text-xs">BACK</span>
                </a>
                <h1 class="font-medium leading-7 dark:text-white">{{ $currentFolder->name }}</h1>
            </div>
        </div>
    </header>
@endsection

@section('content')

    <div id="loading" class="p-8">
        <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>

    <div id="filemanager" class="hidden">
        <div id="folders"></div>
        <div id="files"></div>
        <div id="empty" class="hidden space-y-4 text-center mx-auto p-4 sm:p-6 lg:p-8">
            <img src="/images/sections/empty.svg" class="w-96 mx-auto" alt="empty">
            <p class="tm">Start uploading files it will be visible here.</p>
            <label for="file" class="button !w-fit mx-auto">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path
                        d="M16.44 8.8999C20.04 9.2099 21.51 11.0599 21.51 15.1099V15.2399C21.51 19.7099 19.72 21.4999 15.25 21.4999H8.73998C4.26998 21.4999 2.47998 19.7099 2.47998 15.2399V15.1099C2.47998 11.0899 3.92998 9.2399 7.46998 8.9099"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 15.0001V3.62012" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M15.3499 5.85L11.9999 2.5L8.6499 5.85" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Start Uploading</span>
            </label>
        </div>
    </div>
    <script type="module" src="{{ asset("backend/member/js/DDzrBGya.js") }}"></script>

@endsection
@push('scripts')
        <script type="module" src="{{ asset("backend/member/js/CRELgpri.js") }}"></script>

@endpush

@push('modals')
        <div>
        <input type="file" id="file" class="hidden" multiple />
        <div class="modal fade" tabindex="-1" aria-hidden="true" id="upload">
            <div class="modal-dialog">
                <div class="content">
                    <div class="panel">
                        <div class="flex justify-between items-center gap-4 mb-4">
                            <div class="t-lg">{{ __('member/files/index.modals.upload.title') }}</div>
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
                                    <span>{{ __('member/files/index.modals.upload.from_device') }}</span>
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
                                    <span>{{ __('member/files/index.modals.upload.from_url') }}</span>

                                </button>
                            </li>
                        </ul>

                        <div class="tm-sm">{{ __('member/files/index.modals.upload.default_privacy', ['privacy' => UserSetting::get('private_upload', 0) == 0 ? __('member/files/index.privacy.public') : __('member/files/index.privacy.private')]) }} <a href="/u/account#upload-section"
                                class="leading-6">{{ __('member/files/index.modals.upload.change') }}</a></div>
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
                                <span class="t-lg">{{ __('member/files/index.modals.upload.title') }}</span>
                                <button class="-m-1.5 p-1.5 rounded-md hover:bg-gray-100" data-bs-dismiss="modal">
                                    <span class="sr-only">{{ __('member/files/index.modals.minimize') }}</span>
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
                                <span>{{ __('member/files/index.modals.upload.add_file') }}</span>
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
                            <div class="t-lg">{{ __('member/files/index.modals.upload_url.title') }}</div>
                            <div class="field space-y-1">
                                <input class="" type="url" name="url" placeholder="{{ __('member/files/index.modals.upload_url.url_placeholder') }}"
                                    required="required" />
                                <p class="tm-xs">{{ __('member/files/index.modals.upload_url.support_note') }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <button type="submit" class="button">{{ __('member/files/index.modals.upload_url.upload_button') }}</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">{{ __('member/files/index.modals.cancel') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="mhSRMa" class="fixed bottom-8 right-8 animate-slide-in-bottom hidden" data-bs-toggle="tooltip"
            title="{{ __('member/files/index.uploading') }}">
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
                            <div class="t-lg">{{ __('member/files/index.modals.share.title') }}</div>
                            <p class="tm-sm">{{ __('member/files/index.modals.share.share_via') }}</p>
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
                            <p class="tm-sm">{{ __('member/files/index.modals.share.copy_link') }}</p>
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
                                            class="bg-blue-600 text-white rounded text-xs font-medium py-1 px-2">{{ __('member/files/index.modals.share.copy') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tm-sm">{{ __('member/files/index.modals.share.public_access') }} <button type="button"
                                    class="text-blue-600 hover:text-blue-500 leading-6" id="set-private">{{ __('member/files/index.modals.share.set_private') }}</button></div>
                        </div>
                        <div id="share-private" class="space-y-4 hidden">
                            <div class="t-lg">{{ __('member/files/index.modals.share.private_title') }}</div>
                            <p class="tm-sm">{{ __('member/files/index.modals.share.private_description') }}</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" class="button" id="set-public">{{ __('member/files/index.modals.share.make_public') }}</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">{{ __('member/files/index.modals.cancel') }}</button>
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
                            <div class="t-lg">[title]</div>
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
                                <button type="submit" class="button" disabled="disabled">{{ __('member/files/index.modals.move.move_button') }}</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">{{ __('member/files/index.modals.cancel') }}</button>
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
                            <div class="t-lg">{{ __('member/files/index.modals.rename.title') }}</div>
                            <div class="field space-y-1">
                                <input class="" type="text" name="name" placeholder="{{ __('member/files/index.modals.rename.file_name') }}"
                                    autocomplete="off" />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="submit" class="button">{{ __('member/files/index.modals.rename.rename_button') }}</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">{{ __('member/files/index.modals.cancel') }}</button>
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
                            <div class="t-lg">{{ __('member/files/index.modals.folder.title') }}</div>
                            <div class="field space-y-1">
                                <input class="" type="text" name="name" placeholder="{{ __('member/files/index.modals.folder.name_placeholder') }}"
                                    autocomplete="off" />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="submit" class="button">{{ __('member/files/index.modals.folder.create_button') }}</button>
                                <button type="button" class="button secondary"
                                    data-bs-dismiss="modal">{{ __('member/files/index.modals.cancel') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endpush
