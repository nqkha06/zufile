@extends('layouts.admin')

@section('title', __('Cấp độ'))

@section('page-header-right')
    <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 5l0 14"></path>
            <path d="M5 12l14 0"></path>
        </svg>
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="card">

        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th class="text-start">Tên cấp độ</th>
                        <th>Count</th>
                        <th>Ngày tạo</th>

                        <th>Trạng thái</th>
                        <th class="text-nowrap language-header text-center sorting_disabled">
                            @foreach (Language::getSupportedLanguages() as $lang)
                                <img src="{{ asset('/core/img/flags/' . $lang->flag . '.svg') }}" title="{{ $lang->name }}"
                                    class="flag" style="height: 16px" loading="lazy" alt="English flag">
                            @endforeach
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($levelss->isEmpty())
                        <tr>
                            <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
                        </tr>
                    @else
                        @foreach ($levelss as $level)
                            <tr>
                                <td class="w-1 text-start no-column-visibility dtr-control"><span class="text-secondary">{{ $level->id }}</span></td>
                                <td class="text-start column-key-1">{{ $level->translation(config("app.DEFAULT_LANG_ADMIN"))?->name }}</td>
                                <td>{{ $level->links->count() }}</td>
                                <td>{{ $level->created_at }}</td>
                                <td>
                                    {!! $level->status->html() !!}
                                </td>
                                <td class="text-nowrap language-header text-center">
                                    <div class="text-center language-column">
                                        @foreach (getAllLanguages() as $lang)
                                        @if (false)
                                        <a href="{{ route('admin.levels.edit', $level->id) }}">
                                            <svg class="icon text-success" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg> </a>
                                        @else
                                        <a data-bs-toggle="tooltip"
                                        href="{{ route('admin.levels.edit', [
                                        $level->id,
                                        'ref_lang' => $lang->code
                                        ]) }}"
                                        aria-label="Sửa bản ngôn ngữ khác của bản ghi này"
                                        data-bs-original-title="Sửa bản ngôn ngữ khác của bản ghi này">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                        @endif
                                        @endforeach
                       

                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.levels.editPageload', $level->id) }}" class="btn btn-icon"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-symlink">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 21v-4a3 3 0 0 1 3 -3h5" />
                                            <path d="M9 17l3 -3l-3 -3" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M5 11v-6a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-9.5" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.levels.edit', $level->id) }}" class="btn btn-icon"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.levels.rate', $level->id) }}" class="btn btn-icon"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit rate">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.levels.editConfig', $level->id) }}" class="btn btn-icon"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Config">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-alt">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 8h4v4h-4z" />
                                            <path d="M6 4l0 4" />
                                            <path d="M6 12l0 8" />
                                            <path d="M10 14h4v4h-4z" />
                                            <path d="M12 4l0 10" />
                                            <path d="M12 18l0 2" />
                                            <path d="M16 5h4v4h-4z" />
                                            <path d="M18 4l0 1" />
                                            <path d="M18 9l0 11" />
                                        </svg>
                                    </a>
                                    <a href="#" class="btn btn-icon" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </a>

                                </td>
                            </tr>
                        @endforEach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $levelss->links('pagination.tabler') }}
        </div>
    </div>
@endsection
