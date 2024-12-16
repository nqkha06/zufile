@extends('layouts.admin')
@section('title', __('Sửa hoá đơn: ' . $invoice->id))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.invoices.edit', $invoice) }}
@endsection

@section('content')
<script>
    const BotbleVariables = true;
</script>
<script src="https://cms.botble.com/vendor/core/core/base/libraries/jquery.min.js?v=7.4.6"></script>
<script src="https://cms.botble.com/vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.min.js?v=7.4.6"></script>

<script src="https://cms.botble.com/vendor/core/core/base/js/core.js?v=7.4.6"></script>

    <form class="col-12" action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="row row-cols-lg-2">



{{-- 

                <div class="col-lg-12">
                    <div class="mb-3 position-relative">



                        <label class="form-check form-switch ">
                            <input name="is_change_password" type="hidden" value="0">
                            <input class="form-check-input" name="is_change_password" type="checkbox" value="1"
                                id="is_change_password">

                            <span class="form-check-label">Change password?</span>
                        </label>




                    </div>

                </div> --}}



                <div class="col-lg-6">
                    <div class="mb-3 position-relative" data-bb-collapse="false"
                        data-bb-trigger="[name=is_change_password]" data-bb-value="1" style="display: none;">

                        <label for="password" class="form-label required">Password</label>

                        <input class="form-control" data-counter="60" required="required" name="password"
                            type="password" id="password" aria-required="true">



                    </div>

                </div>



                <div class="col-lg-6">
                    <div class="mb-3 position-relative" data-bb-collapse="true"
                        data-bb-trigger="[name=is_change_password]" data-bb-value="1" style="display: none;">

                        <label for="password_confirmation" class="form-label required">Password confirmation</label>

                        <input class="form-control" data-counter="60" required="required" name="password_confirmation"
                            type="password" id="password_confirmation" aria-required="true">



                    </div>

                </div>


            </div>
        </div>
        <div class="row">
            <div class="gap-3 col-md-9">

                <div class="card mb-3">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required" for="amount">Sô tiền</label>
                                <input class="form-control" name="amount" value="{{ old('amount', $invoice->amount) }}"
                                    id="amount" placeholder="" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required" for="costs">Phí rút (%)</label>
                                <input class="form-control" name="costs" value="{{ old('costs', $invoice->costs) }}"
                                    id="costs" placeholder="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required" for="type">Kiểu rút</label>
                                <select class="form-select" name="type" value="{{ old('type', $invoice->type) }}"
                                    id="type" placeholder="" required>
                                    <option value="">[--chọn--]</option>
                                    <option value="normal" @selected($invoice->type == 0)>Bình thường</option>
                                    <option value="fast" @selected($invoice->type == 1)>Nhanh</option>

                                </select>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required" for="payment_method">Phương thức thanh toán</label>
                                <input class="form-control" name="payment_method"
                                    value="{{ old('payment_method', $invoice->payment_method) }}" id="payment_method"
                                    placeholder="" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label required" for="payment_details">Thông tin tài khoản thanh
                                    toán</label>
                                <textarea class="form-control" rows="5" name="payment_details" id="payment_account_name" placeholder=""
                                    required>{{ old('payment_details', $invoice->payment_details) }}</textarea>
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
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Save

                            </button>

                            <button class="btn" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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

                <div data-bb-waypoint="" data-bb-target="#form-actions"></div>

                <header class="top-0 w-100 position-fixed end-0 z-1000" id="form-actions" style="display: none;">
                    <div class="navbar">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center w-100">
                                <div class="col">
                                    <div class="page-pretitle">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                            </ol>
                                        </nav>

                                    </div>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                                </path>
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Save

                                        </button>

                                        <button class="btn" type="submit" name="submitter" value="save">
                                            <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                        </div>
                    </div>
                </header>


                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label for="status" class="form-label required">Status</label>
                        </h4>
                    </div>


                    <div class=" card-body">
                        <select class="form-select" name="status" value="{{ old('status', $invoice->status) }}"
                            id="status" placeholder="" required>
                            <option value="">[--Trạng thái--]</option>
                            <option value="pending" @selected($invoice->status == 'pending')>Đang xử lý</option>
                            <option value="approved" @selected($invoice->status == 'approved')>Đã xem xét</option>
                            <option value="completed" @selected($invoice->status == 'completed')>Thành công</option>
                            <option value="cancelled" @selected($invoice->status == 'cancelled')>Đã từ chối</option>
                            <option value="hold" @selected($invoice->status == 'hold')>Tạm giữ</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

    </form>
@endsection
