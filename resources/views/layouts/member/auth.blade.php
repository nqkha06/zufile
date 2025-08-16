<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='120x120'/>
        <link href='{{ Setting::get('web_favicon') }}' rel='apple-touch-icon' sizes='152x152'/>
        <link href='{{ Setting::get('web_favicon') }}' rel='icon' type='image/x-icon'/>
        <link href='{{ Setting::get('web_favicon') }}' rel='shortcut icon' type='image/x-icon'/>

        {{-- <link rel="stylesheet" href="{{ asset('backend/member/css/style.css') }}" /> --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ $title }}</title>
    </head>
    <body>
        @yield('content')
    </body>

</html>

