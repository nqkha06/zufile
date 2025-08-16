@extends('layouts.admin')
@section('title', __('Plans'))

@section('content')
<div class="row">
    <div class="col-12 col-md-4">
        <form class="card" action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Thêm mới gói</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required" for="name">Tên gói</label>
                <input class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Nhập tên gói..." required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="description">Mô tả</label>
                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Nhập mô tả gói...">{{ old('description') }}</textarea>
              </div>
              <!-- Language picker for initial translation -->
              <div class="mb-3">
                <label class="form-label required" for="lang">Ngôn ngữ</label>
                <select class="form-select" name="lang" id="lang">
                    @foreach (Language::getSupportedLanguages() as $lng)
                        <option value="{{ $lng->code }}" {{ old('lang', config('app.DEFAULT_LANG_ADMIN')) === $lng->code ? 'selected' : '' }}>
                            {{ $lng->name }}
                        </option>
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label required" for="price">Giá (VND/USD)</label>
                <input type="number" step="0.01" min="0" class="form-control" name="price" value="{{ old('price') }}" id="price" placeholder="0.00" required>
              </div>
              <div class="mb-3">
                <label class="form-label required" for="storage_limit_mb">Dung lượng lưu trữ (MB)</label>
                <input type="number" min="0" class="form-control" name="storage_limit_mb" value="{{ old('storage_limit_mb') }}" id="storage_limit_mb" placeholder="Ví dụ: 10240" required>
              </div>
              <div class="mb-3">
                <label class="form-label required" for="file_size_limit_mb">Giới hạn kích thước file (MB)</label>
                <input type="number" min="0" class="form-control" name="file_size_limit_mb" value="{{ old('file_size_limit_mb') }}" id="file_size_limit_mb" placeholder="Ví dụ: 1024" required>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="file_keep_days">Số ngày giữ file</label>
                    <input type="number" min="0" class="form-control" name="file_keep_days" value="{{ old('file_keep_days') }}" id="file_keep_days" placeholder="0">
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" name="file_keep_forever" value="1" {{ old('file_keep_forever') ? 'checked' : '' }}>
                        <span class="form-check-label">Giữ file vĩnh viễn</span>
                    </label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" name="ads_reduced" value="1" {{ old('ads_reduced') ? 'checked' : '' }}>
                    <span class="form-check-label">Giảm quảng cáo</span>
                </label>
              </div>
            </div>
            <div class="card-footer text-end">
              <input value="Thêm gói" type="submit" class="btn btn-primary">
            </div>
        </form>
      </div>
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Quản lý gói</h3>
            <div class="text-nowrap language-header text-center sorting_disabled">
                @foreach (Language::getSupportedLanguages() as $lang)
                    <img src="{{ asset('backend/media/flags/' . $lang->flag . '.svg') }}" title="{{ $lang->name }}"
                        class="flag" style="height: 16px" loading="lazy" alt="{{ $lang->name }} flag">
                @endforeach
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
              <thead>
                <tr>
                  <th>Tên</th>
                  <th>Giá</th>
                  <th>Lưu trữ</th>
                  <th>Kích thước file</th>
                  <th>Giữ file</th>
                  <th>Giảm QC</th>
                  <th>Người dùng</th>
                  <th class="text-nowrap text-center">Ngôn ngữ</th>
                  <th class="w-1"></th>
                </tr>
              </thead>
              <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ number_format($plan->price, 2) }}</td>
                        <td>{{ $plan->formatted_storage_limit }}</td>
                        <td>{{ $plan->formatted_file_size_limit }}</td>
                        <td>
                            @if($plan->file_keep_forever)
                                Vĩnh viễn
                            @else
                                {{ $plan->file_keep_days }} ngày
                            @endif
                        </td>
                        <td>{{ $plan->ads_reduced ? 'Có' : 'Không' }}</td>
                        <td>{{ $plan->active_users_count }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                @foreach (Language::getSupportedLanguages() as $lang)
                                    @php $has = $plan->hasTranslation($lang->code); @endphp
                                    <a
                                        href="{{ route('admin.plans.edit', [$plan->id, 'ref_lang' => $lang->code]) }}"
                                        class="badge {{ $has ? 'bg-green-lt' : 'bg-secondary-lt' }} text-dark"
                                        data-bs-toggle="tooltip"
                                        title="{{ $has ? __('Sửa bản dịch :lang', ['lang' => $lang->name]) : __('Thêm bản dịch :lang', ['lang' => $lang->name]) }}">
                                        <img src="{{ asset('backend/media/flags/' . $lang->flag . '.svg') }}" class="me-1" style="height: 12px" alt="{{ $lang->name }} flag">
                                        {{ strtoupper($lang->code) }}
                                        @if($has)
                                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        @else
                                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5v14"></path>
                                                <path d="M5 12h14"></path>
                                            </svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </td>
                        <td style="white-space: nowrap">
                            <div class="btn-list flex-nowrap">
                                <a class="btn btn-primary" href="{{ route('admin.plans.edit', $plan->id) }}">Edit</a>
                                <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red" type="button" onclick="confirm('{{ __('Bạn chắc chắn sẽ xoá nó chứ?') }}') ? this.closest('form').submit() : ''">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {{ $plans->links('pagination.tabler') }}
          </div>
        </div>
      </div>
</div>
@endsection
