@extends('layouts.member_2')

@section('title', __('member/upgrade.title'))

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">


        <h2 class="t-lg">Your Subscription</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bcard">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-medium">{{ $currentPlan->plan->name ?? 'Free' }}</h3>
                    <div class="badge green">Active</div>
                </div>

                <div class="space-y-2 tm-sm">
                    <div class="flex justify-between">
                        <span>Billing</span>
                        <span class="font-semibold">{{ $currentPlan->price_paid ?? 0 }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ends on</span>
                        <span class="font-semibold">{{ $currentPlan?->expires_at?->format('M d, Y') ?? 'Unlimited' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Renew</span>
                        <span class="font-semibold">Auto</span>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="t-lg">Upgrade plan</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach ($plans as $plan)
                <div class="bcard">
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                    </div>
                    <p class="flex items-baseline gap-x-1 mb-6">
                        <span class="text-xl font-semibold tracking-tight">${{ number_format($plan->price, 2) }}</span>
                        <span class="text-sm/6 font-semibold tm">/month</span>
                    </p>

                    @if ($plan->id == $currentPlan?->plan_id)
                        <button class="button outline" disabled>Default</button>
                    @else
                        <button type="button" class="button outline" data-bs-toggle="modal"
                            data-bs-target="#upgrade{{ $plan->id }}">
                            Buy plan
                        </button>
                    @endif

                    <ul class="mt-6 space-y-2 text-sm/6 tm">
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg> {{ formatBytes($plan->storage_limit) }} of storage</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg> {{ formatBytes($plan->file_size_limit) }} per file</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $plan->file_keep_forever ? 'File stored forever' : "File stored {$plan->file_keep_days} days no activity" }}
                        </li>
                        @if ($plan->ads_reduced)
                            <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-blue-600" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                        clip-rule="evenodd" />
                                </svg> Ads reduced</li>
                        @endif
                    </ul>
                </div>

                @if ($plan->id != 1)
                    <div class="modal fade upgrade" tabindex="-1" aria-hidden="true" id="upgrade{{ $plan->id }}">
                        <div class="modal-dialog">
                            <div class="content">
                                <div class="panel">
                                    <div class="flex items-center justify-between gap-x-4">
                                        <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                                    </div>
                                    <p class="flex items-baseline gap-x-1 mb-6">
                                        <span class="text-xl font-semibold tracking-tight">${{ number_format($plan->price, 2) }}</span>
                                        <span class="text-sm/6 font-semibold tm">/month</span>
                                    </p>
                                    <p class="tm-sm">Payment method</p>
                                    <ul class="menu-list mb-6" role="list">
                                        <li>
                                            <button class="w-full" data-id="{{ $plan->id }}" data-method="balance">
                                                <svg class="size-6 shrink-0 tm" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" aria-hidden="true">
                                                    <path
                                                        d="M22 12V17C22 20 20 22 17 22H7C4 22 2 20 2 17V12C2 9.28 3.64 7.38 6.19 7.06C6.45 7.02 6.72 7 7 7H17C17.26 7 17.51 7.00999 17.75 7.04999C20.33 7.34999 22 9.26 22 12Z">
                                                    </path>
                                                    <path
                                                        d="M17.7514 7.05C17.5114 7.01 17.2614 7.00001 17.0014 7.00001H7.00141C6.72141 7.00001 6.45141 7.02001 6.19141 7.06001C6.33141 6.78001 6.53141 6.52001 6.77141 6.28001L10.0214 3.02C11.3914 1.66 13.6114 1.66 14.9814 3.02L16.7314 4.79002C17.3714 5.42002 17.7114 6.22 17.7514 7.05Z">
                                                    </path>
                                                    <path
                                                        d="M22 12.5H19C17.9 12.5 17 13.4 17 14.5C17 15.6 17.9 16.5 19 16.5H22">
                                                    </path>
                                                </svg>
                                                <span>Balance ($0.00)</span>
                                            </button>
                                        </li>

                                        <li>
                                            <button class="w-full" data-id="{{ $plan->id }}" data-method="paypal">
                                                <img class="size-6 shrink-0"
                                                    src="https://cdn.safefileku.com/paypal-icon.png" alt="PayPal">
                                                <span>PayPal</span>
                                            </button>
                                        </li>

                                    </ul>
                                    <button type="button" class="button secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('backend/member/js/DDzrBGya.js') }}"></script>
<script type="module">

    const r = htmlToElement(`<div class="p-8">
    <svg class="animate-spin size-8 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
</div>`);
[...document.querySelectorAll(".upgrade [data-method")].map(t => t.addEventListener("click", () => {
    const e = t.closest("ul");
    e.after(r),
    e.classList.add("hidden"),
    http.post("/u/upgrade", t.dataset).then( ({data: a}) => {
        typeof a.url == "string" ? location.href = a.url : location.reload()
    }
    ).catch(a => {
        errorHandler(a),
        r.remove(),
        e.classList.remove("hidden")
    }
    )
}
));
[...document.querySelectorAll(".renew [data-method]")].map(t => t.addEventListener("click", () => {
    const e = t.closest("ul");
    e.after(r),
    e.classList.add("hidden"),
    http.put("/u/upgrade", t.dataset).then( ({data: a}) => {
        typeof a.url == "string" ? location.href = a.url : location.reload()
    }
    ).catch(a => {
        errorHandler(a),
        r.remove(),
        e.classList.remove("hidden")
    }
    )
}
));
// const c = document.getElementById("SbxgTA");
// if (c) {
//     const t = new URLSearchParams(location.search);
//     let e = {};
//     t.has("subscription_id") && (e.method = "paypal",
//     e.id = t.get("subscription_id")),
//     t.has("tripay_reference") && (e.method = "tripay",
//     e.id = t.get("tripay_reference"));
//     async function a(s) {
//         http.post("/u/checkout", s).then( ({data: o}) => {
//             const n = c.querySelector("svg")
//               , l = c.querySelector("h2")
//               , i = c.querySelector(".cNRIaC");
//             switch (o) {
//             case 0:
//                 n.replaceWith(htmlToElement('<img src="https://cdn.safefileku.com/upgrade_cross.svg" alt="cross" class="size-32 mx-auto mb-4">')),
//                 l.innerText = "Purchase Canceled",
//                 i.innerText = "Your subscription purchase has been successfully canceled.",
//                 c.children[0].appendChild(htmlToElement('<a href="/u/upgrade" class="button secondary">Back</a>'));
//                 break;
//             case 1:
//                 n.replaceWith(htmlToElement('<img src="https://cdn.safefileku.com/upgrade_check.svg" alt="check" class="size-32 mx-auto mb-4">')),
//                 l.innerText = "Thank you!",
//                 i.innerText = "Your subscription has been activated. Thank you for your purchase!",
//                 c.children[0].appendChild(htmlToElement('<a href="/u/upgrade" class="button secondary">Back</a>'));
//                 break;
//             case 2:
//                 setTimeout( () => {
//                     s.paypal = 1,
//                     a(s)
//                 }
//                 , 3e3);
//                 break;
//             case 3:
//                 n.remove(),
//                 l.innerText = "Unknown",
//                 i.innerText = "";
//                 break
//             }
//         }
//         ).catch(o => errorHandler(o))
//     }
//     a(e)
// }

</script>
@endpush
