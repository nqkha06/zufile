@include('partials.stu.config')

<script src="{{ URl('/') }}/backend/dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
{{-- <script src="{{ asset('backend/member/js/stu-config.js') }}"></script> --}}

<!-- SCRIPT !-->
<script>
    const STULv = [
        @forEach($levels as $key=>$value)
        {
            id: '{{ $value['id'] }}',
            name: '{{ $value['name'] }}',
            minimumPages: '{{ $value['minimum_pages'] }}',
        },
        @endforEach
    ];
    const NOTELv = [
        @forEach($note_levels as $key=>$value)
        {
            id: '{{ $value['id'] }}',
            name: '{{ $value['name'] }}',
        },
        @endforEach
    ];
    document.addEventListener("DOMContentLoaded", function () {
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/notyf.js` }));
        document.head.appendChild(Object.assign(document.createElement('script'), { src: `{{ URL('/') }}/js/create-link.js?v={{time()}}` }));
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