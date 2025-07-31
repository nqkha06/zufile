@extends('layouts.admin')
@section('title', __('Sửa trang: ' . $page->title))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.pages.edit', $page) }}
@endsection

@push('styles')
        <style>
        .ck-editor__editable_inline {
            height: 500px;
        }

        .ck.ck-icon,
        .ck.ck-icon * {
            stroke: none
        }

        .ck.ck-powered-by {
            display: none !important;
            opacity: 0 !important;
            height: 0 !important;
        }

        .preview {
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
            border: 1px solid #ced4da;
            border-radius: 10px;
            margin: auto;
            background-color: rgb(255, 255, 255);
            box-shadow: 0 0 20px rgba(170, 170, 170, 0.2);
            margin: 20px 0;
        }

        .preview img {
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
@endpush
@section('content')
    <script src="{{ asset('js/ckeditor5/ckeditor.js') }}"></script>

    <form class="col-12" action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="gap-3 col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required" for="post-title">Post title</label>
                            <input type="text" id="post-title" name="title" value="{{ old('title', $page->title) }}"
                                   placeholder="Enter post title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="post-slug">Slug</label>
                            <input type="text" id="post-slug" name="slug" value="{{ old('slug', $page->slug) }}"
                                   placeholder="Enter post slug" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="post-description">Description</label>
                            <input type="text" id="post-description" name="description" value="{{ old('description', $page->description) }}"
                                   placeholder="Enter post description" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="post-content">Post Content</label>
                            <textarea style="min-height: 300px" id="post-content" name="content"
                                      placeholder="Enter post content" class="form-control">{{ old('content', $page->content) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Publish</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                    <path d="M4 14h9"></path>
                                    <path d="M10 11l3 3l-3 3"></path>
                                </svg>
                                Save & Exit
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Img</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="featured-image">Post featured image</label>
                            <input type="file" id="featured-image" class="form-control" name="image">
                            <label class="preview" for="featured-image">
                                <img id="img-preview" src="{{ $page->image ?? '/img.png' }}" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Meta</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="meta_title">Meta title</label>
                            <input type="text" id="meta_title" name="meta_title" placeholder="Enter meta_title"
                                   class="form-control" value="{{ old('meta_title', $page->translation()?->meta_title ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="meta_description">Meta description</label>
                            <input type="text" id="meta_description" name="meta_description"
                                   placeholder="Enter meta_description" class="form-control"
                                   value="{{ old('meta_description', $page->meta_description) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="meta_keywords">Meta keywords</label>
                            <textarea id="meta_keywords" name="meta_keywords" placeholder="Enter meta_keywords"
                                      class="form-control">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card meta-boxes mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Ngôn ngữ</h4>
                    </div>
                    <div class="card-body">
                        <input type="text" name="lang"
                               value="{{ $lang?->code ?? config('app.DEFAULT_LANG_ADMIN') }}" hidden>

                        <div id="list-others-language">
                            @foreach (Language::getSupportedLanguages()->where('code', '!=', $lang?->code ?? config('app.DEFAULT_LANG_ADMIN')) as $lang)
                                <a class="gap-2 d-flex align-items-center text-decoration-none"
                                   href="{{ route('admin.pages.edit', [$page->id, 'ref_lang' => $lang->code]) }}"
                                   target="_blank">
                                    <img src="{{ asset('backend/media/flags/' . $lang->flag . '.svg') }}"
                                         title="{{ $lang->name }}" class="flag" style="height: 16px" loading="lazy"
                                         alt="{{ $lang->name }} flag">
                                    <span>{{ $lang->name }}
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                            <path d="M11 13l9 -9"></path>
                                            <path d="M15 4h5v5"></path>
                                        </svg>
                                    </span>
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
                            @foreach (\App\Enums\BaseStatusEnum::cases() as $status)
                                <option value="{{ $status->value }}"
                                    {{ old('status', $page->status) == $status ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById('featured-image');
            const image = document.getElementById('img-preview');

            input.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    image.src = src;
                }
            });

            ClassicEditor.create(document.querySelector('#post-content'), {
                mediaEmbed: {
                    previewsInData: true
                },
                initialData: `{!! old('content', $page->content) !!}`
            }).catch(error => {
                console.error(error);
            }).then(newEditor => {
                window.editor = newEditor;
            });

            document.getElementById('post-title').addEventListener('keyup', function () {
                var title_input = this.value.toLowerCase();
                title_input = title_input.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                title_input = title_input.replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
                document.getElementById('post-slug').value = title_input;
            });
        });
    </script>
@endsection
