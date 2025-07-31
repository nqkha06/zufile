@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <a href="{{ route('admin.fingerprints.index') }}" class="btn btn-link mb-3">← Quay lại</a>
    <h3>Chi tiết fingerprint #{{ $fingerprint->id }}</h3>

    {{-- ===== THÔNG TIN CƠ BẢN ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Thiết bị & Trình duyệt</div>
        <div class="card-body">
            <p class="text-muted mb-3">Thông tin về thiết bị, trình duyệt và cài đặt người dùng.</p>

            <p><strong>Sạc:</strong> {{ $fingerprint->dcc }}</p>
            <p><strong>%Pin:</strong> {{ $fingerprint->dcl }}</p>
            <p><strong>cpn (CPU Model Name):</strong> {{ $fingerprint->cpn }}</p>
            <p><strong>gvd (GPU Vendor):</strong> {{ $fingerprint->gvd }}</p>
            <p><strong>grr (GPU Renderer):</strong> {{ $fingerprint->grr }}</p>
            <p><strong>ct (Connection Type):</strong> {{ $fingerprint->ct }}</p>
            <p><strong>User Agent:</strong> <span class="text-muted">(Chuỗi định danh trình duyệt)</span> {{ $fingerprint->ua }}</p>
            <p><strong>Platform:</strong> <span class="text-muted">(Hệ điều hành)</span> {{ $fingerprint->platform }}</p>
            <p><strong>Language:</strong> <span class="text-muted">(Ngôn ngữ mặc định)</span> {{ $fingerprint->lang }}</p>
            <p><strong>All Languages:</strong> <span class="text-muted">(Tất cả ngôn ngữ được hỗ trợ)</span> {{ $fingerprint->all_langs }}</p>
            <p><strong>Screen:</strong> <span class="text-muted">(Độ phân giải màn hình)</span> {{ $fingerprint->screen }}</p>
            <p><strong>Timezone Offset:</strong> <span class="text-muted">(Múi giờ)</span> {{ $fingerprint->tz_offset }}</p>
            <p><strong>Do Not Track:</strong> <span class="text-muted">(Cài đặt không theo dõi)</span> {{ var_export($fingerprint->do_not_track, true) }}</p>
            <p><strong>Memory:</strong> <span class="text-muted">(Bộ nhớ thiết bị)</span> {{ $fingerprint->memory }} GB</p>
        </div>
    </div>

    {{-- ===== MẠNG & HIỆU NĂNG ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Mạng & Performance</div>
        <div class="card-body">
            <p class="text-muted mb-3">Thông tin về kết nối mạng và hiệu suất tải trang.</p>

            <p><strong>Network Type:</strong> <span class="text-muted">(Loại kết nối)</span> {{ $fingerprint->network_type }}</p>
            <p><strong>Network Speed:</strong> <span class="text-muted">(Tốc độ kết nối)</span> {{ $fingerprint->network_speed }}</p>
            <p><strong>Network RTT:</strong> <span class="text-muted">(Độ trễ mạng)</span> {{ $fingerprint->network_rtt }}</p>
            <p><strong>Page Load Time:</strong> <span class="text-muted">(Thời gian tải trang)</span> {{ optional($fingerprint->performanceTiming)->load_time }} ms</p>
            <p><strong>DOM Ready Time:</strong> <span class="text-muted">(Thời gian tải DOM)</span> {{ optional($fingerprint->performanceTiming)->dom_ready_time }} ms</p>
            <p><strong>Network Time:</strong> <span class="text-muted">(Thời gian kết nối)</span> {{ optional($fingerprint->performanceTiming)->network_time }} ms</p>
        </div>
    </div>

    {{-- ===== TƯƠNG TÁC NGƯỜI DÙNG ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Tương tác người dùng</div>
        <div class="card-body">
            <p class="text-muted mb-3">Chỉ số về cách người dùng tương tác với trang web.</p>

            <p><strong>Mouse Movement Count:</strong> <span class="text-muted">(Số lần di chuột)</span> {{ $fingerprint->mousemove_count }}</p>
            <p><strong>Scroll Count:</strong> <span class="text-muted">(Số lần cuộn trang)</span> {{ $fingerprint->scroll_count }}</p>
            <p><strong>Keypress Count:</strong> <span class="text-muted">(Số lần nhấn phím)</span> {{ $fingerprint->keypress_count }}</p>
            <p><strong>First Click Delay:</strong> <span class="text-muted">(Độ trễ click đầu tiên)</span> {{ $fingerprint->first_click_delay }}</p>
            <p><strong>Interaction Quality:</strong> <span class="text-muted">(Chất lượng tương tác)</span> {{ $fingerprint->interaction_quality }}</p>
        </div>
    </div>

    {{-- ===== FINGERPRINT DỮ LIỆU ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Fingerprint dữ liệu</div>
        <div class="card-body">
            <p class="text-muted mb-3">Dấu vân tay kỹ thuật số độc nhất của thiết bị.</p>

            <p><strong>Canvas Fingerprint:</strong> <span class="text-muted">(Mã hoá trên canvas)</span> {{ \Str::limit($fingerprint->canvas_fp, 100) }}</p>
            <p><strong>Canvas Fingerprint Full:</strong> <span class="text-muted">(Mã hoá đầy đủ)</span> {{ $fingerprint->canvas_fp_full }}</p>
            <p><strong>Audio Fingerprint:</strong> <span class="text-muted">(Mã hoá âm thanh)</span> {{ $fingerprint->audio_fp }}</p>
        </div>
    </div>

    {{-- ===== VECTOR DATA ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Vector: diit, dit, cmn, mouse, touch</div>
        <div class="card-body">
            <p class="text-muted mb-3">Dữ liệu vector về hành vi người dùng và thiết bị.</p>

            @foreach ($fingerprint->vectors->groupBy('type') as $type => $items)
                <p>
                    @if($type == 'diit')
                        <strong>Device Input Idle Time:</strong>
                    @elseif($type == 'dit')
                        <strong>Device Idle Time:</strong>
                    @elseif($type == 'cmn')
                        <strong>Connection Metrics:</strong>
                    @elseif($type == 'mouse')
                        <strong>Mouse Movement Patterns:</strong>
                    @elseif($type == 'touch')
                        <strong>Touch Interaction Patterns:</strong>
                    @else
                        <strong>{{ $type }}:</strong>
                    @endif
                    <span class="text-muted">(Vector data)</span>
                    {{ collect($items)->pluck('value')->join(' | ') }}
                </p>
            @endforeach
        </div>
    </div>

    {{-- ===== STORAGE ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Khả năng lưu trữ</div>
        <div class="card-body">
            <p class="text-muted mb-3">Khả năng lưu trữ dữ liệu của trình duyệt.</p>

            @php $s = $fingerprint->storageCapabilities; @endphp
            <p><strong>localStorage:</strong> <span class="text-muted">(Lưu trữ cục bộ)</span> {{ var_export($s?->localStorage, true) }}</p>
            <p><strong>sessionStorage:</strong> <span class="text-muted">(Lưu trữ phiên)</span> {{ var_export($s?->sessionStorage, true) }}</p>
            <p><strong>indexedDB:</strong> <span class="text-muted">(Cơ sở dữ liệu cục bộ)</span> {{ var_export($s?->indexedDB, true) }}</p>
            <p><strong>localStorageWrite:</strong> <span class="text-muted">(Khả năng ghi lưu trữ)</span> {{ var_export($s?->localStorageWrite, true) }}</p>
        </div>
    </div>

    {{-- ===== FONTS ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Fonts</div>
        <div class="card-body">
            <p class="text-muted mb-3">Danh sách font chữ được cài đặt trên thiết bị.</p>

            <p><strong>Installed Fonts:</strong> {{ $fingerprint->fonts->pluck('font_name')->join(', ') }}</p>
        </div>
    </div>

    {{-- ===== AUTOMATION FLAGS ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Automation Flags</div>
        <div class="card-body">
            <p class="text-muted mb-3">Dấu hiệu tự động hóa và giả lập trình duyệt.</p>

            @php $a = $fingerprint->automationFlags; @endphp
            <p><strong>WebDriver:</strong> <span class="text-muted">(Sử dụng WebDriver)</span> {{ var_export($a?->webdriver, true) }}</p>
            <p><strong>Headless:</strong> <span class="text-muted">(Trình duyệt không giao diện)</span> {{ var_export($a?->headless, true) }}</p>
            <p><strong>Chrome:</strong> <span class="text-muted">(Sử dụng Chrome)</span> {{ var_export($a?->chrome, true) }}</p>
        </div>
    </div>

    {{-- ===== PERMISSIONS ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Permissions</div>
        <div class="card-body">
            <p class="text-muted mb-3">Quyền truy cập được cấp cho trang web.</p>

            @php $p = $fingerprint->permissions; @endphp
            <p><strong>Notifications:</strong> <span class="text-muted">(Thông báo)</span> {{ $p?->notifications }}</p>
            <p><strong>Geolocation:</strong> <span class="text-muted">(Vị trí)</span> {{ $p?->geolocation }}</p>
            <p><strong>Camera:</strong> <span class="text-muted">(Máy ảnh)</span> {{ $p?->camera }}</p>
            <p><strong>Microphone:</strong> <span class="text-muted">(Microphone)</span> {{ $p?->microphone }}</p>
        </div>
    </div>

    {{-- ===== JS ERRORS ===== --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">JS Errors</div>
        <div class="card-body">
            <p class="text-muted mb-3">Lỗi JavaScript phát sinh trong quá trình sử dụng.</p>

            <ul>
                @foreach ($fingerprint->jsErrors as $error)
                    <li>{{ $error->error_message }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
