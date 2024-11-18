@extends('layouts.admin')

@section('title', 'Sửa phương thức')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.payment-methods.edit', $method) }}
@endsection

@section('content')
<div class="card">

    <div class="card-body">
        <form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Tên Phương Thức Thanh Toán -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên phương thức thanh toán</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $method->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control">
                    <option value="">[--Chọn--]</option>
                    <option value="publish" @selected($method->status == 'publish')>Công khai</option>
                    <option value="unpublish" @selected($method->status == 'unpublish')>Không công khai</option>
                </select>
            </div>
            <!-- Các trường chi tiết (Dynamic Fields) -->
            <div class="mb-3">
                <label for="fields" class="form-label">Chi tiết phương thức thanh toán</label>
                <div id="dynamic-fields">
                    @foreach(json_decode($method->fields, true) as $key=>$field)
                        <div class="input-group mb-3">
                            <input type="text" name="fields[{{ $key }}][name]" class="form-control" value="{{ $field['name'] ?? '' }}" placeholder="Tên trường (VD: Số tài khoản)">
                            <input type="text" name="fields[{{ $key }}][key]" class="form-control" value="{{ $field['key'] ?? '' }}" placeholder="Key (VD: account_number)">
                            <button class="btn btn-danger remove-field" type="button">Xóa</button>
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

            <button type="submit" class="btn btn-success">Cập nhật phương thức thanh toán</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('add-field').addEventListener('click', function() {
        let fieldContainer = document.createElement('div');
        fieldContainer.classList.add('input-group', 'mb-3');

        let nameField = document.createElement('input');
        nameField.type = 'text';
        nameField.name = `fields[${document.querySelectorAll('#dynamic-fields .input-group').length}][name]`; // Lưu tên trường
        nameField.classList.add('form-control');
        nameField.placeholder = 'Tên trường (VD: Số tài khoản)';

        let keyField = document.createElement('input');
        keyField.type = 'text';
        keyField.name = `fields[${document.querySelectorAll('#dynamic-fields .input-group').length}][key]`; // Lưu key trường
        keyField.classList.add('form-control');
        keyField.placeholder = 'Key (VD: account_number)';

        let removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'remove-field');
        removeButton.type = 'button';
        removeButton.innerText = 'Xóa';

        removeButton.addEventListener('click', function() {
            fieldContainer.remove();
        });

        fieldContainer.appendChild(nameField);
        fieldContainer.appendChild(keyField);
        fieldContainer.appendChild(removeButton);

        document.getElementById('dynamic-fields').appendChild(fieldContainer);
    });

    document.querySelectorAll('.remove-field').forEach(function(button) {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });

</script>
@endpush
