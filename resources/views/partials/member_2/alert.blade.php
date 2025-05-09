 <div class="app-container">
    @if (session('user_alerts'))
        <div class="alert alert-danger d-flex flex-column flex-sm-row w-100 p-5 my-5">
            <ul>
                @foreach (session('user_alerts') as $alert)
                    <li>{{ $alert }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger d-flex flex-column flex-sm-row w-100 p-5 my-5">

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <span>{!! $errors->all()[0] !!}</span>
        </div>
    </div>


    <!--end::Alert-->
    @endif  
    @if (session('success'))
    <!--begin::Alert-->
    <div class="alert alert-success d-flex flex-column flex-sm-row w-100 p-5 mb-5">

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <span>{!! session('success') !!}</span>
        </div>

    </div>
    <!--end::Alert-->
    @endif
    @if (session('error'))
    <!--begin::Alert-->
    <div class="alert alert-danger d-flex flex-column flex-sm-row w-100 p-5 mb-5">

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <span>{!! session('error') !!}</span>
        </div>

    </div>
    <!--end::Alert-->
    @endif
 </div>

 