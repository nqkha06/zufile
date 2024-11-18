<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
//         function openNewTabWithoutPermission(url) {
//     // Tạo một phần tử a tạm thời
//     var link = document.createElement('a');
//     link.href = url;
//     link.target = '_blank';
//     link.rel = 'noopener noreferrer';
    
//     // Thêm liên kết vào body
//     document.body.appendChild(link);
    
//     // Mô phỏng nhấp chuột
//     link.click();
    
//     // Xóa liên kết khỏi DOM
//     document.body.removeChild(link);
// }

// Sử dụng
        function safeOpenNewTab(n) {
            let t;
            try {
                if (null == (t = window.open("about:blank", "_blank"))) return console.warn("Cannot open new tab. May be blocked by browser."), !1;
                if (t.close(), null == (t = window.open(n, "_blank"))) return console.warn("Cannot open URL in new tab."), !1;
                return t.focus && t.focus(), !0
            } catch (r) {
                return console.error("Lỗi khi mở tab mới:", r), !1
            }
        }
                // Lấy URL hiện tại
        const currentUrl = window.location.href;

        // Tạo đối tượng URL từ URL hiện tại
        const urlParams = new URL(currentUrl).searchParams;

        // Nhận giá trị của tham số 'url' và 'countdown'
        const url = urlParams.get('url');
        const countdown = urlParams.get('countdown');

        if (countdown) {

        }

        if (url) {
            safeOpenNewTab(url);
        }
        function openNewTabWithoutPermission(url) {
    try {
        // Tạo một tab mới bằng cách dùng window.open
        var newTab = window.open(url, '_blank', 'noopener,noreferrer');
        
        // Kiểm tra nếu tab mở thành công (trình duyệt không chặn)
        if (newTab) {
            newTab.focus(); // Chuyển focus đến tab mới nếu mở được
        } else {
            throw new Error('Trình duyệt đã chặn tab mới.');
        }
    } catch (error) {
        console.error('Không thể mở tab mới:', error.message);
    }
}

// Sử dụng
openNewTabWithoutPermission('https://example.com');

        console.log('URL:', url);
        console.log('Countdown:', countdown);
    </script>
</body>
</html>