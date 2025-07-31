<!DOCTYPE html>
<html dir='ltr' lang='en'>
<!-- Name : {{ env('APP_NAME') }} Version : 6.1(Update) Date : October 25, 2021 Demo :  Type : Premium Designer : Muhammad Maki Website : www.jagodesain.com ============================================================================ NOTE : This theme is premium (paid). You can only get it by purchasing officially. If you get it for free through any method, that means you get it illegally. ============================================================================ -->
<!--[ <head> Open ]-->

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
            // 'twitter:image:alt' => 'twitter_image_alt',
            'twitter:url' => 'twitter_url',
        ];
    @endphp
    {{-- <meta name="twitter:site" content="@your_twitter_username">
    <meta name="twitter:creator" content="@your_personal_or_brand_account"> --}}
    <!-- Open Graph / Facebook -->
    @foreach ($ogMetaTags as $property => $section)
        @if (View::hasSection($section))
            <meta property="{{ $property }}" content="@yield($section)">
        @endif
    @endforeach

    <!-- Twitter -->
    @foreach ($twitterMetaTags as $name => $section)
        @if (View::hasSection($section))
            <meta name="{{ $name }}" content="@yield($section)">
        @endif
    @endforeach

    <title>@yield('title', 'Blog')</title>

    <!--[ CSS stylesheet ]-->
    <link rel="stylesheet" href="{{ asset('fontend/blog2/css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <script type='application/ld+json'>
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "{{ URL('/') }}",
            "name": "{{ env('APP_NAME') }}",
            "alternateName": "{{ env('APP_NAME') }}",
            "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ URL('/') }}/blog/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
            }
        }
    </script>
    <style>
        .pageLoading {
            z-index: 999;
            position: fixed;
            top: -30%;
            right: -30%;
            bottom: -30%;
            left: -30%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            transition: all .7s ease
        }

        .pageLoading.done {
            visibility: hidden;
            opacity: 0
        }

        .pageLoadingC {
            position: absolute;
            display: block;
            background: #ffffff;
            height: 100%;
            width: 100%;
            transition: all .7s ease
        }

        .page-loader {
            width: 48px;
            height: 48px;
            border: 4px solid #2a2b34;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 0.6s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
    </style>

</head>
<!--[ <body> open ]-->

<body
    class="bD
    {{ request()->routeIs('blog.article') || request()->routeIs('blog.page')
        ? 'bD onIt onPs'
        : (request()->routeIs('blog.category')
            ? 'oGrd onId onMl grD'
            : 'onHm onId oGrd') }}"
    id="mainCont">
    <div class='pageLoading'>
        <div class='pageLoadingC'></div>
        <span class='page-loader'></span>
    </div>
    <!--[ Show only onep grid column in Mobile ]-->
    <script>
        const IS_STU = localStorage.getItem('_STU') !== null || location.search.match(/[\?&]a=([^&]+)/);
        if (IS_STU && window.location.pathname.match(/^\/blog\/[a-zA-Z0-9-]+$/) !== null) {
            document.body.classList.add('onSTU');
            document.body.classList.add('onSTU');
        }
    </script>
    <script>
        /*<![CDATA[*/
        (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('#mainCont').classList.add('drK'): document
            .querySelector('#mainCont').classList.remove('drK') /*]]>*/
    </script>
    <div>
        <!--[ Active function ]-->
    <input class='navi hidden' id='offNav' type='checkbox' />
    <div class='mainWrp'>
        <!--[ Notification section ]-->
        @include('partials.blog.notification')

        <!--[ Header section ]-->
        @include('partials.blog.header')

        <!--[ SearchBox section ]-->
        @include('components.blog.search_box')

        <!--[ Scroll menu ]-->
        @include('partials.blog.scroll_menu')
        <!--[ Content section ]-->
        <div class='mainIn'>
            <!--[ Blog content ]-->
            <div class='blogCont'>
                <div class='secIn'>
                    <!--[ Ad content ]-->
                    <div class='blogAd'>
                        <div class='section' id='horizontal-ad'>
                            <div class='widget HTML' data-version='2' id='HTML91'>
                                @include('components.blog.adB')
                            </div>
                        </div>
                    </div>
                    <div class='blogM'>
                        <!--[ Main content ]-->
                        <main class='blogItm mainbar'>
                            @yield('content')
                        </main>
                        <!--[ Sidebar content ]-->
                        @if (!isset($hideSidebar) || !$hideSidebar)
                            @include('partials.blog.sidebar')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--[ Footer section ]-->
        @include('partials.blog.footer')

    </div>
    <!--[ Javascript disable condition ]-->
    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='{{ env('APP_NAME') }} works best with JavaScript enabled'>
            <label for='forNoJS'></label>
        </div>
    </noscript>
    </div>
    @stack('scripts')
    <!--[ Load More - Delete this section if you want to disable this feature ]-->
    <script src="{{ asset('/fontend/blog2/js/app.js') }}"></script>


    <!--[ Lazy adsense Script with auto ads ]-->
    <!--<script>
        /*<![CDATA[*/
        var lazyadsense = false;
        window.addEventListener('scroll', function() {
            if ((document.documentElement.scrollTop != 0 && lazyadsense === false) || (document.body.scrollTop !=
                    0 && lazyadsense === false)) {
                (function() {
                    var ad = document.createElement('script');
                    ad.setAttribute('crossorigin', 'anonymous');
                    ad.async = true;
                    ad.src =
                        'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0000000000000000';
                    var sc = document.getElementsByTagName('script')[0];
                    sc.parentNode.insertBefore(ad, sc);
                })();
                lazyadsense = true;
            }
        }, true); /*]]>*/
    </script>-->
</body>

</html>
