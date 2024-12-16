@extends('layouts.admin')

@section('title', __('Check IP'))
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.users.check', $user) }}
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tổng IP: {{ $totalIps }}</h3>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>IP GROUP.</th>
                            <th>SỐ LƯỢNG</th>
                            <th>TỈ LỆ</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($paginatedData) && $paginatedData->count())
                        @foreach ($paginatedData as $key => $val)
                            <tr>
                                <td>
                                    {{ $key }}
                                </td>
                                <td>
                                    {{ $val['count'] }}
                                </td>
                                <td>
                                    {{ $val['percentage'] }}%
                                </td>

                                <td data-label="">
                                    <div class="btn-list flex-nowrap">
                                      
                                        <a class="btn btn-icon btn-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View List" data-bs-original-title="View List">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stack-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-8 4l8 4l8 -4l-8 -4" /><path d="M4 12l8 4l8 -4" /><path d="M4 16l8 4l8 -4" /></svg>
                                        </a>
                                        
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
                {{ $paginatedData->links('pagination.tabler') }}
            </div>

        </div>

    </div>

@endsection


