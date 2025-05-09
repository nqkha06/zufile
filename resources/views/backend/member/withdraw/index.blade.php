@extends('layouts.member')

@section('title', __('withdraw.title'))

@section('content')
    @php $user_metric = (request()->attributes->get('user_metric')) @endphp

    <div class="container-wd">
        <div class="box-wd" style="background: #ff6363">
            <div class="box-wd-left">
                <div class="box-wd-hd">{{ __('withdraw.available_balances') }}</div>
                <div class="box-wd-body">
                    <div class="body-number">${{ round($user_metric['total_balance'], 3) }}</div>
                </div>
            </div>
            <div class="box-wd-right">
                <i class="bi bi-wallet"></i>
            </div>
        </div>

        <div class="box-wd" style="background: #8f8f8f">
            <div class="box-wd-left">
                <div class="box-wd-hd">{{ __('withdraw.processing') }}</div>
                <div class="box-wd-body">
                    <div class="body-number">{{ round($user_metric['total_pending'], 3) }}</div>
                </div>
            </div>
            <div class="box-wd-right">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>

        <div class="box-wd" style="background: #f8be27">
            <div class="box-wd-left">
                <div class="box-wd-hd">{{ __('withdraw.withheld') }}</div>
                <div class="box-wd-body">
                    <div class="body-number">${{ round($user_metric['total_hold'], 3) }}</div>
                </div>
            </div>
            <div class="box-wd-right">
                <i class="bi bi-exclamation-circle"></i>
            </div>
        </div>

        <div class="box-wd" style="background: #36c975">
            <div class="box-wd-left">
                <div class="box-wd-hd">{{ __('withdraw.total_payment') }}</div>
                <div class="box-wd-body">
                    <div class="body-number">${{ round($user_metric['total_completed'], 3) }}</div>
                </div>
            </div>
            <div class="box-wd-right">
                <i class="bi bi-send-check"></i>
            </div>
        </div>

    </div>

    <div class="withdraw">
        <form action="" method="post">
            @csrf
            <div class="ls-wd">
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="3">
                    <span>$3</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="5">
                    <span>$5</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="10">
                    <span>$10</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="20">
                    <span>$20</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="30">
                    <span>$30</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="50">
                    <span>$50</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="80">
                    <span>$80</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="100">
                    <span>$100</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="500">
                    <span>$500</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="800">
                    <span>$800</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="1000">
                    <span>$1000</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="2000">
                    <span>$2000</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="5000">
                    <span>$5000</span>
                </label>
                <label class="ls-jml-wd">
                    <input type="radio" class="hidden" name="amount" value="8000">
                    <span>$8000</span>
                </label>

                <style>
                    .form-selectgroup {
                        display: inline-flex;
                        margin: 0 -.5rem -.5rem 0;
                        flex-wrap: wrap;
                    }

                    .form-selectgroup .form-selectgroup-item {
                        margin: 0 .5rem .5rem 0
                    }

                    .form-selectgroup-vertical {
                        flex-direction: column
                    }

                    .form-selectgroup-item {
                        display: block;
                        position: relative
                    }

                    .form-selectgroup-input {
                        position: absolute;
                        top: 0;
                        left: 0;
                        z-index: -1;
                        opacity: 0
                    }

                    .form-selectgroup-label {
                        position: relative;
                        display: block;
                        min-width: calc(1.4285714286em + 1.125rem + calc(1px * 2));
                        margin: 0;
                        padding: .5625rem .75rem;
                        font-size: .875rem;
                        line-height: 1.4285714286;
                        color: #000;
                        background: #fff;
                        text-align: center;
                        cursor: pointer;
                        -webkit-user-select: none;
                        -moz-user-select: none;
                        -ms-user-select: none;
                        user-select: none;
                        border: 1px solid var(--border-color);
                        border-radius: 3px;
                        transition: border-color .3s, background .3s, color .3s
                    }

                    @media (prefers-reduced-motion:reduce) {
                        .form-selectgroup-label {
                            transition: none
                        }
                    }

                    .form-selectgroup-label .icon:only-child {
                        margin: 0 -.25rem
                    }

                    /* .form-selectgroup-label:hover {
            color: #36c975
        } */

                    .form-selectgroup-input:checked+.form-selectgroup-label {
                        z-index: 1;
                        color: #066fd1;
                        background: rgba(6, 111, 209, .04);
                        border-color: #066fd1;
                    }
                </style>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="type" value="fast" class="form-selectgroup-input">
                    <div class="form-selectgroup-label">
                        {!! __('withdraw.fast_wd') !!}
                    </div>
                </label>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="type" value="normal" class="form-selectgroup-input" checked="">
                    <div class="form-selectgroup-label">
                        {!! __('withdraw.normal_wd') !!}
                    </div>
                </label>

            </div>
            <div class="control-alert">{!! __('withdraw.war_form') !!}</div>
            <input type="submit" name="submit" class="btn-wd" value="{{ __('withdraw.withdraw') }}">
        </form>

    </div>

    <p class="note no-icon">{!! __('withdraw.note') !!}</p>

    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-clock-history"></i></div>
                <div class="title">{{ __('withdraw.withdrawal_history') }}</div>
            </div>

        </div>
        <div class="box-container">
            <div class="content">
                <div class="dataTable-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('withdraw.id') }}</th>
                                <th>{{ __('withdraw.withdrawal_date') }}</th>
                                <th>{{ __('withdraw.date_payment') }}</th>
                                <th>{{ __('withdraw.amount') }}</th>
                                <th>{{ __('withdraw.costs') }}</th>
                                <th>{{ __('withdraw.form') }}</th>
                                {{-- <th>{{ __('withdraw.method') }}</th> --}}
                                <th>{{ __('withdraw.withdrawal_account') }}</th>
                                <th>{{ __('withdraw.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($invoices->count())
                                @foreach ($invoices as $key => $value)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $value->id }}</td>
                                        <td style="white-space: nowrap">
                                            {{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                                        <td style="white-space: nowrap">
                                            {{ $value->paid_at == null ? date('H:i, d/m/Y', strtotime($value->created_at . ' +7 days')) : date('H:i, d/m/Y', strtotime($value->paid_at)) }}
                                        </td>
                                        <td style="white-space: nowrap">${{ $value->amount }}</td>
                                        <td style="white-space: nowrap">${{ ($value->amount * $value->costs) / 100 }}</td>
                                        <td style="white-space: nowrap">{!! $value->type == 0
                                            ? '<span class="badge-s2 normal">thường</span>'
                                            : '<span class="badge-s2 fast">nhanh</span>' !!}</td>
                                        <td style="white-space: nowrap">
                                            @php
                                                $payment_details = json_decode($value->payment_details, true);
                                            @endphp
                                            @if ($payment_details)
                                                <button
                                                    onclick="return alert('*Phương thức thanh toán: {{ $value->payment_method }}\n*Chi tiết: {{ implode(' - ', $payment_details) }}')">Xem
                                                    Chi Tiết</button>
                                            @endif
                                        </td>


                                        <td>
                                            <span
                                                @class([
                                                    'status' => true,
                                                    'pending' => $value->status->isPending() || $value->status->isRefunded() || $value->status->isOnHold(),
                                                    'watched' => $value->status->isReviewed(),
                                                    'success' => $value->status->isCompleted(),
                                                    'refuse' => $value->status->isFailed() || $value->status->isCancelled(),
                                                ])
                                            >{{ $value->status->label() }}<span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                {{ $invoices->links('pagination.default') }}
            </div>
        </div>
    </div>
    <script>
        var eltFctls = document.querySelectorAll('.withdraw input[name="type"][type="radio"]');

        eltFctls.forEach(function(elt) {
            elt.addEventListener("click", function() {
                var selectedValue = this.value;

                localStorage.setItem('withdrawal_type', selectedValue);
            });
        });

        var sVal = localStorage.getItem('withdrawal_type');

        if (sVal) {
            eltFctls.forEach(function(elt) {
                if (elt.value == sVal) {
                    elt.checked = true;
                }
            });
        }
    </script>

@endsection
