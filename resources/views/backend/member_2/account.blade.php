@extends('layouts.member_2')

@section('title', __('Account settings'))

@section('content')
    <div class="divide-y divide-black/5">
        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Account Information</h2>
                <p class="mt-1 tm-sm">Settings relating to your account information.</p>
            </div>

            <form class="account md:col-span-2 sm:max-w-xl">
                <div class="space-y-6 md:space-y-8">
                    <div>
                        <div class="field space-y-1">
                            <div>Display name</div>
                            <input class="" type="text" name="name" autocomplete="off" value="Ngô Quốc Kha">
                        </div>
                        <p class="tm-sm">Can be changed once every 14 days.</p>
                    </div>
                    <div>
                        <div class="field space-y-1">
                            <div>Email address</div>
                            <input class="" type="email" name="email" autocomplete="off"
                                value="ngo********@g****.com" disabled="disabled">
                        </div>
                        <button type="button" class="text-blue-600 hover:text-blue-500 leading-6" data-bs-toggle="modal"
                            data-bs-target="#SndXKi">Change email</button>
                        <div class="modal fade" tabindex="-1" aria-hidden="true" id="SndXKi">
                            <div class="modal-dialog">
                                <div class="content">
                                    <div class="panel">
                                        <div class="overflow-x-hidden">
                                            <div id="IiYFab"
                                                class="flex flex-nowrap relative left-0 transition-[left] duration-300">
                                                <div class="shrink-0 w-full text-center space-y-4">
                                                    <img src="/images/sections/email.svg" alt="Email"
                                                        class="h-48 mx-auto" loading="lazy">
                                                    <div>
                                                        <p>Change email</p>
                                                        <p class="tm-sm">We'll send you a link to your current email
                                                            address, in order to change it.</p>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <button type="button" class="button"
                                                            id="IEiLQL">Continue</button>
                                                        <button type="button" class="button secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <script>
                                                        const button = document.getElementById('IEiLQL');
                                                        const text = button.innerText;
                                                        let duration = 0 * 1000;

                                                        interval = setInterval(() => {
                                                            button.innerText = `${text} (${duration / 1000}s)`;
                                                            duration -= 1000;

                                                            if (duration < 0) {
                                                                clearInterval(interval);
                                                                button.innerText = text;
                                                                button.disabled = false;
                                                            }
                                                        }, 1000);
                                                    </script>
                                                </div>
                                                <div class="shrink-0 w-full text-center space-y-4">
                                                    <svg class="h-48 mx-auto" viewBox="0 0 83 98" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M82.7985 41.7368C82.7985 19.0979 64.4174 0.716797 41.7785 0.716797C19.1396 0.716797 0.758503 19.0979 0.758503 41.7368C0.758503 64.3758 19.1396 82.7568 41.7785 82.7568C64.4174 82.7568 82.7985 64.3758 82.7985 41.7368Z"
                                                            fill="#00D06C"></path>
                                                        <path
                                                            d="M57.9567 26.4C57.5514 26.1167 57.0942 25.9161 56.6113 25.8094C56.1284 25.7027 55.6291 25.692 55.142 25.778C54.6549 25.8641 54.1896 26.0451 53.7726 26.3108C53.3556 26.5765 52.9951 26.9216 52.7117 27.3265L38.3934 47.7489L29.0051 41.3442C28.2522 40.8298 27.3254 40.6351 26.4288 40.8032C25.5322 40.9713 24.7391 41.4881 24.2241 42.2401C23.709 42.992 23.5142 43.9177 23.6824 44.8131C23.8507 45.7086 24.3681 46.5006 25.1211 47.015L37.7055 55.5997C38.093 55.8639 38.5311 56.0454 38.9921 56.1328C39.4531 56.2203 39.9273 56.2117 40.3849 56.1078C40.8729 56.0225 41.3394 55.8419 41.7574 55.5764C42.1755 55.3108 42.5369 54.9654 42.8211 54.56L58.8849 31.6411C59.4574 30.8227 59.6812 29.8108 59.507 28.8277C59.3328 27.8446 58.775 26.9708 57.9561 26.3983"
                                                            fill="white"></path>
                                                        <path
                                                            d="M41.0185 90.331C53.1824 90.331 63.0585 92.0338 63.0585 94.131C63.0585 96.2282 53.1824 97.931 41.0185 97.931C28.8546 97.931 18.9785 96.2282 18.9785 94.131C18.9785 92.0338 28.8546 90.331 41.0185 90.331Z"
                                                            fill="#E3E3E3"></path>
                                                    </svg>
                                                    <div>
                                                        <p>Email has been sent</p>
                                                        <p class="tm-sm">If you're not receiving emails, check your spam
                                                            inbox. If you still don't find it you can request it again.</p>
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
                    </div>
                </div>

                <div class="mt-8 flex">
                    <button type="submit" class="button !w-auto">Save</button>
                </div>
            </form>
        </div>

        {{-- <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Download page options </h2>
                <p class="mt-1 tm-sm">Options for settings on the download page for your files.</p>
            </div>

            <form class="account md:col-span-2 sm:max-w-xl">
                <input type="hidden" name="_file" value="1">

                <div class="space-y-6 md:space-y-8">
                    <div class="field flex items-center justify-between">
                        <label for="relate-file">Display related file at download</label>
                        <label for="relate-file"
                            class="relative h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 bg-blue-600"
                            role="switch" aria-checked="true">
                            <input type="checkbox" name="relate" id="relate-file" class="hidden" checked="">
                            <span aria-hidden="true"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-5"></span>
                        </label>
                    </div>

                </div>

                <div class="mt-8 flex">
                    <button type="submit" class="button !w-auto">Save</button>
                </div>
            </form>
        </div> --}}

        <div id="upload-section"
            class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Upload options </h2>
                <p class="mt-1 tm-sm">Options to customize such as default file settings when uploading etc.</p>
            </div>

            <form class="account md:col-span-2 sm:max-w-xl">
                <input type="hidden" name="_upload" value="1">

                <div class="space-y-6 md:space-y-8">


                    <div class="field flex items-center justify-between">
                        <label for="upload-as-private">
                            <div>Upload as private</div>
                            <p class="tm-xs">Uploaded files will be set as private by default.</p>
                        </label>
                        <label for="upload-as-private"
                            class="bg-gray-200 relative h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
                            role="switch" aria-checked="false">
                            <input type="checkbox" name="private" id="upload-as-private" class="hidden"
                            @checked(UserSetting::get('private_upload', 0) == 1)>
                            <span aria-hidden="true"
                                class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex">
                    <button type="submit" class="button !w-auto">Save</button>
                </div>
            </form>
        </div>

        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Change password</h2>
                <p class="mt-1 tm-sm">Update your password associated with your account.</p>
            </div>

            <form id="change-password" class="md:col-span-2 sm:max-w-xl">
            <div class="hidden">
                <input type="text" id="username" name="username" value="ngokhavliem@gmail.com" autocomplete="username">
            </div>
                        <div class="space-y-6 md:space-y-8">
                <div class="field space-y-1">
            <label for="current-password">Current password</label>
            <input class="" type="password" name="current_password" id="current-password" autocomplete="current-password" />
        </div>
                <div class="field space-y-1">
            <label for="new-password">New password</label>
            <input class="" type="password" name="password" id="new-password" autocomplete="new-password" />
            <p class="tm-xs">Use 8 or more characters with at least a number or symbol</p>
    </div>
            </div>

            <div class="mt-8 flex">
                <button type="submit" class="button !w-auto">Save</button>
            </div>
                    </form>
        </div>
{{--
        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Linked account</h2>
                <p class="mt-1 tm-sm">Here are the external accounts that you have linked to/with your account. You can use
                    them to authenticate.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 md:col-span-2 text-center gap-4">
                <div class="flex justify-between flex-col bcard sm space-y-2 text-center" data-bs-toggle="tooltip"
                    data-bs-original-title="Google">
                    <svg class="h-12 w-12 mx-auto" viewBox="0 0 533.5 544.3" aria-hidden="true">
                        <path
                            d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z"
                            fill="#4285f4"></path>
                        <path
                            d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z"
                            fill="#34a853"></path>
                        <path
                            d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z"
                            fill="#fbbc04"></path>
                        <path
                            d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z"
                            fill="#ea4335"></path>
                    </svg>
                    <div class="tm-sm">
                        <svg class="size-5 inline-block" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                class="fill-green-400"></path>
                            <path
                                d="M10.5795 15.5801C10.3795 15.5801 10.1895 15.5001 10.0495 15.3601L7.21945 12.5301C6.92945 12.2401 6.92945 11.7601 7.21945 11.4701C7.50945 11.1801 7.98945 11.1801 8.27945 11.4701L10.5795 13.7701L15.7195 8.6301C16.0095 8.3401 16.4895 8.3401 16.7795 8.6301C17.0695 8.9201 17.0695 9.4001 16.7795 9.6901L11.1095 15.3601C10.9695 15.5001 10.7795 15.5801 10.5795 15.5801Z"
                                class="fill-green-600"></path>
                        </svg>
                        <span class="align-middle">Linked</span>
                    </div>
                    <form class="rPDJMg">
                        <input type="hidden" name="_token" value="misu5cL8BwNUMMdmz2M5f6GfBs3NCVegMiu84hcS"
                            autocomplete="off"> <button type="submit" name="client" value="google"
                            class="button secondary mt-auto">Unlink</button>
                    </form>
                </div>

            </div>
        </div> --}}

        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7">Delete account</h2>
                <p class="mt-1 tm-sm">No longer want to use our service? You can delete your account here. This action is
                    not reversible. All information related to this account will be deleted permanently.</p>
            </div>

            <div class="flex items-start md:col-span-2">
                <button type="submit" class="button !w-auto !bg-red-600 hover:!bg-red-700" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">Yes, delete my account</button>
                <div class="modal fade" tabindex="-1" aria-hidden="true" id="delete-modal">
                    <div class="modal-dialog">
                        <div class="content">
                            <div class="panel">
                                <div class="text-center space-y-6">
                                    <img src="/images/sections/bye.svg" alt="Bye" class="h-48 mx-auto"
                                        loading="lazy">
                                    <p>Are you sure you want to delete your account?</p>
                                    <p class="tm-sm">All files that have been uploaded cannot be restored, and usernames
                                        and emails cannot be used anymore.</p>
                                    <div class="grid grid-cols-2 gap-4">
                                        <button type="button" class="button !bg-red-500 hover:!bg-red-400"
                                            id="delete-account">Delete</button>
                                        <button type="button" class="button secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="module" src="{{ asset("backend/member/js/DDzrBGya.js") }}"></script>

    <script type="module" src="{{ asset("backend/member/js/account.js") }}"></script>
@endpush
