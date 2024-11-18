@extends('layouts.admin')

@section('title', __('Thêm phương thức thanh toán'))

@section('content')
    <form class="card" action="{{ route('admin.payment-methods.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label required" for="name">Tên phương thức</label>
                        <input type="text" id="name" class="form-control" placeholder="Nhập tên phương thức..."
                            name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label required" for="withdraw_fee">Phí thanh toán</label>
                        <input type="text" placeholder="Nhập phí thanh toán..." id="withdraw_fee" class="form-control"
                            name="withdraw_fee" value="{{ old('withdraw_fee') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label required" for="min_withdraw_amount">Số tiền rút tối thiểu</label>
                        <input type="text" id="min_withdraw_amount" class="form-control"
                            placeholder="Nhập số tiền rút tối thiểu.." name="min_withdraw_amount"
                            value="{{ old('min_withdraw_amount') }}">
                    </div>
                </div>
                <div class="mb-3">
                  <label for="fields" class="form-label">Chi tiết phương thức thanh toán</label>
              
                  <div id="dynamic-fields">
                      <div class="input-group mb-3">
                          <input type="text" name="fields[0][name]" class="form-control" placeholder="Nhập tên...">
                          <input type="text" name="fields[0][key]" class="form-control" placeholder="Nhập key...">
                          <button class="btn btn-danger remove-field" type="button">Xóa</button>
                      </div>
                  </div>
                  <button type="button" id="add-field" class="btn btn-primary">Thêm trường</button>
              </div>
              

            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>

    </form>

@endsection

@push('scripts')
    <script>
        document.getElementById('add-field').addEventListener('click', function() {
            let fieldContainer = document.createElement('div');
            fieldContainer.classList.add('input-group', 'mb-3');

            let nameField = document.createElement('input');
            nameField.type = 'text';
            nameField.name = `fields[${document.querySelectorAll('#dynamic-fields .input-group').length}][name]`; // Lưu tên
            nameField.classList.add('form-control');
            nameField.placeholder = 'Nhập tên...';

            let keyField = document.createElement('input');
            keyField.type = 'text';
            keyField.name = `fields[${document.querySelectorAll('#dynamic-fields .input-group').length}][key]`; // Lưu key
            keyField.classList.add('form-control');
            keyField.placeholder = 'Nhập key...';

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
