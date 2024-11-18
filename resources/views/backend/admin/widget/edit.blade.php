
@extends('layouts.admin')
@section('title', __('Sửa hoá đơn: '. $invoice->id))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.invoices.edit', $invoice) }}
@endsection

@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.permission-groups.update') }}" method="POST">

            <div class="card rounded-3">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="amount">Sô tiền</label>
                            <input class="form-control" name="amount" value="{{ old('amount') }}" id="amount"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="costs">Phí rút (%)</label>
                            <input class="form-control" name="costs" value="{{ old('costs') }}" id="costs"
                                placeholder="" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="type">Kiểu rút</label>
                            <select class="form-select" name="type" value="{{ old('type') }}" id="type"
                                placeholder="" required>
                            <option value="">[--chọn--]</option>
                        </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_method">Phương thức thanh toán</label>
                            <input class="form-control" name="payment_method" value="{{ old('payment_method') }}" id="payment_method"
                                placeholder="" required>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="status">Trạng thái</label>
                            <input class="form-control" name="status" value="{{ old('status') }}" id="status"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="payment_bank_name">Tên ngân hàng (nếu có)</label>
                            <input class="form-control" name="payment_bank_name" value="{{ old('payment_bank_name') }}" id="payment_bank_name"
                                placeholder="">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_account_name">Tên TKNH</label>
                            <input class="form-control" name="payment_account_name" value="{{ old('payment_account_name') }}" id="payment_account_name"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_account_number">Số TKNH</label>
                            <input class="form-control" name="payment_account_number" value="{{ old('payment_account_number') }}" id="payment_account_number"
                                placeholder="" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-3">
              <input value="Cập nhật" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection

