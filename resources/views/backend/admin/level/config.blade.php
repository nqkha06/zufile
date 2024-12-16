@extends('layouts.admin')
@section('title', __('Cấu hình cấp độ: ' . $level->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.levels.editConfig', $level) }}
@endsection

@section('content')
    @php
        $tabConfigs = [
            'direct' => [
                'title' => 'AD Trực tiếp',
                'key_name' => 'direct',
                'fields' => [
                    ['label' => 'Timer', 'name' => '[confs][timer]', 'type' => 'text', 'required' => true],
                    ['label' => 'Xuất hiện', 'name' => '[confs][page_appear]', 'type' => 'text', 'required' => true],
                    ['label' => 'Liên kết', 'name' => '[confs][link]', 'type' => 'textarea', 'required' => true],
                ],
            ],
            'banner' => [
                'title' => 'AD Biêu Ngữ',
                'key_name' => 'banner',
                'fields' => [
                    ['label' => 'Phần tử', 'name' => '[confs][select]', 'type' => 'text', 'required' => true],
                    ['label' => 'Xuất hiện ở trang', 'name' => '[confs][page_appear]', 'type' => 'text', 'required' => true],

                    ['label' => 'HTML', 'name' => '[confs][html]', 'type' => 'textarea'],
                ],
            ],
            'step' => [
                'title' => 'AD Bước Thêm',
                'key_name' => 'step',

                'fields' => [
                    [
                        'label' => 'Vị trí',
                        'name' => '[confs][position]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => '[confs][page_appear]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => '[confs][icon]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true
                    ],
                    ['label' => 'Tên', 'name' => '[confs][name]', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => '[confs][type]', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => '[confs][appr_rate]', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => '[confs][exist_time]', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => '[confs][click_limit]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => '[confs][reset_time]',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'label' => 'Liên kết',
                        'name' => '[confs][links]',
                        'type' => 'text',
                        'required' => true,
                    ],
                ],
            ],
            'click' => [
                'title' => 'AD Bấm',
                'key_name' => 'click',
                'fields' => [
                    [
                        'label' => 'Vị trí',
                        'name' => '[confs][position]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => '[confs][page_appear]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => '[confs][icon]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true
                    ],
                    ['label' => 'Tên', 'name' => '[confs][name]', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => '[confs][select]', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => '[confs][appr_rate]', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => '[confs][exist_time]', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => '[confs][click_limit]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => '[confs][reset_time]',
                        'type' => 'text',
                        'required' => true,
                    ],
                ],
            ],
            'click2' => [
                'title' => 'AD Click 2',
                'key_name' => 'click2',

                'fields' => [
                    [
                        'label' => 'Vị trí',
                        'name' => '[confs][position]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => '[confs][page_appear]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => '[confs][icon]',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true
                    ],
                    ['label' => 'Tên', 'name' => '[confs][name]', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => '[confs][type]', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => '[confs][appr_rate]', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => '[confs][exist_time]', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => '[confs][click_limit]', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => '[confs][reset_time]',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'label' => 'Liên kết',
                        'name' => '[confs][links]',
                        'type' => 'text',
                        'required' => true,
                    ],
                ],
            ],
            'next' => [
                'title' => 'AD Bước Tiếp Theo',
                'key_name' => 'next',
                'fields' => [['label' => 'Liên kết', 'name' => '[confs][link]', 'type' => 'textarea']],
            ],
            'verify' => [
                'title' => 'Verify',
                'key_name' => 'verify',
                'fields' => [
                    [
                        'label' => 'Đếm ngược',
                        'name' => '[confs][timer]',
                        'type' => 'text',
                        'required' => true
                    ],
                    [
                        'label' => 'Liên kết',
                        'name' => '[confs][links]',
                        'type' => 'text',
                        'required' => true,
                    ]
               
                ],
            ],
            'setting' => [
                'title' => 'Cài Đặt Chung',
                'key_name' => 'setting',

                'fields' => [['label' => 'Tổng trang', 'name' => '[confs][total_page]', 'type' => 'text', 'required' => true]],
            ],
        ];
    @endphp

    <form action="{{ route('admin.levels.updateConfig', $level->id) }}" method="POST">
        
        @csrf
        @method('PUT')

        
        <div class="row">

        <div class="gap-3 col-md-9">
            <div class="card mb-5">
                <div class="card-body">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        @foreach ($tabConfigs as $key => $config)
                            <li class="nav-item">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#{{ $key }}"
                                    type="button">{{ $config['title'] }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card">

                {{-- <div class="card-body p-0"> --}}
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($tabConfigs as $key => $config)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}"
                                aria-labelledby="{{ $key }}-tab">
                                @php
                                    $data_config = isset($level->config) ? json_decode($level->config) : [];
                                @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <div id="{{ $key }}-configs"></div>
                                    </div>
                                    <div class="card-footer">
                                        <button count="0" id="add-{{ $key }}-config" class="btn" type="button">
                                                            <svg class="icon icon-left svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M12 5l0 14"></path>
                                      <path d="M5 12l14 0"></path>
                                    </svg>            
                                    Thêm cấu hình mới
                                                
                                            </button>
                                    </div>
                                </div>
                               
                            </div>
                        @endforeach
                    {{-- </div> --}}
    
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
                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            Save

                        </button>

                        <button class="btn" type="submit" name="submitter" value="save">
                            <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                            </path>
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Save

                                    </button>

                                    <button class="btn" type="submit" name="submitter" value="save">
                                        <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        </div>

        
    </div>
    </form>

    <script>
        const dataConfig = @json(json_decode($level->config));
        const tabConfigs = @json($tabConfigs);

        document.addEventListener('DOMContentLoaded', function() {
            const configTypes = ['direct', 'banner', 'next', 'step', 'click', 'click2', 'verify', 'setting'];

            configTypes.forEach(type => {
                const addButton = document.getElementById(`add-${type}-config`);
                const configContainer = document.getElementById(`${type}-configs`);

                if (addButton && configContainer) {
                    addButton.setAttribute('count', dataConfig[type]?.length ?? 0);

                    addButton.addEventListener('click', function() {
                        const countConfig = this.getAttribute('count');
                        addConfig(type, configContainer, countConfig);
                        this.setAttribute('count', parseInt(countConfig) + 1);
                    });

                    configContainer.setAttribute('data-key', type);

                    // Load lại dữ liệu cũ
                    if (dataConfig && dataConfig[type]) {
                        dataConfig[type].forEach((config, index) => {
                            addConfig(type, configContainer, index); // Thêm cấu hình
                            const configElement = document.getElementById(
                            `${type}-config-${index}`);

                            // Duyệt qua các trường đã lưu
                            Object.keys(config.confs).forEach(confKey => {
                                const input = configElement.querySelector(
                                    `[name="${type}[${index}][confs][${confKey}]"]`);
                                if (input) input.value = config.confs[
                                confKey]; // Gán giá trị cho các trường
                            });

                            // Duyệt qua các điều kiện đã lưu
                            if (config.conds) {
                                const conds = config.conds; // Lưu đối tượng conds
                                const countConditions = conds.val
                                .length; // Số lượng điều kiện dựa trên mảng val

                                for (let i = 0; i < countConditions; i++) {
                                    addCondition(configElement.querySelector(`.${type}-add-cond`),
                                        type, i); // Thêm điều kiện
                                    const conditionElement = document.getElementById(
                                        `${type}-cond-${i}`);

                                    conditionElement.querySelector(
                                            `[name="${type}[${index}][conds][cond][]"]`).value =
                                        conds.cond[i];
                                    conditionElement.querySelector(
                                            `[name="${type}[${index}][conds][type][]"]`).value =
                                        conds.type[i];
                                    conditionElement.querySelector(
                                            `[name="${type}[${index}][conds][val][]"]`).value =
                                        conds.val[i];
                                }
                            }
                        });
                    }
                }
            });
        });

        function renderConfig(type, count) {
            if (!tabConfigs[type]) return '';

            const fields = tabConfigs[type].fields;

            let html = `<div class="hr-text my-3">Cấu hình ${count}</div>
            <div class="px-4">
        <div class="confs mb-3 row">`;
            html += `<div class="row mb-3">
                <div class="col-11">
                    <label class="form-label required" for="" >Kích hoạt</label>
                    <select name="${type}[${count}][confs][active]" class="form-select" required="">
                        <option value="" hidden="">[--Chọn--]</option>
                        <option value="false">Tắt</option>
                        <option value="true">Bật</option>
                    </select>
                </div>
                <div class="col-1 d-flex align-items-end">
                    <button data-parent="${type}-config-${count}" type="button" class="btn w-100 btn-danger btn-icon remove-config">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </button>
                </div>
            </div>`;

            fields.forEach(e => {
                html += `
            <div class="col-6 mb-3">
                <label for="${type}[${count}]${e.name}" class="form-label required">${e.label}</label>
                ${e.type === 'textarea' 
                    ? `<textarea id="${type}[${count}]${e.name}" name="${type}[${count}]${e.name}" class="form-control"></textarea>` 
                    : `<input type="${e.type}" id="${type}[${count}]${e.name}" name="${type}[${count}]${e.name}" class="form-control"/>`}
            </div>
        `;
            });
            
            html += `</div>
        <div class="conds mb-3" id="${type}-conds-${count}"></div>
        <div class="mb-3">
            <button class="btn btn-primary ${type}-add-cond" count-condition="${(dataConfig[type] && dataConfig[type][count] && dataConfig[type][count].conds && dataConfig[type][count].conds.val ? dataConfig[type][count].conds.val.length : 0)
}" data-index="${count}" parent-id="${type}-conds-${count}">Thêm điều kiện</button>
        </div></div>`;

            return html;
        }

        function addConfig(type, container, countConfig) {
            const cnt = countConfig;
            const newConfig = document.createElement('div');

            newConfig.id = type + '-config-' + cnt;
            newConfig.className = type + '-config row';

            newConfig.innerHTML = renderConfig(type, cnt);
            container.appendChild(newConfig);

            newConfig.querySelector('.remove-config').addEventListener('click', () => removeConfig(type, container,
                newConfig.querySelector('.remove-config')));

            newConfig.querySelector(`.${type}-add-cond`).addEventListener('click', function(event) {
                event.preventDefault();

                let countCondition = this.getAttribute('count-condition');
                addCondition(this, type, countCondition);

                this.setAttribute('count-condition', ++countCondition);
            });
        }

        function removeConfig(type, container, button) {
            if (container.children.length > 1) {
                container.removeChild(button.closest(`.${type}-config`));
            } else {
                alert('Phải tối thiểu 1 cấu hình');
            }
        }

        function addCondition(button, type, cntCond) {
            const parentId = button.getAttribute('parent-id');
            const index = button.getAttribute('data-index');
            const group = document.getElementById(parentId);
            let html = `
        <div class="cond" id="${type}-cond-${cntCond}">
            <div class="hr-text text-red">Điều kiện ${cntCond}</div>
            <div class="row mb-3">
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="">Điều kiện</label>
                            <select name="${type}[${index}][conds][cond][]" class="form-select" required>
                                <option value="" hidden>[--Chọn--]</option>
                                <option value="website">Website</option>
                                <option value="country">Quốc gia</option>
                                <option value="device">Thiết bị</option>
                                <option value="operating_system">Hệ điều hành</option>
                                <option value="time">Thời gian</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Loại điều kiện</label>
                            <select name="${type}[${index}][conds][type][]" class="form-select" required>
                                <option value="" hidden>[--Chọn--]</option>
                                <option value="only">Only</option>
                                <option value="block">Block</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn w-100 btn-danger btn-icon remove-cond" data-parent="${type}-cond-${cntCond}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá trị điều kiện</label>
                <input type="text" name="${type}[${index}][conds][val][]" class="form-control" required />
            </div>
        </div>
    `;

            const newCond = document.createElement('div');
            newCond.innerHTML = html;
            group.appendChild(newCond);

            // Xử lý khi nhấn nút xóa điều kiện
            newCond.querySelector('.remove-cond').addEventListener('click', function() {
                group.removeChild(newCond);
            });
        }
    </script>
@endsection
