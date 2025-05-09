@php
    $SEO = json_decode(base64_decode(request()->get("SEO")), true);
    $url = urldecode(base64_decode(request()->get("url")));

    if (!isset($SEO) && empty($SEO)) {
        $SEO = [
            'title' => Setting::get("web_name"),
            'description' => Setting::get("web_description")
        ];
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $SEO['description'] }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $SEO['title'] }}</title>
</head>
<body>
    <script>
        window.location.href = `{{ $url }}`
    </script>
    <noscript>
        Vui lòng bật JS để tiếp tục, Link4Sub chỉ hoạt động khi kích hoạt JavaScript!
    </noscript>
</body>
</html>