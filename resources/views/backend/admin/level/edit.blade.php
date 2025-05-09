@extends('layouts.admin')
@section('title', __('Chỉnh sửa cấp độ: ' . $level->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.levels.edit', $level) }}
@endsection

@section('content')
    <form action="{{ route('admin.levels.update', $level->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            @if (isset($lang) && !empty($lang))
                <div class="col-12">
                    <div role="alert" class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg class="icon alert-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 9h.01"></path>
                                    <path d="M11 12h1v4h1"></path>
                                </svg>
                            </div>
                            <div class="w-100">

                                Bạn đang chỉnh sửa phiên bản tiếng "<strong
                                    class="current_language_text">{{ $lang->name }}</strong>"

                            </div>
                        </div>



                    </div>
                </div>
            @endif
            <div class="gap-3 col-md-9">

                <div class="card mb-3">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $level?->translation($lang?->code)?->name }}" @required(true) />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="limit" class="form-label">Test link</label>
                                <input type="url" name="test_link" id="test_link" class="form-control"
                                    value="{{ $level->test_link }}" />
                            </div>

                            <div class="col-12 col-md-12 mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Nhập mô tả..." name="description" id="description"
                                    style="min-height: 300px">{{ $level?->translation($lang?->code)?->description }}</textarea>
                            </div>
                        </div>
                   
                    </div>

                </div>


            </div>

            <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Publish
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Save

                            </button>

                            <button class="btn" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                    <path d="M4 14h9"></path>
                                    <path d="M10 11l3 3l-3 3"></path>
                                </svg>
                                Save &amp; Exit

                            </button>


                        </div>
                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            Ngôn ngữ
                        </h4>
                    </div>

                    <div class="card-body">
                        <input type="text" name="lang" value="{{ $lang?->code ?? config("app.DEFAULT_LANG_ADMIN") }}" hidden>
                        <div id="list-others-language">
                            @foreach (Language::getSupportedLanguages()->where("code", "!=", $lang?->code ?? config("app.DEFAULT_LANG_ADMIN")) as $lang)
                            <a class="gap-2 d-flex align-items-center text-decoration-none"
                            href="{{ route("admin.levels.edit", [$level->id, "ref_lang" => $lang->code])}}" target="_blank">
                            <img src="{{ asset("core/img/flags/".$lang->flag.".svg")}}" title="{{ $lang->name }}"
                                class="flag" style="height: 16px" loading="lazy" alt="{{ $lang->name }} flag">
                            <span>{{ $lang->name }} <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                    <path d="M11 13l9 -9"></path>
                                    <path d="M15 4h5v5"></path>
                                </svg></span>
                        </a>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label for="status" class="form-label required">Status</label>
                        </h4>
                    </div>

                    <div class="card-body">
                        <select class="form-select" name="status" id="status" required="">
                            <option value="">[--Trạng thái--]</option>
                            @foreach ($baseStatus as $status)
                                <option value="{{ $status->value }}" @selected(old('status', $status->value) == $level->status->value)> {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
        </div>

    </form>
@endsection
