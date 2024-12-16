<div class="config-form row">
    <div class="col-12 col-md-6 mb-3">
        <div class="form-label">Kích hoạt</div>
        <label class="form-check form-switch">
            <input class="form-check-input" name="active[]" type="checkbox" {{ $config->active ?? false ? 'checked' : '' }}>
            <span class="form-check-label">Bật/ tắt</span>
        </label>
    </div>
    <div class="col-12 col-md-6 mb-3 text-end">
        <button class="btn btn-danger" type="button" onclick="removeConfig(this)">XOÁ</button>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <div class="form-label">Axaj</div>
        <label class="form-check form-switch">
            <input class="form-check-input" name="axaj[]" type="checkbox" {{ $config->axaj ?? false ? 'checked' : '' }}>
            <span class="form-check-label">Bật/ tắt</span>
        </label>
    </div>
    @php
        $fields = [
            'country' => 'Áp dụng cho Quốc gia',
            'block_country' => 'Ngoại trừ Quốc gia',
            'device' => 'Áp dụng cho thiết bị',
            'block_device' => 'Ngoại trừ thiết bị',
            'os' => 'Áp dụng cho HĐH',
            'block_os' => 'Ngoại trừ HĐH',
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