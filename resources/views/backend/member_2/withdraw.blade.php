@extends('layouts.member_2')

@section('title', __('member/withdraw.title'))
@section('actions')
@endsection



@section('content')
  <style>
            input[type=number]::-webkit-outer-spin-button, input[type=number]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
    <div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">



        <div class="bg-blue-50 dark:bg-blue-950 p-4 not-prose rounded-md">
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
                    <p class="text-sm font-medium text-blue-700 dark:text-blue-300">{{ __('member/withdraw.new_payment_method') }} <b>USDT
                            (BEP20)</b></p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="flex flex-col justify-between">
                <div class="space-y-4">
                    <div>
                        <div>{{ __('member/withdraw.balance') }}</div>
                        <div class="t-xl">{{ currencyFormat(Auth::user()?->balance, '$') }}</div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <div class="text-sm">{{ __('member/withdraw.pending') }}</div>
                            <div class="font-medium">{{ currencyFormat($totalPending, '$') }}</div>
                        </div>
                        <div>
                            <div class="text-sm">{{ __('member/withdraw.total_paid') }}</div>
                            <div class="font-medium">{{ currencyFormat($totalCompleted, '$') }}</div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('u.withdraw.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{ Auth::user()?->balance }}" required>
                    <button type="submit" class="button mt-4">{{ __('member/withdraw.withdraw_balance') }}
                    </button>
                </form>
            </div>

            <div class="min-w-0">
                <div class="bcard overflow-hidden !p-0">
                    <div class="p-4">
                        <div class="t-lg mb-2">{{ __('member/withdraw.payment_method') }}</div>
                        <div class="flex gap-2 items-center">
                            @if ($currentMethod)
                                <div class="shrink-0">
                                    <svg width="80" style=" stroke: rgb(96, 96, 96);
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1;" class="shadow rounded shrink-0" viewBox="0 0 24 24" fill="none"><path d="M12.37 2.15009L21.37 5.75006C21.72 5.89006 22 6.31006 22 6.68006V10.0001C22 10.5501 21.55 11.0001 21 11.0001H3C2.45 11.0001 2 10.5501 2 10.0001V6.68006C2 6.31006 2.28 5.89006 2.63 5.75006L11.63 2.15009C11.83 2.07009 12.17 2.07009 12.37 2.15009Z" stroke-miterlimit="10"></path><path d="M22 22H2V19C2 18.45 2.45 18 3 18H21C21.55 18 22 18.45 22 19V22Z" stroke-miterlimit="10"></path><path d="M4 18V11" stroke-miterlimit="10"></path><path d="M8 18V11" stroke-miterlimit="10"></path><path d="M12 18V11" stroke-miterlimit="10"></path><path d="M16 18V11" stroke-miterlimit="10"></path><path d="M20 18V11" stroke-miterlimit="10"></path><path d="M1 22H23" stroke-miterlimit="10"></path><path d="M12 8.5C12.8284 8.5 13.5 7.82843 13.5 7C13.5 6.17157 12.8284 5.5 12 5.5C11.1716 5.5 10.5 6.17157 10.5 7C10.5 7.82843 11.1716 8.5 12 8.5Z" stroke-miterlimit="10"></path>
</svg>
                                    {{-- <svg class="shadow rounded shrink-0" viewBox="0 0 70 50" fill="none"
                                        aria-hidden="true" width="80">
                                        <path
                                            d="M66 0H4C1.79086 0 0 1.79086 0 4V46C0 48.2091 1.79086 50 4 50H66C68.2091 50 70 48.2091 70 46V4C70 1.79086 68.2091 0 66 0Z"
                                            fill="white"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M29.4419 13H36.266C38.188 13 40.4675 13.0625 41.9925 14.4073C43.0111 15.3057 43.5457 16.7371 43.4221 18.2737C43.0037 23.4845 39.8868 26.4031 35.7072 26.4031H32.3415C31.7688 26.4031 31.3891 26.7826 31.2275 27.8107L30.2883 33.7851C30.2274 34.1727 30.0594 34.4011 29.7527 34.4288H25.5489C25.0825 34.4288 24.9167 34.0719 25.0386 33.2991L28.0658 14.1337C28.187 13.3656 28.6072 13 29.4419 13Z"
                                            fill="#1B3D92"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M33.8306 19H40.6479C44.3077 19 45.6858 20.8526 45.4731 23.5791C45.1222 28.0735 42.4048 30.5587 38.8005 30.5587H36.9806C36.4867 30.5587 36.1543 30.8853 36.0197 31.7728L35.2392 36.9251C35.1885 37.2598 35.0125 37.4563 34.7481 37.4803H30.4734C30.0712 37.4803 29.9281 37.1725 30.0333 36.506L32.6438 19.9778C32.7483 19.3153 33.1106 19 33.8306 19Z"
                                            fill="#00A2D3"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M31 27.5204L32.1916 19.9777C32.2963 19.3154 32.6587 19.0001 33.3787 19.0001H40.196C41.3245 19.0001 42.2362 19.1762 42.9507 19.5007C42.2657 24.1383 39.2662 26.715 35.3385 26.715H31.9727C31.5298 26.715 31.1988 26.9415 31 27.5204Z"
                                            fill="#1B2E7F"></path>
                                    </svg> --}}

                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1">
                                        <span>{{ $currentMethod->name }}</span>
                                    </div>
                                    {{-- {{ dd($fieldValues) }} --}}
                                    @if ($fieldValues)
                                        @foreach (json_decode($fieldValues) as $field => $value)
                                            <div class="t-lg truncate">{{ $value }}</div>
                                        @endforeach

                                    @endif
                                </div>
                            @else
                                <div class="mx-auto text-zinc-600 dark:text-zinc-300">{{ __('member/withdraw.no_payment_method') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#edit-payment-method"
                        class="block w-full text-center font-medium border-t border-zinc-200 dark:border-zinc-700 px-4 py-3 hover:bg-blue-50 dark:hover:bg-blue-950 overflow-hidden">
                        {{ $currentMethod ? __('member/withdraw.change') : __('member/withdraw.add') }}</button>
                </div>
            </div>
        </div>

        <div class="space-y-4">

            <div class="bg-blue-50 dark:bg-blue-950 p-4 not-prose rounded-md">
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
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">{{ __('member/withdraw.earnings_notice') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="t-lg mb-2">{{ __('member/withdraw.transaction_history') }}</h2>
            @if ($invoices->count())
                <div class="bcard !p-0 px-4 lg:px-6 divide-y divide-zinc-100 dark:divide-zinc-800 overflow-y-auto max-h-80">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('member/withdraw.table_id') }}</th>
                                <th>{{ __('member/withdraw.table_date') }}</th>
                                <th>{{ __('member/withdraw.table_amount') }}</th>
                                <th>{{ __('member/withdraw.table_payment_account') }}</th>
                                <th>{{ __('member/withdraw.table_status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->created_at->format('H:i, d/m/Y') }}</td>
                                    <td>{{ currencyFormat($invoice->amount) }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ $invoice->status->label() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <ul class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    <li>
                        <div class="space-y-8 text-center mx-auto p-4 sm:p-6 lg:p-8 min-h-full">
                            <svg class="size-40 mx-auto text-zinc-200 dark:text-zinc-700" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true">
                                <path d="M3.92969 15.8792L15.8797 3.9292" stroke-miterlimit="10"></path>
                                <path d="M11.1013 18.2791L12.3013 17.0791" stroke-miterlimit="10"></path>
                                <path d="M13.793 15.5887L16.183 13.1987" stroke-miterlimit="10"></path>
                                <path
                                    d="M3.60127 10.239L10.2413 3.599C12.3613 1.479 13.4213 1.469 15.5213 3.569L20.4313 8.479C22.5313 10.579 22.5213 11.639 20.4013 13.759L13.7613 20.399C11.6413 22.519 10.5813 22.529 8.48127 20.429L3.57127 15.519C1.47127 13.419 1.47127 12.369 3.60127 10.239Z">
                                </path>
                                <path d="M2 21.9985H22"></path>
                            </svg>
                            <p class="tm-sm">{{ __('member/withdraw.no_transaction') }}</p>
                        </div>
                    </li>
                </ul>

            @endif



        </div>
    </div>
@endsection

@push('scripts')
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="edit-payment-method">
        <div class="modal-dialog">
            <div class="content">
                <div class="panel">
                    <form class="space-y-4" action="{{ route('u.payment.update') }}" method="POST"
                        id="paymentForm">
                        <div class="t-lg">{{ __('member/withdraw.payment_method') }}</div>
                        <div class="field space-y-1">
                            @csrf
                            @method('PUT')

                            {{-- Payment Method --}}
                            <div>
                                <div class="mb-3">
                                    <label for="payment_method">{{ __('member/payment.payment_method') }}</label>
                                    <select id="payment_method" name="payment_method" class="" required>
                                        <option value="" hidden>{{ __('member/payment.select_pmt_methods') }}
                                        </option>
                                        @foreach ($paymentMethods as $m)
                                            <option value="{{ $m->id }}" @selected($currentMethod && $m->id === $currentMethod->id)>
                                                {{ $m->translation()?->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Dynamic Fields --}}
                            <div id="payment-details"></div>


                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="submit" class="button">{{ __('member/withdraw.save') }}</button>
                            <button type="button" class="button secondary" data-bs-dismiss="modal">{{ __('member/withdraw.cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@php
    $methods = $paymentMethods->map(
        fn($m) => [
            'id' => $m->id,
            'fields' => $m->translation()?->fields,
        ],
    );
@endphp

@push('scripts')
<script type="module" src="{{ asset("backend/member/js/DDzrBGya.js") }}"></script>
    <script>
        (() => {
            const methods = @json($methods);
            const oldValues = JSON.parse(@json($fieldValues ?? []));
            const detailsEl = document.getElementById('payment-details');
            const selectEl = document.getElementById('payment_method');

            const renderFields = (methodId) => {
                const m = methods.find(x => x.id == methodId);
                if (!m) return detailsEl.innerHTML = '';

                let html = '';
                (m.fields || []).forEach(f => {
                    const val = oldValues[f.name] ?? '';
                    const reqAttr = f.required ? 'required' : '';
                    const phAttr = f.placeholder ? `placeholder="${f.placeholder}"` : '';
                    const id = 'f_' + f.name;

                    if (f.type === 'select') {
                        const opts = (f.options || []).map(o =>
                            `<option value="${o.value}" ${o.value == val ? 'selected' : ''}>${o.label}</option>`
                        ).join('');
                        html += `
                    <div class="mb-3">
                        <label for="${id}">${f.label}</label>
                        <select id="${id}" name="fields[${f.name}]" ${reqAttr}>
                            <option value="" hidden>${f.placeholder || '{{ __('member/payment.fields.placeholder_select') }}'}</option>
                            ${opts}
                        </select>
                    </div>`;
                    } else if (f.type === 'textarea') {
                        html += `
                    <div class="mb-3">
                        <label for="${id}">${f.label}</label>
                        <textarea id="${id}" name="fields[${f.name}]" ${phAttr} ${reqAttr}>${val}</textarea>
                    </div>`;
                    } else {
                        html += `
                    <div class="mb-3">
                        <label for="${id}">${f.label}</label>
                        <input type="${f.type || 'text'}" id="${id}"
                               name="fields[${f.name}]" value="${val}" ${phAttr} ${reqAttr}>
                    </div>`;
                    }
                });

                detailsEl.innerHTML = html;
            };

            selectEl.addEventListener('change', e => renderFields(e.target.value));
            if (selectEl.value) renderFields(selectEl.value);
        })();
    </script>
@endpush


@push('modals')
      <div class="modal fade" tabindex="-1" aria-hidden="true" id="withdrawal">
                <div class="modal-dialog">
                    <div class="content">
                        <div class="panel">
                            <form id="ZNjHHK" class="space-y-4">
                                <div class="bg-blue-50 dark:bg-blue-950 p-4 rounded-md flex justify-between">
                                    <div>{{ __('member/withdraw.balance') }}</div>
                                    <div class="text-blue-500 dark:text-blue-400">{{ currencyFormat(Auth::user()?->balance, '$', 2) }}</div>
                                </div>
                                <div class="flex items-center gap-1 text-4xl justify-center">
                                    <div id="input-width"
                                        style="width:auto;display:inline-block;visibility:hidden;position:fixed;overflow:auto;box-sizing:unset">
                                        0.00</div>
                                    <span>$</span>
                                    <input type="number" autocomplete="off" name="amount" step="0.01" value="0.00"
                                        class="inline-block outline-0 w-auto appearance-none dark:bg-zinc-900"
                                        required="" style="width: 76px;">
                                </div>
                                <p class="tm-xs">{{ __('member/withdraw.payment_fee_notice') }}</p>
                                <button type="submit" class="button">{{ __('member/withdraw.submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endpush
