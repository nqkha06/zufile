
@extends('layouts.admin')
@section('title', __('Sửa hoá đơn: '. $invoice->id))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.invoices.edit', $invoice) }}
@endsection

@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">

            <div class="card rounded-3">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="amount">Sô tiền</label>
                            <input class="form-control" name="amount" value="{{ old('amount', $invoice->amount) }}" id="amount"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="costs">Phí rút (%)</label>
                            <input class="form-control" name="costs" value="{{ old('costs', $invoice->costs) }}" id="costs"
                                placeholder="" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="type">Kiểu rút</label>
                            <select class="form-select" name="type" value="{{ old('type', $invoice->type) }}" id="type"
                                placeholder="" required>
                                <option value="">[--chọn--]</option>
                                <option value="normal" @selected($invoice->type == 0)>Bình thường</option>
                                <option value="fast" @selected($invoice->type == 1)>Nhanh</option>

                            </select>
                        </div>
      
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="status">Trạng thái</label>
                            <select class="form-select" name="status" value="{{ old('status', $invoice->status) }}" id="status"
                                placeholder="" required>
                                <option value="">[--chọn--]</option>
                                <option value="pending" @selected($invoice->status == 'pending')>Đang xử lý</option>
                                <option value="approved" @selected($invoice->status == 'approved')>Đã xem xét</option>
                                <option value="completed" @selected($invoice->status == 'completed')>Thành công</option>
                                <option value="cancelled" @selected($invoice->status == 'cancelled')>Đã từ chối</option>
                                <option value="hold" @selected($invoice->status == 'hold')>Tạm giữ</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_method">Phương thức thanh toán</label>
                            <input class="form-control" name="payment_method" value="{{ old('payment_method', $invoice->payment_method) }}" id="payment_method"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_details">Thông tin tài khoản thanh toán</label>
                            <input class="form-control" name="payment_details" value="{{ old('payment_details', $invoice->payment_details) }}" id="payment_account_name"
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

