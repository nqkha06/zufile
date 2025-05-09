@extends('layouts.member_2')

@section('title', __('member/withdraw.title'))
@section('actions')
@endsection

@php
    /**
     * Build stat cards dynamically để tránh lặp code
     */
    $stats = [
        [
            'amount' => currencyFormat(Auth::user()?->balance, '<span class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">đ</span>'),
            'label'  => __('member/withdraw.available_balances'),
            'bg'     => 'bg-light-danger',
            'icon'   => 'text-danger',
        ],
        [
            'amount' => currencyFormat($totalPending, '<span class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">đ</span>'),
            'label'  => __('member/withdraw.processing'),
            'bg'     => 'bg-light-warning',
            'icon'   => 'text-warning',
        ],
        [
            'amount' => currencyFormat(0, '<span class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">đ</span>'), // TODO: bind real withheld value
            'label'  => __('member/withdraw.withheld'),
            'bg'     => 'bg-light-primary',
            'icon'   => 'text-primary',
        ],
        [
            'amount' => currencyFormat($totalCompleted, '<span class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">đ</span>'),
            'label'  => __('member/withdraw.total_payment'),
            'bg'     => 'bg-light-success',
            'icon'   => 'text-success',
        ],
    ];
@endphp

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="row g-3">
            @foreach($stats as $stat)
                <div class="col-sm-6 col-md {{ $loop->last ? 'col-12' : '' }}">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column align-items-start">
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{!! $stat['amount'] !!}</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">{{ $stat['label'] }}</span>
                            </div>
                            <div class="symbol symbol-70px symbol-circle">
                                <span class="symbol-label {{ $stat['bg'] }}">
                                    <i class="ki-outline ki-wallet {{ $stat['icon'] }} fs-3x"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <form action="" method="POST" class="col-12 mt-10">
                @csrf
                <div class="row g-3 mb-4">
                    @foreach ($optionWithdrawAmounts as $item)
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="amount" value="{{ $item }}" id="amount_{{ $item }}" />
                            <label for="amount_{{ $item }}" class="btn btn-sm btn-light-danger w-100 d-flex align-items-center justify-content-center">{{ currencyFormat($item) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <button class="btn btn-success w-100">{{ __('member/withdraw.withdraw_button') }}</button>
                    </div>
                </div>

                <div class="alert alert-primary d-flex align-items-center p-5 mb-0">
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-primary">{{ __('member/withdraw.note_title') }}</h4>
                        <span>
                            {!! __('member/withdraw.note_1', ['url' => 'https://t.me/vuotnhanh_bill']) !!}<br>
                            {!! __('member/withdraw.note_2', ['min' => currencyFormat(20000)]) !!}<br>
                            {!! __('member/withdraw.note_3') !!}
                        </span>
                    </div>
                </div>
            </form>

            <div class="col-12 mt-10">
                <div class="card">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('member/withdraw.history_title') }}</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ __('member/withdraw.history_sub', ['count' => $invoices->count()]) }}</span>
                            </h3>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="{{ __('member/withdraw.filter_status') }}" data-qk-withdraw-filter="status">
                                    <option></option>
                                    <option value="all">{{ __('member/withdraw.filter_all') }}</option>
                                    <option value="Đang xử lý">{{ __('member/withdraw.filter_pending') }}</option>
                                    <option value="Đã xem xét">{{ __('member/withdraw.filter_reviewed') }}</option>
                                    <option value="Thành công">{{ __('member/withdraw.filter_completed') }}</option>
                                    <option value="Thất bại">{{ __('member/withdraw.filter_failed') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-0">
                        @if($invoices->count())
                            <table id="qk_withdraw_table" class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        @foreach(['id','withdraw_date','paid_date','amount','fee','type','payment_account','status'] as $field)
                                            <th class="text-nowrap {{ $field === 'status' ? 'text-end' : '' }}">{{ __('member/withdraw.table.' . $field) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td class="text-nowrap">{{ $invoice->id }}</td>
                                            <td class="text-nowrap">{{ $invoice->created_at->format('H:i, d/m/Y') }}</td>
                                            <td class="text-nowrap">
                                                {{ $invoice->paid_at == null ? date('H:i, d/m/Y', strtotime($invoice->created_at . ' +7 days')) : date('H:i, d/m/Y', strtotime($invoice->paid_at)) }}
                                            </td>
                                            <td class="text-nowrap">{{ currencyFormat($invoice->amount) }}</td>
                                            <td class="text-nowrap">{{ currencyFormat(($invoice->amount * $invoice->costs) / 100) }}</td>
                                            <td class="text-nowrap">
                                                <span class="bullet {{ $invoice->type == 0 ? 'bg-primary' : 'bg-danger' }} me-2"></span>
                                                {{ $invoice->type == 0 ? __('member/withdraw.type_normal') : __('member/withdraw.type_fast') }}
                                            </td>
                                            <td style="white-space: nowrap">
                                                @php $details = json_decode($invoice->payment_details, true); @endphp
                                                @if($details)
                                                    <a onclick="return alert('*{{ __('member/withdraw.payment_method') }}: {{ $invoice->payment_method }}\n*{{ __('member/withdraw.details') }}: {{ implode(' - ', $details) }}')">{{ __('member/withdraw.view_detail') }}</a>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @php
                                                    $statusClasses = [
                                                        'warning' => $invoice->status->isPending() || $invoice->status->isRefunded() || $invoice->status->isOnHold(),
                                                        'primary' => $invoice->status->isReviewed(),
                                                        'success' => $invoice->status->isCompleted(),
                                                        'dark'    => $invoice->status->isFailed() || $invoice->status->isCancelled(),
                                                    ];
                                                    $badgeClass = collect($statusClasses)->filter()->keys()->first();
                                                @endphp
                                                <span class="badge py-3 px-4 fs-7 badge-light-{{ $badgeClass }} status">{{ $invoice->status->label() }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="dt-empty m-3 text-center">
                                <img src="{{ asset('backend/media/illustrations/sketchy-1/5.png') }}" class="mw-300px" alt="empty" />
                                <div class="fs-1 fw-bolder text-dark my-4">{{ __('member/withdraw.empty') }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    "use strict";
    
    var QKVuotNhanh = (function() {
        var tableSelector;     
        var tableElement;   
        var dataTableInstance; 
    
        return {
            init: function() {
                tableSelector = "#qk_withdraw_table";
                tableElement  = document.querySelector(tableSelector);
    
                dataTableInstance = new DataTable(tableSelector, {
                    order: [],          // Không sắp xếp mặc định
                    pageLength: 10,     // Số dòng hiển thị trên mỗi trang
                    scrollX: true       // Kích hoạt thanh cuộn ngang
                });
    
                (function() {
                    const filterElement = document.querySelector('[data-qk-withdraw-filter="status"]');
    
                    $(filterElement).on("change", (event) => {
                        const selectedValue = event.target.value;
    
                        dataTableInstance
                            .column(7)
                            .search(selectedValue === "all" ? "" : selectedValue, false, false)
                            .draw();
                    });
                })();
            }
        };
    })();
    
    KTUtil.onDOMContentLoaded(function() {
        QKVuotNhanh.init();
    });
    </script>
@endpush
