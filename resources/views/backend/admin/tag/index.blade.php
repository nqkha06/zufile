@extends('layouts.admin')
@section('title', __('Blog: Thẻ'))
@section('page-header-right')
<a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
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
  <div class="card-header">
    <h3 class="card-title">Quản lý thẻ</h3>
  </div>
  <div class="table-responsive">
    <table class="table table-vcenter card-table table-striped">
      <thead>
        <tr>
          <th>Tên</th>
          <th>Slug</th>
          <th>Mô tả</th>
          <th>Count</th>
          <th>Trạng thái</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @if(count($tags))
            @foreach($tags as $key=>$value)
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->slug }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->posts()->count() }}</td>
                    <td>{!! isset($value->status) ? $value->status->html() : '' !!}</td>
                    <td style="white-space: nowrap">
                        <div class="btn-list flex-nowrap">
                            <a class="btn btn-primary" href="{{ route('admin.tags.edit', $value->id) }}" >
                              Edit
                            </a>
                            <form action="{{ route('admin.tags.destroy', $value->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-red" type="button" onclick="confirm('{{ __('Bạn chắc chắn sẽ xoá nó chứ?') }}') ? this.closest('form').submit() : ''">
                                    Delete
                                </button>
                            </form>
                          
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
        </tr>
        @endif
        
  
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex align-items-center">
    {{ $tags->links('pagination.tabler') }}
  </div>
</div>
@endsection
