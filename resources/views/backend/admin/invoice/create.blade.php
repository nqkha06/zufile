
@extends('layouts.admin')
@section('title', __('Tạo hoá đơn'))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.invoices.index') }}
@endsection
@php
    $user = is_numeric(request('user')) ? \App\Models\User::find(request('user')) : null;
@endphp
@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.invoices.store') }}" method="POST">

            <div class="card rounded-3">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="email">Email</label>
                            <input class="form-control" name="email" value="{{ old('email', (!empty($user) ? $user?->email : '')) }}" id="email"
                                placeholder="" required>
                        </div>
  
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
       
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="type">Kiểu rút</label>
                            <select class="form-select" name="type" value="{{ old('type') }}" id="type"
                                placeholder="" required>
                                <option value="">[--chọn--]</option>
                                <option value="normal" @selected(old('type') == 0)>Bình thường</option>
                                <option value="fast" @selected(old('type') == 1)>Nhanh</option>

                            </select>
                        </div>
      
          
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_method">Phương thức thanh toán</label>
                            <input class="form-control" name="payment_method" value="{{ old('payment_method') }}" id="payment_method"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="payment_details">Thông tin tài khoản thanh toán</label>
                            <input class="form-control" name="payment_details" value="{{ old('payment_details') }}" id="payment_account_name"
                                placeholder="" required>
                        </div>

                    </div>
                </div>

            </div>
            <div class="mt-3">
              <input value="Tạo" type="submit" class="btn btn-primary">
              <input value="Tạo (no send mail)" name="no_send_mail" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection

