@extends('layouts.member_2')

@section('title', __('member/referral.title'))

@section('content')

    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">


        <div>
            <p>If you have questions or need assistance, please select one of the following support options:</p>
            <div class="space-y-2">
                <a href="mailto:support@safefileku.com" target="_blank" rel="noreferrer" class="b-h inline-block">
                    <span class="sr-only">Email</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="currentColor"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <a href="https://facebook.com/safefileku" target="_blank" rel="noreferrer"
                    class="b-h !text-[#0866FF] inline-block">
                    <span class="sr-only">Facebook</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z">
                        </path>
                    </svg>
                </a>
                <a href="https://t.me/safefileku_support" target="_blank" rel="noreferrer"
                    class="b-h !text-[#26A5E4] inline-block">
                    <span class="sr-only">Telegram</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z">
                        </path>
                    </svg>
                </a>
                <a href="https://wa.me/+6285179766651?text=My%20username%20is%20Ngô Quốc Kha." target="_blank"
                    rel="noreferrer" class="b-h !text-[#25D366] inline-block">
                    <span class="sr-only">WhatsApp</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
                        </path>
                    </svg>
                </a>

            </div>
        </div>
        {{-- <div>
            <button type="button" class="button !w-auto" data-bs-toggle="modal" data-bs-target="#create-ticket">Create
                ticket</button>
            <div class="modal fade" tabindex="-1" aria-hidden="true" id="create-ticket">
                <div class="modal-dialog">
                    <div class="content">
                        <div class="panel">
                            <form id="nLkSBw" class="space-y-4">
                                <div class="t-lg">Create New Ticket</div>
                                <div class="field space-y-1">
                                    <label for="issue">Issue</label>
                                    <select class="" id="issue" name="issue" required="required">
                                        <option value="">Choose issue</option>
                                        <option>Account</option>
                                        <option>File manager</option>
                                        <option>Download/upload</option>
                                        <option>Payment</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="field space-y-1">
                                    <label for="lang">Language</label>
                                    <select class="" id="lang" name="lang" required="required">
                                        <option value="en">English</option>
                                        <option value="id">Indonesia</option>
                                    </select>
                                </div>
                                <div class="field space-y-1">
                                    <label for="subject">Subject</label>
                                    <input class="" type="text" id="subject" name="subject" required="required">
                                </div>
                                <div>
                                    <textarea name="message" id="message" rows="5" placeholder="Message"></textarea>
                                    <p class="text-xs text-gray-400"><span id="remaining">255</span>/255 character left</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <button type="submit" class="button">Send</button>
                                    <button type="button" class="button secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bcard">
            <div role="list" class="divide-y divide-zinc-100 dark:divide-zinc-800 overflow-hidden">
                <div class="py-4">
                    <p class="tm text-center">No cases created yet.</p>
                </div>
            </div>
        </div> --}}

        <p>You can get more information in <a href="/faq">FAQ</a>.</p>
    </div>

@endsection
