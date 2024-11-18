
@extends('layouts.admin')

@section('title', __('Cấp độ'))

@section('page-header-right')
<a href="{{ route('admin.note_levels.create') }}" class="btn btn-primary">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>Id.</th>
                    <th>Tên cấp độ</th>
                    <th>Giá trị</th>
                    <th>Giới hạn</th>
                    <th>Số trang</th>
                    {{-- <th>Mô tả</th> --}}
                    <th>Count</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th></th>
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
                            <td>{{ $level->name }}</td>
                            <td>{{ $level->click_value }}</td>
                            <td>{{ $level->click_limit }}</td>
                            <td>{{ $level->minimum_pages }}</td>
                            {{-- <td>{{ $level->description }}</td> --}}
                            <td>{{ $level->links->count() }}</td>
                            <td>{{ $level->created_at }}</td>
                            <td>
                                @if ($level->status == 1)
                                    <span class="badge bg-green text-green-fg">Công khai</span>
                                @else
                                    <span class="badge bg-red text-red-fg">Riêng tư</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.note_levels.editPageload', $level->id) }}" class="btn btn-icon"
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
                                <a href="{{ route('admin.note_levels.edit', $level->id) }}" class="btn btn-icon"
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
                                <a href="{{ route('admin.note_levels.editConfig', $level->id) }}" class="btn btn-icon"
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
                                <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Remove">
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