@extends('layouts.admin')

@section('title', __('Thêm người dùng'))

@section('content')
    <form class="card" action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row row-cards">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Tên người dùng</label>
                        <input type="text" class="form-control" placeholder="Nhập tên người dùng.." name="name"
                            value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control" placeholder="Nhập địa chỉ email.." name="email"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Mật khẩu</label>
                        <input type="text" class="form-control" placeholder="Nhập mật khẩu.." name="password"
                            value="{{ old('password') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cards">

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tên đầy đủ</label>
                        <input type="text" class="form-control" placeholder="Nhập tên đầy đủ..." name="fullname"
                            value="{{ old('fullname') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" placeholder="Nhập số điện thoại..." name="phone_number"
                            value="{{ old('phone_number') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ 1</label>
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ 1..." name="address_1"
                            value="{{ old('address_1') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ 2</label>
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ 2..." name="address_2"
                            value="{{ old('address_2') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Vùng (huyện)</label>
                        <input type="text" class="form-control" placeholder="Nhập vùng (huyện)..." name="region"
                            value="{{ old('region') }}">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Thành phố (tỉnh)</label>
                        <input type="text" class="form-control" placeholder="Nhập thành phố (tỉnh)" name="city"
                            value="{{ old('city') }}">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Zipcode</label>
                        <input type="text" class="form-control" placeholder="Nhập mã code..." name="zipcode"
                            value="{{ old('zipcode') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-label">Vai trò</div>
                    <select class="form-select" multiple="" style="height: 150px" name="role[]"
                        value="{{ old('role') ?? '' }}">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row row-cards">

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phương thức thanh toán</label>
                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="" hidden>{{ __('profile.select_pmt_methods') }}</option>
                            @foreach ($paymentMethods as $method)
                                <option value="{{ $method->id }}" @selected($method->id == old('payment_method'))>
                                    {{ $method->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6" id="payment-details"></div>
              
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
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
            if (selectedMethod) {
                JSON.parse(selectedMethod.fields).forEach(field => {
                    paymentDetails.innerHTML += `
                        <div class="mb-3">
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

