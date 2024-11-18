<div class="page-header">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-md-6 mb-3">
                <div class="mb-1">
                    @if(View::hasSection('breadcrumb'))
                        @yield('breadcrumb')
                    @else
                        {{ Breadcrumbs::render() }}
                    @endif
                </div>
                <h2 class="page-title">
                    <span class="text-truncate" style="line-height: 1.5rem">@yield('title', 'Admin')</span>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                @yield('page-header-right', '')
            </div>

        </div>
    </div>
</div>

