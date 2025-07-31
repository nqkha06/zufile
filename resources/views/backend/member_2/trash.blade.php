@extends('layouts.member_2')

@section('title', __('Trash'))
@section('subTitle', __('Files moved to trash will be deleted after 30 days.'))

@section('nav')
    <nav id="file-tool">
    <ul id="tools" role="list">
        <li>
            <button id="tool-restore" disabled>
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M10.33 7.51001C10.83 7.36001 11.38 7.26001 12 7.26001C14.76 7.26001 17 9.50001 17 12.26C17 15.02 14.76 17.26 12 17.26C9.24 17.26 7 15.02 7 12.26C7 11.23 7.31 10.28 7.84 9.48001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.62012 7.64999L11.2801 5.73999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.62012 7.6499L11.5601 9.0699" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </li>
        <li>
            <button id="tool-delete" disabled>
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.85 9.13989L18.2 19.2099C18.09 20.7799 18 21.9999 15.21 21.9999H8.79C6 21.9999 5.91 20.7799 5.8 19.2099L5.15 9.13989" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.33 16.5H13.66" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.5 12.5H14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </li>
    </ul>

    <ul role="list">
        <li>
            <button id="tool-clear" class="flex gap-2 !px-2 items-center">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9.87 5.6701L6.45 7.75012L4.89001 5.19012C4.32001 4.25012 4.62 3.01012 5.56 2.44012C6.5 1.87012 7.74 2.1701 8.31 3.1101L9.87 5.6701Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.82 9.16009L8.66001 11.0801C6.82001 12.2001 6.26 14.4601 7.15 16.2601L9.2 20.4401C9.86 21.7901 11.46 22.2601 12.74 21.4701L19.17 17.5601C20.46 16.7801 20.77 15.1501 19.88 13.9401L17.11 10.2001C15.91 8.58013 13.66 8.04009 11.82 9.16009Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.7566 5.09791L5.63205 8.21851L7.71245 11.6349L12.837 8.51431L10.7566 5.09791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.31 16.8101L15.96 19.5201" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.75 18.3701L13.4 21.0801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.87 15.25L18.52 17.96" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Empty trash</span>
            </button>
        </li>
        <li>
            <button id="tool-layout">
                <svg id="tool-layout-card" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg id="tool-layout-list" class="w-6 h-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M19.9 13.5H4.1C2.6 13.5 2 14.14 2 15.73V19.77C2 21.36 2.6 22 4.1 22H19.9C21.4 22 22 21.36 22 19.77V15.73C22 14.14 21.4 13.5 19.9 13.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.9 2H4.1C2.6 2 2 2.64 2 4.23V8.27C2 9.86 2.6 10.5 4.1 10.5H19.9C21.4 10.5 22 9.86 22 8.27V4.23C22 2.64 21.4 2 19.9 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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


@section('content')

 <div id="loading" class="p-8">
    <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
</div>

<div id="filemanager" class="hidden">
    <div id="folders"></div>
    <div id="files"></div>
    <div id="empty" class="hidden space-y-8 text-center mx-auto p-4 sm:p-6 lg:p-8 min-h-full text-zinc-200  dark:text-zinc-700">
        <svg class="size-40 mx-auto " viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.85 9.13989L18.2 19.2099C18.09 20.7799 18 21.9999 15.21 21.9999H8.79C6 21.9999 5.91 20.7799 5.8 19.2099L5.15 9.13989" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.33 16.5H13.66" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.5 12.5H14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p>Nothing in trash</p>
    </div>
</div>
@endsection


@push('scripts')

    <script type="module" src="{{ asset("backend/member/js/DDzrBGya.js") }}"></script>

    <script type="module" src="{{ asset("backend/member/js/trash.js") }}"></script>
    {{-- <script type="module" src="{{ asset("backend/member/js/CRELgpri.js") }}"></script> --}}

    {{-- <script type="module" src="{{ asset("backend/member/js/trash.js") }}"></script> --}}
@endpush
