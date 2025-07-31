@extends('layouts.admin')

@section('title', 'Sửa phương thức')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.payment-methods.edit', $method) }}
@endsection

@section('content')
<form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST">
    @csrf
    @method('PUT')
    @if (isset($lang) && !empty($lang))
        <div class="col-12">
            <div role="alert" class="alert alert-info">
                <div class="d-flex">
                    <div>
                        <svg class="icon alert-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                        </svg>
                    </div>
                    <div class="w-100">

                        Bạn đang chỉnh sửa phiên bản tiếng "<strong
                            class="current_language_text">{{ $lang->name }}</strong>"

                    </div>
                </div>



            </div>
        </div>
    @endif
    <div class="row">
        <div class="gap-3 col-md-9">

            <div class="card mb-3">

                <div class="card-body">

                    <!-- Tên Phương Thức Thanh Toán -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên phương thức thanh toán</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $method->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Các trường chi tiết (Dynamic Fields) -->
                    <div class="mb-3">
                        <label for="fields" class="form-label">Chi tiết phương thức thanh toán</label>
                        <div id="dynamic-fields">
                            @foreach($method->fields as $key => $field)
                            <div class="field-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="fields[{{ $key }}][label]" class="form-control" value="{{ $field['label'] ?? '' }}" placeholder="Nhãn hiển thị (VD: Số tài khoản)" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="fields[{{ $key }}][name]" class="form-control" value="{{ $field['name'] ?? '' }}" placeholder="Tên trường (VD: account_number)" required>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="fields[{{ $key }}][type]" class="form-control field-type" required>
                                            <option value="text" @selected(($field['type'] ?? 'text') == 'text')>Text</option>
                                            <option value="number" @selected(($field['type'] ?? '') == 'number')>Number</option>
                                            <option value="email" @selected(($field['type'] ?? '') == 'email')>Email</option>
                                            <option value="password" @selected(($field['type'] ?? '') == 'password')>Password</option>
                                            <option value="select" @selected(($field['type'] ?? '') == 'select')>Select</option>
                                            <!-- Thêm các loại input khác nếu cần -->
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="fields[{{ $key }}][placeholder]" class="form-control" value="{{ $field['placeholder'] ?? '' }}" placeholder="Placeholder (VD: Nhập số tài khoản)">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button class="btn btn-danger remove-field" type="button">Xóa</button>
                                    </div>
                                </div>
                                <!-- Phần tùy chọn cho select đặt ngoài .row -->
                                <div class="col-md-12 mt-2 options-container" @if(($field['type'] ?? '') != 'select') style="display: none;" @endif>
                                    <label class="form-label">Tùy chọn (Options)</label>
                                    <textarea
                                    name="fields[{{ $key }}][options]"
                                    class="form-control"
                                    placeholder="Nhập các tùy chọn, mỗi tùy chọn trên một dòng">{{ isset($field['options'])
                                        ? collect($field['options'])->map(fn($item) => trim($item['value']) . '|' . trim($item['label']))->implode("\n")
                                        : ''
                                    }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-field" class="btn btn-primary">Thêm trường</button>
                    </div>

                    <!-- Phí Rút -->
                    <div class="mb-3">
                        <label for="withdraw_fee" class="form-label">Phí rút</label>
                        <input type="number" step="0.01" name="withdraw_fee" id="withdraw_fee" class="form-control @error('withdraw_fee') is-invalid @enderror" value="{{ old('withdraw_fee', $method->withdraw_fee) }}" required>
                        @error('withdraw_fee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Số tiền rút tối thiểu -->
                    <div class="mb-3">
                        <label for="min_withdraw_amount" class="form-label">Số tiền rút tối thiểu</label>
                        <input type="number" step="0.01" name="min_withdraw_amount" id="min_withdraw_amount" class="form-control @error('min_withdraw_amount') is-invalid @enderror" value="{{ old('min_withdraw_amount', $method->min_withdraw_amount) }}" required>
                        @error('min_withdraw_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            Save

                        </button>

                        <button class="btn" type="submit" name="submitter" value="save">
                            <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

            <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            Ngôn ngữ
                        </h4>
                    </div>

                    <div class="card-body">
                        <input type="text" name="lang" value="{{ $lang?->code ?? config("app.DEFAULT_LANG_ADMIN") }}" hidden>
                        <div id="list-others-language">
                            @foreach (Language::getSupportedLanguages()->where("code", "!=", $lang?->code ?? config("app.DEFAULT_LANG_ADMIN")) as $lang)
                            <a class="gap-2 d-flex align-items-center text-decoration-none"
                            href="{{ route("admin.payment-methods.edit", [$method->id, "ref_lang" => $lang->code])}}" target="_blank">
                            <img src="{{ asset("core/img/flags/".$lang->flag.".svg")}}" title="{{ $lang->name }}"
                                class="flag" style="height: 16px" loading="lazy" alt="{{ $lang->name }} flag">
                                <span>{{ $lang->name }}
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                        <path d="M11 13l9 -9"></path>
                                        <path d="M15 4h5v5"></path>
                                    </svg>
                                </span>
                            </a>
                            @endforeach

                        </div>
                    </div>
                </div>

            <div class="card meta-boxes">
                <div class="card-header">
                    <h4 class="card-title">
                        <label for="status" class="form-label required">Status</label>
                    </h4>
                </div>

                <div class="card-body">
                    <select class="form-select" name="status" id="status" required="">
                        <option value="">[--Trạng thái--]</option>
                        @foreach ($baseStatus as $status)
                        <option value="{{ $status->value }}" @selected($method->status->value == $status->value)>{{ $status->label() }}</option>

                        @endforeach
                    </select>
                </div>

            </div>

        </div>
    </div>

</form>
@endsection

@push('scripts')
<script>
    document.getElementById('add-field').addEventListener('click', function() {
        let dynamicFields = document.getElementById('dynamic-fields');
        let fieldGroups = dynamicFields.querySelectorAll('.field-group');
        let fieldCount = fieldGroups.length;

        let fieldGroup = document.createElement('div');
        fieldGroup.classList.add('field-group', 'mb-3');

        fieldGroup.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="fields[${fieldCount}][label]" class="form-control" placeholder="Nhãn hiển thị (VD: Số tài khoản)" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="fields[${fieldCount}][name]" class="form-control" placeholder="Tên trường (VD: account_number)" required>
                </div>
                <div class="col-md-2">
                    <select name="fields[${fieldCount}][type]" class="form-control field-type" required>
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="password">Password</option>
                        <option value="select">Select</option>
                        <!-- Thêm các loại input khác nếu cần -->
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="fields[${fieldCount}][placeholder]" class="form-control" placeholder="Placeholder (VD: Nhập số tài khoản)">
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button class="btn btn-danger remove-field" type="button">Xóa</button>
                </div>
            </div>
            <!-- Phần tùy chọn cho select đặt ngoài .row -->
            <div class="col-md-12 mt-2 options-container" style="display: none;">
                <label class="form-label">Tùy chọn (Options)</label>
                <textarea name="fields[${fieldCount}][options]" class="form-control" placeholder="Nhập các tùy chọn, mỗi tùy chọn trên một dòng"></textarea>
            </div>
        `;

        dynamicFields.appendChild(fieldGroup);
    });

    // Sự kiện xóa trường và cập nhật lại chỉ số
    document.getElementById('dynamic-fields').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-field')) {
            e.target.closest('.field-group').remove();
            updateFieldIndices();
        }
    });

    // Sự kiện thay đổi loại trường để hiển thị hoặc ẩn phần tùy chọn
    document.getElementById('dynamic-fields').addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('field-type')) {
            let selectedType = e.target.value;
            let fieldGroup = e.target.closest('.field-group');
            let optionsContainer = fieldGroup.querySelector('.options-container');

            if (selectedType === 'select') {
                if (optionsContainer) {
                    optionsContainer.style.display = 'block';
                }
            } else {
                if (optionsContainer) {
                    optionsContainer.style.display = 'none';
                    // Xóa giá trị trong textarea khi không phải select
                    let textarea = optionsContainer.querySelector('textarea');
                    if (textarea) {
                        textarea.value = '';
                    }
                }
            }
        }
    });

    function updateFieldIndices() {
        const dynamicFields = document.getElementById('dynamic-fields');
        const fieldGroups = dynamicFields.querySelectorAll('.field-group');
        fieldGroups.forEach((group, index) => {
            group.querySelectorAll('input, select, textarea').forEach(input => {
                // Sử dụng regex để thay thế chỉ số trong tên trường
                let name = input.getAttribute('name');
                if (name) {
                    name = name.replace(/fields\[\d+\]/, `fields[${index}]`);
                    input.setAttribute('name', name);
                }
            });
        });
    }
</script>

@endpush
