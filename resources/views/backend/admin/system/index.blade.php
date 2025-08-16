@extends('layouts.admin')

@section('title', __('Cấu hình chung'))

@section('content')
    <div class="card general">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end general-panel">
                <div class="card-body">
                    <div class="list-group list-group-transparent">
                        <button class="list-group-item list-group-item-action d-flex align-items-center active"
                            data-tab="tab_web">Cấu hình WEB</button>
                        <button class="list-group-item list-group-item-action d-flex align-items-center"
                            data-tab="tab_stu">Cấu hình Ads download</button>
                        <button class="list-group-item list-group-item-action d-flex align-items-center"
                            data-tab="tab_note">Cấu hình NOTE</button>
                        <button class="list-group-item list-group-item-action d-flex align-items-center"
                            data-tab="tab_optimal">Tối ưu</button>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column general-config">
                <form action="{{ route('admin.general.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h2 class="mb-4">Cấu hình</h2>
                        <div id="tab_web" class="">
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label required">Tên website</div>
                                        <input type="text" class="form-control"
                                            value="{{ old('web_name', $settings['web_name'] ?? 'Link4Sub') }}"
                                            name="web_name">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label required">URL</div>
                                        <input type="url" class="form-control"
                                            value="{{ old('web_url', $settings['web_url'] ?? 'https://link4sub.qkt') }}"
                                            name="web_url">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label required">Từ khoá</div>
                                        <textarea style="min-height:150px" type="text" class="form-control" name="web_keywords">{{ old('web_keywords') ?? $settings['web_keywords'] }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label required">Mô tả ngắn</div>
                                        <textarea style="min-height:150px" type="url" class="form-control" name="web_description">{{ old('web_description') ?? $settings['web_description'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label">Favicon</div>
                                        <input type="file" id="featured-favicon" class="form-control" name="web_favicon">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label">Image</div>
                                        <input type="file" id="featured-image" class="form-control" name="web_image">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="preview card p-2" for="featured-favicon">
                                            <img id="favicon-preview"
                                                src="{{ old('web_favicon', $settings['web_favicon'] ?? '/img.png') }}">
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="preview card p-2" for="featured-image">
                                            <img id="image-preview"
                                                src="{{ old('web_image', Setting::get('web_image') ?? '/img.png') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-label">Logo</div>
                                        <input type="file" id="site-logo" class="form-control" name="site_logo">
                                    </div>

                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Chuyển đổi VNĐ</label>
                                <input type="text" class="form-control"
                                    value="{{ old('usd_to_vnd', Setting::get('usd_to_vnd') ?? 0) }}" name="usd_to_vnd">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">% Hoa hồng giới thiệu</label>
                                <input type="text" placeholder="Nhập phần trăm hoa hồng, ví dụ: 10" class="form-control"
                                    value="{{ old('ref_percent', Setting::get('ref_percent') ?? 0) }}" name="ref_percent">
                            </div>
                        </div>
                        <div id="tab_stu" class="d-none">
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <div class="form-label required">Direct button</div>
                                    <input type="text" class="form-control"
                                        value="{{ old('direct_link_onclick_btn', Setting::get("direct_link_onclick_btn")) }}"
                                        name="direct_link_onclick_btn">
                                </div>
                                <div class="mb-4 col-12">
                                    <div class="form-label required">Direct link fake button</div>
                                    <input type="text" class="form-control" name="direct_link_fake_btn"
                                        value="{{ old('direct_link_fake_btn', Setting::get('direct_link_fake_btn')) }}">
                                </div>



                            </div>
                        </div>
                        <div id="tab_note" class="d-none">
                            <div class="mb-4">
                                <div class="form-label required">URL Ngắn</div>
                                <input type="url" class="form-control"
                                    value="{{ old('note_url', $settings['note_url'] ?? env('APP_URL') . '/note') }}"
                                    name="note_url">
                            </div>
                            <div class="mb-4">
                                <div class="form-label required">Độ dài Alias</div>
                                <input type="number" class="form-control"
                                    value="{{ old('note_length', $settings['note_length'] ?? 4) }}" name="note_length">
                            </div>

                        </div>
                        <div id="tab_optimal" class="d-none">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Xoá bộ nhớ đệm (ref)</label>
                                    <button type="submit" name="action" value="ref" class="btn btn-danger"
                                        onclick="return confirm('Bạn có muốn xoá tất cả bộ nhớ đệm ref không?')">Xoá
                                        ngay</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Xoá bộ nhớ đệm (access)</label>
                                    <button type="submit" name="action" value="access" class="btn btn-danger"
                                        onclick="return confirm('Bạn có muốn xoá tất cả bộ nhớ đệm access không?')">Xoá
                                        ngay</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <input value="Lưu" type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const buttons = document.querySelectorAll(".general .general-panel button");

            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    const activeTab = button.getAttribute("data-tab");

                    buttons.forEach(btn => {
                        const tab = btn.getAttribute("data-tab");
                        btn.classList.remove("active");

                        if (tab) {
                            document.getElementById(tab).classList.add("d-none");
                        }
                    });

                    button.classList.add("active");

                    if (activeTab) {
                        document.getElementById(activeTab).classList.remove("d-none");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inpF = document.getElementById('featured-favicon');
            const prevF = document.getElementById('favicon-preview');

            const inpI = document.getElementById('featured-image');
            const prevI = document.getElementById('image-preview');

            inpF.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    prevF.src = src;
                }
            });
            inpI.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    prevI.src = src;
                }
            });
        });
    </script>
@endsection
