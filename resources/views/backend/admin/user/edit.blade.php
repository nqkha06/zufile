@extends('layouts.admin')

@section('title', __('Sửa User: ' . $user->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.users.edit', $user) }}
@endsection

@section('content')
    @php
        $_userPaymentMethod = $user->paymentMethods->first();
        $hasPmt = $_userPaymentMethod->fields ?? [];
        $fields = $_userPaymentMethod->pivot->details ?? [];

    @endphp
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="gap-3 col-md-9">

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Tên người dùng</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên người dùng.."
                                        name="name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control" placeholder="Nhập địa chỉ email.."
                                        name="email" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên đầy đủ</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên đầy đủ..."
                                        name="fullname" value="{{ old('fullname', $user->address->fullname ?? null) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="Nhập số điện thoại..."
                                        name="phone_number"
                                        value="{{ old('phone_number', $user->address->number_phone ?? null) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ 1</label>
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ 1..."
                                        name="address_1" value="{{ old('address_1', $user->address->address_1 ?? null) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ 2</label>
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ 2..."
                                        name="address_2" value="{{ old('address_2', $user->address->address_2 ?? null) }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Vùng (huyện)</label>
                                    <input type="text" class="form-control" placeholder="Nhập vùng (huyện)..."
                                        name="region" value="{{ old('region', $user->address->region ?? null) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Thành phố (tỉnh)</label>
                                    <input type="text" class="form-control" placeholder="Nhập thành phố (tỉnh)"
                                        name="city" value="{{ old('city', $user->address->city ?? null) }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Zipcode</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã code..." name="zipcode"
                                        value="{{ old('zipcode', $user->address->zipcode ?? null) }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3 position-relative">
                                    <label class="form-check form-switch">
                                        <input name="is_change_password" type="hidden" value="0">
                                        <input class="form-check-input" name="is_change_password" type="checkbox"
                                            value="1" id="is_change_password_toggle" @checked(old('is_change_password', false))>
                                        <span class="form-check-label">Đổi mật khẩu?</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6" id="password_field" style="display: none;">
                                <div class="mb-3 position-relative">
                                    <label class="form-label form-label required" for="password">Mật khẩu</label>
                                    <input class="form-control" data-counter="60" name="password" type="text"
                                        id="password" aria-required="true">
                                </div>
                            </div>

                            <div class="col-lg-6" id="password_confirmation_field" style="display: none;">
                                <div class="mb-3 position-relative">
                                    <label class="form-label form-label required" for="password_confirmation">Xác nhận mật
                                        khẩu</label>
                                    <input class="form-control" data-counter="60" name="password_confirmation"
                                        type="text" id="password_confirmation" aria-required="true">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            Phương thức thanh toán
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Phương thức thanh toán -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="payment_method">{{ __('profile.pmt_methods') }}</label>
                                    <select class="form-select" name="payment_method" id="payment_method">
                                        <option value="">{{ __('profile.select_pmt_methods') }}</option>
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

                                        <div class="mb-3">
                                            <label for="fields_{{ $field['name'] }}" class="form-label">{{ $field['label'] ?? '' }}</label>

                                            @if (isset($field['type']) && $field['type'] === 'select')
                                                <select class="form-select" name="fields[{{ $field['name'] }}]" id="fields_{{ $field['name'] }}" 
                                                    @if(isset($field['required']) && $field['required']) required @endif>
                                                    <option value="" hidden>{{ __('[-- Chọn ngân hàng --]') }}</option>
                                                    @foreach ($field['options'] as $option)
                                                        <option value="{{ $option['value'] }}" @selected($option['value'] == old('fields.' . $field['name'], $value))>
                                                            {{ $option['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @elseif (isset($field['type']) && $field['type'] === 'textarea')
                                                <textarea 
                                                    name="fields[{{ $field['name'] }}]" 
                                                    id="fields_{{ $field['name'] }}" 
                                                    class="form-control" 
                                                    placeholder="{{ $field['placeholder'] ?? '' }}" 
                                                    @if(isset($field['required']) && $field['required']) required @endif>
                                                    {{ old('fields.' . $field['name'], $value) }}
                                                </textarea>
                                            @else
                                                <input 
                                                    type="{{ $field['type'] ?? 'text' }}" 
                                                    name="fields[{{ $field['name'] }}]" 
                                                    id="fields_{{ $field['name'] }}" 
                                                    class="form-control"
                                                    value="{{ old('fields.' . $field['name'], $value) }}" 
                                                    placeholder="{{ $field['placeholder'] ?? '' }}"
                                                    @if(isset($field['required']) && $field['required']) required @endif
                                                >
                                            @endif

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Publish
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Save

                            </button>

                            <button class="btn" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                    <path d="M4 14h9"></path>
                                    <path d="M10 11l3 3l-3 3"></path>
                                </svg>
                                Save &amp; Exit

                            </button>


                        </div>
                    </div>
                </div>

                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label for="status" class="form-label required">Trạng thái</label>
                        </h4>
                    </div>

                    <div class="card-body">
                        <select class="form-select" name="status" id="status" required="">
                            <option value="">[--Trạng thái--]</option>
                            @foreach ($userStatusEnum as $sttt)
                                <option value="{{ $sttt->value }}" selected> {{ $sttt->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            Vai trò
                        </h4>
                    </div>

                    <div class="card-body">
                        <div>
                            @foreach ($roles as $role)
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" name="roles[]" type="checkbox"
                                        value="{{ $role }}" @checked(in_array($role, old('roles', $userRoles)))>
                                    <span class="form-check-label">{{ ucfirst($role) }}</span>
                                </label>
                            @endforeach


                        </div>

                    </div>
                </div>
            </div>


        </div>
    </form>

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
                        const placeholder = field.placeholder ? `placeholder="${field.placeholder}"` : '';
    
                        // Tạo phần tử input dựa trên loại trường
                        let inputElement = '';
                        switch(fieldType) {
                            case 'select':
                                // Kiểm tra xem field.options có tồn tại và là mảng không
                                const options = Array.isArray(field.options) ? field.options : [];
                                inputElement = `
                                    <select name="fields[${field.name}]" id="fields_${field.name}" class="form-select" ${isRequired}>
                                        <option value="" hidden>${field.placeholder ? field.placeholder : 'Select an option'}</option>
                                        ${options.map(option => `<option value="${option.value}">${option.label}</option>`).join('')}
                                    </select>
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
                            <div class="mb-3">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCheckbox = document.getElementById('is_change_password_toggle');
            const passwordField = document.getElementById('password_field');
            const passwordConfirmationField = document.getElementById('password_confirmation_field');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');

            // Hàm để cập nhật giao diện dựa trên trạng thái của checkbox
            function updatePasswordFields() {
                if (toggleCheckbox.checked) {
                    passwordField.style.display = 'block';
                    passwordConfirmationField.style.display = 'block';
                    passwordInput.setAttribute('required', 'required');
                    passwordConfirmationInput.setAttribute('required', 'required');
                } else {
                    passwordField.style.display = 'none';
                    passwordConfirmationField.style.display = 'none';
                    passwordInput.removeAttribute('required');
                    passwordConfirmationInput.removeAttribute('required');
                    // Xóa giá trị nếu không đổi mật khẩu
                    passwordInput.value = '';
                    passwordConfirmationInput.value = '';
                }
            }

            // Lắng nghe sự kiện thay đổi của checkbox
            toggleCheckbox.addEventListener('change', updatePasswordFields);

            // Gọi hàm khi trang được tải để thiết lập trạng thái ban đầu
            updatePasswordFields();
        });
    </script>
@endpush
