    <!-- STU JS -->
    <script src="/js/notyf.js" defer></script>
	<script src="/js/create-link.js" defer></script>
    <!-- Libs JS -->
    <script src="/backend/dist/libs/apexcharts/dist/apexcharts.min.js?v={{ time() }}" defer></script>
    {{-- <script src="/backend/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?v={{ time() }}" defer></script>
    <script src="/backend/dist/libs/jsvectormap/dist/maps/world.js?v={{ time() }}" defer></script>
    <script src="/backend/dist/libs/jsvectormap/dist/maps/world-merc.js?v={{ time() }}" defer></script> --}}
	{{-- <script src="/backend/dist/libs/list.js/dist/list.js?1720208459" defer=""></script> --}}

	<!-- litetpicker -->
	<script src="/backend/dist/libs/litepicker/dist/nocss/litepicker.js" defer></script>
	<script src="/backend/dist/libs/litepicker/dist/nocss/plugins/keyboardnav.js" defer></script>
	<script src="/backend/dist/libs/litepicker/dist/nocss/plugins/ranges.js" defer></script>
	<script src="/backend/dist/libs/litepicker/dist/nocss/plugins/mobilefriendly.js" defer></script>
    <!-- Tabler Core -->
    <script src="/backend/dist/js/tabler.min.js?v={{ time() }}" defer></script>
    <script src="/backend/dist/js/demo.min.js?v={{ time() }}" defer></script>
    <link href="{{ URL('/') }}/css/notyf.css" rel="stylesheet">

	@include('partials.stu.config')

	<script src="{{ asset('backend/member/js/stu-config.js') }}"></script>
