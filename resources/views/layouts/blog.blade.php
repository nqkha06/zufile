<html dir="ltr" lang="{{ App::currentLocale() }}" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="max-image-preview:large" name="robots">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default keywords')">
    <meta name="author" content="@yield('meta_author', 'Your Name')">

    <!-- Favicon -->
    <link href='{{ Setting::get("web_favicon") ? asset(Setting::get("web_favicon")) : "#" }}' rel='apple-touch-icon' sizes='120x120' />
    <link href='{{ Setting::get("web_favicon") ? asset(Setting::get("web_favicon")) : "#" }}' rel='apple-touch-icon' sizes='152x152' />
    <link href='{{ Setting::get("web_favicon") ? asset(Setting::get("web_favicon")) : "#" }}' rel='icon' type='image/x-icon' />
    <link href='{{ Setting::get("web_favicon") ? asset(Setting::get("web_favicon")) : "#" }}' rel='shortcut icon' type='image/x-icon' />

    @php
    $ogMetaTags = [
        'og:type' => 'og_type',
        'og:title' => 'og_title',
        'og:description' => 'og_description',
        'og:image' => 'og_image',
        'og:url' => 'og_url',
    ];

    $twitterMetaTags = [
        'twitter:card' => 'twitter_card',
        'twitter:title' => 'twitter_title',
        'twitter:description' => 'twitter_description',
        'twitter:image' => 'twitter_image',
    ];
    @endphp

    <!-- Open Graph / Facebook -->
    @foreach($ogMetaTags as $property => $section)
        @if(View::hasSection($section))
            <meta property="{{ $property }}" content="@yield($section)">
        @endif
    @endforeach

    <!-- Twitter -->
    @foreach($twitterMetaTags as $name => $section)
        @if(View::hasSection($section))
            <meta name="{{ $name }}" content="@yield($section)">
        @endif
    @endforeach

    <title>@yield('title', 'Blog')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[ CSS ]-->
    <link rel="stylesheet" href="{{ URL('/') }}/fontend/blog/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL('/') }}/fontend/blog/css/anti-adblock.css" rel="stylesheet">

    @stack('styles')

    <script>
        //<![CDATA[
        var STUstatus = false;
        for (var i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);
            if (key.indexOf("_STU") === 0 || key.indexOf("_ALIAS") === 0) {
                STUstatus = true;
                break;
            }
        }
        //]]>
    </script>
</script>


</head>

<body class="oGrd bD onIt onPg {{ str_contains(request()->url(), '/blog/') || str_contains(request()->url(), '/pages/') ? 'onIt' : 'onId' }} " id="mainCont" style="padding-right: 0px;">
    <script>/*<![CDATA[*/
    if (STUstatus === true) {
        document.body.classList.add('stu');
    }
    /*]]>*/</script>
    <script>/*<![CDATA[*/ (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('#mainCont').classList.add('drK') : document.querySelector('#mainCont').classList.remove('drK') /*]]>*/</script>

    <input class="navi hidden" id="offNav" type="checkbox">
    <div class="mainWrp">

        <header class="header" id="header">
            @include('partials.blog.header')
        </header>

        <div class="mainIn">
            <div class="secIn">

                <div class="blogCont">
                    <div class="blogIn">

                        <div class="blogM">
                            <main class="blogItm mainbar">
                                @yield('content')
                            </main>

                            @if(View::hasSection('sidebar'))
                            <aside class="blogItm sidebar">
                                @yield('sidebar')
                            </aside>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer>
        @include('partials.blog.footer')
    </footer>
    </div>

    <div id="cookie-container"></div>

    <script src="{{ asset('/fontend/blog/js/app.js') }}"></script>
    <script src="{{ asset('/fontend/blog/js/cookie.js') }}"></script>
    <script src="{{ asset('/fontend/blog/js/simpleAjax.js') }}"></script>
    <script src="{{ asset('/fontend/blog/js/anti-adblock.js') }}"></script>

    @stack('scripts')

    <!--[ Javascript disable condition ]-->
    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='Link4Sub - Only works with JavaScript enabled!'>
            <label for='forNoJS'></label>
        </div>
    </noscript>
    <!--[ </body> close ]-->
</body>

</html>
