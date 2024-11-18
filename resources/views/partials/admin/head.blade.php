<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - {{ $settings['web_name'] ?? env('APP_NAME') }}</title>
    <!-- Favicon -->
    <link href='{{ $settings['web_favicon'] }}' rel='apple-touch-icon' sizes='120x120'/>
    <link href='{{ $settings['web_favicon'] }}' rel='apple-touch-icon' sizes='152x152'/>
    <link href='{{ $settings['web_favicon'] }}' rel='icon' type='image/x-icon'/>
    <link href='{{ $settings['web_favicon'] }}' rel='shortcut icon' type='image/x-icon'/>  
    <!-- CSS files -->
    <link href="/backend/dist/css/tabler.min.css?v={{ time() }}" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-flags.min.css?v={{ time() }}" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-payments.min.css?v={{ time() }}" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-vendors.min.css?v={{ time() }}" rel="stylesheet"/>
    <link href="/backend/dist/css/demo.min.css?v={{ time() }}" rel="stylesheet"/>
    <link href="/backend/dist/css/stu.min.css?v={{ time() }}" rel="stylesheet"/>
    @stack('styles')

    <!-- CSS STU -->
    <script>
      const BASE_URL = "";
      const STU_URL = "";
      const STU_ALIAS_LEN = 4;
      const NOTE_URL = "";
      const NOTE_ALIAS_LEN = 4;
    </script>
    
  </head>