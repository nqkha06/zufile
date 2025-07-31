@extends('layouts.admin')
@section('title', __('Chỉnh sửa rate: ' . $level->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.note_levels.edit', $level) }}
@endsection

@section('content')
    <form action="{{ route('admin.note_levels.postRate', $level->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="gap-3 col-md-9">

                <div class="card mb-3">

                    <div class="card-body">
                        <div class="row gap-5">
                            <div class="col-12">
                                <!-- Dòng nhập giá trị thông thường -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        Worldwide Deal(All Countries)
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[all][0]" value="{{ old("value[all][0]", isset($rates['ALL']) ? $rates['ALL'][0] : "") }}"
                                                class="form-control desktop-country" placeholder="Desktop"
                                                id="value-alll-0" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[all][1]" value="{{ old("value[all][1]", isset($rates['ALL']) ? $rates['ALL'][1] : "") }}"
                                                class="form-control mobile-country" placeholder="Mobile / Tablet"
                                                id="value-alll-1" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dòng nhập View Limit Daily cho Desktop và Mobile/Tablet -->
                                <div class="row mt-2">
                                    <div class="col-sm-4">
                                        <label>Limit Daily (Worldwide Deal - All Countries)</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[all][2]" value="{{ old("value[all][2]", isset($rates['ALL']) ? $rates['ALL'][2] : "") }}"
                                                class="form-control desktop-value" placeholder="Desktop Limit Daily"
                                                id="value-all-2" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[all][3]" value="{{ old("value[all][3]", isset($rates['ALL']) ? $rates['ALL'][3] : "") }}"
                                                class="form-control mobile-value" placeholder="Mobile/Tablet Limit Daily"
                                                id="value-all-3" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($countries as $country)
                            <div class="col-12">
                                <!-- Dòng nhập giá trị thông thường -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        {{ $country->name }}
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[{{ strtolower($country->abv) }}][0]"
                                            value="{{ old("value[".strtolower($country->abv)."][0]", $rates[$country->abv][0] ?? '') }}"
                                                class="form-control desktop-country" placeholder="Desktop"
                                                id="value-{{ strtolower($country->abv) }}-0" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[{{ strtolower($country->abv) }}][1]"
                                            value="{{ old("value[".strtolower($country->abv)."][1]", $rates[$country->abv][1] ?? '') }}"
                                                class="form-control mobile-country" placeholder="Mobile / Tablet"
                                                id="value-{{ strtolower($country->abv) }}-1" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dòng nhập View Limit Daily cho Desktop và Mobile/Tablet -->
                                <div class="row mt-2">
                                    <div class="col-sm-4">
                                        <label>Limit Daily ({{ $country->name }})</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[{{ strtolower($country->abv) }}][2]"
                                            value="{{ old("value[".strtolower($country->abv)."][2]", $rates[$country->abv][2] ?? '') }}"
                                                class="form-control desktop-limit" placeholder="Desktop Limit Daily"
                                                id="value-{{ strtolower($country->abv) }}-2" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="value[{{ strtolower($country->abv) }}][3]"
                                            value="{{ old("value[".strtolower($country->abv)."][3]", $rates[$country->abv][3] ?? '') }}"
                                                class="form-control mobile-limit" placeholder="Mobile/Tablet Limit Daily"
                                                id="value-{{ strtolower($country->abv) }}-3" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

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
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
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

            </div>
        </div>

    </form>
@endsection
