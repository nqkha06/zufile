<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-gray-900 order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">{{ __('member/partials/footer.copyright') }}</span>
            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">{{ Setting::get('web_name', env('APP_NAME')) }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        @php
        $footMenu = $menus->where('slug', 'backend-menu')->first();
        @endphp
        @if ($footMenu && $footMenu->items->count())
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            @foreach ($footMenu->items as $item)
            <li class="menu-item">
                <a href="{{ $item->url }}" target="_blank" class="menu-link px-2">{{ $item->name }}</a>
            </li>
            @endforeach
        </ul>
        @endif
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>