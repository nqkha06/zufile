@extends('layouts.member_2')

@section('title', __('member/stu.title'))

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->

        <div id="kt_app_content_container" class="app-container">
            <!-- FILTER -->
            <div class="card mb-10">
                <div class="card-body">
                    <form action="{{ route('member.stu_links') }}" method="GET">
                        <div class="row">
                            {{-- keyword --}}
                            <div class="col-sm-4">
                                <label for="keyword" class="form-label">
                                    {{ __('member/stu.search') }}
                                </label>
                                <input id="keyword" name="keyword" type="text"
                                    value="{{ request('keyword') ?? old('keyword') }}"
                                    placeholder="{{ __('member/stu.keyword_placeholder') }}" class="form-control">
                            </div>

                            {{-- created_at --}}
                            <div class="col-sm-2">
                                <label for="created_at" class="form-label">
                                    {{ __('member/stu.created_at') }}
                                </label>
                                <input id="created_at" name="created_at" type="date"
                                    value="{{ request('created_at') ?? old('created_at') }}" class="form-control">
                            </div>

                            {{-- level --}}
                            <div class="col-sm-3">
                                <label for="level" class="form-label">
                                    {{ __('member/stu.level') }}
                                </label>
                                <select id="level" name="level" class="form-control form-select">
                                    <option value="" hidden>
                                        {{ __('member/stu.select_level') }}
                                    </option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}" @selected(request('level') == $level->id)>
                                            {{ $level->translation()?->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- buttons --}}
                            <div class="col-sm-3 d-flex align-items-end gap-1">
                                <button class="btn btn-primary flex">
                                    {{ __('member/stu.find') }}
                                </button>
                                <button type="button" class="btn btn-secondary flex"
                                    onclick="location.href = location.pathname">
                                    {{ __('member/stu.reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('links.your_link') }}</h3>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped gy-7 gs-7 mb-0">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="white-space: nowrap">{{ __('links.no') }}</th>
                                <th style="white-space: nowrap">{{ __('links.link') }}</th>
                                <th style="white-space: nowrap">{{ __('links.date_created') }}</th>
                                <th style="white-space: nowrap">{{ __('links.views') }}</th>
                                <th style="white-space: nowrap">{{ __('links.income') }}</th>
                                <th style="white-space: nowrap">{{ __('links.levels') }}</th>
                                <th style="white-space: nowrap" class="text-end">{{ __('links.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$links->isEmpty())
                                @foreach ($links as $value)
                                    @php
                                        /*-------------------------
                                         | Thứ tự liên tục (#No)
                                         |------------------------
                                         | $loop->index   = 0,1,...
                                         | firstItem()    = STT record đầu của page
                                         -------------------------*/
                                        $no = ($links->firstItem() ?? 0) + $loop->index;
                        
                                        $badgeClass = [
                                            0 => 'secondary',   // default
                                            1 => 'secondary',
                                            2 => 'primary',
                                            3 => 'success',
                                            4 => 'warning',
                                        ][$value->level_id] ?? 'primary';
                                    @endphp
                                
                                    <tr>
                                        {{-- #No --}}
                                        <td>{{ $no }}</td>
                                
                                        {{-- Link --}}
                                        <td style="white-space: nowrap">
                                            <a href="{{ route('stu.show', $value->alias) }}"
                                               target="_blank">
                                                {{ route('stu.show', $value->alias) }}
                                            </a>
                                        </td>
                                
                                        {{-- Ngày tạo --}}
                                        <td style="white-space: nowrap">
                                            {{ $value->created_at->format('H:i, d/m/Y') }}
                                        </td>
                                
                                        {{-- Lượt xem / Doanh thu --}}
                                        <td>{{ $value->stats->count() }}</td>
                                        <td>{{ formatCurrency($value->stats->sum('revenue')) }}</td>
                                
                                        {{-- Level --}}
                                        <td>
                                            <span class="badge badge-{{ $badgeClass }}">
                                                {{ $value->level->translation()?->name }}
                                            </span>
                                        </td>
                                
                                        {{-- Hành động --}}
                                        <td style="white-space: nowrap" class="text-end">
                                            <div  style="cursor:pointer">
                                                {{-- Edit --}}
                                                <button  class="btn btn-sm btn-light-primary me-1"
                                                         data-alias="{{ $value->alias }}"
                                                         data-param="{{ $value->data }}"
                                                         data-bs-toggle="modal"
                                                         data-bs-target="#qk_modal_edit_stu"
                                                         onclick="editSTU(this)">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                
                                                {{-- Delete --}}
                                                <form action="{{ route('member.stu.destroy', $value->alias) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-light-danger me-1"
                                                            onclick="return confirm(`Bạn có chắc chắn muốn xoá liên kết '{{ $value->alias }}' chứ? Nó không thể khôi phục nếu bạn xoá nó!`)">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                
                                                {{-- Copy --}}
                                                <button class="btn btn-sm btn-light-info"
                                                        data-alias="{{ $value->alias }}"
                                                        onclick="cpLink(this)">
                                                    <i class="bi bi-clipboard"></i> Copy
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center">
                                    {{ __('member/stu.no_data') }}
                                </td>
                            </tr>
                            @endif
                            <!--show data-->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $links->links('pagination.metronic') }}
                </div>
            </div>


        </div>
    </div>
@endsection

@push('modals')
<div class="modal fade" id="qk_modal_edit_stu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div id="qk_edit_link_form" class="modal-content form">   {{-- gộp 2 class lại --}}
            <div class="modal-header">
                <h2 class="modal-title">
                    {{ __('member/stu.edit_link_modal_title') }}
                </h2>
                <button type="button"
                        class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </button>
            </div>

            <div class="modal-body">
                <div id="EDIT_STU"></div>
            </div>
        </div>
    </div>
</div>

@endpush

@push('scripts')
<script>
    window.StuLang = {
        copySuccessTitle  : @json(__('member/stu.copy_success_title')),
        copySuccessVisit  : @json(__('member/stu.copy_success_visit')),
        copySuccessClose  : @json(__('member/stu.copy_success_close')),
        confirmDeleteTitle: @json(__('member/stu.confirm_delete_title')),
        confirmDeleteHtml : alias => @json(__('member/stu.confirm_delete_html', ['alias' => '___ALIAS___'])).replace('___ALIAS___', alias),
        confirmYes        : @json(__('member/stu.confirm_delete_confirm')),
        confirmNo         : @json(__('member/stu.confirm_delete_cancel')),
        deleting          : @json(__('member/stu.deleting_processing')),
        deleteOK          : @json(__('member/stu.delete_success_title')),
        deleteFail        : @json(__('member/stu.delete_failed_title')),
    };

</script>
@endpush
@push('scripts')
<script>
/*
 |------------------------------------------------------------------
 |  STU helpers – đỡ bốc mùi
 |------------------------------------------------------------------
*/
(() => {
    'use strict';

    const t    = window.StuLang;   // alias ngắn gọn
    const swal = Swal;             // khỏi gõ dài

    /* ---------- tiện ích copy ---------- */
    const copyToClipboard = txt =>
        navigator.clipboard?.writeText(txt)            // browser mới
        ?? new Promise(resolve => {                    // fallback
                const $tmp = Object.assign(document.createElement('input'), { value: txt });
                document.body.appendChild($tmp);
                $tmp.select();
                document.execCommand('copy');
                $tmp.remove();
                resolve();
        });

    /* ---------- mở modal edit ---------- */
    window.editSTU = el => {
        const alias = el.dataset.alias;
        const raw   = JSON.parse(el.dataset.param || '{}');
        const inpSTU = {}, btnSTU = {};

        ['btn', 'lnk', 'oth'].forEach(cat => {
            if (!raw[cat]) return;
            Object.entries(raw[cat]).forEach(([k, v]) => {
                btnSTU[`g_${k}`] = true;                       // đánh dấu checkbox / radio
                inpSTU[k]        = decodeURIComponent(atob(v)); // field value
            });
        });

        new STU({
            select : '#EDIT_STU',
            type   : 'edit',
            data   : { inp: inpSTU, outp: btnSTU, alias }
        });
    };

    /* ---------- copy link ---------- */
    window.cpLink = el => {
        const link = `https://link4sub.com/${el.dataset.alias}`;

        copyToClipboard(link)
            .then(() => swal.fire({
                title            : t.copySuccessTitle,
                icon             : 'success',
                confirmButtonText: t.copySuccessVisit,
                showCancelButton : true,
                cancelButtonText : t.copySuccessClose
            }))
            .then(r => r?.isConfirmed && window.open(link, '_blank'))
            .catch(() => swal.fire(t.deleteFail, '', 'error'));
    };

    /* ---------- xoá link ---------- */
    window.rmLink = el => {
        const alias = el.dataset.alias;
        const html  = typeof t.confirmDeleteHtml === 'function'
                        ? t.confirmDeleteHtml(alias)
                        : t.confirmDeleteHtml.replace(':alias', alias);

        swal.fire({
            title            : t.confirmDeleteTitle,
            html,
            icon             : 'warning',
            showCancelButton : true,
            confirmButtonText: t.confirmYes,
            cancelButtonText : t.confirmNo,
        }).then(r => {
            if (!r.isConfirmed) return;

            swal.fire({
                title            : t.deleting,
                allowEscapeKey   : false,
                allowOutsideClick: false,
                didOpen: () => {
                    swal.showLoading();

                    fetch(`/stu/${alias}`, {
                        method : 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.ok ? res.json() : Promise.reject())
                    .then(()  => swal.fire(t.deleteOK,   '', 'success').then(() => location.reload()))
                    .catch(() => swal.fire(t.deleteFail, '', 'error'));
                }
            });
        });
    };
})();
</script>
@endpush

