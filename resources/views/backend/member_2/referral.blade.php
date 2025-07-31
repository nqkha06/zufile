@extends('layouts.member_2')

@section('title', __('member/referral.title'))

@section('content')

    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">

        {{-- <div class="bg-blue-50 dark:bg-blue-950 p-4 not-prose rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="size-5 text-blue-400 dark:text-blue-600" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-700 dark:text-blue-300">Tính năng đang bảo trì, vui lòng quay lại sau : (</p>
                </div>
            </div>
        </div> --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bcard space-y-4">
                <div class="t-lg mb-2">Your Invite Link</div>
                <div class="flex rounded-md shadow-sm">
                    <input
                        class="block w-full rounded-none dark:bg-zinc-900 rounded-l-md border-0 py-1.5 px-3 text-zinc-900 dark:text-zinc-100 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-600 sm:text-sm/6 outline-none"
                        value="{{ route("ref", Auth::id()) }}" readonly="">
                    <button type="button" id="clipboard"
                        class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 dark:text-zinc-100 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <svg class="-ml-0.5 size-5 text-gray-400" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M16 12.9V17.1C16 20.6 14.6 22 11.1 22H6.9C3.4 22 2 20.6 2 17.1V12.9C2 9.4 3.4 8 6.9 8H11.1C14.6 8 16 9.4 16 12.9Z">
                            </path>
                            <path
                                d="M22 6.9V11.1C22 14.6 20.6 16 17.1 16H16V12.9C16 9.4 14.6 8 11.1 8H8V6.9C8 3.4 9.4 2 12.9 2H17.1C20.6 2 22 3.4 22 6.9Z">
                            </path>
                        </svg>
                        <span>Copy</span>
                    </button>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <div class="text-sm">Total user</div>
                    <div class="font-medium">0</div>
                </div>
                <div>
                    <div class="text-sm">Total earn</div>
                    <div class="font-medium">$0.00</div>
                </div>
            </div>
        </div>

        <p class="tm-sm">The referral program is a great way to spread the word of this great service and to earn even more
            money with your files! Refer friends and receive 10% bonus of their earnings for life!</p>

        <div>
            <div class="t-lg">Users</div>
            <p class="tm-sm">List of users that you have referred.</p>
            <ul class="divide-y divide-zinc-100 dark:divide-zinc-800">
                <li>
                    <div class="space-y-8 text-center mx-auto p-4 sm:p-6 lg:p-8 min-h-full">
                        <svg class="w-40 h-40 mx-auto text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true">
                            <path
                                d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z">
                            </path>
                            <path d="M3.40991 22C3.40991 18.13 7.25994 15 11.9999 15"></path>
                            <path
                                d="M18.2 21.4C19.9673 21.4 21.4 19.9673 21.4 18.2C21.4 16.4327 19.9673 15 18.2 15C16.4327 15 15 16.4327 15 18.2C15 19.9673 16.4327 21.4 18.2 21.4Z">
                            </path>
                            <path d="M22 22L21 21"></path>
                        </svg>
                        <p class="text-gray-400 text-sm">There is no referral yet</p>
                    </div>
                </li>
            </ul>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        (function() {
            const target = document.getElementById('kt_referral_link_input');
            const button = target.nextElementSibling;

            var clipboard = new ClipboardJS(button, {
                target: target,
                text: function() {
                    return target.value;
                }
            });

            clipboard.on('success', function(e) {
                const currentLabel = button.innerHTML;

                if (button.innerHTML === 'Copied!') {
                    return;
                }

                button.innerHTML = 'Copied!';

                setTimeout(function() {
                    button.innerHTML = currentLabel;
                }, 3000)
            });
        })()
    </script>
@endpush
