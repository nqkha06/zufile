@extends('layouts.admin')

@section('title', 'Thêm thẻ mới')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.tags.create') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.tags.store') }}" accept-charset="UTF-8" class="js-base-form dirty-check" novalidate="novalidate">
        @csrf
        <div class="row">
            <div class="gap-3 col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-body">

                            <div class="mb-3 position-relative">

                                <label class="form-label form-label required" for="name" aria-required="true">
                                    Tên
                                </label>


                                <input class="form-control" data-counter="120" placeholder="Nhập tên" id="name" required="required"
                                    name="name" type="text" value="{{ old('name') }}" aria-required="true">

                            </div>



                            <div class="mb-3 ">
                                <div class="slug-field-wrapper" data-field-name="name">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label required" for="slug" aria-required="true">
                                            Đường dẫn
                                        </label>

                                        <div class="input-group input-group-flat">

                                            <span class="input-group-text" id="current-url">
                                                {{ url('/').'/tag/' }}
                                            </span>

                                            <input class="form-control ps-0" type="text" name="slug" id="slug"
                                                required="required" aria-required="true" value="{{ old('slug') }}">


                                            <span class="input-group-text slug-actions">
                                                <a href="#!" class="link-secondary" data-bs-toggle="tooltip" id="gen-slug"
                                                    aria-label="Tạo URL" data-bs-original-title="Tạo URL">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M6 21l15 -15l-3 -3l-15 15l3 3"></path>
                                                        <path d="M15 6l3 3"></path>
                                                        <path
                                                            d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2">
                                                        </path>
                                                        <path
                                                            d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2">
                                                        </path>
                                                    </svg> </a>
                                            </span>

                                        </div>
                                    </div>
                                    
                                </div>


                            </div>
                            <div class="mb-3 position-relative">

                                <label class="form-label" for="description">
                                    Mô tả
                                </label>

                                <textarea class="form-control" id="description" data-counter="400" rows="4" placeholder="Mô tả ngắn" name="description" cols="50">{{ old('description') }}</textarea>

                            </div>

                        </div>
                    </div>
                </div>


                <div id="advanced-sortables" class="meta-box-sortables">
                    <div class="card meta-boxes mb-3" id="seo_wrap">
                        <div class="card-header">
                            <h4 class="card-title">
                                Tối ưu hoá bộ máy tìm kiếm (SEO)
                            </h4>

                            <div class="card-actions"><a href="#" class="btn-trigger-show-seo-detail">
                                    Chỉnh sửa SEO
                                </a></div>
                        </div>

                        <div class="card-body">
                            <div class="seo-preview">
                                <p class="default-seo-description hidden" id="default-seo-description">
                                    Thiết lập các thẻ mô tả giúp người dùng dễ dàng tìm thấy trên công cụ tìm kiếm như
                                    Google.
                                </p>

                                <div class="existed-seo-meta" id="existed-seo-meta">
                                    <h4 class="page-title-seo text-truncate" id="page-title-seo">
                                    </h4>

                                    <div class="page-url-seo" id="page-url-seo">
                                        <p>-</p>
                                    </div>

                                    <div>
                                        <span style="color: #70757a;">{{ blogFormatDateTime(time()) }}
                                            - </span>
                                        <span class="page-description-seo" id="page-description-seo">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="seo-edit-section hidden">
                                <hr class="my-4">

                                <div class="mb-3 position-relative">

                                    <label class="form-label" for="seo_meta[seo_title]">
                                        Tiêu đề trang
                                    </label>


                                    <input class="form-control" data-counter="70" placeholder="Tiêu đề trang"
                                        id="seo_meta[seo_title]" name="seo_meta[seo_title]" type="text">

                                </div>



                                <div class="mb-3 position-relative">

                                    <label class="form-label" for="seo_meta[seo_description]">
                                        Mô tả trang
                                    </label>


                                    <textarea class="form-control" data-counter="160" rows="3" placeholder="Mô tả trang" data-allow-over-limit=""
                                        name="seo_meta[seo_description]" id="seo_meta[seo_description]" cols="50"></textarea>
                                </div>



                                <div class="mb-3 position-relative">

                                    <label class="form-label" for="seo_meta[index]">
                                        Mục lục


                                    </label>


                                    <div class="position-relative form-check-group mb-3">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" id="seo_meta[index]" type="radio"
                                                name="seo_meta[index]" value="index" checked="">

                                            <span class="form-check-label">Mục lục</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" id="seo_meta[index]" type="radio"
                                                name="seo_meta[index]" value="noindex">

                                            <span class="form-check-label">Không có chỉ mục</span>
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Xuất bản
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Lưu &amp; chỉnh sửa

                            </button>

                            <button class="btn" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                    <path d="M4 14h9"></path>
                                    <path d="M10 11l3 3l-3 3"></path>
                                </svg>
                                Lưu

                            </button>


                        </div>
                    </div>
                </div>

                <div data-bb-waypoint="" data-bb-target="#form-actions"></div>

                <header class="top-0 w-100 position-fixed end-0 z-1000 vertical-wrapper" id="form-actions"
                    style="display: none;">
                    <div class="navbar">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center w-100">
                                <div class="col">
                                    <div class="page-pretitle">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                            </ol>
                                        </nav>

                                    </div>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                                </path>
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Lưu &amp; chỉnh sửa

                                        </button>

                                        <button class="btn" type="submit" name="submitter" value="save">
                                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                                <path d="M4 14h9"></path>
                                                <path d="M10 11l3 3l-3 3"></path>
                                            </svg>
                                            Lưu

                                        </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label for="status" class="form-label required" aria-required="true">Trạng thái</label>
                        </h4>
                    </div>

                    <div class=" card-body">
                        <select data-placeholder="Chọn một tùy chọn" class="form-control form-select" required="required"
                            id="status" name="status" aria-required="true">
                            <option value="">[--Trạng thái--]</option>
                            @foreach ($baseStatus as $status)
                            <option value="{{ $status->value }}" @selected(old('status') == $status->value)> {{ $status->label() }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        function convertSlug(str) {
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
            str = str.replace(/đ/g, 'd');
            str = str.replace(/\[|\]|\(|\)|'|"|`|\\|%|!|#|\$|&|=|~|\^|<|>|\?|\/|\{|\}|\*|\||@|:|;/g,'');
            str = str.replace(/,|\.|-| |_|\+/g, '-');
            str = str.replace(/-{2,}/g, '-');

            return str;
        }
     
        const NAME = document.getElementById('name');
        const SLUG = document.getElementById('slug');
        const DESCRIPTION = document.getElementById('description');
        const GEN_SLUG = document.getElementById('gen-slug');
        const EDIT_SEO_META = document.querySelector("#seo_wrap .btn-trigger-show-seo-detail");
        
        const META_NAME = document.getElementById('seo_meta[seo_title]');
        const META_DESCRIPTION = document.getElementById('seo_meta[seo_description]');

        if (GEN_SLUG) {
            GEN_SLUG.addEventListener('click', function() {
                SLUG.value = convertSlug(NAME.value ?? '');
                document.querySelector("#seo_wrap .page-url-seo>p").innerText = document.getElementById("current-url").innerText + convertSlug(SLUG.value);

            });
        }
        if (EDIT_SEO_META) {
            EDIT_SEO_META.addEventListener('click', function() {
                const SEO_META_SECTION = document.querySelector("#seo_wrap .seo-edit-section");
                SEO_META_SECTION.classList.toggle('hidden');
                document.querySelector("#seo_wrap .page-url-seo>p").innerText = document.getElementById("current-url").innerText + convertSlug(SLUG.value);
            });
        }
        if (NAME) {
            NAME.addEventListener('keyup', function() {
                if (META_NAME && !META_NAME.value) {
                    const page_title_seo = document.querySelector("#seo_wrap .page-title-seo");
                    if (page_title_seo) page_title_seo.innerText = NAME.value;
                }
            })
        }
        if (SLUG) {
            SLUG.addEventListener('keyup', function() {
                SLUG.value = convertSlug(SLUG.value);
                document.querySelector("#seo_wrap .page-url-seo>p").innerText = document.getElementById("current-url").innerText + convertSlug(SLUG.value);
            })
        }

        if (DESCRIPTION) {
            DESCRIPTION.addEventListener("keyup", function() {
                if (META_DESCRIPTION && !META_DESCRIPTION.value) {
                    document.getElementById("page-description-seo").innerText = DESCRIPTION.value;
                }
            });
        }

        if (META_NAME) {
            META_NAME.addEventListener("keyup", function() { 
                const page_title_seo = document.querySelector("#seo_wrap .page-title-seo");
                if (page_title_seo) page_title_seo.innerText = META_NAME.value;
            })
        }

        if (META_DESCRIPTION) {
            META_DESCRIPTION.addEventListener("keyup", function() { 
                document.getElementById("page-description-seo").innerText = META_DESCRIPTION.value;
            })
        }
    </script>
@endpush
