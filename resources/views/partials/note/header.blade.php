<nav class="PLSheader-nav PLSsecIn">
    <div class="PLSheader-nav-left">
        <span class="PLSheader-nav-left-image">
            <img src="{{ Setting::get('web_favicon') }}"
                width="35">
        </span>
        <h1 class="PLSheader-nav-left-heading">
            <span class="PLSheader-nav-left-heading-title">{{ Setting::get("web_name", config("app.name")) }}</span>
            @php
                function getDomainExtension($url) {
                    if (!$url) return null;
                    $parts = explode('.', parse_url($url, PHP_URL_HOST) ?: $url);
                    return end($parts);
                }
            @endphp
            <span class="PLSheader-nav-left-heading-description">.{{ getDomainExtension(Setting::get("web_url", config("app.url"))) }}</span>
        </h1>
    </div>
    <div class="PLSheader-nav-right"><a class="PLSheader-nav-right-button" target="_blank"
            href="{{ Setting::get("web_url", config("app.url")) }}"><svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M 7.82422,1 A 1.0000999,1.0000999 0 0 0 7.11328,1.29688 L 1.28906,7.1875 A 1.0000999,1.0000999 0 0 0 1,7.89062 l 0,8.28516 a 1.0000999,1.0000999 0 0 0 0.29688,0.71094 L 7.1875,22.71094 A 1.0000999,1.0000999 0 0 0 7.89062,23 l 8.28516,0 a 1.0000999,1.0000999 0 0 0 0.71094,-0.29688 L 22.71094,16.8125 A 1.0000999,1.0000999 0 0 0 23,16.10938 L 23,7.82422 A 1.0000999,1.0000999 0 0 0 22.70312,7.11328 L 16.8125,1.28906 A 1.0000999,1.0000999 0 0 0 16.10938,1 L 7.82422,1 Z M 8.24219,3 15.69727,3 21,8.24219 21,15.69727 15.75781,21 8.30273,21 3,15.75781 3,8.30078 8.24219,3 Z m 3.74219,4.5 A 1.0000998,1.0000998 0 0 0 11,8.51367 L 11,11 8.51367,11 a 1.0000998,1.0000998 0 1 0 0,2 L 11,13 l 0,2.48633 a 1.0000998,1.0000998 0 1 0 2,0 L 13,13 l 2.48633,0 a 1.0000998,1.0000998 0 1 0 0,-2 L 13,11 13,8.51367 A 1.0000998,1.0000998 0 0 0 11.98438,7.5 Z">
                </path>
            </svg><span>Tạo ghi chú!</span></a></div>
</nav>
