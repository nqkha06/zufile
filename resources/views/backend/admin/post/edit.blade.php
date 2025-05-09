@extends('layouts.admin')
@section('title', __('Sửa bài viết: ' . $post->title))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.posts.edit', $post) }}
@endsection

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="gap-3 col-md-9">

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label required" for="post-title">Post title</label>
                                <input type="text" id="post-title" name="title" value="{{ $post->title }}"
                                    placeholder="Enter post title" class="form-control">
                            </div>
                            <div class="mb-3 position-relative">
                                <label class="form-label required" for="slug">
                                    Permalink

                                </label>

                                <div class="input-group input-group-flat">

                                    <span class="input-group-text">
                                        {{ route('blog') .'/' }}
                                    </span>

                                    <input class="form-control ps-0" type="text" name="slug" id="slug"
                                        value="{{ $post->slug }}"
                                        required="required" />


                                    <span class="input-group-text slug-actions">
                                        <a href="#!" id="gen-slug" class="link-secondary" data-bs-toggle="tooltip" aria-label="Generate URL" data-bs-original-title="Generate URL">
                                            <svg class="icon  svg-icon-ti-ti-wand" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6 21l15 -15l-3 -3l-15 15l3 3" />
                                                <path d="M15 6l3 3" />
                                                <path d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                <path d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                            </svg>
                                        </a>
                                    </span>

                                </div>

                                <small class="form-hint mt-n2 text-truncate">Preview: <a
                                        href="{{ route('blog.article', $post->slug) }}"
                                        target="_blank">{{ route('blog.article', $post->slug) }}</a></small>
                           
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="post-description">Description</label>
                                <input type="text" id="post-description" name="description" value="{{ old('description', $post->description) }}"
                                    placeholder="Enter post description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="post-content">Post Content</label>
                                <textarea style="min-height: 300px" type="text" id="post-content" name="content" value=""
                                    placeholder="Enter post Content" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card meta-boxes mb-3" id="seo_wrap">
                    <div class="card-header">
                        <h4 class="card-title">
                            Search Engine Optimize
                        </h4>

                        <div class="card-actions">
                            <a href="#!" class="btn-trigger-show-seo-detail">
                                Edit SEO meta
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="seo-preview">
                            <p class="default-seo-description hidden">
                                Setup meta title &amp; description to make your site easy to discovered on search engines
                                such as Google
                            </p>

                            <div class="existed-seo-meta">

                                <h4 class="page-title-seo text-truncate">
                                    {{ $post->meta_title ?? $post->title }}
                                </h4>

                                <div class="page-url-seo">
                                    <p>{{ route('blog.article', $post->slug) }}
                                    </p>
                                </div>

                                <div>
                                    <span style="color: #70757a;">{{ blogFormatDateTime($post->created_at) }} - </span>
                                    <span class="page-description-seo">
                                        {{ !empty(old('seo_meta[seo_description]', $post->meta_description)) ? old('seo_meta[seo_description]', $post->meta_description) : old('description', $post->description) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="hidden seo-edit-section">
                            <hr class="my-4">
                            </hr>

                            <div class="mb-3 position-relative">

                                <label class="form-label" for="seo_meta[seo_title]">
                                    SEO Title
                                </label>


                                <input class="form-control" id="seo_meta[seo_title]" data-counter="70" placeholder="SEO Title"
                                    name="seo_meta[seo_title]" value="{{ $post->meta_title }}" type="text">
                            </div>

                            <div class="mb-3 position-relative">

                                <label class="form-label" for="seo_meta[seo_description]">
                                    SEO description

                                </label>

                                <textarea id="seo_meta[seo_description]" class="form-control" data-counter="160" rows="3" placeholder="SEO description" data-allow-over-limit
                                    name="seo_meta[seo_description]" cols="50" id="">{{ $post->meta_description }}</textarea>

                            </div>

                            <div class="mb-3 position-relative">

                                <label class="form-label" for="seo_meta[index]">
                                    Index
                                </label>


                                <div class="position-relative form-check-group">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" id="seo_meta[index]" type="radio"
                                            name="seo_meta[index]" value="index" checked>

                                        <span class="form-check-label">Index</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" id="seo_meta[index]" type="radio"
                                            name="seo_meta[index]" value="noindex">

                                        <span class="form-check-label">No index</span>
                                    </label>
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
                            Publish
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-list">
                            <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Save

                            </button>

                            <button class="btn" type="submit" name="submitter" value="save">
                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
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
                                <option value="{{ $status->value }}" @selected(old('status', $status->value) == $post->status->value)>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label class="form-label" for="categories[]">
                                Categories
                            </label>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-icon">
                                <input type="text" id="search-category-input-225217574" class="form-control"
                                    placeholder="Search..." onkeyup="filter_categories(225217574)" formnovalidate="">
                                <span class="input-icon-addon">
                                    <svg class="icon  svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg> </span>
                            </div>
                        </div>

                        <div data-bb-toggle="tree-checkboxes" class="tree-categories-list-225217574">
                            <ul class="list-unstyled ">
                                @foreach ($categories as $category)
                                    <li>
                                        <label class="form-check" style="">
                                            <input type="checkbox" name="categories[]" class="form-check-input"
                                                value="{{ $category->id }}" @checked($post->categories()->where('category_id', $category->id)->first())>

                                            <span class="form-check-label">
                                                {{ $category->name }}
                                            </span>

                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            function filter_categories(inputSearchId) {
                                const searchInput = document.getElementById('search-category-input-' + inputSearchId).value.toLowerCase();
                                const categories = document.querySelectorAll('.tree-categories-list-' + inputSearchId + ' label');

                                categories.forEach(category => {
                                    const text = category.textContent.toLowerCase();
                                    category.style.display = text.includes(searchInput) ? '' : 'none';
                                });
                            }
                        </script>
                    </div>
                </div>
                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label class="form-label" for="categories[]">
                                Image
                            </label>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="image-box image-box-avatar_image" action="select-image" data-counter="250">
                            <input class="image-data" name="avatar_image" type="hidden" value="" data-counter="250">
                        
                            
                            <div style="width: 8rem" class="preview-image-wrapper mb-1">
                                <div class="preview-image-inner">
                                    <label for="featured-image" class="image-box-actions" data-result="avatar_image" data-allow-thumb="1">
                                        <img class="preview-image default-image" src="{{ $post->image ?? 'https://cms.botble.com/vendor/core/core/base/images/placeholder.png' }}" alt="Preview image">
                                        <span class="image-picker-backdrop"></span>
                                    </label>
                                    <button class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="--bb-btn-font-size: 0.5rem; display: none;" type="button" data-bb-toggle="image-picker-remove" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Remove image" data-bs-original-title="Remove image" aria-describedby="tooltip955336" title="Remove image">
                                                <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M18 6l-12 12"></path>
                          <path d="M6 6l12 12"></path>
                        </svg>            
                            
                                </button>
                                </div>
                            </div>
                        
                            <label for="featured-image" class="color-link" data-allow-thumb="1" href="#">
                                Choose image
                            </label>
                        
                                    {{-- <div data-bb-toggle="upload-from-url">
                                    <span class="text-muted">or</span>
                                    <a href="javascript:void(0)" class="mt-1" data-bs-toggle="modal" data-bs-target="#image-picker-add-from-url" data-bb-target=".image-box-avatar_image">
                                        Add from URL
                                    </a>
                                </div> --}}
                            </div>
                        <div class="mb-3">
                            <input type="file" id="featured-image" class="hidden form-control" name="image">
                            <label class="preview" for="featured-image">
                                <img id="img-preview" src="{{ $post->image ?? '/img.png' }}" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card meta-boxes">
                    <div class="card-header">
                        <h4 class="card-title">
                            <label class="form-label" for="tags[]">
                                Tags
                            </label>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-icon">
                                <input type="text" id="search-tags-input-225217574" class="form-control"
                                    placeholder="Search..." onkeyup="filter_tags(225217574)" formnovalidate="">
                                <span class="input-icon-addon">
                                    <svg class="icon  svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg> </span>
                            </div>
                        </div>

                        <div data-bb-toggle="tree-checkboxes" class="tree-tags-list-225217574">
                            <ul class="list-unstyled ">
                                @foreach ($tags as $tag)
                                    <li>
                                        <label class="form-check" style="">
                                            <input type="checkbox" name="tags[]" class="form-check-input"
                                                value="{{ $tag->id }}" @checked($post->tags()->where('tag_id', $tag->id)->first())>

                                            <span class="form-check-label">
                                                {{ $tag->name }}
                                            </span>

                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            function filter_tags(inputSearchId) {
                                const searchInput = document.getElementById('search-tags-input-' + inputSearchId).value.toLowerCase();
                                const categories = document.querySelectorAll('.tree-tags-list-' + inputSearchId + ' label');

                                categories.forEach(category => {
                                    const text = category.textContent.toLowerCase();
                                    category.style.display = text.includes(searchInput) ? '' : 'none';
                                });
                            }
                        </script>
                    </div>
                        
            </div>
        </div>

    </form>
@endsection

@push('styles')
    <style>
        #seo_wrap {
            position: relative
        }

        #seo_wrap .seo-preview * {
            word-break: break-all
        }

        #seo_wrap .seo-preview .page-title-seo {
            color: #1a0dab;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 2px
        }

        #seo_wrap .seo-preview .page-title-seo p {
            margin-bottom: 0
        }

        #seo_wrap .seo-preview .page-index-status {
            color: var(--bb-warning);
            display: inline-block;
            font-size: 14px
        }

        #seo_wrap .seo-preview .page-description-seo p {
            color: #545454;
            display: block;
            font-size: 13px;
            line-height: 18px
        }

        #seo_wrap .seo-preview .page-url-seo p {
            word-wrap: break-word;
            color: #006621;
            display: block;
            font-size: 13px;
            line-height: 16px;
            margin-bottom: 2px
        }

        #seo_wrap .seo-preview.noindex,
        #seo_wrap .seo-preview.noindex .page-title-seo,
        #seo_wrap .seo-preview.noindex .page-url-seo p {
            color: var(--bb-secondary-color) !important;
            text-decoration-line: line-through
        }

        [data-bs-theme=dark] #seo_wrap .seo-preview .page-title-seo {
            color: #8ab4f8
        }

        [data-bs-theme=dark] #seo_wrap .seo-preview .page-url-seo p {
            color: #74cd91
        }

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

        .preview-image-wrapper {
    border: 1px solid #dce1e7;
    border-radius: 8px;
    overflow: hidden
}

.preview-image-wrapper .preview-image-inner {
    overflow: hidden;
    padding-top: 100%;
    position: relative;
    width: 100%
}

.preview-image-wrapper .preview-image-inner img.default-image {
    padding: 10px
}

.preview-image-wrapper .preview-image-inner .preview-image {
    height: 100%;
    inset: 0;
    -o-object-fit: cover;
    object-fit: cover;
    position: absolute;
    width: 100%
}

.preview-image-wrapper .preview-image-inner .image-box-actions {
    height: 100%;
    inset: 0;
    position: absolute;
    width: 100%;
    z-index: 11
}

.preview-image-wrapper .preview-image-inner .image-box-actions a {
    cursor: pointer
}

.preview-image-wrapper .preview-image-inner .image-picker-backdrop {
    inset: 0;
    position: absolute;
    transition: .3s
}

.preview-image-wrapper .preview-image-inner:hover .image-picker-backdrop {
    background-color: rgba(0,0,0,.5);
    height: 100%;
    width: 100%;
    z-index: 10
}

.preview-image-wrapper .preview-image-inner .image-picker-remove-button {
    position: absolute;
    right: 5px;
    top: 5px;
    z-index: 12
}

.preview-image-wrapper .preview-image-inner .image-picker-remove-button button {
    border-radius: 50%;
    height: 20px;
    width: 20px
}
    </style>
@endpush
@push('scripts')
<script src="{{ asset('js/ckeditor5/ckeditor.js') }}"></script>
<script>
class PostEditor {
    constructor() {
        this.initializeElements();
        this.attachEventListeners();
        this.initializeCKEditor();
    }

    initializeElements() {
        this.elements = {
            title: document.getElementById('post-title'),
            slug: document.getElementById('slug'),
            description: document.getElementById('post-description'),
            genSlug: document.getElementById('gen-slug'),
            editSeoMeta: document.querySelector('#seo_wrap .btn-trigger-show-seo-detail'),
            seoTitle: document.getElementById('seo_meta[seo_title]'),
            seoDescription: document.getElementById('seo_meta[seo_description]'),
            featuredImage: document.getElementById('featured-image'),
            imagePreview: document.getElementById('img-preview')
        };
    }

    attachEventListeners() {
        // Image preview
        this.elements.featuredImage?.addEventListener('change', this.handleImagePreview.bind(this));

        // Slug generation
        this.elements.genSlug?.addEventListener('click', () => 
            this.elements.slug.value = this.convertToSlug(this.elements.title.value)
        );

        // SEO meta toggle
        this.elements.editSeoMeta?.addEventListener('click', () => 
            document.querySelector('#seo_wrap .seo-edit-section').classList.toggle('hidden')
        );

        // Live preview updates
        this.setupLivePreview();
    }

    setupLivePreview() {
        const updatePreview = (inputEl, previewEl, defaultInputEl = null) => {
            inputEl?.addEventListener('input', () => {
                const preview = document.querySelector(previewEl);
                if (preview) {
                    if (defaultInputEl && !inputEl.value) {
                        preview.innerText = defaultInputEl.value;
                    } else {
                        preview.innerText = inputEl.value;
                    }
                }
            });
        };

        updatePreview(this.elements.seoTitle, '#seo_wrap .page-title-seo', this.elements.title);
        updatePreview(this.elements.slug, '#seo_wrap .page-url-seo>p');
        updatePreview(this.elements.seoDescription, '#seo_wrap .page-description-seo', this.elements.description);
    }

    async initializeCKEditor() {
        try {
            const editor = await ClassicEditor.create(document.querySelector('#post-content'), {
                mediaEmbed: { previewsInData: true },
                initialData: `{!! $post->content !!}`
            });
            window.editor = editor;
        } catch (error) {
            console.error('CKEditor initialization failed:', error);
        }
    }

    handleImagePreview(event) {
        if (event.target.files.length) {
            const src = URL.createObjectURL(event.target.files[0]);
            this.elements.imagePreview.src = src;
        }
    }

    convertToSlug(text) {
        return text.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
    }
}

document.addEventListener('DOMContentLoaded', () => new PostEditor());
</script>
@endpush
