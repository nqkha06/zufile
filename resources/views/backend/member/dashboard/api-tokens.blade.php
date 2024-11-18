
    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-clock-history"></i></div>
                <div class="title">{{ 'Your Tokens' }}</div>
            </div>
            <div class="top-right">
                <button class="button">                <label class="c" for="forCreateTokenSTU">TẠO API</label>
                    </button>
            </div>
        </div>
        <div class="box-container">
            <div class="content">
                <div class="dataTable">

                    <div class="dataTable-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    {{-- <th style="white-space: nowrap">#STT</th> --}}
                                    <th style="white-space: nowrap">#Tên</th>
                                    {{-- <th style="white-space: nowrap">#Loại</th> --}}
                                    <th style="white-space: nowrap">#Token</th>
                                    <th style="white-space: nowrap">#Trạng thái</th>
                                    <th style="white-space: nowrap">#Ngày tạo</th>
                                    <th style="white-space: nowrap">##</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$user_api_tokens->isEmpty())
                                    @foreach($user_api_tokens as $key=>$value)
                                        <tr>
                                            {{-- <td>{{ $key+1 }}</td> --}}
                                            <td style="white-space: nowrap">{{ $value->name }}</a></td>
                                            {{-- <td style="white-space: nowrap">##</td> --}}
                                            <td style="white-space: nowrap">{{ $value->token }}</td>
                                            <td style="white-space: nowrap">{!! $value->status == 1 ? '<span class="badge-s2 success">Hoạt động<span>' : '<span class="badge-s2 warning">Tạm tắt</span>' !!}</td>
                                            <td style="white-space: nowrap">{{ $value->created_at }}</td>
                                            <td style="white-space: nowrap">
                                                <div class="btnDt" style="cursor:pointer">
                                                    <label class="d" data-token="{{ $value->token }}" data-param="{{ $value->data }}" onclick="editTOKEN(this)" for="forEdit"><i class="bi bi-pencil-square"></i></label>
                                                    <span class="c" data-alias="{{ $value->name }}" onclick="rmLink(this)"><i class="bi bi-trash"></i></span>
                                                    <span class="l" data-alias="TOKEN/{{ $value->token }}" onclick="cpLink(this)"><i class="bi bi-clipboard"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                    <td>KHÔNG CÓ DỮ LIỆU</td>
                                </tr>
                                @endif
                            <!--show data-->
                            </tbody>
                        </table>
                    </div>
                    <!--pagination-->
                    {{ $user_api_tokens->links('pagination.default') }}

                </div>
            </div>
        </div>
    </div>

</div>

<input class="hidden" id="forEdit" type="checkbox" />
<input class="hidden" id="forCreateTokenSTU" type="checkbox" />
<div class="popUp edit"> 
    <div class="popIn">
        <div class="popC">
            <div class="popH">
                <div class="t">Chỉnh sửa token</div>
                <label class="c" for="forEdit"></label>
            </div>
            <div class="popB">
                <div class="c">
                  <div class="hero">
                    <div class="stuContainer">
                        <div class="stu_cnt" id="editTkSTU"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <label class="fc" for="forEdit"></label>
</div>

<div class="popUp createTokenSTU"> 
    <div class="popIn">
        <div class="popC">
            <div class="popH">
                <div class="t">Tạo mới token</div>
                <label class="c" for="forCreateTokenSTU"></label>
            </div>
            <div class="popB">
                <div class="c">
                  <div class="hero">
                    <div class="stuContainer">
                        <div class="stu_cnt" id="createTkSTU"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <label class="fc" for="forCreateTokenSTU"></label>
</div>

<script>


function editTOKEN(e) {
    const alias = e.dataset.token;
    const data = JSON.parse(e.dataset.param || '{}');
    const btn_STU = {};
    const input_STU = {};

    for (let category of ['btn', 'lnk', 'oth']) {
        for (let key in data[category]) {
            btn_STU['g_' + key] = true;
            input_STU[key] = decodeURIComponent(atob(data[category][key]));
        }
    }
    const editSTU2 = new STU({
        select: '#editTkSTU',
        type: 'edit',
        data: {
            inp: input_STU,
            outp: btn_STU,
            alias: alias
        }
});
}
function cpLink(element) {
    const link = 'https://link4sub.com/' + element.dataset['alias'];
    const tempInput = document.createElement('input');
    document.body.appendChild(tempInput);
    tempInput.value = link;
    tempInput.select();
    document.execCommand('copy');
    tempInput.remove();
    Swal.fire({
        title: 'Sao chép liên kết thành công!',
        icon: 'success',
        confirmButtonText: 'Truy cập link',
        showCancelButton: true,
        cancelButtonText: 'Đóng'
    }).then((result) => {
        if (result.isConfirmed) {
            window.open(link, '_blank');
        };
    })
}

function rmLink(element) {
    var link = element.dataset.alias,
        idurl = link;

    Swal.fire({
        title: 'Bạn có chắc không?',
        html: 'Nó không thể khôi phục nếu bạn xoá nó! Bạn chắc chắn muốn xoá api <b>"' + idurl +
            '"</b> chứ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Chắc chắn!',
        cancelButtonText: 'Huỷ'
    }).then((rs) => {
        if (rs.isConfirmed) {
            let timerInterval;
            Swal.fire({
                title: "Đang xử lý..",
                timer: 2000,
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Create a new XMLHttpRequest object
                    var xhr = new XMLHttpRequest();

                    // Configure it: specify the request method and the URL
                    xhr.open('POST', '/your-server-endpoint', true);

                    // Set the request header if needed (e.g., for JSON)
                    xhr.setRequestHeader('Content-Type', 'application/json');

                    // Define the function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Handle the response from the server as needed
                            var data = JSON.parse(xhr.responseText);
                            console.log(data);
                        }
                    };

                    // Send the request with the data
                    xhr.send(JSON.stringify({ alias: idurl }));
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire({
                        title: 'error!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const editSTU2 = new STU({
        select: '#createTkSTU',
        type: 'api',
    })
})
</script>

