@php
    $fields = $data['fields'];
    $key_name = $data['key_name'];
    $value_old = isset($value_old) && !empty($value_old) ? $value_old : [];

    $checkRequired = function ($field) {
        return isset($field['required']) && $field['required'];
    };

    $checkValue = function ($field) use ($value_old) {
        return isset($value_old->$field) && !empty($value_old->$field) ? $value_old->$field : '';
    };
@endphp

<div class="row">
    <div class="col-6 col-md-6 mb-3">
        <div class="form-label">Kích hoạt</div>
        <label class="form-check form-switch">
            <input class="form-check-input" name="{{ $key_name }}[active][]" type="checkbox"
                {{ !empty($checkValue('active')) ? 'checked' : '' }}>
            <span class="form-check-label">Bật/ tắt</span>
        </label>
    </div>
    <div class="col-6 col-md-6 mb-3 text-end">
        <button type="button" class="btn btn-danger remove-config">Xoá</button>
    </div>
    @foreach ($fields as $field)
        @php
            $isRequired = $checkRequired($field);
            $fieldName = $key_name . $field['name'];
            $fieldValue = $checkValue($field['name']) ?? '';
        @endphp

        @if ($field['type'] === 'text')
            <div class="col-12 col-md-6 mb-3">
                <label
                    class="form-label @if ($isRequired) required @endif">{{ $field['label'] }}</label>
                <input type="text" class="form-control" name="{{ $fieldName }}" value="{{ $fieldValue }}"
                    @if ($isRequired) required @endif>
            </div>
        @elseif ($field['type'] === 'textarea')
            <div class="col-12 mb-3">
                <label
                    class="form-label @if ($isRequired) required @endif">{{ $field['label'] }}</label>
                <textarea class="form-control" name="{{ $fieldName }}" @if ($isRequired) required @endif>{{ $fieldValue }}</textarea>
            </div>
        @elseif ($field['type'] === 'time')
            <div class="col-12 mb-3">
                <label
                    class="form-label @if ($isRequired) required @endif">{{ $field['label'] }}</label>
                <input type="time" class="form-control" name="{{ $fieldName }}" value="{{ $fieldValue }}"
                    @if ($isRequired) required @endif>
            </div>
        @elseif ($field['type'] === 'select')
            <div class="col-12 col-md-6 mb-3">
                <label
                    class="form-label @if ($isRequired) required @endif">{{ $field['label'] }}</label>
                <select type="select" class="form-select" name="{{ $fieldName }}" value="{{ $fieldValue }}"
                    @if ($isRequired) required @endif>
                    @foreach ($field['options'] as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    @endforeach

</div>
