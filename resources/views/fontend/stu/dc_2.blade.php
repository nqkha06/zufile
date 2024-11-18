<meta name="robots" content="noindex">
@php
    $post_links = ["https://link4sub.qkt/blog/kiem-tien-hieu-qua-voi-tiktok-affiliate-moi-nhat-2024-tu-a-z",
  "https://link4sub.qkt/blog/top-5-game-mobile-5v5-cuc-hay-ma-ban-nen-trai-nghiem",
  "https://link4sub.qkt/blog/cach-kiem-tien-tu-google-adsense-moi-nhat-2024-tu-a-z",
  "https://link4sub.qkt/blog/top-7-game-sinh-ton-tren-mobile-ban-khong-the-bo-lo",
  "https://link4sub.qkt/blog/microsoft-that-bai-trong-viec-kiem-soat-chatbot-bing-ai",
  "https://link4sub.qkt/blog/cach-su-dung-pivot-table-thong-ke-bao-cao-trong-excel",
  "https://link4sub.qkt/blog/ban-co-the-de-dang-chan-tin-nhan-tren-iphone-bang-cach-nay"];
    $script = '';
    $alias = Request::query('a') ?? null;

    if ($alias == null) {
        $script = "window.location.href = \"" . URL('/') . "\";";
    } else {
        $random_link = $post_links[array_rand($post_links)];
        $script = "
        function setCookie(name, value, days) {
            let expires = '';
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }
            document.cookie = name + '=' + (value || '') + expires + '; path=/';
        }

        function deleteCookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }
        function setLocalStorage(key, value) {
            const jsonString = JSON.stringify(value);
            return localStorage.setItem(key, jsonString);
        }
        localStorage.removeItem('_STU');

        deleteCookie('_OLD');
        setLocalStorage('_ALIAS', '{$alias}');
        window.location.href = '{$random_link}';
        ";
    }
@endphp

<script>
    {!! $script !!}
</script>
