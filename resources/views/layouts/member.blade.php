<!DOCTYPE html>
<html lang="{{ Lang::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <title>@yield('title', 'Member') - {{ Setting::get('web_name', env('APP_NAME')) }}</title>

    <!-- Favicon -->
    <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='120x120'/>
    <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='152x152'/>
    <link href='{{ Setting::get('web_favicon') }}' rel='icon' type='image/x-icon'/>
    <link href='{{ Setting::get('web_favicon') }}' rel='shortcut icon' type='image/x-icon'/>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap-utilities.min.css">
    <!-- CSS STYLE -->
    <link href="{{ URl('/') }}/backend/dist/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/style.css?v={{time()}}" rel="stylesheet">
    <link href="{{ URL('/') }}/css/notyf.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/ckeditor.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css">
    @stack('styles')

    <script>
        const BASE_URL = "{{ !empty(Setting::get('url')) ? Setting::get('url') : URL('/') }}";
        const STU_URL = "{{ !empty(Setting::get('stu_short_url')) ? Setting::get('stu_short_url') : URL('/') }}";
        const STU_ALIAS_LEN = {{ !empty(Setting::get('stu_alias_length')) ? Setting::get('stu_alias_length') : 4 }};
        const NOTE_URL = "{{ !empty(Setting::get('note_short_url')) ? Setting::get('note_short_url') : URL('/') . '/note' }}";
        const NOTE_ALIAS_LEN = {{ !empty(Setting::get('note_alias_length')) ? Setting::get('note_alias_length') : 4 }};
    </script>

</head>

<body>
    <input class="cbNav hidden" id="pNav" type="checkbox" />
    <input class="cbStu hidden" id="pCreate" type="checkbox" />
    <!--[ Wrapper ]-->
    <div class="mainW">
        <style>
            .f1-effect{position:relative;z-index:99999999}.f1-effect .f1-effect-flower{opacity:1;border-radius:100%;background:url(https://file.hstatic.net/200000259653/file/pages_17a8568517e94dcd9c8aec5587_570924d1fa4b4da1aa011044c9d7cc1c.png);position:fixed;top:-10%;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}@media (max-width:767px){.f1-effect .f1-effect-flower:nth-of-type(2n){display:none}}.f1-effect .f1-effect-flower:nth-of-type(0){left:5%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s;width:16px;height:16px;background-position:0 -23px}.f1-effect .f1-effect-flower:first-of-type{left:10%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s;width:13px;height:13px;background-position:0 -50px}.f1-effect .f1-effect-flower:nth-of-type(2){left:20%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s;width:15px;height:15px;background-position:-49px -35px}.f1-effect .f1-effect-flower:nth-of-type(3){left:30%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s;width:14px;height:14px;background-position:-31px 0}.f1-effect .f1-effect-flower:nth-of-type(4){left:40%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s;width:16px;height:16px;background-position:0 -23px}.f1-effect .f1-effect-flower:nth-of-type(5){left:50%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s;width:13px;height:13px;background-position:0 -50px}.f1-effect .f1-effect-flower:nth-of-type(6){left:60%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s;width:15px;height:15px;background-position:-49px -35px}.f1-effect .f1-effect-flower:nth-of-type(7){left:70%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s;width:14px;height:14px;background-position:-31px 0}.f1-effect .f1-effect-flower:nth-of-type(8){left:80%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s;width:14px;height:14px;background-position:-31px 0}.f1-effect .f1-effect-flower:nth-of-type(9){left:90%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s;width:16px;height:16px;background-position:0 -23px}.f1-effect .f1-effect-flower:nth-of-type(10){left:95%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s;width:13px;height:13px;background-position:0 -50px}@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}      
        </style>
        <div class="f1-effect">
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
            <div class="f1-effect-flower"></div>
        </div>
        <!-- header -->
        @include('partials.member.header')

        <div class="mainC">

            <!-- [ Left Sidebar ] -->
            @include('partials.member.sidebar')

            <div class="container">
                @include('partials.member.breadcrumb')

                @include('partials.member.arlert')

                @yield('content')

                @include('partials.member.footer')
            </div>

            @include('partials.member.create')
        </div>
    </div>
    @include('partials.member.script')
    @stack('scripts')
</body>

</html>
