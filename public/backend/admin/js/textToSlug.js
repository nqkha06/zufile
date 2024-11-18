document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('post-title').addEventListener('keyup', function () {
        var title_input = this.value;
        title_input = title_input.toLowerCase();
        title_input = title_input.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
        title_input = title_input.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
        title_input = title_input.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
        title_input = title_input.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
        title_input = title_input.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
        title_input = title_input.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
        title_input = title_input.replace(/đ/g, 'd');
        title_input = title_input.replace(/\[|\]|\(|\)|'|"|`|\\|%|!|#|\$|&|=|~|\^|<|>|\?|\/|\{|\}|\*|\||@|:|;/g, '');
        title_input = title_input.replace(/,|\.|-| |_|\+/g, '-');
        title_input = title_input.replace(/-{2,}/g, '-');
        document.getElementById('post-slug').value = title_input;
    });
});
