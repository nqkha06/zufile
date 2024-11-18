<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <div class="form-label">Kích hoạt</div>
        <label class="form-check form-switch">
            <input class="form-check-input" name="active[]" type="checkbox" {{ $config->active ?? false ? 'checked' : '' }}>
            <span class="form-check-label">Bật/ tắt</span>
        </label>
    </div>
    <div class="col-12 col-md-6 mb-3 text-end">
        <button class="btn btn-danger remove-config">XOÁ</button>
    </div>
    @php
        $fields = [
            'direct_country' => 'Áp dụng cho Quốc gia',
            'direct_block_country' => 'Ngoại trừ Quốc gia',
            'direct_device' => 'Áp dụng cho thiết bị',
            'direct_block_device' => 'Ngoại trừ thiết bị',
            'direct_os' => 'Áp dụng cho HĐH',
            'direct_block_os' => 'Ngoại trừ HĐH',
            'direct_browser' => 'Áp dụng cho Browser',
            'direct_block_browser' => 'Ngoại trừ Browser',
            'direct_timer' => 'Thời gian',
            'direct_page_appear' => 'Vị trí trang',
        ];
    @endphp
    @foreach ($fields as $field => $label)
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label required">{{ $label }}</label>
            <input class="form-control" name="{{ $field }}[]" value="{{ $config->$field ?? '' }}" required>
        </div>
    @endforeach
    <div class="mb-3 col-12">
        <label class="form-label required">Liên kết</label>
        <textarea class="form-control" name="link[]" style="min-height: 300px" required>{{ $config->link ?? '' }}</textarea>
    </div>
</div>