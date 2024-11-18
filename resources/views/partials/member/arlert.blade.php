@if ($errors->any())
<p class="note wr">{!! $errors->all()[0] !!}</p>
@endif  
@if (session('success'))
    <p class="note">{!! session('success') !!}</p>
@endif

@if (session('error'))
    <p class="note w">{!! session('error') !!}</p>
@endif