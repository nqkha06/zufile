@hasSection('customHeader')
    @yield('customHeader')
@else
    <header class="border-b border-zinc-200 dark:border-zinc-700">

        <div class="px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 lg:gap-4">
                <h1 class="font-medium leading-7 dark:text-white">@yield('title')</h1>
            </div>
            @hasSection('subTitle')
            <p class="tm-xs">@yield('subTitle')</p>
            @endif
        </div>
    </header>
@endif
