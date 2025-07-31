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
                <a href="{{ $currentFolder->parent == null ? route("member.files.index") : route("u.files.show", $currentFolder->parent->alias) }}" class="b-h flex items-center gap-0.5">
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
