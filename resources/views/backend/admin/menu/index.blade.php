@extends('layouts.admin')
@section('title', __('Admin: Menus'))

@section('page-header-right')
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
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

    <!-- Hiển thị các group menu và items -->
    <div>
        @foreach($menuGroups as $group)
        <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Menu: {{ $group->name }}</h3>
                    <p class="card-subtitle">
                        {{ $group->slug }}
                      </p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('admin.menus.edit', $group->id) }}" class="btn">
                        Chỉnh sửa
                    </a>
                    <form action="{{ route('admin.menus.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                            Xoá
                        </button>
                    </form>
                </div>
                
            </div>
            <div class="card-body">
                <ul>
                    @foreach($group->items as $item)
                        <li>
                            {{ $item->name }} ({{ $item->url }})
                            @if($item->children->isNotEmpty())
                                <ul>
                                    @foreach($item->children as $child)
                                        <li>{{ $child->name }} ({{ $child->url }})</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
        
    </div>
    <!-- Form thêm menu group và items -->
@endsection

