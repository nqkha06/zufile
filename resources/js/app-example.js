// Ví dụ sử dụng helper để tải các file JS đã minified
import { loadPublicScript } from './helpers/public-assets';

// Import bootstrapping code
import './bootstrap';

// Load các file JS đã minified từ thư mục public
document.addEventListener('DOMContentLoaded', async () => {
  try {
    // Tải các file JS cần thiết
    await loadPublicScript('backend/member/js/DDzrBGya.js');

    // Sau khi tải xong, bạn có thể sử dụng các biến/hàm toàn cục từ file đã tải
    if (window.toast) {
      window.toast('Tài nguyên đã được tải thành công!', 'success');
    }
  } catch (error) {
    console.error('Lỗi khi tải tài nguyên:', error);
  }
});

// Tất cả code khác của ứng dụng...
