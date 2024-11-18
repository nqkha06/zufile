
@extends('layouts.admin')
@section('title', __('Cấu hình pageload: '. $level->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.levels.editPageload', $level) }}
@endsection

@section('content')

<form class="card rounded-3" action="{{ route('admin.levels.updatePageload', $level->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-body">
        <div id="config-container">
            @php
                $configs = json_decode($level->pageload_config) ?? [];
            @endphp
            @forelse ($configs as $config)
                @include('backend.tabler.level.components.pageload_form', ['config' => $config])
            @empty
                @include('backend.tabler.level.components.pageload_form')
            @endforelse
        </div>
        <button id="add-config" type="button" class="btn btn-success">Thêm config</button>
    </div>
    <div class="card-footer">
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
</form>

<script>
    const configTemplate = `@include('backend.tabler.level.components.pageload_form', ['config' => []])`;

    document.getElementById('add-config').addEventListener('click', function() {
        const newConfigForm = document.createElement('div');
        newConfigForm.innerHTML = configTemplate;
        document.getElementById('config-container').appendChild(newConfigForm.firstElementChild);
    });

    function removeConfig(button) {
        const configForms = document.querySelectorAll('.config-form');
        if (configForms.length > 1) {
            button.closest('.config-form').remove();
        } else {
            alert('Không thể xóa form cuối cùng.');
        }
    }
</script>

@endsection