@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $_userPaymentMethod = $user->paymentMethods->first();
    // Giả sử bạn đã sử dụng casts trong model để tự động chuyển đổi JSON thành mảng
    $hasPmt = $_userPaymentMethod->fields ?? [];
    $fields = $_userPaymentMethod->pivot->details ?? [];
@endphp

@extends('layouts.member')

@section('title', __('payment.title'))

@section('content')

    <style>
        /*input*/
        input[disabled],
        input[readonly] {
            background: #f8f8f8;
            cursor: not-allowed;
        }

        .input-box {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: var(--bs-gutter-y);
        }

        @media (min-width:768px) {
            .input-box {
                flex: 0 0 auto;
                width: 100%;
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
            box-shadow: 0 1px 0 var(--bgsd-input-fc);
        }

        .column {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        .address:where(input, .select-box) {
            margin-top: 15px;
        }

        .select-box select {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            color: var(--color-input);
            background-color: var(--bg-input);
            font-size: 1rem;
        }
    </style>

    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-person"></i></div>
                <div class="title">{{ __('Thông tin thanh toán') }}</div>
            </div>
        </div>
        <div class="box-container">

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="account-profile">
                        <div class="account-content">
                            <form action="{{ route('member.payment.update') }}" method="post" class="form">
                                @csrf
                                @method('PUT')

                                <!-- Phương thức thanh toán -->
                                <div class="input-box">
                                    <label for="payment_method">{{ __('profile.pmt_methods') }} <span
                                            style="color: #f1416c">*</span></label>
                                    <div class="select-box">
                                        <select name="payment_method" id="payment_method" required>
                                            <option value="" hidden>{{ __('profile.select_pmt_methods') }}
                                            </option>
                                            @foreach ($paymentMethods as $method)
                                                <option value="{{ $method->id }}" @selected(!empty($_userPaymentMethod) && $method->id == $_userPaymentMethod->id)>
                                                    {{ $method->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Chi tiết phương thức thanh toán -->
                                <div id="payment-details">
                                    @if (!empty($_userPaymentMethod) && !empty($hasPmt) && !empty($fields))
                                        @php
                                            $fields = json_decode($fields, true);
                                        @endphp
                                        @foreach ($hasPmt as $field)
                                            @php
                                                $value = $fields[$field['name']] ?? '';
                                            @endphp

                                            <div class="input-box">
                                                <label for="fields_{{ $field['name'] }}"
                                                    class="form-label">{{ $field['label'] }}</label>

                                                @if ($field['type'] === 'select')
                                                    <div class="select-box">
                                                        <select name="fields[{{ $field['name'] }}]"
                                                            id="fields_{{ $field['name'] }}"
                                                            @if (isset($field['required']) && $field['required']) required @endif>
                                                            <option value="" hidden>
                                                                {{ __('[-- Chọn ngân hàng --]') }}</option>
                                                            @foreach ($field['options'] as $option)
                                                                <option value="{{ $option['value'] }}"
                                                                    @selected($option['value'] == old('fields.' . $field['name'], $value))>
                                                                    {{ $option['label'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @elseif ($field['type'] === 'textarea')
                                                    <textarea name="fields[{{ $field['name'] }}]" id="fields_{{ $field['name'] }}" class="form-control"
                                                        placeholder="{{ $field['placeholder'] ?? '' }}" @if (isset($field['required']) && $field['required']) required @endif>
                                        {{ old('fields.' . $field['name'], $value) }}
                                    </textarea>
                                                @else
                                                    <input type="{{ $field['type'] ?? 'text' }}"
                                                        name="fields[{{ $field['name'] }}]"
                                                        id="fields_{{ $field['name'] }}" class="form-control"
                                                        value="{{ old('fields.' . $field['name'], $value) }}"
                                                        placeholder="{{ $field['placeholder'] ?? '' }}"
                                                        @if (isset($field['required']) && $field['required']) required @endif>
                                                @endif

                                                @error('fields.' . $field['name'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <input class="btn-submit" type="submit" name="submit"
                                    value="{{ __('profile.save') }}">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <table class="table table-hover table-striped" style="
                    border: 2px solid #dee2ec;
                ">
                        <thead>
                            <tr>
                                <th>{{ __('Phương thức rút tiền') }}</th>
                                <th>{{ __('Số tiền rút tối thiểu') }}</th>
                                <th>{{ __('Phí rút') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentMethods as $method)
                            <tr>
                                <td>{{ $method->name }}</td>
                                <td>{{ round($method->min_withdraw_amount) }}$</td>
                                <td>{{ $method->withdraw_fee }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    if (selectedMethod && selectedMethod.fields) {
                        selectedMethod.fields.forEach(field => {
                            const fieldType = field.type || 'text';
                            const isRequired = field.required ? 'required' : '';
                            const placeholder = field.placeholder ?
                                `placeholder="${field.placeholder}"` : '';

                            // Tạo phần tử input dựa trên loại trường
                            let inputElement = '';
                            switch (fieldType) {
                                case 'select':
                                    // Kiểm tra xem field.options có tồn tại và là mảng không
                                    const options = Array.isArray(field.options) ? field.options :
                                    [];
                                    inputElement = `
                                <div class="select-box">
                                    <select name="fields[${field.name}]" id="fields_${field.name}" class="form-control" ${isRequired}>
                                        <option value="" hidden>${field.placeholder ? field.placeholder : 'Select an option'}</option>
                                        ${options.map(option => `<option value="${option.value}">${option.label}</option>`).join('')}
                                    </select>
                                </div>
                            `;
                                    break;
                                case 'textarea':
                                    inputElement = `
                                <textarea 
                                    name="fields[${field.name}]" 
                                    id="fields_${field.name}" 
                                    class="form-control" 
                                    ${placeholder} 
                                    ${isRequired}></textarea>
                            `;
                                    break;
                                default:
                                    inputElement = `
                                <input 
                                    type="${fieldType}" 
                                    name="fields[${field.name}]" 
                                    id="fields_${field.name}" 
                                    class="form-control" 
                                    ${placeholder} 
                                    ${isRequired}>
                            `;
                            }

                            paymentDetails.innerHTML += `
                        <div class="input-box">
                            <label for="fields_${field.name}" class="form-label">${field.label}</label>
                            ${inputElement}
                        </div>
                    `;
                        });
                    }
                }
            });
        });
    </script>
@endpush
