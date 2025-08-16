@extends('layouts.admin')
@section('title', __('Gói: ' . $plan->name))
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.plans.edit', $plan) }}
@endsection
@section('content')
@php
$currentLangCode = $lang?->code ?? config('app.DEFAULT_LANG_ADMIN')
@endphp

<!-- Language tabs -->
<div class="mb-3">
    <ul class="nav nav-tabs">
        @foreach (Language::getSupportedLanguages() as $lng)
            @php $has = $plan->hasTranslation($lng->code); @endphp
            <li class="nav-item">
                <a class="nav-link {{ $currentLangCode === $lng->code ? 'active' : '' }}"
                   href="{{ route('admin.plans.edit', [$plan->id, 'ref_lang' => $lng->code]) }}"
                   title="{{ $has ? __('Sửa bản dịch :lang', ['lang' => $lng->name]) : __('Thêm bản dịch :lang', ['lang' => $lng->name]) }}">
                    <img src="{{ asset('backend/media/flags/' . $lng->flag . '.svg') }}" class="me-1" style="height:14px" alt="{{ $lng->name }} flag">
                    {{ $lng->name }}
                    @unless($has)
                        <span class="badge bg-secondary ms-1">New</span>
                    @endunless
                </a>
            </li>
        @endforeach
    </ul>
</div>

<form action="{{ route('admin.plans.update',  $plan->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="row">
      <div class="gap-3 col-md-9">

          <div class="card mb-3">

              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label required" for="name">Tên ({{ strtoupper($currentLangCode) }})</label>
                  <input class="form-control" name="name" value="{{ old('name') ?: $plan?->translation($currentLangCode)?->name ?? $plan->name }}" id="name" placeholder="Nhập tên gói..." required>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="description">Mô tả ({{ strtoupper($currentLangCode) }})</label>
                  <textarea class="form-control" name="description" id="description" rows="4" placeholder="Nhập mô tả...">{{ old('description') ?: $plan?->translation($currentLangCode)?->description }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label required" for="price">Giá</label>
                  <input type="number" step="0.01" min="0" class="form-control" name="price" value="{{ old('price') ?: $plan->price }}" id="price" placeholder="0.00" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required" for="storage_limit_mb">Dung lượng lưu trữ</label>
                    <input
                        type="text"
                        class="form-control bytes-mb"
                        name="storage_limit_mb"
                        id="storage_limit_mb"
                        value="{{ old('storage_limit_mb') ?: (int) ($plan->storage_limit / 1048576) }}"
                        placeholder="vd: 500mb | 2gb | 1.5tb"
                        required>
                    <div class="form-text hint-bytes" data-for="storage_limit_mb"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label required" for="file_size_limit_mb">Giới hạn kích thước file</label>
                    <input
                        type="text"
                        class="form-control bytes-mb"
                        name="file_size_limit_mb"
                        id="file_size_limit_mb"
                        value="{{ old('file_size_limit_mb') ?: (int) ($plan->file_size_limit / 1048576) }}"
                        placeholder="vd: 100mb | 1gb"
                        required>
                    <div class="form-text hint-bytes" data-for="file_size_limit_mb"></div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="file_keep_days">Số ngày giữ file</label>
                        <input type="number" min="0" class="form-control" name="file_keep_days" value="{{ old('file_keep_days') ?: $plan->file_keep_days }}" id="file_keep_days" placeholder="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="file_keep_forever" value="1" {{ old('file_keep_forever', $plan->file_keep_forever) ? 'checked' : '' }}>
                            <span class="form-check-label">Giữ file vĩnh viễn</span>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                  <label class="form-check">
                      <input class="form-check-input" type="checkbox" name="ads_reduced" value="1" {{ old('ads_reduced', $plan->ads_reduced) ? 'checked' : '' }}>
                      <span class="form-check-label">Giảm quảng cáo</span>
                  </label>
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
                  <input type="hidden" name="lang" value="{{ $currentLangCode }}">
                  <div class="btn-list">
                      <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                          Save
                      </button>

                      <button class="btn" type="submit" name="submitter" value="save">
                          Save &amp; Exit
                      </button>


                  </div>
              </div>
          </div>

          <div class="card meta-boxes mb-3">
              <div class="card-header">
                  <h4 class="card-title">
                      Ngôn ngữ
                  </h4>
              </div>

              <div class="card-body">
                  <div class="small text-muted">Chọn tab ở trên để chuyển đổi ngôn ngữ cần chỉnh sửa. Các trường chỉ dịch: Tên, Mô tả.</div>
                  <div class="mt-2 d-flex flex-wrap gap-2">
                      @foreach (Language::getSupportedLanguages() as $lng)
                          @php $has = $plan->hasTranslation($lng->code); @endphp
                          <a class="badge {{ $has ? 'bg-green-lt' : 'bg-secondary-lt' }} text-dark"
                             href="{{ route('admin.plans.edit', [$plan->id, 'ref_lang' => $lng->code]) }}">
                              <img src="{{ asset('backend/media/flags/' . $lng->flag . '.svg') }}" class="me-1" style="height:12px" alt="{{ $lng->name }} flag">{{ strtoupper($lng->code) }}
                          </a>
                      @endforeach
                  </div>
              </div>
          </div>

      </div>
  </div>

</form>
@endsection

@push('scripts')
<script>
(() => {
  const KB = 1024;
  const MB = KB * 1024;
  const GB = MB * 1024;
  const TB = GB * 1024;

  const num = v => Number.isFinite(v) ? v : 0;

  function formatNumber(n) {
    try { return new Intl.NumberFormat().format(n); } catch { return String(n); }
  }

  function formatBytes(bytes) {
    if (!bytes || bytes < KB) return `${formatNumber(num(bytes))} B`;
    if (bytes < MB) return `${(bytes/KB).toFixed(2)} KB`;
    if (bytes < GB) return `${(bytes/MB).toFixed(2)} MB`;
    if (bytes < TB) return `${(bytes/GB).toFixed(2)} GB`;
    return `${(bytes/TB).toFixed(2)} TB`;
  }

  // Parse chuỗi như: "1.5tb", "2 gb", "500mb", "1024", "1_024", "1,024"
  // Trả về MB (integer) để submit về server
  function parseToMB(input) {
    if (!input) return 0;

    let s = String(input).trim().toLowerCase();
    // chấp nhận 1_024 hoặc 1,024 hoặc 1 024
    s = s.replace(/[_\s,]/g, '');

    // nếu chỉ là số => hiểu là MB
    if (/^\d+(\.\d+)?$/.test(s)) {
      return Math.floor(parseFloat(s));
    }

    const m = s.match(/^(\d+(\.\d+)?)(kb|k|mb|m|gb|g|tb|t)$/i);
    if (!m) return NaN;

    const val = parseFloat(m[1]);
    const unit = m[3];

    if (unit === 'kb' || unit === 'k') return Math.floor((val * KB) / MB);
    if (unit === 'mb' || unit === 'm') return Math.floor(val);
    if (unit === 'gb' || unit === 'g') return Math.floor(val * 1024);
    if (unit === 'tb' || unit === 't') return Math.floor(val * 1024 * 1024);

    return NaN;
  }

  function mbToBytes(mb) {
    return num(mb) * MB;
  }

  function updateHint(input) {
    const id = input.id;
    const hint = document.querySelector(`.hint-bytes[data-for="${id}"]`);
    if (!hint) return;

    const raw = input.value;
    const parsedMB = parseToMB(raw);

    if (isNaN(parsedMB)) {
      hint.textContent = 'Giá trị không hợp lệ. Ví dụ: 500mb, 2gb, 1.5tb hoặc số MB thuần.';
      hint.classList.add('text-danger');
      return;
    }

    hint.classList.remove('text-danger');

    const bytes = mbToBytes(parsedMB);
    const pretty = formatBytes(bytes);

    // Hiển thị: ≈ 1.50 GB (1,536 MB) • 1,649,267,441 B
    hint.textContent = `≈ ${pretty} (${formatNumber(parsedMB)} MB) • ${formatNumber(bytes)} B`;
  }

  function normalizeOnBlur(input) {
    const parsedMB = parseToMB(input.value);
    if (!isNaN(parsedMB)) {
      // Chuẩn hóa lại input về MB thuần để POST lên server
      input.value = String(parsedMB);
    }
  }

  // Gắn sự kiện
  document.querySelectorAll('.bytes-mb').forEach(el => {
    updateHint(el); // render hint lần đầu từ value hiện có
    el.addEventListener('input', () => updateHint(el));
    el.addEventListener('blur', () => {
      normalizeOnBlur(el);
      updateHint(el);
    });
  });

  // Trước khi submit, đảm bảo tất cả về MB số nguyên
  const form = document.querySelector('form[action*="admin/plans"]');
  if (form) {
    form.addEventListener('submit', () => {
      document.querySelectorAll('.bytes-mb').forEach(el => {
        const parsedMB = parseToMB(el.value);
        el.value = isNaN(parsedMB) ? '' : String(parsedMB);
      });
    });
  }
})();
</script>

@endpush
