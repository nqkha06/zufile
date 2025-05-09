@extends('layouts.member_2')

@section('title', __('Thông tin thanh toán'))

@section('content')
<div id="kt_app_content_container" class="app-container">
    <div class="row mb-10">
        <div class="col-12">
            <form class="card" action="{{ route('member.payment.update') }}" method="POST" id="paymentForm">
                @csrf @method('PUT')

                {{-- header --}}
                <div class="card-header">
                    <h3 class="card-title">{{ __('Thông tin thanh toán') }}</h3>
                </div>

                {{-- body --}}
                <div class="card-body">
                    {{-- Phương thức thanh toán --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                            {{ __('Phương thức thanh toán') }}
                        </label>

                        <div class="col-lg-8">
                            <select id="payment_method"
                                    name="payment_method"
                                    class="form-select form-select-lg fw-semibold"
                                    required>
                                <option value="" hidden>{{ __('profile.select_pmt_methods') }}</option>
                                @foreach ($paymentMethods as $m)
                                    <option value="{{ $m->id }}" @selected($currentMethod && $m->id === $currentMethod->id)>
                                        {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Các trường chi tiết (động) --}}
                    <div id="payment-details"></div>
                </div>

                {{-- footer --}}
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Lưu thay đổi') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@php
    $methods = $paymentMethods->map(function ($m) {
        return [
            'id'    => $m->id,
            'fields'=> $m->fields,   // [{name,label,type,...}]
        ];  
    });
 
@endphp

@push('scripts')
<script>
(() => {
    /* ----- DATA ----- */
    const methods = @json($methods);
    
    const oldValues = JSON.parse(@json($fieldValues ?? []));
    
    /* ----- DOM ----- */
    const detailsEl = document.getElementById('payment-details');
    const selectEl  = document.getElementById('payment_method');

    /* ----- RENDER ----- */
    const renderFields = (methodId) => {
        const m = methods.find(x => x.id == methodId);
        if (!m) { detailsEl.innerHTML = ''; return; }

        let html = '';
        (m.fields || []).forEach(f => {
            const val     = oldValues[f.name] ?? '';
            const reqAttr = f.required ? 'required' : '';
            const phAttr  = f.placeholder ? `placeholder="${f.placeholder}"` : '';
            const id      = 'f_' + f.name;
            
            if (f.type === 'select') {
                const opts = (f.options || [])
                    .map(o => `<option value="${o.value}" ${o.value == val ? 'selected' : ''}>${o.label}</option>`)
                    .join('');
                html += `
                    <div class="mb-5">
                        <label class="form-label" for="${id}">${f.label}</label>
                        <select class="form-control" id="${id}" name="fields[${f.name}]" ${reqAttr}>
                            <option value="" hidden>${f.placeholder || '-- chọn --'}</option>
                            ${opts}
                        </select>
                    </div>`;
            } else if (f.type === 'textarea') {
                html += `
                    <div class="mb-5">
                        <label class="form-label" for="${id}">${f.label}</label>
                        <textarea class="form-control" id="${id}" name="fields[${f.name}]" ${phAttr} ${reqAttr}>${val}</textarea>
                    </div>`;
            } else {
                html += `
                    <div class="mb-5">
                        <label class="form-label" for="${id}">${f.label}</label>
                        <input class="form-control"
                               type="${f.type || 'text'}"
                               id="${id}"
                               name="fields[${f.name}]"
                               value="${val}"
                               ${phAttr} ${reqAttr}>
                    </div>`;
            }
        });
        detailsEl.innerHTML = html;
    };

    /* ----- Sự kiện ----- */
    selectEl.addEventListener('change', e => renderFields(e.target.value));

    /* render ngay lần đầu (trường hợp đã có phương thức) */
    if (selectEl.value) renderFields(selectEl.value);
})();
</script>
@endpush
