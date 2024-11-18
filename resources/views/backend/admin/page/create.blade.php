@extends('layouts.admin')
@section('title', __('Trang trang mới'))

@section('content')
    <div class="row row-deck">
        <div class="col-12">
            <form class="form card" action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="mb-3">
                                <label class="form-label required" for="post-title">Post title</label>
                                <input value="{{ old('title') }}" type="text" id="post-title" name="title" placeholder="Enter post title"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="post-slug">Slug</label>
                                <input value="{{ old('slug') }}" type="text" id="post-slug" name="slug" placeholder="Enter post slug"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="post-description">Description</label>
                                <input type="text" id="post-description" name="description" value="{{ old('description') }}"
                                    placeholder="Enter post description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="post-content">Post Content</label>
                                <textarea style="min-height: 300px" type="text" id="post-content" name="content" value="{{ old('content') }}"
                                    placeholder="Enter post Content" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="featured-image">Post featured image</label>
                                <input type="file" id="featured-image" class="form-control" name="image">
                                <label class="preview" for="featured-image">
                                    <img id="img-preview" src="/img.png" />
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">[--Chọn--]</option>
                                    <option value="public" @selected(old('status') == 'public')>Công khai</option>
                                    <option value="private" @selected(old('status') == 'private')>Riêng tư</option>
                                    <option value="draft" @selected(old('status') == 'draft')>Nháp</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="meta_title">Meta title</label>
                                <input type="text" id="meta_title" name="meta_title" placeholder="Enter meta_title" class="form-control" value="{{ old('meta_title') }}">
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label" for="meta_description">Meta description</label>
                                <input type="text" id="meta_description" name="meta_description" placeholder="Enter meta_description" class="form-control" value="{{ old('meta_description') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta_keywords">Meta keywords</label>
                                <textarea type="text" id="meta_keywords" name="meta_keywords" placeholder="Enter meta_keywords" class="form-control">{{ old('meta_keywords') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <input class="btn btn-primary" type="submit" name="submit" value="Lưu lại">
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <script src="https://link4sub.qkt/js/ckeditor5/ckeditor.js"></script>

    <style>
        .ck-editor__editable_inline {
            height: 400px;
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
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById('featured-image');
            const image = document.getElementById('img-preview');

            input.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    image.src = src;
                }
            });
            ClassicEditor.create(document.querySelector('#post-content'), {
                    // ckfinder: {
                    //     uploadUrl: '/ckeditor/upload?_token=' + CR_TOKEN,
                    // },
                    mediaEmbed: {
                        previewsInData: true
                    },
                })
                .catch(error => {
                    console.error(error);
                }).then(newEditor => {
                    window.editor = newEditor;
                });
        });
    </script>

    <script>
        document.getElementById('post-title').addEventListener('keyup', function() {
            var title_input = this.value;
            title_input = title_input.toLowerCase();
            title_input = title_input.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
            title_input = title_input.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
            title_input = title_input.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
            title_input = title_input.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
            title_input = title_input.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
            title_input = title_input.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
            title_input = title_input.replace(/đ/g, 'd');
            title_input = title_input.replace(/\[|\]|\(|\)|'|"|`|\\|%|!|#|\$|&|=|~|\^|<|>|\?|\/|\{|\}|\*|\||@|:|;/g,
                '');
            title_input = title_input.replace(/,|\.|-| |_|\+/g, '-');
            title_input = title_input.replace(/-{2,}/g, '-');
            document.getElementById('post-slug').value = title_input;
        });
    </script>
@endpush
