@extends('layouts.member')

@section('title', __('note_link.title'))

@section('content')
    <style>
        .auto {
            width: auto
        }

        .gap5 {
            gap: 5px
        }

        .gap10 {
            gap: 10px
        }

        .mt5 {
            margin-top: 5px
        }

        .mt10 {
            margin-top: 10px
        }

        .bot-items {
            align-items: flex-end
        }

        .btn {
            border-radius: 3px;
            line-height: 1.5
        }

        .btn-w-m {
            min-width: 100px
        }

        .btn-primary {
            background-color: #1ab394;
            border-color: #1ab394;
            color: #fff
        }

        .btn-primary:active,
        .btn-primary:active:focus,
        .btn-primary:active:hover,
        .btn-primary:focus,
        .btn-primary:hover {
            background-color: #18a689;
            border-color: #18a689;
            color: #fff
        }

        .btn-primary:active {
            background-image: none
        }

        .btn-primary[disabled],
        .btn-primary[disabled]:active,
        .btn-primary[disabled]:focus,
        .btn-primary[disabled]:hover {
            background-color: #1dc5a3;
            border-color: #1dc5a3
        }

        .btn-default {
            color: inherit;
            background: #fff;
            border: 1px solid #e7eaec
        }

        .btn-default:active,
        .btn-default:active:focus,
        .btn-default:active:hover,
        .btn-default:focus,
        .btn-default:hover {
            color: inherit;
            border: 1px solid #d2d2d2
        }

        .btn-default:active {
            box-shadow: 0 2px 5px rgba(0, 0, 0, .15) inset
        }

        .btn-default[disabled],
        .btn-default[disabled]:active,
        .btn-default[disabled]:focus,
        .btn-default[disabled]:hover {
            color: #cacaca
        }
    </style>

    <div class="box">
        <div class="box-container">
            <div class="content">
                <form action="" method="GET">
                    <div class="row bot-items">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="keyword">Tìm kiếm</label>
                                <input type="text" id="keyword" name="keyword"
                                    value="{{ request('keyword') ?: old('keyword') }}"
                                    placeholder="Bí danh, tiêu đề, nội dung.." class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="created_at">Ngày tạo</label>
                                <input type="date" id="created_at" name="created_at"
                                    value="{{ request('created_at') ?: old('created_at') }}" placeholder="created_at"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 mt10">
                            <div class="form-group flex gap10">
                                <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                                <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default"
                                    onclick="location.href = location.pathname">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                                    <th style="white-space: nowrap">{{ '#Tiêu đề' }}</th>
                                    <th style="white-space: nowrap">{{ __('links.link') }}</th>
                                    <th style="white-space: nowrap">{{ __('links.views') }}</th>
                                    <th style="white-space: nowrap">{{ __('links.income') }}</th>
                                    <th style="white-space: nowrap">{{ __('links.levels') }}</th>
                                    <th style="white-space: nowrap">{{ __('links.date_created') }}</th>
                                    <th style="white-space: nowrap">{{ __('links.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$user_note_links->isEmpty())
                                    @foreach ($user_note_links as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td
                                                style="display: block;max-width: 300px; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                                {{ $value->title }}</td>
                                            <td style="white-space: nowrap"><a
                                                    href="{{ $settings['note_url'].'/'.$value->alias }}"
                                                    target="_blank">{{ $settings['note_url'].'/'.$value->alias }}</a></td>
                                            <td>{{ $value->stats->sum('clicks') }}</td>
                                            <td>${{ $value->stats->sum('revenue') }}</td>
                                            <td>{{ $value->level->name ?? '' }}</td>
                                            <td style="white-space: nowrap">
                                                {{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                                            <td style="white-space: nowrap">
                                                <div class="btnDt" style="cursor:pointer">
                                                    <label class="btnDtt d" data-alias="{{ $value->alias }}"
                                                        data-param='{{ json_encode(['title' => $value->title, 'content' => $value->content, 'password' => $value->password]) }}'
                                                        onclick="editNOTE(this)" for="forEdit"><i
                                                            class="bi bi-pencil-square"></i></label>
                                                    <form action="{{ route('member.note.destroy', $value->alias) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btnDtt c" onclick="return confirm('Bạn có chắc chắn muốn xoá liên kết  \'{{ $value->alias }}\' chứ? Nó không thể khôi phục nếu bạn xoá nó!')"><i class="bi bi-trash"></i></button>
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
                    {{ $user_note_links->links('pagination.default') }}

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
        function editNOTE(e) {
            const alias = e.dataset.alias;
            const data = JSON.parse(e.dataset.param || '{}');

            const boot = new NOTE({
                select: '#eSCtn',
                type: 'edit',
                data: {
                    title: data.title,
                    content: data.content,
                    password: data.password,
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

    </script>

@endsection
