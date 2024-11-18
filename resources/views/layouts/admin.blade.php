

<!doctype html>

<html lang="en">
  @include('partials.admin.head')
  <body >
    <script src="/backend/dist/js/demo-theme.min.js"></script>

    <div class="page">
      @include('partials.admin.sidebar')
      <!-- Navbar -->
      @include('partials.admin.navbar')
      <div class="page-wrapper px-2">
        <!-- Page header -->
        @include('partials.admin.breadcrumb')
        <div class="page-body">
          <div class="container-xl">
          @include('partials.admin.arlert')

          <!-- Page body -->
          @yield('content')
        </div>
        </div>
        @include('partials.admin.footer')
    </div>

    @include('partials.admin.modal')
    @include('partials.admin.script')
    @stack('scripts')

  </body>
</html>