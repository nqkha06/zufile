<html dir="ltr" lang="{{ App::currentLocale() }}" class="">

<!--[ <head> Open ]-->

<head>
    <!--[ Homepage title ]-->
    <title>{{ Setting::get('web_name') ?? env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[ Meta for browser ]-->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="max-image-preview:large" name="robots">

    <link rel='canonical' href='{{ Setting::get('web_url') ?? env('APP_URL') }}' />

    <meta name="description" content="{{ Setting::get('web_description') ?? '' }}">
    <meta name="keywords" content="{{ Setting::get('web_keywords') ?? '' }}">

    <!--[ Theme Color ]-->
    <meta content="#ed143d" name="theme-color">
    <meta content="#ed143d" name="msapplication-navbutton-color">
    <meta content="#ed143d" name="apple-mobile-web-app-status-bar-style">
    <meta content="true" name="apple-mobile-web-app-capable">

    <!-- Favicon -->
@if (!empty(Setting::get('web_favicon')))
    <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='120x120' />
    <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='152x152' />
    <link href='{{ Setting::get('web_favicon') }}' rel='icon' type='image/x-icon' />
    <link href='{{ Setting::get('web_favicon') }}' rel='shortcut icon' type='image/x-icon' />
@endif

    <!-- Open Graph --->
    <meta property="og:title" content="{{ Setting::get('web_name') ?? env('APP_NAME') }}">
    <meta property="og:site_name" content="{{ Setting::get('web_name', env('APP_NAME')) }}">
    <meta property='og:url' content='{{ Setting::get('web_url') ?? env('APP_URL') }}'>
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ Setting::get('description') ?? '' }}">
    <meta property="og:image" content="{{ Setting::get('web_image', '') }}">

    <!-- Twitter Card -->
    <meta name="twitter:title" content="{{ Setting::get('web_name') ?? env('APP_NAME') }}">
    <meta name="twitter:description" content="{{ Setting::get('description') ?? '' }}">
    <meta name="twitter:url" content="{{ Setting::get('web_url') ?? env('APP_URL') }}">
    <meta name="twitter:site" content="@link4sub">
    <meta name="twitter:image:alt" content="{{ Setting::get('web_name') ?? env('APP_NAME') }}">
    <meta name="twitter:image:src" content="{{ Setting::get('web_image', '') }}">
    <meta name="twitter:card" content="summary">

    <!-- others -->
    <meta name="apple-mobile-web-app-title" content="{{ Setting::get('web_name') ?? env('APP_NAME') }}">
    <meta name="application-name" content="{{ Setting::get('web_name') ?? env('APP_NAME') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!--[ CSS stylesheet ]-->
    <link rel="stylesheet" href="{{ URL('/') }}/home/css/style.css?v={{time()}}">
    <link rel="stylesheet" href="{{ URL('/') }}/css/stu.css">
    <link rel="stylesheet" href="{{ URL('/') }}/css/notyf.css">
    <style>
        .stu_lv {
            display: none !important;
        }
    </style>
     <style>

        .stu_ftr_inp .grp {
            gap: 20px 12px !important;
        }
                .grp__feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
            position: absolute;
            bottom: -20px;
        }
        
            .grp:not(.a)  {
                display: none;
            }
            .grp__item {
                position: relative;
                flex-grow: 1;
                transition: .3s;
            }
            .grp.a .grp__item {
                animation: .5s nudge;
            }
            .grp__label {
                top: -10px;
                font-size: 10px;
                line-height: 18px;
                padding: 0 4px;
                background: #fffdfc;
                border: 1px solid #e6e6e6;
                border-radius: 6px;
                letter-spacing: .5px;
                position: absolute;
                left: 15px;
                z-index: 1;
            }
        
        .stu_fi.er~.grp__icon--right, .stu_fi.ok~.grp__icon--right {
            display: flex;
            color: var(--iclr);
        }
        
        .stu_fi~* {
            color: #545454;
        }
        .stu_fi.ok~.grp__icon--right {
            --iclr: green;
        }
        .stu_fi.er~.grp__icon--right {
            --iclr: red;
        }
        .stu_fi~.grp__icon--right::before {
            content: '';
            background: currentColor;
            position: absolute;
            opacity: .2;
            inset: 0;
        }
        
        .stu_fi~span.grp__icon--right svg>* {
            display: none;
        }
        .stu_fi.er~.grp__icon--right svg>:nth-child(2), .stu_fi.ok~.grp__icon--right svg>:first-child {
            display: block;
        }
            .grp__input-wrapper, .grp__style-wrapper {
                position: relative;
                display: flex;
                align-items: center;
            }
            .grp__style {
                width: 100%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                display: flex;
            }
            
            .grp__input {
                width: 100%;
                padding: 14px 35px 14px 50px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                outline: none;
        
            }
            
            .grp__icon.grp__icon--left, .stu_rst input~span {
                display: flex;
                align-items: center;
                left: 0;
                padding: 0 10px;
                border-right: 1px dashed currentColor;
                line-height: 1;
            }
            
            .stu_fi.er~i, .stu_fi.ok~i {
                display: flex;
                color: var(--iclr);
            }
            .grp__icon--right {
                    display: none;
                    right: 7px;
                    border-radius: 50%;
                    overflow: hidden;
                    width: 22px;
                    height: 22px;
                    align-items: center;
                }
        
            .grp__icon--right, .grp__icon, .stu_rst input~span {
                justify-content: center;
                top: 50%;
                transform: translateY(-50%);
                position: absolute;
            }
        
            .grp__icon svg {
                fill: currentColor;
                stroke: none;
                width: 20px;
                height: 20px;
            }
        </style>
     <script>
        const BASE_URL = "{{ !empty($settings['url']) ? $settings['url'] : URL('/') }}";
        const STU_URL = "{{ !empty($settings['stu_short_url']) ? $settings['stu_short_url'] : URL('/') }}";
        const STU_ALIAS_LEN = {{ !empty($settings['stu_alias_length']) ? $settings['stu_alias_length'] : 4 }};
        const NOTE_URL = "{{ !empty($settings['note_short_url']) ? $settings['note_short_url'] : URL('/') . '/note' }}";
        const NOTE_ALIAS_LEN = {{ !empty($settings['note_alias_length']) ? $settings['note_alias_length'] : 4 }};
    </script>
    {{-- <link rel="stylesheet" href="/swal.css"> --}}
    <script src="{{ URL('/') }}/js/notyf.js"></script>

    <script>
        /*<![CDATA[*/
                const STULv = [
                    @forEach($levels as $key=>$value)
                    {
                        id: '{{ $value['id'] }}',
                        name: '{{ $value['name'] }}',
                        minimumPages: '{{ $value['minimum_pages'] }}',
                    },
                    @endforEach
                ];
        const STUtxt = {
            'ttl_ph': '{{ __('stu.ttl_ph') }}',
            'sttl_ph': '{{ __('stu.sttl_ph') }}',

            'yt1_n': 'Subscribe',
            'yt1_ph': '{{ __('stu.yt1_ph') }}',
            'yt2_n': 'Subscribe #2',
            'yt2_ph': '{{ __('stu.yt2_ph') }}',
            'yt3_n': 'Subscribe #3',
            'yt3_ph': '{{ __('stu.yt3_ph') }}',

            'ytl1_n': 'Like',
            'ytl1_ph': '{{ __('stu.ytl1_ph') }}',
            'ytl2_n': 'Like #2',
            'ytl2_ph': '{{ __('stu.ytl2_ph') }}',
            'ytl3_n': 'Like #3',
            'ytl3_ph': '{{ __('stu.ytl3_ph') }}',

            'ytc1_n': 'Comment',
            'ytc1_ph': '{{ __('stu.ytc1_ph') }}',
            'ytc2_n': 'Comment #2',
            'ytc2_ph': '{{ __('stu.ytc2_ph') }}',

            'tg1_n': 'Join Group',
            'tg1_ph': '{{ __('stu.tg1_ph') }}',
            'tg2_n': 'Join Group #2',
            'tg2_ph': '{{ __('stu.tg2_ph') }}',
            'tg3_n': 'Join Group #3',
            'tg3_ph': '{{ __('stu.tg3_ph') }}',

            'tk1_n': 'Follow',
            'tk1_ph': '{{ __('stu.tk1_ph') }}',
            'tk2_n': 'Follow #2',
            'tk2_ph': '{{ __('stu.tk2_ph') }}',
            'tk3_n': 'Follow #3',
            'tk3_ph': '{{ __('stu.tk3_ph') }}',

            'tkl1_n': 'Like',
            'tkl1_ph': '{{ __('stu.tkl1_ph') }}',
            'tkl2_n': 'Like #2',
            'tkl2_ph': '{{ __('stu.tkl2_ph') }}',
            'tkl3_n': 'Like #3',
            'tkl3_ph': '{{ __('stu.tkl3_ph') }}',

            'ig1_n': 'Follow',
            'ig1_ph': '{{ __('stu.ig1_ph') }}',
            'ig2_n': 'Follow #2',
            'ig2_ph': '{{ __('stu.ig2_ph') }}',
            'ig3_n': 'Follow #3',
            'ig3_ph': '{{ __('stu.ig3_ph') }}',

            'igl1_n': 'Like',
            'igl1_ph': '{{ __('stu.igl1_ph') }}',
            'igl2_n': 'Like #2',
            'igl2_ph': '{{ __('stu.igl2_ph') }}',
            'igl3_n': 'Like #3',
            'igl3_ph': '{{ __('stu.igl3_ph') }}',

            'fb1_n': 'Follow',
            'fb1_ph': '{{ __('stu.fb1_ph') }}',
            'fb2_n': 'Follow #2',
            'fb2_ph': '{{ __('stu.fb2_ph') }}',
            'fb3_n': 'Follow #3',
            'fb3_ph': '{{ __('stu.fb3_ph') }}',

            'fbl1_n': 'Like',
            'fbl1_ph': '{{ __('stu.fbl1_ph') }}',
            'fbl2_n': 'Like #2',
            'fbl2_ph': '{{ __('stu.fbl2_ph') }}',
            'fbl3_n': 'Like #3',
            'fbl3_ph': '{{ __('stu.fbl3_ph') }}',

            'dc1_n': 'Join',
            'dc1_ph': '{{ __('stu.dc1_ph') }}',
            'dc2_n': 'Join #2',
            'dc2_ph': '{{ __('stu.dc2_ph') }}',
            'dc3_n': 'Join #3',
            'dc3_ph': '{{ __('stu.dc3_ph') }}',

            'ct1_n': '{{ __('stu.ct1_n') }}',
            'ct1_ph': '{{ __('stu.ct1_ph') }}',
            'ct1t_ph': '{{ __('stu.ct1t_ph') }}',
            'ct2_n': '{{ __('stu.ct2_n') }}',
            'ct2_ph': '{{ __('stu.ct2_ph') }}',
            'ct2t_ph': '{{ __('stu.ct2t_ph') }}',
            'ct3_n': '{{ __('stu.ct3_n') }}',
            'ct3_ph': '{{ __('stu.ct3_ph') }}',
            'ct3t_ph': '{{ __('stu.ct3t_ph') }}',

            'lnk1_n': '{{ __('stu.lnk1t_n') }}',
            'lnk1_ph': '{{ __('stu.lnk1_ph') }}',
            'lnk1t_ph': '{{ __('stu.lnk1t_ph') }}',
            'lnk2_n': '{{ __('stu.lnk2_n') }}',
            'lnk2_ph': '{{ __('stu.lnk2_ph') }}',
            'lnk2t_ph': '{{ __('stu.lnk2t_ph') }}',
            'lnk3_n': '{{ __('stu.lnk3_n') }}',
            'lnk3_ph': '{{ __('stu.lnk3_ph') }}',
            'lnk3t_ph': '{{ __('stu.lnk3t_ph') }}',
            'lnk4_n': '{{ __('stu.lnk4_n') }}',
            'lnk4_ph': '{{ __('stu.lnk4_ph') }}',
            'lnk4t_ph': '{{ __('stu.lnk4t_ph') }}',
            'lnk5_n': '{{ __('stu.lnk5_n') }}',
            'lnk5_ph': '{{ __('stu.lnk5_ph') }}',
            'lnk5t_ph': '{{ __('stu.lnk5t_ph') }}',

            'pwd_n': '{{ __('stu.pwd_n') }}',
            'not_n': '{{ __('stu.not_n') }}',
            'sty_n': '{{ __('stu.sty_n') }}',
            'exp_n': '{{ __('stu.exp_n') }}',
            'thmb_n': '{{ __('stu.thmb_n') }}',
            'pwd_ph': '{{ __('stu.pwd_ph') }}',
            'not_ph': '{{ __('stu.not_ph') }}',
            'sty_ph': '{{ __('stu.sty_ph') }}',
            'exp_ph': '{{ __('stu.exp_ph') }}',
            'thmb_ph': '{{ __('stu.thmb_ph') }}',

            'lv_lb': '{{ __('stu.lv_lb') }}',

            'create_link': '{{ __('stu.create_link') }}',
            'reset': '{{ __('stu.reset') }}',
        };
        /*]]>*/
    </script>
    <script src="{{ URL('/') }}/js/create-link.js?v={{time()}}"></script>
    <script src="{{ asset('backend/member/js/stu-config.js?v='.time()) }}"></script>

    <style>
        /*<![CDATA[*/
        /* Dark Mode */
        .drK .tDL .d2 {
            display: block
        }

        .drK .tDL svg .f {
            stroke: none;
            fill: var(--darkT)
        }

        .drK .pThmb:not(.nul)::before {
            background-image: linear-gradient(90deg, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, .07) 20%, rgba(0, 0, 0, .1) 60%, rgba(0, 0, 0, 0))
        }

        .drK input::placeholder,
        .drK .cpL input,
        .drK .cArea label .n {
            color: rgba(255, 255, 255, .25)
        }

        .drK .nArea .contact-form-error-message-with-border {
            color: #f94f4f
        }

        .drK .cmC i[rel=image]::before,
        .drK .widget input[type=text],
        .drK .widget input[type=email],
        .drK .widget textarea {
            background: var(--darkBs);
            border-color: rgba(255, 255, 255, .15)
        }

        .drK .erroC h3 span.e {
            color: var(--darkBa)
        }

        .drK svg,
        .drK svg.c-1 {
            fill: var(--darkT)
        }

        .drK svg.line {
            fill: none;
            stroke: var(--darkT)
        }

        .drK svg.c-2 {
            fill: var(--darkTalt);
            opacity: .4
        }

        .drK,
        .drK .headCn,
        .drK .navbar {
            background: var(--darkB);
            color: var(--darkT)
        }

        .drK .ntfC {
            background: var(--darkBa);
            color: var(--darkTa)
        }

        .drK header,
        .drK .tbHd,
        .drK .pRelate,
        .drK blockquote,
        .drK blockquote.s-1,
        .drK .cmC i[rel=quote],
        .drK details.sp,
        .drK .ps table:not(.tr-caption-container),
        .drK .ps table th,
        .drK .ps table:not(.tr-caption-container) tr:not(:last-child) td,
        .drK .pre.tb .preH,
        .drK details.ac,
        .drK .ancrA,
        .drK .ancrC,
        .drK .pSh,
        .drK .cmBd.del .cmCo,
        .drK .cmHl li li .cmIn::before,
        .drK .cpLb,
        .drK .tpMn li.br::after,
        .drK .cmHl>li:not(:last-child) {
            border-color: rgba(255, 255, 255, .15)
        }

        .drK .pre {
            background: var(--darkBs);
            color: var(--darkTa)
        }

        .drK .cmC i[rel=pre] {
            background: var(--darkB);
            color: var(--darkTa)
        }

        .drK footer {
            background: var(--darkBs);
            border-color: rgba(255, 255, 255, .15)
        }

        .drK .tIc::after,
        .drK .shL a,
        .drK .cpLb {
            background: rgba(0, 0, 0, .15)
        }

        .drK h1,
        .drK h2,
        .drK h3,
        .drK h4,
        .drK h5,
        .drK h6,
        .drK footer,
        .drK .button {
            color: var(--darkT)
        }

        .drK .admPs {
            border-color: transparent
        }

        .drK .admPs,
        .drK .dlBox,
        .drK .fixLs,
        .drK .cArea input:focus~.n,
        .drK .cArea textarea:focus~.n,
        .drK .cArea input[data-text=fl]~.n,
        .drK .cArea textarea[data-text=fl]~.n,
        .drK .wL.bg li>*,
        .drK .BlogSearch input {
            background: var(--darkBs)
        }

        .drK .ancrA {
            background: var(--darkBa)
        }

        .drK .button.ln {
            background: transparent
        }

        .drK::selection,
        .drK a,
        .drK .free::after,
        .drK .new::after,
        .drK .aTtl a:hover,
        .drK details.ac[open] summary,
        .drK .cpL label,
        .drK .wL li>*:hover .lbC,
        .drK .wL li>div .lbC,
        .drK .wL .lbM,
        .drK .cmBtn.ln:hover,
        .drK .wL.cl .lbN:hover .lbC,
        .drK .wL.cl div.lbN .lbC,
        .drK .tpMn .a:hover,
        .drK .tpMn ul li a:hover {
            color: var(--darkU)
        }

        .drK .wL li>*:hover svg,
        .drK .wL li>div svg {
            stroke: var(--darkU)
        }

        .drK .blogPg>*,
        .drK .button,
        .drK .zmImg::after,
        .drK .widget input[type=button],
        .drK .widget input[type=submit] {
            background: var(--darkU)
        }

        .drK .pS input[id*="1"]:checked~.tbHd label[for*="1"],
        .drK .pS input[id*="2"]:checked~.tbHd label[for*="2"],
        .drK .pS input[id*="3"]:checked~.tbHd label[for*="3"],
        .drK .pS input[id*="4"]:checked~.tbHd label[for*="4"],
        .drK .widget input[type=text]:focus,
        .drK .widget input[type=email]:focus,
        .drK .widget textarea:focus,
        .drK .widget input[data-text=fl],
        .drK .widget textarea[data-text=fl],
        .drK .wL.cl .lbN:not(div):hover,
        .drK .wL.cl div.lbN {
            border-color: var(--darkU)
        }

        .drK .button.ln:hover {
            border-color: var(--darkU);
            box-shadow: 0 0 0 1px var(--darkU) inset
        }

        .drK header a,
        .drK .pLbls>*,
        .drK .aTtl a,
        .drK .blogPg>*,
        .drK .brdCmb a,
        .drK .wL li>*,
        .drK .cmAc a,
        .drK .pShc>*,
        .drK .topM a,
        .drK footer a {
            color: inherit
        }

        .drK .blogPg .nPst,
        .drK .blogPg .current {
            background: var(--contentL);
            color: var(--bodyCa)
        }

        @media screen and (max-width:1100px) {
            .drK .tpBr {
                background: var(--darkBs)
            }

            .drK .tpC label {
                background: var(--darkBa)
            }

            .drK .tpC svg.rad {
                fill: var(--darkBa)
            }

            .drK .topI:checked~.topM .tpC label {
                background: var(--darkU)
            }
        }

        @media screen and (min-width:897px) {
            .drK .mnMn .a:hover {
                color: var(--darkU)
            }

            .drK .mnMn .a::after {
                border-color: var(--darkU)
            }

            .drK .mnMn ul {
                background: var(--darkBs)
            }

            .drK .mnMn ul li>*:hover {
                background: rgba(0, 0, 0, .15)
            }
        }

        @media screen and (min-width:641px) {
            .drK .ftMn a:hover {
                color: var(--darkU)
            }
        }

        @media screen and (max-width:640px) {
            .drK .ftMn {
                background: var(--darkBa)
            }
        }

        @media screen and (max-width:896px) {
            .drK .mnBrs {
                background: var(--darkBs)
            }

            .drK .mnMn li:not(.drp) .a:hover,
            .drK .mnMn ul li a:hover,
            .drK .mnMn li:not(.mr) .drpI:checked~.a {
                color: var(--darkU)
            }

            .drK .mnMn .a:hover svg:not(.d) {
                fill: var(--darkU)
            }

            .drK .mnMn .a:hover svg.line:not(.d) {
                fill: none;
                stroke: var(--darkU)
            }

            .drK .mnMn li:not(.mr) .a::before,
            .drK .mnMn .drp.mr li>*::before {
                border-color: var(--darkU)
            }

            .drK .mnMn>li.br::after,
            .drK .mnMn li:not(.mr) ul::before,
            .drK .mnMn li:not(.mr) li::before {
                border-color: rgba(255, 255, 255, .15)
            }
        }

        @media screen and (max-width:500px) {
            .drK .itemFt .itm .iCtnt {
                border-color: rgba(255, 255, 255, .15)
            }
        }

        .note a {
            text-decoration: underline;
            color: #fff;
        }

        .footR {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px
        }

        .cbProfil:checked~.Iprofil,
        .cbLang:checked~.Ilang,
        .cbNotif:checked~.Inotif {
            visibility: visible;
            opacity: 1
        }

        .iPu {
            position: absolute;
            display: block;
            /* bottom:calc(65px - 80%);*/
            bottom: 0;
            right: 0;
            /* margin:0 15px;*/
            /* padding:15px;*/
            width: auto;
            max-width: 350px;
            min-width: 200px;
            background: #fff;
            color: #000;
            border-radius: 10px;
            border: 1px solid #e7eaf0;
            box-shadow: 0 10px 30px -8px rgb(0 0 0 / 15%);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            z-index: 99;
            opacity: 0;
            visibility: hidden
        }

        .fc-ovl::after {
            content: "";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            transition: background 0.1s ease, opacity 0.1s ease, visibility 0.1s ease, backdrop-filter 0.1s ease;
            background-color: transparent;
            opacity: 0;
            visibility: hidden
        }

        .cbProfil:checked~.profile.fc-ovl::after,
        .cbLang:checked~.language.fc-ovl::after,
        .cbNotif:checked~.notification.fc-ovl::after {
            opacity: 1;
            visibility: visible
        }

        .ipopUp-lang>.a {
            background-color: rgba(0, 0, 0, .05)
        }

        .iPu .ipopUp-lang>* {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            color: #000
        }

        .ipopUp-lang>.a::after {
            content: "";
            display: inline-block;
            width: 5px;
            height: 15px;
            border: 1px solid #000;
            border-width: 0 1px 1px 0;
            transform: rotate(45deg);
            margin-right: 5px
        }

        .nJ {
            position: fixed;
            left: 0;
            bottom: 22px;
            right: 0;
            max-width: 400px;
            margin-inline: 22px;
            padding: 18px 20px;
            padding-block-end: 36px;
            border-radius: 8px;
            color: var(--warnC);
            background: var(--warnBg);
            font: small/1.3 var(--fontBody-alt);
            box-shadow: 0 15px 30px -8px rgb(0 0 0 / 8%);
            z-index: 99
        }

        .nJ.cookie:not(.hidden) {
            display: block
        }

        .nJ.cookie {
            bottom: 0;
            margin-bottom: 22px;
            padding-block-end: 15px;
            color: #0e2045;
            background-color: #fffdfc;
            font-size: .94rem;
            box-shadow: 0 15px 30px 8px rgb(0 0 0 / 8%);
            transition: bottom .1s ease, opacity .1s ease, visibility .1s ease;
            animation: slideTop 2.2s ease-in forwards
        }

        .nJ.cookie p {
            margin-block: 0 5px
        }

        .nJ.cookie p a:hover {
            text-decoration: underline;
            opacity: 1
        }

        .nJ.cookie .ft {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
            font-weight: 500
        }

        .nJ.cookie .ft>* {
            padding-block: 5px
        }

        .nJ.cookie .acc {
            cursor: pointer;
            width: auto;
            color: #fefefe;
            background: #ed143d;
            padding: 5px 12px;
            border-radius: 20px
        }

        .nJ.cookie .acc:hover {
            opacity: 0.8
        }

        @media screen and (max-width:640px) {

            /* noScript/cookie */
            .nJ {
                bottom: 0;
                max-width: none;
                margin-inline: 0;
                border-radius: 0;
                box-shadow: none
            }

            .nJ.cookie {
                margin-bottom: 0
            }
        }

        .landing-page {
            background: #f7f7fc
        }

        .page-1 .bg {
            position: absolute;
            background: #ed143d;
            width: 200%;
            height: 100%;
            transform: rotate(0deg);
            top: -59%
        }

        .page-1 .hero {
            max-width: 100%
        }

        .hero .stu_cnt {
            background: rgba(255, 255, 255, 1);
            position: relative;
            overflow: hidden
        }

        .hero .stu_cnt::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: -1;
            backdrop-filter: blur(5px)
        }

        .anim-elements {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden
        }

        .anim-elements .anim-element {
            position: absolute
        }

        .anim-elements .anim-element:nth-child(1) {
            background: rgb(16, 255, 0, 1);
            width: 15px;
            height: 15px;
            border-radius: 50%;
            top: 12%;
            left: 15%;
            animation: animTwo 13s infinite linear
        }

        .anim-elements .anim-element:nth-child(2) {
            border: 5px solid rgba(0, 153, 229, 1);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            top: 15%;
            left: 45%;
            animation: animOne 15s infinite linear
        }

        .anim-elements .anim-element:nth-child(3) {
            border: 5px solid rgba(244, 34, 104, 1);
            width: 25px;
            height: 25px;
            bottom: 20%;
            left: 30%;
            animation: animFour 15s infinite linear alternate
        }

        .anim-elements .anim-element:nth-child(4) {
            background: rgba(252, 162, 73, 1);
            width: 15px;
            height: 15px;
            border-radius: 5px;
            bottom: 15%;
            right: 25%;
            animation: animFive 15s infinite linear alternate
        }

        .anim-elements .anim-element:nth-child(5) {
            background: rgb(251 255 0);
            width: 3px;
            height: 20px;
            top: 18%;
            right: 25%;
            animation: animFour 15s infinite linear alternate
        }

        .anim-elements .anim-element:nth-child(5):after,
        .anim-elements .anim-element:nth-child(5):before {
            content: '';
            display: block;
            width: 100%;
            height: calc(50% - 2px);
            top: 6px;
            background: inherit;
            position: absolute;
            transform: rotate(90deg)
        }

        .anim-elements .anim-element:nth-child(5):before {
            right: -6px
        }

        .anim-elements .anim-element:nth-child(5):after {
            left: -6px
        }

        @keyframes animOne {
            0% {
                transform: translate(0, 0) rotate(0)
            }

            20% {
                transform: translate(73px, -1px) rotate(35deg)
            }

            40% {
                transform: translate(141px, 72px) rotate(75deg)
            }

            60% {
                transform: translate(83px, 122px) rotate(110deg)
            }

            80% {
                transform: translate(-40px, 72px) rotate(145deg)
            }

            100% {
                transform: translate(0, 0) rotate(0)
            }
        }

        @keyframes animTwo {
            0% {
                transform: translate(0, 0) rotate(0) scale(1)
            }

            20% {
                transform: translate(73px, -1px) rotate(36deg) scale(0.9)
            }

            40% {
                transform: translate(141px, 72px) rotate(72deg) scale(1)
            }

            60% {
                transform: translate(83px, 122px) rotate(108deg) scale(1.2)
            }

            80% {
                transform: translate(-40px, 72px) rotate(144deg) scale(1.1)
            }

            100% {
                transform: translate(0, 0) rotate(0) scale(1)
            }
        }

        @keyframes animFour {
            0% {
                transform: translate(-300px, 151px) rotate(0)
            }

            100% {
                transform: translate(251px, -200px) rotate(180deg)
            }
        }

        @keyframes animFive {
            0% {
                transform: translate(61px, -99px) rotate(0)
            }

            21% {
                transform: translate(4px, -190px) rotate(38deg)
            }

            41% {
                transform: translate(-139px, -200px) rotate(74deg)
            }

            60% {
                transform: translate(-263px, -164px) rotate(108deg)
            }

            80% {
                transform: translate(-195px, -49px) rotate(144deg)
            }

            100% {
                transform: translate(-1px, 0) rotate(180deg)
            }
        }

        .landing-page .landing-content {
            width: 1100px;
            max-width: 100%;
            margin: auto;
            padding: 0 20px
        }

        .page-1 .landing-absolute {
            position: relative;
            margin: 0 auto;
            z-index: 2;
            padding: 20px;
            border-radius: 8px
        }

        .landing-page .titlex {
            text-align: center;
            margin-bottom: 50px
        }

        .page-1 .landing-box .titlex {
            font-size: 2.3rem;
            line-height: 1.5em;
            color: #fefefe
        }

        .landing-page .titlex h2 {
            position: relative;
            line-height: 1.5em;
            color: inherit
        }

        .landing-page .titlex span {
            display: block;
            font-weight: 400;
            font-size: 15px;
            margin-top: 10px;
            color: #505050;
            line-height: 1.58em
        }

        .page-1 .landing-box .titlex h2 {
            color: #fefefe
        }

        .page-1 .landing-box p {
            margin: 20px 0 0;
            line-height: 1.58em;
            font-size: 15px;
            color: #fefefe
        }

        .stu_sty {
            display: none;
        }

        /*]]>*/
    </style>

    <script>
        /*<![CDATA[*/ /*@shinsenter/defer.js*/ ! function(c, i, t) {
            var f, o = /^data-(.+)/,
                u = 'IntersectionObserver',
                r = /p/.test(i.readyState),
                s = [],
                a = s.slice,
                d = 'lazied',
                n = 'load',
                e = 'pageshow',
                l = 'forEach',
                m = 'hasAttribute',
                h = 'shift';

            function p(e) {
                i.head.appendChild(e)
            }

            function v(e, n) {
                a.call(e.attributes)[l](n)
            }

            function y(e, n, t, o) {
                return o = (o = n ? i.getElementById(n) : o) || i.createElement(e), n && (o.id = n), t && (o.onload = t), o
            }

            function b(e, n) {
                return a.call((n || i).querySelectorAll(e))
            }

            function g(t, e) {
                b('source', t)[l](g), v(t, function(e, n) {
                    (n = o.exec(e.name)) && (t[n[1]] = e.value)
                }), e && (t.className += ' ' + e), n in t && t[n]()
            }

            function I(e) {
                f(function(o) {
                    o = b(e || '[type=deferjs]'),
                        function e(n, t) {
                            (n = o[h]()) && (n.parentNode.removeChild(n), (t = y(n.nodeName)).text = n.text, v(n,
                                function(e) {
                                    'type' != e.name && (t[e.name] = e.value)
                                }), t.src && !t[m]('async') ? (t.onload = t.onerror = e, p(t)) : (p(t), e()))
                        }()
                })
            }(f = function(e, n) {
                r ? t(e, n) : s.push(e, n)
            }).all = I, f.js = function(n, t, e, o) {
                f(function(e) {
                    (e = y('SCRIPT', t, o)).src = n, p(e)
                }, e)
            }, f.css = function(n, t, e, o) {
                f(function(e) {
                    (e = y('LINK', t, o)).rel = 'stylesheet', e.href = n, p(e)
                }, e)
            }, f.dom = function(e, n, t, o, i) {
                function r(e) {
                    o && !1 === o(e) || g(e, t)
                }
                f(function(t) {
                    t = u in c && new c[u](function(e) {
                        e[l](function(e, n) {
                            e.isIntersecting && (n = e.target) && (t.unobserve(n), r(n))
                        })
                    }, i), b(e || '[data-src]')[l](function(e) {
                        e[m](d) || (e.setAttribute(d, ''), t ? t.observe(e) : r(e))
                    })
                }, n)
            }, f.reveal = g, c.Defer = f, c.addEventListener('on' + e in c ? e : n, function() {
                for (I(); s[0]; t(s[h](), s[h]())) r = 1
            })
        }(this, document, setTimeout),
        function(e, n) {
            e.defer = n = e.Defer, e.deferscript = n.js, e.deferstyle = n.css, e.deferimg = e.deferiframe = n.dom
        }(this); /*]]>*/
    </script>
    <script id="polyfill-js">
        'IntersectionObserver' in window || document.write(
            '<script src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver"><\/script>');
    </script>
</head>
<!--[ </head> close ]-->

<body class="oGrd bD {{ str_contains(request()->url(), '/page/') ? 'onIt onPg' : 'onId onHm' }}" id="mainCont"
    style="padding-right: 0px;">
    <!--[ <body> open ]-->

    <!--[ Active function ]-->
    <input class="navi hidden" id="offNav" type="checkbox">
    <div class="mainWrp">
        <!--[ Header section ]-->
        <header class="header stick" id="header">
            <!--[ Header content ]-->
            <div class="headCn">
                <div class="headIn secIn">

                    <div class="headD headL">
                        <!--[ Header widget ]-->
                        <div class="headN section" id="header-title">
                            <div class="widget Header" id="Header1">
                                <div class="headInnr">
                                    <h1 class="headH hasSub">
                                        <span class="headTtl">
                                            <span
                                                style="font-weight: 700">{{ Setting::get('web_name') ?? env('APP_NAME') }}</span>
                                        </span>
                                        <span class="headSub" data-text=""></span>
                                    </h1>
                                </div>
                                <div class="headDsc hidden">{{ Setting::get('description') ?? '' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="headD headR">
                        <div class="headI">
                            <!--[ Header menu ]-->
                            <div class="headM">
                                <div class="mnBr">
                                    <div class="mnBrs">
                                        <div class="mnH">
                                            <label aria-label="Close" class="c" data-text="Close"
                                                for="offNav"></label>
                                        </div>
                                        <div class="mnMen section" id="header-Menu">

                                            <ul class="mnMn">
                                                <li>
                                                    <a class="a" href="{{ route('auth.login') }}">
                                                        <span class="n">Đăng nhập</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="a" href="#Featured">
                                                        <span class="n">Features</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="a" href="#FAQ">
                                                        <span class="n">FAQ</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <label class="fCls" for="offNav"></label>
                            </div>

                            <!--[ Header icon ]-->
                            <div class="headP section" id="header-icon">
                                <ul class="headIc">
                                    <li class="isMn">
                                        <label class="tNav tIc bIc" for="offNav">
                                            <svg class="line" viewBox="0 0 24 24">
                                                <line x1="3" x2="21" y1="12" y2="12">
                                                </line>
                                                <line x1="3" x2="21" y1="5" y2="5">
                                                </line>
                                                <line x1="3" x2="21" y1="19" y2="19">
                                                </line>
                                            </svg>
                                        </label>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!--[ Landing Page ]-->
        @yield('content')
        <!--[ Footer section ]-->

        <footer>
            <div class="secIn">
                <!--[ Credit ]-->
                <div class="cdtIn section" id="credit-widget">
                    <div class="widget HTML" id="HTML88">
                        <div class="fotCd">
                            <span class="credit">© 2022 - <span id="getYear"><script>/*<![CDATA[*/ var d = new Date(); var n = d.getFullYear(); document.getElementById('getYear').innerHTML = n; /*]]>*/</script></span><bdi> ‧ <a
                                        href="{{ Setting::get('web_url', env('APP_URL')) }}">{{ Setting::get('web_name', env('APP_NAME')) }}</a></bdi>
                            </span>
                            <span class="creator pSml">Distributed By <a href="https://www.quockhablog.com/">NGÔ QUỐC
                                    KHA</a></span>
                        </div>
                    </div>
                    <div class="widget LinkList footR" id="LinkList88">
                        <div class="fLang fontM">
                            <input class="cbLang hidden" id="pLang" type="checkbox">

                            <label for="pLang" class="language fc-ovl">
                                <svg class="line" style="stroke: #ffffff" viewBox="0 0 24 24">
                                    <path d="M19.06 18.6699L16.92 14.3999L14.78 18.6699"></path>
                                    <path d="M15.1699 17.9099H18.6899"></path>
                                    <path
                                        d="M16.9201 22.0001C14.1201 22.0001 11.8401 19.73 11.8401 16.92C11.8401 14.12 14.1101 11.8401 16.9201 11.8401C19.7201 11.8401 22.0001 14.11 22.0001 16.92C22.0001 19.73 19.7301 22.0001 16.9201 22.0001Z">
                                    </path>
                                    <path
                                        d="M5.02 2H8.94C11.01 2 12.01 3.00002 11.96 5.02002V8.94C12.01 11.01 11.01 12.01 8.94 11.96H5.02C3 12 2 11 2 8.92999V5.01001C2 3.00001 3 2 5.02 2Z">
                                    </path>
                                    <path d="M9.00995 5.84985H4.94995"></path>
                                    <path d="M6.96997 5.16992V5.84991"></path>
                                    <path d="M7.98994 5.83984C7.98994 7.58984 6.61994 9.00983 4.93994 9.00983"></path>
                                    <path d="M9.0099 9.01001C8.2799 9.01001 7.61991 8.62 7.15991 8"></path>
                                    <path d="M2 15C2 18.87 5.13 22 9 22L7.95 20.25"></path>
                                    <path d="M22 9C22 5.13 18.87 2 15 2L16.05 3.75"></path>
                                </svg>
                            </label>

                            <div class="Ilang iPu">
                                <div class="ipopUp-lang">
                                    <?php
                                    $availableLanguages = [
                                        'en' => 'English',
                                        'vi' => 'VietNam',
                                    ];
                                    
                                    foreach ($availableLanguages as $code => $language) {
                                        $mark = App::currentLocale() == $code ? 'nLang a' : 'nLang';
                                        echo "<a class='$mark' href='" . URL('/') . "/lang/$code'>$language</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <span>|</span>
                        <ul class="mSoc">
                            <li>
                                <a aria-label="Facebook" class="a tIc bIc" href="https://www.facebook.com/nqckha.06"
                                    rel="noopener" role="button" target="_blank">
                                    <svg viewBox="0 0 32 32">
                                        <path
                                            d="M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H17V18h4a1,1,0,0,0,0-2H17V14a2,2,0,0,1,2-2h2a1,1,0,0,0,0-2H19a4,4,0,0,0-4,4v2H12a1,1,0,0,0,0,2h3v9H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a aria-label="Telegram" class="a tIc bIc" href="https://t.me/nqkhadz"
                                    rel="noopener" role="button" target="_blank">
                                    <svg viewBox="0 0 32 32">
                                        <path
                                            d="M24,28a1,1,0,0,1-.62-.22l-6.54-5.23a1.83,1.83,0,0,1-.13.16l-4,4a1,1,0,0,1-1.65-.36L8.2,18.72,2.55,15.89a1,1,0,0,1,.09-1.82l26-10a1,1,0,0,1,1,.17,1,1,0,0,1,.33,1l-5,22a1,1,0,0,1-.65.72A1,1,0,0,1,24,28Zm-8.43-9,7.81,6.25L27.61,6.61,5.47,15.12l4,2a1,1,0,0,1,.49.54l2.45,6.54,2.89-2.88-1.9-1.53A1,1,0,0,1,13,19a1,1,0,0,1,.35-.78l7-6a1,1,0,1,1,1.3,1.52Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a aria-label="Youtube" class="a tIc bIc"
                                    href="https://www.youtube.com/@Link4SubOfficial" rel="noopener" role="button"
                                    target="_blank">
                                    <svg viewBox="0 0 32 32">
                                        <path
                                            d="M29.73,9.9A5,5,0,0,0,25.1,5.36a115.19,115.19,0,0,0-18.2,0A5,5,0,0,0,2.27,9.9a69,69,0,0,0,0,12.2A5,5,0,0,0,6.9,26.64c3,.24,6.06.36,9.1.36s6.08-.12,9.1-.36a5,5,0,0,0,4.63-4.54A69,69,0,0,0,29.73,9.9Zm-2,12A3,3,0,0,1,25,24.65a113.8,113.8,0,0,1-17.9,0,3,3,0,0,1-2.78-2.72,65.26,65.26,0,0,1,0-11.86A3,3,0,0,1,7.05,7.35C10,7.12,13,7,16,7s6,.12,9,.35a3,3,0,0,1,2.78,2.72A65.26,65.26,0,0,1,27.73,21.93Z">
                                        </path>
                                        <path
                                            d="M21.45,15.11l-8-4A1,1,0,0,0,12,12v8a1,1,0,0,0,.47.85A1,1,0,0,0,13,21a1,1,0,0,0,.45-.11l8-4a1,1,0,0,0,0-1.78ZM14,18.38V13.62L18.76,16Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="nJ cookie">
        <p>
            <span class="opacity">{{ __('landing.cookies_description')}}</span>
            <a aria-label="{{ __('landing.learn_more') }}" class="extL opacity" data-text="{{ __('landing.learn_more') }}" href="#" rel="noreferrer"
                target="_blank">{{ __('landing.learn_more') }}</a>
        </p>
        <div class="flex ft">
            <span class="acc">
                {{ __('landing.accept') }}
            </span>
        </div>
    </div>

    <svg style="display: none;">
        <!-- Facebook icon -->
        <symbol id="svgFb" viewBox="0 0 32 32">
            <path
                d="M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H17V18h4a1,1,0,0,0,0-2H17V14a2,2,0,0,1,2-2h2a1,1,0,0,0,0-2H19a4,4,0,0,0-4,4v2H12a1,1,0,0,0,0,2h3v9H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z">
            </path>
        </symbol>
        
        <!-- Telegram icon -->
        <symbol id="svgTlg" viewBox="0 0 32 32">
            <path
                d="M24,28a1,1,0,0,1-.62-.22l-6.54-5.23a1.83,1.83,0,0,1-.13.16l-4,4a1,1,0,0,1-1.65-.36L8.2,18.72,2.55,15.89a1,1,0,0,1,.09-1.82l26-10a1,1,0,0,1,1,.17,1,1,0,0,1,.33,1l-5,22a1,1,0,0,1-.65.72A1,1,0,0,1,24,28Zm-8.43-9,7.81,6.25L27.61,6.61,5.47,15.12l4,2a1,1,0,0,1,.49.54l2.45,6.54,2.89-2.88-1.9-1.53A1,1,0,0,1,13,19a1,1,0,0,1,.35-.78l7-6a1,1,0,1,1,1.3,1.52Z">
            </path>
        </symbol>
    
        <!-- Youtube icon -->
        <symbol id="svgYtb" viewBox="0 0 32 32">
            <path
                d="M29.73,9.9A5,5,0,0,0,25.1,5.36a115.19,115.19,0,0,0-18.2,0A5,5,0,0,0,2.27,9.9a69,69,0,0,0,0,12.2A5,5,0,0,0,6.9,26.64c3,.24,6.06.36,9.1.36s6.08-.12,9.1-.36a5,5,0,0,0,4.63-4.54A69,69,0,0,0,29.73,9.9Zm-2,12A3,3,0,0,1,25,24.65a113.8,113.8,0,0,1-17.9,0,3,3,0,0,1-2.78-2.72,65.26,65.26,0,0,1,0-11.86A3,3,0,0,1,7.05,7.35C10,7.12,13,7,16,7s6,.12,9,.35a3,3,0,0,1,2.78,2.72A65.26,65.26,0,0,1,27.73,21.93Z">
            </path>
            <path
                d="M21.45,15.11l-8-4A1,1,0,0,0,12,12v8a1,1,0,0,0,.47.85A1,1,0,0,0,13,21a1,1,0,0,0,.45-.11l8-4a1,1,0,0,0,0-1.78ZM14,18.38V13.62L18.76,16Z">
            </path>
        </symbol>
    </svg>
    
    <script>
        /*<![CDATA[*/
        const cookieBox = document.querySelector(".nJ.cookie"),
            acceptBtn = cookieBox.querySelector(".acc");
        acceptBtn.onclick = () => {
            document.cookie = "cookie=Notification; max-age=" + 60 * 60 * 24 * 30 * 90;
            if (document.cookie) {
                cookieBox.classList.add("hidden");
            } else {
                alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
            }
        };
        let checkCookie = document.cookie.indexOf("cookie=Notification");
        checkCookie != -1 ? cookieBox.classList.add("hidden") : cookieBox.classList.remove("hidden"); /*]]>*/
    </script>
    <script>

        /*<![CDATA[*/
        const CREATE_STU_HOME = new STU({
            select: '#stuCnt',
            type: 'create',
        })
        document.getElementById('i_level').value = 1;

        /*]]>*/
    </script>

    <!--[ Javascript disable condition ]-->
    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='{{ Setting::get('web_name', env('APP_NAME')) }} - Only works with JavaScript enabled!'>
            <label for='forNoJS'></label>
        </div>
    </noscript>
    <!--[ </body> close ]-->
</body>

</html>
