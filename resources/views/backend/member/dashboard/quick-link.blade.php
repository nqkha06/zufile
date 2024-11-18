<style>
pre {
    display: block;
    padding: 9.5px;
    margin: 15px 0;
    font-size: 13px;
    line-height: 1.42857143;
    color: #333;
    word-break: break-all;
    word-wrap: break-word;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 4px;
    overflow: auto;
}</style>
<div class="box box-border">
        {{-- <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-gear"></i></div>
                <div class="title">{{ 'Liên kết nhanh' }}</div>
            </div>
        </div> --}}
        <div class="box-container">
            <div class="content">
                @if (!$user_api_tokens->isEmpty())
                <div class="input-box">
                    <label for="api_token">API Token <span style="color: #f1416c">*</span></label>
                    <div class="select-box">
                        <select id="api_token">
                            <option hidden="">Chọn API Token..</option>
                            @foreach ($user_api_tokens as $api_token)
                            <option value="{{ $api_token->token }}">{{ $api_token->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p>Mọi người có thể sử dụng cách rút gọn link nhanh nhất với Link4Sub.com</p>

                <p>Chỉ cần sao chép liên kết bên dưới vào thanh địa chỉ vào trình duyệt web của bạn, thay đổi phần cuối cùng thành liên kết đích và nhấn ENTER. Web1s.com sẽ chuyển hướng bạn đến liên kết rút gọn của bạn. Sao chép nó bất cứ nơi nào bạn muốn và được trả tiền.</p>
                <p>Để tạo liên kết nhanh, hãy làm theo các bước sau:</p>
                <ol style="padding:0 20px">
                    <li>Sao chép liên kết bên dưới và dán vào thanh địa chỉ trình duyệt web của bạn.</li>
                    <li>Thay thế "yourdestinationlink.com" bằng liên kết đích thực tế của bạn.</li>
                    <li>Chọn một hoặc nhiều hành động từ danh sách bên dưới và nối chúng vào liên kết.</li>
                    <li>Nhấn ENTER để tạo liên kết rút gọn của bạn.</li>
                    <li>Link4Sub sẽ chuyển hướng bạn đến liên kết rút gọn tùy chỉnh của bạn.</li>
                    <li>Sao chép liên kết rút gọn và chia sẻ nó ở bất cứ đâu bạn muốn để kiếm phần thưởng.</li>
                </ol>

                <pre>https://link4sub.com/st?api=<b id="resToken">api-token</b>&amp;lnk1=<b>lien-ket-dich.com</b></pre>

                <p class="card-description">Các tham số khác: (Tuỳ chọn thêm)</p>
                <ul>
                    <li><b>lnk1t:</b> Tên liên kết đích của bạn.. #1</li>
                    <li><b>lnk2:</b> Liên kết đích của bạn.. #2</li>
                    <li><b>lnk2t:</b> Tên liên kết đích của bạn.. #2</li>
                    <li><b>lnk3:</b> Liên kết đích của bạn.. #3</li>
                    <li><b>lnk3t:</b> Tên liên kết đích của bạn.. #3</li>
                    <li><b>lnk4:</b> Liên kết đích 1của bạn.. #4</li>
                    <li><b>lnk4t:</b> Tên liên kết đích của bạn.. #4</li>
                    <li><b>lnk5:</b> Liên kết đích của bạn.. #5</li>
                    <li><b>lnk5t:</b> Tên liên kết đích của bạn.. #5</li>
                </ul>
                <p>LƯU Ý: Bắt buộc phải có tham số api và lnk1 thì <b>Quick Link</b> mới hoạt động.</p>
                @else
                <p>Bạn chưa có API, vui lòng tạo API tại <a href={{ rote('user.api.tokens') }}>đây</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const apiTk = document.getElementById("api_token");
    apiTk.addEventListener("change", function() {
        var elt = document.getElementById('resToken');
        if (elt) {
            elt.innerHTML = apiTk.value;
        }
    });
</script>

