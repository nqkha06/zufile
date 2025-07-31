@extends('layouts.admin')

@section('title', __('Cấp độ'))

@section('page-header-right')
    <a href="{{ route('admin.note_levels.create') }}" class="btn btn-primary">
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
        <div class="card-header">
            <h3 class="card-title">Danh sách cấp độ</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Tên cấp độ</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th class="language-header text-center sorting_disabled">
                            @foreach (Language::getSupportedLanguages() as $lang)
                                <img src="{{ asset('backend/media/flags/' . $lang->flag . '.svg') }}"
                                    title="{{ $lang->name }}" class="flag" style="height: 16px" loading="lazy"
                                    alt="English flag">
                            @endforeach
                        </th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($levelss->isEmpty())
                        <tr>
                            <td>KHÔNG CÓ DỮ LIỆU</td>
                        </tr>
                    @else
                        @foreach ($levelss as $level)
                            <tr>
                                <td><span class="text-secondary">{{ $level->id }}</span></td>
                                <td>{{ $level->translation(config('app.DEFAULT_LANG_ADMIN'))?->name }}</td>
                                <td>{{ $level->created_at }}</td>

                                <td>
                                    @if ($level->status == \App\Enums\BaseStatusEnum::PUBLISHED)
                                        <span class="badge bg-green text-green-fg">Công khai</span>
                                    @else
                                        <span class="badge bg-red text-red-fg">Riêng tư</span>
                                    @endif
                                </td>
                                <td class="language-header text-center">
                                    <div class="text-center language-column">
                                        @foreach (getAllLanguages() as $lang)
                                            @if (false)
                                                <a href="{{ route('admin.note_levels.edit', $level->id) }}">
                                                    <svg class="icon text-success" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M5 12l5 5l10 -10"></path>
                                                    </svg> </a>
                                            @else
                                                <a
                                                    href="{{ route('admin.note_levels.edit', [$level->id, 'ref_lang' => $lang->code]) }}">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                        </path>
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
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('admin.note_levels.edit', $level->id) }}"
                                            class="btn btn-primary">
                                            Edit
                                        </a>

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top" role="button"
                                                aria-expanded="false" data-bs-toggle="dropdown" >
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.note_levels.editPageload', $level->id) }}">
                                                    Edit Pageload
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.note_levels.rate', $level->id) }}">
                                                    Edit Rate
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.note_levels.editConfig', $level->id) }}">
                                                    Edit Config
                                                </a>
                                                <a class="dropdown-item text-danger" href="#">
                                                    Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
