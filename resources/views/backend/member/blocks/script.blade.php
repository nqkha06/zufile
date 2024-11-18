<script src="{{ URl('/') }}/backend/dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- SCRIPT !-->
<script>
    const STULv = {
        @forEach($_levels as $key=>$value)
        '{{ $value['id'] }}': '{{ $value['name'] }}',
        @endforEach
    };
    
    const STUtxt = {
        'ttl_ph': '{{__('stu.ttl_ph')}}',
        'sttl_ph': '{{__('stu.sttl_ph')}}',

        'yt1_n': 'Subscribe',
        'yt1_ph': '{{__('stu.yt1_ph')}}', 
        'yt2_n': 'Subscribe #2',
        'yt2_ph': '{{__('stu.yt2_ph')}}',
        'yt3_n': 'Subscribe #3',
        'yt3_ph': '{{__('stu.yt3_ph')}}',

        'ytl1_n': 'Like',
        'ytl1_ph': '{{__('stu.ytl1_ph')}}',
        'ytl2_n': 'Like #2',
        'ytl2_ph': '{{__('stu.ytl2_ph')}}',
        'ytl3_n': 'Like #3',
        'ytl3_ph': '{{__('stu.ytl3_ph')}}',

        'ytc1_n': 'Comment',
        'ytc1_ph': '{{__('stu.ytc1_ph')}}',
        'ytc2_n': 'Comment #2',
        'ytc2_ph': '{{__('stu.ytc2_ph')}}',

        'tg1_n': 'Join Group',
        'tg1_ph': '{{__('stu.tg1_ph')}}',
        'tg2_n': 'Join Group #2',
        'tg2_ph': '{{__('stu.tg2_ph')}}',
        'tg3_n': 'Join Group #3',
        'tg3_ph': '{{__('stu.tg3_ph')}}',

        'tk1_n': 'Follow',
        'tk1_ph': '{{__('stu.tk1_ph')}}',
        'tk2_n': 'Follow #2',
        'tk2_ph': '{{__('stu.tk2_ph')}}',
        'tk3_n': 'Follow #3',
        'tk3_ph': '{{__('stu.tk3_ph')}}',

        'tkl1_n': 'Like',
        'tkl1_ph': '{{__('stu.tkl1_ph')}}',
        'tkl2_n': 'Like #2',
        'tkl2_ph': '{{__('stu.tkl2_ph')}}',
        'tkl3_n': 'Like #3',
        'tkl3_ph': '{{__('stu.tkl3_ph')}}',

        'ig1_n': 'Follow',
        'ig1_ph': '{{__('stu.ig1_ph')}}',
        'ig2_n': 'Follow #2',
        'ig2_ph': '{{__('stu.ig2_ph')}}',
        'ig3_n': 'Follow #3',
        'ig3_ph': '{{__('stu.ig3_ph')}}',

        'igl1_n': 'Like',
        'igl1_ph': '{{__('stu.igl1_ph')}}',
        'igl2_n': 'Like #2',
        'igl2_ph': '{{__('stu.igl2_ph')}}',
        'igl3_n': 'Like #3',
        'igl3_ph': '{{__('stu.igl3_ph')}}',

        'fb1_n': 'Follow',
        'fb1_ph': '{{__('stu.fb1_ph')}}',
        'fb2_n': 'Follow #2',
        'fb2_ph': '{{__('stu.fb2_ph')}}',
        'fb3_n': 'Follow #3',
        'fb3_ph': '{{__('stu.fb3_ph')}}',

        'fbl1_n': 'Like',
        'fbl1_ph': '{{__('stu.fbl1_ph')}}',
        'fbl2_n': 'Like #2',
        'fbl2_ph': '{{__('stu.fbl2_ph')}}',
        'fbl3_n': 'Like #3',
        'fbl3_ph': '{{__('stu.fbl3_ph')}}',

        'dc1_n': 'Join',
        'dc1_ph': '{{__('stu.dc1_ph')}}',
        'dc2_n': 'Join #2',
        'dc2_ph': '{{__('stu.dc2_ph')}}',
        'dc3_n': 'Join #3',
        'dc3_ph': '{{__('stu.dc3_ph')}}',

        'ct1_n': '{{__('stu.ct1_n')}}',
        'ct1_ph': '{{__('stu.ct1_ph')}}',
        'ct1t_ph': '{{__('stu.ct1t_ph')}}',
        'ct2_n': '{{__('stu.ct2_n')}}',
        'ct2_ph': '{{__('stu.ct2_ph')}}',
        'ct2t_ph': '{{__('stu.ct2t_ph')}}',
        'ct3_n': '{{__('stu.ct3_n')}}',
        'ct3_ph': '{{__('stu.ct3_ph')}}',
        'ct3t_ph': '{{__('stu.ct3t_ph')}}',

        'lnk1_n': '{{__('stu.lnk1t_n')}}',
        'lnk1_ph': '{{__('stu.lnk1_ph')}}',
        'lnk1t_ph': '{{__('stu.lnk1t_ph')}}',
        'lnk2_n': '{{__('stu.lnk2_n')}}',
        'lnk2_ph': '{{__('stu.lnk2_ph')}}',
        'lnk2t_ph': '{{__('stu.lnk2t_ph')}}',
        'lnk3_n': '{{__('stu.lnk3_n')}}',
        'lnk3_ph': '{{__('stu.lnk3_ph')}}',
        'lnk3t_ph': '{{__('stu.lnk3t_ph')}}',
        'lnk4_n': '{{__('stu.lnk4_n')}}',
        'lnk4_ph': '{{__('stu.lnk4_ph')}}',
        'lnk4t_ph': '{{__('stu.lnk4t_ph')}}',
        'lnk5_n': '{{__('stu.lnk5_n')}}',
        'lnk5_ph': '{{__('stu.lnk5_ph')}}',
        'lnk5t_ph': '{{__('stu.lnk5t_ph')}}',

        'advanced_options': 'Advanced Options (new)',

        'pwd_n': '{{__('stu.pwd_n')}}',
        'pwd_n': '{{__('stu.pwd_n')}}',
        'not_n': '{{__('stu.not_n')}}',
        'sty_n': '{{__('stu.sty_n')}}',
        'exp_n': '{{__('stu.exp_n')}}',
        'thmb_n': '{{__('stu.thmb_n')}}',
        'pwd_ph': '{{__('stu.pwd_ph')}}',
        'not_ph': '{{__('stu.not_ph')}}',
        'sty_ph': '{{__('stu.sty_ph')}}',
        'exp_ph': '{{__('stu.exp_ph')}}',
        'thmb_ph': '{{__('stu.thmb_ph')}}',

        'lv_lb': '{{__('stu.lv_lb')}}',

        'create_link': '{{__('stu.create_link')}}',
        'reset': '{{__('stu.reset')}}',
    };

    document.addEventListener("DOMContentLoaded", function () {
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/notyf.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/create-link.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/ckeditor/ckeditor.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/ckeditor/translations/{{ Lang::getLocale() }}.js` }));

        const CREATE_NEW_BTN = document.getElementById('CREATE_NEW');
        if (CREATE_NEW_BTN) {
            CREATE_NEW_BTN.addEventListener('click', function () {
                const CREATE_STU = new STU({
                    select: '#CREATE_STU',
                    type: 'create',
                });
                const CREATE_NOTE = new NOTE({
                    select: '#CREATE_NOTE',
                    type: 'create',
                });
            }, { once: true })
        }
        
        const labelsCreate = document.querySelectorAll('[for="forCreate"]');
        if (labelsCreate.length) {
            labelsCreate.forEach((label) => {
                label.addEventListener('click', function () {
                    document.body.classList.toggle('no-scroll')
                })
            })
        }
    });
    
    function logout() {
        Swal.fire({title: "Bạn có chắc không?", text: "Bạn có chắc chắn muốn đăng xuất tài khoản này không?", icon: 'warning', showCancelButton: true, confirmButtonColor: "#195afe", confirmButtonText: "Chắc chắn!",cancelButtonText: "Huỷ"}).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{route('auth.logout')}}'
            }
        })
    }
</script>