@extends('layouts.admin')

@section('title', __('Cấu hình cấp độ: ' . $level->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.levels.editConfig', $level) }}
@endsection

@section('content')
    @php
        // Định nghĩa các tab cấu hình
        $tabConfigs = [
            'direct' => [
                'title' => 'DirectLink Ad',
                'key_name' => 'direct',
                'fields' => [
                    ['label' => 'Timer', 'name' => 'timer', 'type' => 'text', 'required' => true],
                    ['label' => 'Xuất hiện', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    ['label' => 'Liên kết', 'name' => 'link', 'type' => 'textarea', 'required' => true],
                ],
                'config_select_type' => [
                    'random', 'first'
                ]
            ],
            'popunder' => [
                'title' => 'DirectLink Ad (Mobile only)',
                'key_name' => 'direct',
                'fields' => [
                    ['label' => 'Xuất hiện', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    ['label' => 'Liên kết', 'name' => 'link', 'type' => 'textarea', 'required' => true],
                ],
                'config_select_type' => [
                    'random', 'first'
                ]
            ],
            'banner' => [
                'title' => 'AD Biểu Ngữ',
                'key_name' => 'banner',
                'fields' => [
                    ['label' => 'Phần tử', 'name' => 'select', 'type' => 'text', 'required' => true],
                    ['label' => 'Xuất hiện ở trang', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    ['label' => 'HTML', 'name' => 'html', 'type' => 'textarea', 'required' => false],
                ],
            ],
            'step' => [
                'title' => 'AD Bước Thêm',
                'key_name' => 'step',
                'fields' => [
                    [
                        'label' => 'Vị trí',
                        'name' => 'position',
                        'type' => 'select',
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true,
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => 'icon',
                        'type' => 'select',
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true,
                    ],
                    ['label' => 'Tên', 'name' => 'name', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => 'type', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => 'appr_rate', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => 'exist_time', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => 'click_limit', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => 'reset_time',
                        'type' => 'text',
                        'required' => true,
                    ],
                    ['label' => 'Liên kết', 'name' => 'links', 'type' => 'text', 'required' => true],
                ],
            ],
            'click' => [
                'title' => 'AD Bấm',
                'key_name' => 'click',
                'fields' => [
                    [
                        'label' => 'Vị trí',
                        'name' => 'position',
                        'type' => 'select',
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true,
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => 'icon',
                        'type' => 'select',
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true,
                    ],
                    ['label' => 'Tên', 'name' => 'name', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => 'select', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => 'appr_rate', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => 'exist_time', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => 'click_limit', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => 'reset_time',
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
                        'name' => 'position',
                        'type' => 'select',
                        'options' => ['first' => 'Đầu', 'last' => 'Cuối'],
                        'required' => true,
                    ],
                    ['label' => 'Xuất hiện ở trang', 'name' => 'page_appear', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Biểu tượng',
                        'name' => 'icon',
                        'type' => 'select',
                        'options' => ['ad' => 'Ad', 'ytb' => 'YouTube'],
                        'required' => true,
                    ],
                    ['label' => 'Tên', 'name' => 'name', 'type' => 'text', 'required' => true],
                    ['label' => 'Phần tử', 'name' => 'type', 'type' => 'text', 'required' => true],
                    ['label' => 'Tỉ lệ xuất hiện', 'name' => 'appr_rate', 'type' => 'text', 'required' => true],
                    ['label' => 'Thời gian tồn tại', 'name' => 'exist_time', 'type' => 'text', 'required' => true],
                    ['label' => 'Lượt nhấp tối đa', 'name' => 'click_limit', 'type' => 'text', 'required' => true],
                    [
                        'label' => 'Thời gian reset lượt nhấp',
                        'name' => 'reset_time',
                        'type' => 'text',
                        'required' => true,
                    ],
                    ['label' => 'Liên kết', 'name' => 'links', 'type' => 'text', 'required' => true],
                ],
            ],
            'next' => [
                'title' => 'AD Bước Tiếp Theo',
                'key_name' => 'next',
                'fields' => [['label' => 'Liên kết', 'name' => 'links', 'type' => 'textarea', 'required' => true]],
            ],
            'verify' => [
                'title' => 'Verify',
                'key_name' => 'verify',
                'fields' => [
                    ['label' => 'Đếm ngược', 'name' => 'timer', 'type' => 'text', 'required' => true],
                    ['label' => 'Liên kết', 'name' => 'links', 'type' => 'text', 'required' => true],
                ],
            ],
            'setting' => [
                'title' => 'Cài Đặt Chung',
                'key_name' => 'setting',
                'fields' => [['label' => 'Tổng trang', 'name' => 'total_page', 'type' => 'text', 'required' => true]],
            ],
        ];

        // Giải mã cấu hình hiện tại của cấp độ
        $dataConfig = isset($level->config) ? json_decode($level->config, true) : [];
    @endphp

    <form action="{{ route('admin.levels.updateConfig', $level->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Phần nội dung chính -->
            <div class="col-md-9 gap-3">
                <!-- Tabs Navigation -->
                <div class="card mb-5">
                    <div class="card-body">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            @foreach ($tabConfigs as $key => $config)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab"
                                        data-bs-toggle="pill" data-bs-target="#{{ $key }}" type="button"
                                        role="tab">{{ $config['title'] }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Tabs Content -->
                <div class="card mb-5">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($tabConfigs as $key => $config)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}"
                                aria-labelledby="{{ $key }}-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="{{ $key }}-configs">
                                            {{-- Các cấu hình sẽ được thêm vào đây bởi JavaScript --}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" id="add-{{ $key }}-config" class="btn btn-primary">
                                            <svg class="icon icon-left svg-icon-ti-ti-plus"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 5v14M5 12h14"></path>
                                            </svg>
                                            Thêm cấu hình mới
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Phần sidebar -->
            <div class="col-md-3 gap-3 d-flex flex-column mb-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Publish</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" name="submitter" value="apply">
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2v-12a2 2 0 0 1 2-2z"></path>
                                    <circle cx="12" cy="16" r="2"></circle>
                                    <path d="M14 4v4l-6 0v-4z"></path>
                                </svg>
                                Save
                            </button>

                            <button class="btn btn-secondary" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 18v3h16v-14l-8-4-8 4v3"></path>
                                    <path d="M4 14h9"></path>
                                    <path d="M10 11l3 3-3 3"></path>
                                </svg>
                                Save &amp; Exit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Header fixed khi cuộn trang (ẩn mặc định) -->
                <header class="top-0 w-100 position-fixed end-0 z-1000 d-none" id="form-actions">
                    <div class="navbar">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center w-100">
                                <div class="col">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb"></ol>
                                    </nav>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit" name="submitter" value="apply">
                                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2v-12a2 2 0 0 1 2-2z">
                                                </path>
                                                <circle cx="12" cy="16" r="2"></circle>
                                                <path d="M14 4v4l-6 0v-4z"></path>
                                            </svg>
                                            Save
                                        </button>

                                        <button class="btn btn-secondary" type="submit" name="submitter" value="save">
                                            <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 18v3h16v-14l-8-4-8 4v3"></path>
                                                <path d="M4 14h9"></path>
                                                <path d="M10 11l3 3-3 3"></path>
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
        // Chuyển dữ liệu cấu hình từ PHP sang JavaScript
        const dataConfig = @json($dataConfig);
        const tabConfigs = @json($tabConfigs);

        document.addEventListener('DOMContentLoaded', function() {
            Object.keys(tabConfigs).forEach(type => {
                const addButton = document.getElementById(`add-${type}-config`);
                const configContainer = document.getElementById(`${type}-configs`);

                if (addButton && configContainer) {
                    // Khởi tạo số lượng cấu hình hiện tại
                    let configCount = dataConfig[type]?.length || 0;
                    addButton.setAttribute('data-count', configCount);

                    // Thêm cấu hình mới khi nhấn nút
                    addButton.addEventListener('click', function() {
                        const count = parseInt(this.getAttribute('data-count'));
                        addConfig(type, configContainer, count);
                        this.setAttribute('data-count', count + 1);
                    });

                    // Tải các cấu hình đã lưu
                    if (dataConfig[type]) {
                        dataConfig[type].forEach((config, index) => {
                            addConfig(type, configContainer, index, config);
                        });
                    }
                }
            });
        });

        /**
         * Thêm một cấu hình mới vào container
         * @param {string} type - Loại cấu hình
         * @param {HTMLElement} container - Container chứa cấu hình
         * @param {number} count - Số thứ tự cấu hình
         * @param {object} config - Dữ liệu cấu hình (tuỳ chọn)
         */
        function addConfig(type, container, count, config = {}) {
            const configDiv = document.createElement('div');
            configDiv.id = `${type}-config-${count}`;
            configDiv.className = `${type}-config mb-4`;

            // Tạo nội dung cấu hình
            configDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Cấu hình ${count + 1}</h4>
                        <button class="btn btn-icon remove-config mb-3 text-danger" type="button">
                                <svg class="icon icon-left svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7l16 0"></path>
                                    <path d="M10 11l0 6"></path>
                                    <path d="M14 11l0 6"></path>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>            
                        </button>
                    
                </div>
                <div class="row">
                    ${renderFields(type, count, config.confs)}
                </div>
                <div class="conds mb-3">
                    <h5>Điều kiện</h5>
                    <div id="${type}-conds-${count}" class="mb-3">
                        <!-- Các điều kiện sẽ được thêm vào đây -->
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm add-cond" data-type="${type}" data-count="${count}">
                        Thêm điều kiện
                    </button>
                </div>
            `;

            container.appendChild(configDiv);

            // Thêm sự kiện xóa cấu hình
            configDiv.querySelector('.remove-config').addEventListener('click', () => {
                container.removeChild(configDiv);

                // if (container.children.length > 1) {
                //     container.removeChild(configDiv);
                // } else {
                //     alert('Phải tối thiểu 1 cấu hình');
                // }
            });

            // Thêm sự kiện thêm điều kiện
            configDiv.querySelector('.add-cond').addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const count = this.getAttribute('data-count');
                const condContainer = document.getElementById(`${type}-conds-${count}`);
                const condCount = condContainer.children.length;
                addCondition(type, count, condContainer, condCount);
            });

            // Nếu có dữ liệu cấu hình, điền vào các trường
            if (config.confs) {
                Object.entries(config.confs).forEach(([key, value]) => {
                    const input = configDiv.querySelector(`[name="${type}[${count}][confs][${key}]"]`);
                    if (input) {
                        if (input.tagName.toLowerCase() === 'select') {
                            input.value = value;
                        } else {
                            input.value = value;
                        }
                    }
                });
            }

            // Nếu có điều kiện, thêm các điều kiện đã lưu
            if (config.conds && typeof config.conds === 'object') {
                const conds = config.conds;
                if (Array.isArray(conds.cond) && conds.cond.length > 0) {
                    conds.cond.forEach((cond, idx) => {
                        addCondition(type, count, document.getElementById(`${type}-conds-${count}`), idx, {
                            cond: conds.cond[idx],
                            type: conds.type[idx],
                            val: conds.val[idx]
                        });
                    });
                }
            }
        }

        /**
         * Render các trường form dựa trên cấu hình tab
         * @param {string} type - Loại cấu hình
         * @param {number} count - Số thứ tự cấu hình
         * @param {object} confs - Dữ liệu cấu hình (tuỳ chọn)
         * @returns {string} - HTML các trường form
         */
        function renderFields(type, count, confs = {}) {
            let fieldsHtml = '';
            const fields = tabConfigs[type].fields;

            fields.forEach(field => {
                const fieldName = `${type}[${count}][confs][${field.name}]`;
                const fieldId = `${type}_${count}_${field.name}`;
                const isRequired = field.required ? 'required' : '';
                const fieldValue = confs[field.name] ?? '';

                fieldsHtml += `
                    <div class="col-md-6 mb-3">
                        <label for="${fieldId}" class="form-label ${field.required ? 'required' : ''}">${field.label}</label>
                        ${field.type === 'textarea' ? `
                                <textarea id="${fieldId}" name="${fieldName}" class="form-control" ${isRequired}>${fieldValue}</textarea>
                            ` : field.type === 'select' ? `
                                <select id="${fieldId}" name="${fieldName}" class="form-select" ${isRequired}>
                                    <option value="" hidden>[--Chọn--]</option>
                                    ${Object.entries(field.options).map(([value, label]) => `
                                    <option value="${value}" ${fieldValue == value ? 'selected' : ''}>${label}</option>
                                `).join('')}
                                </select>
                            ` : `
                                <input type="${field.type}" id="${fieldId}" name="${fieldName}" class="form-control" value="${fieldValue}" ${isRequired}>
                            `}
                    </div>
                `;
            });

            return fieldsHtml;
        }

        /**
         * Thêm một điều kiện vào cấu hình
         * @param {string} type - Loại cấu hình
         * @param {number} configCount - Số thứ tự cấu hình
         * @param {HTMLElement} container - Container chứa điều kiện
         * @param {number} condCount - Số thứ tự điều kiện
         * @param {object} cond - Dữ liệu điều kiện (tuỳ chọn)
         */
        function addCondition(type, configCount, container, condCount, cond = {}) {
            const condDiv = document.createElement('div');
            condDiv.className = 'mb-3';
            condDiv.innerHTML = `

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Điều kiện ${condCount + 1}</h5>
                        <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill remove-cond" type="button">
                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18 6l-12 12"></path>
                                <path d="M6 6l12 12"></path>
                            </svg>            
    
                        </button>
                
                </div>
                <div class="row mb-2">
                    <div class="col-auto w-50 w-sm-auto">
                        <div class="mb-3 position-relative">
                       <select name="${type}[${configCount}][conds][cond][]" class="form-select" required>
                            <option value="" hidden>[--Chọn--]</option>
                            <option value="website" ${cond.cond === 'website' ? 'selected' : ''}>Website</option>
                            <option value="country" ${cond.cond === 'country' ? 'selected' : ''}>Quốc gia</option>
                            <option value="device" ${cond.cond === 'device' ? 'selected' : ''}>Thiết bị</option>
                            <option value="operating_system" ${cond.cond === 'operating_system' ? 'selected' : ''}>Hệ điều hành</option>
                            <option value="time" ${cond.cond === 'time' ? 'selected' : ''}>Thời gian</option>
                        </select>
</div>
                    </div>

                    <div class="col-auto w-50 w-sm-auto">
                        <div class="mb-3 position-relative">
                       <select name="${type}[${configCount}][conds][type][]" class="form-select" required>
                            <option value="" hidden>[--Chọn--]</option>
                            <option value="only" ${cond.type === 'only' ? 'selected' : ''}>Only</option>
                            <option value="block" ${cond.type === 'block' ? 'selected' : ''}>Block</option>
                        </select>
</div>
                    </div>

                   

                    <div class="col-auto w-100 w-sm-25">
                        <div class="filter-column-value-wrap mb-3">
                            <input type="text" name="${type}[${configCount}][conds][val][]" class="form-control" value="${cond.val ?? ''}" required>
                        </div>
                    </div>
                 
                </div>
             
            `;

            // Thêm sự kiện xóa điều kiện
            condDiv.querySelector('.remove-cond').addEventListener('click', () => {
                container.removeChild(condDiv);
            });

            container.appendChild(condDiv);
        }
    </script>
@endsection
