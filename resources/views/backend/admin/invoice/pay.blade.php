@extends('layouts.admin')
@section('title', __('Thanh toán #' . $invoice->id))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.invoices.edit', $invoice) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <p>Phương thức thanh toán: {{ $invoice->payment_method }} </p>
                    <p>Thông tin tài khoản:
                        @php
                            $payment_details = json_decode($invoice->payment_details, true);
                        @endphp
                        @if ($payment_details)
                            {{ implode(' - ', $payment_details) }}
                        @endif
                    </p>
                    <p>Thành tiền: {{ ($invoice->amount - ($invoice->amount * $invoice->costs) / 100) * Setting::get('usd_to_vnd', 0) }} vnđ</p>
                    <p>Nội dung chuyển khoản: link4sub {{ $invoice->id }}</p>
                </div>
{{--       
                <div class="col-12 col-md-6">
                    <div class="row text-center justify-content-center">
                        <img src="https://img.vietqr.io/image/970416-18330951-compact1.jpg?addInfo=fapi 1&amp;accountName=NGO QUOC KHA" height="256px" width="256px" style="border: 1px solid rgba(128, 128, 128, 0.4); width: 256px; height: 256px;">
                        <span>Quét mã QR để chuyển khoản (khuyến khích)</span>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
    <div class="mt-3 btn-list">
        @if ($invoice->status == 'completed')
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-success">BẠN ĐÃ THANH TOÁN</a>
        @endif
        @if ($invoice->status == 'approved')
            <a href="{{ route('admin.invoices.success', $invoice->id) }}"
                onclick="return confirm('Bạn chắc chắn chuyển khoản với nội dung đó chưa?')" class="btn btn-red">Thanh
                toán</a>
        @endif
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-seccound">Quay về</a>
    </div>
@endsection
