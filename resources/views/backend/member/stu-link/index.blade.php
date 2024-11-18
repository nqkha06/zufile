@extends('layouts.member')

@section('title', __('stu_link.title'))

@section('content')
@include('backend.member.components.filter-link')

<div class="box">
    <div class="box-top">
        <div class="top-left">
            <div class="icon"><i class="bi bi-clock-history"></i></div>
            <div class="title">{{ __('links.your_link') }}</div>
        </div>
    </div>
    <div class="box-container">
        <div class="content">
            <div class="dataTable">

                <div class="dataTable-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="white-space: nowrap">{{ __('links.no') }}</th>
                                <th style="white-space: nowrap">{{ __('links.link') }}</th>
                                <th style="white-space: nowrap">{{ __('links.date_created') }}</th>
                                <th style="white-space: nowrap">{{ __('links.views') }}</th>
                                <th style="white-space: nowrap">{{ __('links.income') }}</th>
                                <th style="white-space: nowrap">{{ __('links.levels') }}</th>
                                <th style="white-space: nowrap">{{ __('links.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$links->isEmpty())
                                @foreach($links as $key=>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td style="white-space: nowrap"><a href="{{ route('stu.show', $value->alias) }}" target="__blank">{{ route('stu.show', $value->alias) }}</a></td>
                                        <td style="white-space: nowrap">{{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->stats->sum('clicks') }}</td>
                                        <td>${{ round($value->stats->sum('revenue'), 3) }}</td>
                                        @php
                                            switch ($value->level_id) {
                                                case 0:
                                                    $elt_lv = '<span class="level s0">'.$value->level->name.'</span>';
                                                    break;
                                                case 1:
                                                    $elt_lv = '<span class="level s1">'.$value->level->name.'</span>';
                                                    break;
                                                case 2:
                                                    $elt_lv = '<span class="level s2">'.$value->level->name.'</span>';
                                                    break;
                                                case 3:
                                                    $elt_lv = '<span class="level s3">'.$value->level->name.'</span>';
                                                case 4:
                                                    $elt_lv = '<span class="level s4">'.$value->level->name.'</span>';
                                                    break;
                                            }
                                        @endphp
                                        <td>{!! $elt_lv !!}</td>
                                        <td style="white-space: nowrap">
                                            <div class="btnDt" style="cursor:pointer">
                                                <label class="btnDtt d" data-alias="{{ $value->alias }}" data-param="{{ $value->data }}" onclick="editSTU(this)" for="forEdit"><i class="bi bi-pencil-square"></i></label>
                                                <form action="{{ route('member.stu.destroy', $value->alias) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btnDtt c" onclick="return confirm('Bạn có chắc chắn muốn xoá liên kết \'{{ $value->alias }}\' chứ? Nó không thể khôi phục nếu bạn xoá nó!')"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <span class="btnDtt l" data-alias="{{ $value->alias }}" onclick="cpLink(this)"><i class="bi bi-clipboard"></i></span>
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
                {{ $links->links('pagination.default') }}

            </div>
        </div>
    </div>
</div>

<input class="hidden" id="forEdit" type="checkbox" />
<div class="popUp edit"> 
    <div class="popIn">
        <div class="popC">
            <div class="popH">
                <div class="t">Chỉnh sửa liên kết</div>
                <label class="c" for="forEdit"></label>
            </div>
            <div class="popB">
                <div class="c">
                  <div class="hero">
                    <div class="stuContainer">
                        <div class="stu_cnt" id="eSCtn"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <label class="fc" for="forEdit"></label>
    
</div>

<script>

    function editSTU(e) {
        const alias = e.dataset.alias;
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
            select: '#eSCtn',
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
            html: `Nó không thể khôi phục nếu bạn xoá nó! Bạn chắc chắn muốn xoá liên kết <b>"${idurl}"</b> chứ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Chắc chắn!',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                title: 'Đang xử lý...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    fetch(`/stu/${idurl}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Xóa liên kết thất bại');
                        }
                    }).then(data => {
                        if (data.status === 'success') {
                            setTimeout(() => {
                                Swal.close();
                                Swal.fire({
                                    title: 'Xóa thành công!',
                                    icon: 'success',
                                }).then((result) => {
                                    window.location.href = window.location.href;
                                });
                            }, 1000);
                        } else {
                            Swal.fire({
                            title: 'Xóa thất bại!',
                            icon: 'error',
                            });
                        }
                    }).catch(error => {
                        Swal.fire({
                            title: 'Xóa thất bại!',
                            text: error.message, // Provide specific error message
                            icon: 'error',
                        });
                    });
                }
                });
            }
        });
    }

</script>
@endsection


