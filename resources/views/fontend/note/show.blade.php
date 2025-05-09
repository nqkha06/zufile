@extends('layouts.note')

@section('title', $data->title)

@section('content')
    @if ($data->level_id == 2)
        <style>
            .popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup-content {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                max-width: 500px;
                width: 90%;
            }

            button {
                padding: 10px 20px;
                margin-top: 20px;
                border: none;
                border-radius: 5px;
                background-color: #007BFF;
                color: white;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }

            .container-verfy {
                display: block;
                justify-content: space-around;
                margin-top: 20px;
            }

            .container-verfy .btn-verfy {
                display: block;
                background: #3999ff;
                color: #fff;
                padding: 12px 14px;
                margin: 10px 0;
                text-decoration: none;
                border-radius: 20px;
            }

            .btn-verfy.done {
                background: rgb(32 165 32)
            }
        </style>
        <div id="popup" class="popup">
            <div class="popup-content">
                <h2 class="popup-title">Xác minh danh tính</h2>
                <p>Vui lòng nhấn vào tất cả các nút bên dưới để hoàn thành xác minh</p>
                <div class="container-verfy">
                    <a class="btn-verfy" href="#" target="_blank">Xác minh lần 1</a>
                    <a class="btn-verfy" href="#" target="_blank">Xác minh lần 2</a>
                    <a class="btn-verfy" href="#" target="_blank">Xác minh lần 3</a>
                    <a class="btn-verfy" href="#" target="_blank">Xác minh lần 4</a>
                </div>
            </div>
        </div>
        <script>
            const verfyBtns = document.querySelectorAll('.btn-verfy');
            let cntBtnDone = 0;

            // Gắn sự kiện click cho từng nút
            verfyBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (!btn.classList.contains('done')) {
                        btn.classList.add('done');
                        btn.innerText = 'Đã xác minh';
                        cntBtnDone += 1;

                        if (cntBtnDone === verfyBtns.length) {
                            document.getElementById('popup').classList.add('hidden');
                        }
                    }
                });
            });
        </script>
    @endif
    <div class="paste-title-container">
        <h2 class="title-display" id="paste-t"></h2>

        <div id="paste-share" class="paste-share">
            <div id="share-on">Share on :</div><a aria-label="Facebook" class="cfb" data-text="Share"
                href="https://www.facebook.com/sharer.php?u={{ route('note.show', $data->alias) }}" rel="noopener"
                role="button" target="_blank"><svg viewBox="0 0 64 64">
                    <path
                        d="M20.1,36h3.4c0.3,0,0.6,0.3,0.6,0.6V58c0,1.1,0.9,2,2,2h7.8c1.1,0,2-0.9,2-2V36.6c0-0.3,0.3-0.6,0.6-0.6h5.6 c1,0,1.9-0.7,2-1.7l1.3-7.8c0.2-1.2-0.8-2.4-2-2.4h-6.6c-0.5,0-0.9-0.4-0.9-0.9v-5c0-1.3,0.7-2,2-2h5.9c1.1,0,2-0.9,2-2V6.2 c0-1.1-0.9-2-2-2h-7.1c-13,0-12.7,10.5-12.7,12v7.3c0,0.3-0.3,0.6-0.6,0.6h-3.4c-1.1,0-2,0.9-2,2v7.8C18.1,35.1,19,36,20.1,36z" />
                </svg></a><a aria-label="Whatsapp" class="cwa" data-text="Share"
                href="https://api.whatsapp.com/send?text={{ route('note.show', $data->alias) }}" rel="noopener"
                role="button" target="_blank"><svg viewBox="0 0 64 64">
                    <path
                        d="M6.9,48.4c-0.4,1.5-0.8,3.3-1.3,5.2c-0.7,2.9,1.9,5.6,4.8,4.8l5.1-1.3c1.7-0.4,3.5-0.2,5.1,0.5 c4.7,2.1,10,3,15.6,2.1c12.3-1.9,22-11.9,23.5-24.2C62,17.3,46.7,2,28.5,4.2C16.2,5.7,6.2,15.5,4.3,27.8c-0.8,5.6,0,10.9,2.1,15.6 C7.1,44.9,7.3,46.7,6.9,48.4z M21.3,19.8c0.6-0.5,1.4-0.9,1.8-0.9s2.3-0.2,2.9,1.2c0.6,1.4,2,4.7,2.1,5.1c0.2,0.3,0.3,0.7,0.1,1.2 c-0.2,0.5-0.3,0.7-0.7,1.1c-0.3,0.4-0.7,0.9-1,1.2c-0.3,0.3-0.7,0.7-0.3,1.4c0.4,0.7,1.8,2.9,3.8,4.7c2.6,2.3,4.9,3,5.5,3.4 c0.7,0.3,1.1,0.3,1.5-0.2c0.4-0.5,1.7-2,2.2-2.7c0.5-0.7,0.9-0.6,1.6-0.3c0.6,0.2,4,1.9,4.7,2.2c0.7,0.3,1.1,0.5,1.3,0.8 c0.2,0.3,0.2,1.7-0.4,3.2c-0.6,1.6-2.1,3.1-3.2,3.5c-1.3,0.5-2.8,0.7-9.3-1.9c-7-2.8-11.8-9.8-12.1-10.3c-0.3-0.5-2.8-3.7-2.8-7.1 C18.9,22.1,20.7,20.4,21.3,19.8z" />
                </svg></a><a aria-label="Twitter" class="ctw" data-text="Tweet"
                href="https://twitter.com/share?url={{ route('note.show', $data->alias) }}" rel="noopener" role="button"
                target="_blank"><svg viewBox="0 0 64 64">
                    <path
                        d="M11.4,26.6C11.5,26.6,11.5,26.6,11.4,26.6c-0.9,0-1.8-0.2-2.6-0.4c-1.3-0.4-2.5,0.8-2.1,2 c1.1,4.3,4.5,7.7,8.8,8.6c-1,0.3-2,0.4-3,0.4c-1,0-1.7,1.1-1.2,2c1.9,3.5,5.6,5.9,9.7,6h1c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2 c-1.3,0-2.9-0.1-4.5-0.5c-1-0.2-2-0.2-2.9,0.1c-1.7,0.6-3.5,1.1-5.4,1.3C8.5,50.2,8,50.7,8,51.4v0c0,0.5,0.3,1,0.8,1.2 c3.9,1.7,8.3,2.7,12.9,2.7c21.1,0,32.7-17.9,32.7-33.5v0c0-0.9,0.4-1.8,1.1-2.4c1.2-1,2.3-2.1,3.3-3.4c0.4-0.5-0.1-1.2-0.7-1 c-1.2,0.4-2.4,0.7-3.7,0.9c-0.2,0-0.3-0.2-0.1-0.4c1.5-1.1,2.8-2.6,3.6-4.3c0.3-0.6-0.3-1.2-0.9-0.9c-1.1,0.6-2.3,1-3.5,1.4 c-1.2,0.4-2.6,0.1-3.6-0.7c-1.9-1.5-4.4-2.4-7-2.4c-5.3,0-9.8,3.7-11.1,8.8c-0.2,0.9,0.5,1.7,1.4,1.7c1.6-0.1,3.2-0.3,4.4-0.5 c1-0.2,2,0.3,2.4,1.2c0.5,1.2-0.2,2.4-1.3,2.7c-4.6,1.3-9.7,0.4-9.7,0.4l0,0C21.2,21.8,14.3,18,9.3,12.5C8.6,11.7,7.3,12,7,12.9 c-0.4,1.2-0.6,2.5-0.6,3.9C6.4,20.9,8.4,24.5,11.4,26.6z" />
                </svg></a>
            <label aria-label="shareToOtherApps" for="forShare" class="cpl"><svg viewBox="0 0 512 512">
                    <path
                        d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256 c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32 C448,238.3,434.3,224,417.4,224z" />
                </svg></label>
        </div>
        <div class="panel-auth" id="panel-auth">

            <div class="auth-left">
                <span class="entry-author">
                    <span class="author-avatar-wrap"><span class="author-avatar"
                            style="background-image:url(/images/user.png)"></span></span>
                    <span class="by sp">Bởi</span>
                    <span class="author-name">{{ $data->username }}</span>
                </span>
                <span class="entry-time">
                    <div class="published">
                        <icon class="icon-pub"></icon>
                        <time>{{ date('d/m/Y', strtotime($data->created_at)) }}</time>
                    </div>
                    @if (!empty($data->updated_at))
                        <span class="on sp"></span>

                        <div class="updated">
                            <icon class="icon-updated"></icon>
                            <time>{{ date('d/m/Y', strtotime($data->updated_at)) }}</time>
                        </div>
                    @endif
                </span>
            </div>

            <div class="auth-right">
                <span class="views-note"><a name="{{ $data->alias }}"><span
                            id="postviews">{{ round_views($data->clicks) }}</span><span
                            class="text-view">Views</span></a></span>
            </div>
        </div>
    </div>
    <div class="prepx dc" data-text="css" data-file="herda" data-lang=".xml" data-time="true" data-download="true"
        data-copy="true" data-view="true">
        <div class="prepxM">
            <div class="prepxT"><span class="prTlx" style="font-weight:700">Paste: </span><span class="prCdx"></span>
            </div>
            <div class="prepxA"><button class="prCpx"><svg viewBox="0 0 24 24">
                        <path class="a"
                            d="M20,16V4H8V16H20M22,16A2,2 0 0,1 20,18H8C6.89,18 6,17.1 6,16V4C6,2.89 6.89,2 8,2H20A2,2 0 0,1 22,4V16M16,20V22H4A2,2 0 0,1 2,20V7H4V20H16Z" />
                        <path class="b"
                            d="M20,16V10H22V16A2,2 0 0,1 20,18H8C6.89,18 6,17.1 6,16V4C6,2.89 6.89,2 8,2H16V4H8V16H20M10.91,7.08L14,10.17L20.59,3.58L22,5L14,13L9.5,8.5L10.91,7.08M16,20V22H4A2,2 0 0,1 2,20V7H4V20H16Z" />
                    </svg></button>
                <button class="prDlx"><svg viewBox="0 0 24 24">
                        <path class="a"
                            d="M8 17V15H16V17H8M16 10L12 14L8 10H10.5V6H13.5V10H16M12 2C17.5 2 22 6.5 22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2M12 4C7.58 4 4 7.58 4 12C4 16.42 7.58 20 12 20C16.42 20 20 16.42 20 12C20 7.58 16.42 4 12 4Z" />
                        <path class="b"
                            d="M13,2.03C17.73,2.5 21.5,6.25 21.95,11C22.5,16.5 18.5,21.38 13,21.93V19.93C16.64,19.5 19.5,16.61 19.96,12.97C20.5,8.58 17.39,4.59 13,4.05V2.05L13,2.03M11,2.06V4.06C9.57,4.26 8.22,4.84 7.1,5.74L5.67,4.26C7.19,3 9.05,2.25 11,2.06M4.26,5.67L5.69,7.1C4.8,8.23 4.24,9.58 4.05,11H2.05C2.25,9.04 3,7.19 4.26,5.67M2.06,13H4.06C4.24,14.42 4.81,15.77 5.69,16.9L4.27,18.33C3.03,16.81 2.26,14.96 2.06,13M7.1,18.37C8.23,19.25 9.58,19.82 11,20V22C9.04,21.79 7.18,21 5.67,19.74L7.1,18.37M12,16.5L7.5,12H11V8H13V12H16.5L12,16.5Z" />
                        <path class="c"
                            d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M7,15H17V17H7V15M10.3,11.2L8.4,9.3L7,10.7L10.3,14L17,7.3L15.6,5.9L10.3,11.2Z" />
                    </svg></button>
            </div>
        </div>
        <div class="prec">
            <div class="p-content" id="paste-c"></div>
        </div>
    </div>
    {{-- <div class="ad-demo"></div> --}}

@endsection
