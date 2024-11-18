<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Note')</title>
    <meta name="keywords" content="sub2unlock, sub2unlock link, sub unlock, subscribe to unlock link, sub to unlock, sub 2 unlock, sub4 unlock net, sub4unlock, subfor unlock net, unlock link, unlock, link, sub, to unlock, subscribe, unlock net, subfor, sub3unlock, Link4Sub.com, link locker, content locking, subscribe for access, unlock with subscription, locked content, đăng ký để mở khoá, khoá nội dung, đăng ký để tải xuống, subscribe download, link4sub, subunlock, unlock link, url shortener, social unlock">
    <!-- Favicon -->
    <link href='/images/favicon.png' rel='apple-touch-icon' sizes='120x120' />
    <link href='/images/favicon.png' rel='apple-touch-icon' sizes='152x152' />
    <link href='/images/favicon.png' rel='icon' type='image/x-icon' />
    <link href='/images/favicon.png' rel='shortcut icon' type='image/x-icon' />

    <!--[ CSS ]-->
    <link rel="stylesheet" href="{{ URL('/') }}/fontend/note/css/app.css" rel="stylesheet">
    @stack('styles')
  </head>

  <body>
    <div id='toastNotif' class='tNtf'></div>
    <div class="note-link4sub">
      <header class="PLSheader">
        @include('partials.note.header')
      </header>

      <div class="con-container" id="ppaste">

        <div class="con-iner">
            @yield('content')

        </div>
      </div>
      <footer class="PLSfooter">
        @include('partials.note.footer')
      </footer>
    </div>
    <div class="pFoot">
        @include('partials.note.sh')
    </div>

    </div>
    <script src="{{ asset('/fontend/note/js/app.js') }}"></script>
    <script>
      /*<![CDATA[*/
      const json_data = {!! json_encode($data) !!};
      const data = {
        title: (json_data.title),
        content: (`${json_data.content}`),
        password: json_data.password
      };
      const content = document.getElementById("paste-c");
      const title = document.getElementById("paste-t");

      content.innerHTML = `
        <div>${data.content}</div>
    `;
      title.innerHTML = `
        <div>${data.title}</div>
    `;
      /*]]>*/
    </script>
    @stack('scripts')

  </body>

</html>