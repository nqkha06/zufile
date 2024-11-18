document.addEventListener('DOMContentLoaded', function () {
    const btnLoadMore = document.getElementById('LoadMorePosts');
    if (btnLoadMore) {
        btnLoadMore.addEventListener('click', function(event) {
            if (!btnLoadMore.classList.contains('loading')) {
                btnLoadMore.classList.add('loading');

                btnLoadMore.innerHTML = `<div class="jsLd wait nPst" data-text="Đang tải…"><svg viewBox="0 0 50 50" x="0px" y="0px">
                                            <path d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                                                <animateTransform attributeName="transform" attributeType="xml" dur="0.6s" from="0 25 25" repeatCount="indefinite" to="360 25 25" type="rotate"></animateTransform>
                                            </path>
                                        </svg></div>`;
                const articles = document.querySelectorAll('.blogPts>article');

                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var res = JSON.parse(xhr.responseText);
                            if (res.html !== '') {
                                document.querySelector('.blogPts').innerHTML += res.html;
                                btnLoadMore.innerHTML = `<a aria-label="Tải thêm bài đăng" class="jsLd" data-text="Tải thêm bài đăng" href="javascript:;"></a>`;
                            } else {
                                btnLoadMore.innerHTML = `<div class="jsLd nPst" data-text="Không tìm thấy kết quả"></div>`;
                            }
                        } else {
                            btnLoadMore.innerHTML = `<div class="jsLd nPst" data-text="Không tìm thấy kết quả"></div>`;
                        }
                    }
                };

                xhr.open('GET', `/api/blog/fetch?start=${articles.length}&end=${articles.length+6}`, true);
                xhr.send();

                btnLoadMore.classList.remove('loading');

            }
        })
    }
})