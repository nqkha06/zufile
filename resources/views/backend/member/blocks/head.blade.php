<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">

<title>{{$title}} - Link4Sub</title>

<!-- Favicon -->
<link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='120x120'/>
<link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='152x152'/>
<link href='{{ URL('/') }}/images/favicon.png' rel='icon' type='image/x-icon'/>
<link href='{{ URL('/') }}/images/favicon.png' rel='shortcut icon' type='image/x-icon'/>  

<!-- CSS STYLE -->
<link href="{{ URl('/') }}/backend/dist/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ URL('/') }}/css/style.css">
<link rel="stylesheet" href="{{ URL('/') }}/css/notyf.css">
<link rel="stylesheet" href="{{ URL('/') }}/css/ckeditor.css">

<script>
const BASE_URL = "{{ !empty($settings['url']) ? $settings['url'] : URL('/') }}";
const STU_URL = "{{ !empty($settings['stu_short_url']) ? $settings['stu_short_url'] : URL('/') }}";
const STU_ALIAS_LEN = {{ !empty($settings['stu_alias_length']) ? $settings['stu_alias_length'] : 4 }};
const NOTE_URL = "{{ !empty($settings['note_short_url']) ? $settings['note_short_url'] : URL('/').'/note' }}";
const NOTE_ALIAS_LEN = {{ !empty($settings['note_alias_length']) ? $settings['note_alias_length'] : 4 }};
</script>

