@php
$_userPaymentMethod = Auth::user()->paymentMethods->first();

function findElt($array, $keyValue) {
    return collect($array)->firstWhere('key', $keyValue);
}
@endphp

@extends('layouts.member')

@section('title', __('payment.title'))

@section('content')

<style>
    /*input*/
    input[disabled],
    input[readonly] {
        background: #f8f8f8;
        cursor: not-allowed
    }

    .input-box {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--bs-gutter-x)* .5);
        padding-left: calc(var(--bs-gutter-x)* .5);
        margin-top: var(--bs-gutter-y)
    }

    @media (min-width:768px) {
        .input-box {
            flex: 0 0 auto;
            width: 100%
        }
    }

    div :where(.input-box input, .select-box) {
        position: relative;
        height: 40px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: var(--color-input);
        background: var(--bg-input);
        margin-top: 7px;
        margin-bottom: 10px;
        border: 1px solid var(--border-input);
        border-radius: 6px;
        padding: 0 15px;
    }

    .input-box input:focus {
        box-shadow: 0 1px 0 var(--bgsd-input-fc)
    }

    .column {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1* var(--bs-gutter-y));
        margin-right: calc(-.5* var(--bs-gutter-x));
        margin-left: calc(-.5* var(--bs-gutter-x))
    }

    .address:where(input, .select-box) {
        margin-top: 15px
    }

    .select-box select {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        color: var(--color-input);
        background-color: var(--bg-input);
        font-size: 1rem
    }
</style>
<div class="box">
    <div class="box-top">
        <div class="top-left">
            <div class="icon"><i class="bi bi-person"></i></div>
            <div class="title">Thông tin thanh toán</div>
        </div>
    </div>
    <div class="box-container">
        <div class="content">
            <div class="account-profile">
                <div class="account-content">
                    <form action="" method="post" class="form">
                        @csrf
                        <div class="input-box">
                            <label>{{ __('profile.pmt_methods') }} <span style="color: #f1416c">*</span></label>
                            <div class="select-box">
                                <select name="payment_method" id="payment_method" required>
                                    <option value="" hidden>{{ __('profile.select_pmt_methods') }}</option>
                                    @foreach ($paymentMethods as $method)
                                        <option value="{{ $method->id }}" @selected(!empty($_userPaymentMethod) && $method->id == $_userPaymentMethod->pivot->payment_method_id)>
                                            {{ $method->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="payment-details">
                        @if (!empty($_userPaymentMethod))
                            @php
                                $hasPmt = json_decode($_userPaymentMethod->fields ?? '[]', true);
                                $fields = json_decode($_userPaymentMethod->pivot->details ?? '[]', true);
                            @endphp

                            @foreach ($fields as $key => $value)
                                @php
                                    $chosen = findElt($hasPmt, $key);
                                @endphp

                                <div class="input-box">
                                    <label for="fields[{{ $chosen['key'] ?? '' }}]" class="form-label">{{ $chosen['name'] ?? '' }}</label>
                                    <input type="text" name="fields[{{ $chosen['key'] ?? '' }}]" class="form-control"
                                        value="{{ $value }}" placeholder="">
                                </div>
                            @endforeach
                        @endif
                        </div>
                        <input class="btn-submit" type="submit" name="submit" value="{{ __('profile.save') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS remains unchanged */
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.getElementById('payment_method');
    const paymentDetails = document.getElementById('payment-details');
    const paymentMethods = @json($paymentMethods);

    paymentMethodSelect.addEventListener('change', function() {
        const selectedMethodId = this.value;
        paymentDetails.innerHTML = '';

        if (selectedMethodId) {
            const selectedMethod = paymentMethods.find(method => method.id == selectedMethodId);
            if (selectedMethod) {
                JSON.parse(selectedMethod.fields).forEach(field => {
                    paymentDetails.innerHTML += `
                        <div class="input-box">
                            <label class="form-label">${field.name}</label>
                            <input type="text" name="fields[${field.key}]" class="form-control" placeholder="">
                        </div>
                    `;
                });
            }
        }
    });
});
</script>
@endpush