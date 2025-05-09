<!DOCTYPE html>
<html dir='ltr' lang='en'>

<!--[ <head> Open ]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="max-image-preview:large" name="robots">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default keywords')">
    <meta name="author" content="@yield('meta_author', 'Link4Sub')">
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
    <link href='/images/1721055856.png' rel='apple-touch-icon' sizes='120x120' />
    <link href='/images/1721055856.png' rel='apple-touch-icon' sizes='152x152' />
    <link href='/images/1721055856.png' rel='icon' type='image/x-icon' />
    <link href='/images/1721055856.png' rel='shortcut icon' type='image/x-icon' />

    {{-- @php
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
    @endphp --}}
    {{-- <meta name="twitter:site" content="@your_twitter_username">
    <meta name="twitter:creator" content="@your_personal_or_brand_account"> --}}
    <!-- Open Graph / Facebook -->
    {{-- @foreach ($ogMetaTags as $property => $section)
        @if (View::hasSection($section))
            <meta property="{{ $property }}" content="@yield($section)">
        @endif
    @endforeach --}}

    <!-- Twitter -->
    {{-- @foreach ($twitterMetaTags as $name => $section)
        @if (View::hasSection($section))
            <meta name="{{ $name }}" content="@yield($section)">
        @endif
    @endforeach --}}

    <title>@yield('title', 'Link4Sub')</title>
    <link href="{{ asset('/fontend/stu/css/app.css') }}" rel="stylesheet" />

    <!--[ CSS stylesheet ]-->
    <link rel="stylesheet" href="{{ URL('/') }}/fontend/blog2/css/app.css" rel="stylesheet">
    @stack('styles')
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

    <!--[ Show only onep grid column in Mobile ]-->
    <script>
        const IS_STU = localStorage.getItem('_STU') !== null || location.search.match(/[\?&]a=([^&]+)/);
        if (IS_STU) {
            document.body.classList.add('onSTU');
        }
    </script>
    <script>
        /*<![CDATA[*/
        (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('#mainCont').classList.add('drK'): document
            .querySelector('#mainCont').classList.remove('drK') /*]]>*/
    </script>
    <!--[ Active function ]-->
    <input class='navi hidden' id='offNav' type='checkbox' />
    <div class='mainWrp'>

        <!--[ Header section ]-->
        @include('partials.stu.header')

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

                            <!--[ Blog content ]-->
                            <div class="section" id="main-widget">
                                <div class="widget Blog">
                                    <div class="bg_stu">
                                        <div id="topAd"></div>
                                        <div class="stu-container" id="stuC">
                                            <div class='stu-box-wrap '>
                                                <div class="loading-stu"></div>
                                            </div>
                                        </div>
                                        <div style="margin: 25px 0" id="botAd"></div>
                                    </div>

                                </div>
                            </div>

                        </main>

                    </div>
                </div>
            </div>
        </div>
        <!--[ Footer section ]-->
        @include('partials.stu.footer')

    </div>
    <!--[ Javascript disable condition ]-->
    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='{{ env('APP_NAME') }} works best with JavaScript enabled'>
            <label for='forNoJS'></label>
        </div>
    </noscript>


</body>

</html>
