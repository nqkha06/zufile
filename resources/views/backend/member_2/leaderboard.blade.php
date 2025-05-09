@extends('layouts.member_2')

@section('title', __('Bảng xếp hạng'))
@php
    function maskName($name) {
        // return $name;

        $fixedLength = 8;
        $name = trim($name);
        $visible = mb_substr($name, 0, 2);
        $masked = str_repeat('*', max(0, $fixedLength - mb_strlen($visible)));

        return $visible . $masked;
    }
@endphp
@push('styles')
<style>


    .leaderboard__top-user {
        background: linear-gradient(135deg, #6B73FF, #6366F1);
        color: #fff;
        padding: 30px 10px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 25px;
        box-shadow: 0 5px 10px rgba(99, 102, 241, 0.2);
    }

    .leaderboard__top-user-image {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    .leaderboard__top-user-name {
        margin-top: 15px;
        color: #fff;

        font-size: 1.25rem;
        font-weight: 600;
    }

    .leaderboard__top-user-points {
        font-size: 1rem;
        margin-bottom: 8px;
        opacity: 0.9;
    }

    .leaderboard__badge {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 5px 12px;
        font-weight: 600;
    }

    .leaderboard__list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .leaderboard__list-item {
        display: flex;
        align-items: center;
        border-radius: 15px;
        padding: 15px;
        transition: transform 0.2s;
    }

    .leaderboard__list-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .leaderboard__rank {
        flex: 0 0 30px;
        font-size: 1.1rem;
        font-weight: 700;
        color: #6366F1;
    }

    .leaderboard__user {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .leaderboard__user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: cover;
    }

    .leaderboard__user-name {
        font-weight: 600;
        color: #333;
    }
/* 
    .leaderboard__points {
        flex: 0 0 100px;
        text-align: right;
        font-weight: 600;
        color: #6366F1;
    } */
    .leaderboard__points {
        flex: 0 0 90px;
        text-align: right;
        background-color: #e9ecef;
        color: #6c757d;
        padding: 4px 8px;
        border-radius: 50px;
        font-size: 0.9rem;
    }
    .leaderboard__footer {
        text-align: center;
        margin-top: 20px;
    }

    
    .reward-card {
      border-radius: 15px;
    }
    
    .reward-header {
        background-color: #6366F1;
      color: white;
      border-radius: 15px 15px 0 0;
      padding: 15px;
    }
    
   
    .btn-primary {
        background-color: #6366F1;
        border-color: #6366F1;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #4F46E5;
        border-color: #4F46E5;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 70, 229, 0.2);
    }
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->

    <div id="kt_app_content_container" class="app-container">
            <div class="row g-5 g-xl-8">
                <div class="col-lg-12 col-12">
                    <div class="leaderboard">

                        @php
                            // Lấy user đứng đầu (nếu có)
                            $topUser = $users->first();
                        @endphp

                        @if($topUser)
                            <div class="leaderboard__top-user">
                                {{-- Ảnh đại diện top user, bạn có thể thay link/avatar thật tại đây --}}
                                <img src="{{ Setting::get('web_favicon') }}" alt="Top User"
                                     class="leaderboard__top-user-image">
                                
                                <h4 class="leaderboard__top-user-name">
                                    {{-- Lấy tên user qua quan hệ: --}}
                                    {{ maskName(optional($topUser->user)->name ?? 'N/A') }}
                                </h4>

                                <p class="leaderboard__top-user-points">
                                    {{ $topUser->total_views }} views
                                </p>
                                <span class="leaderboard__badge">🥇 Hạng 1</span>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body p-3">
                                       {{-- Danh sách các user còn lại --}}
                        <ul class="leaderboard__list">
                            @foreach($users->skip(1) as $index => $userItem)
                                @php 
                                    // Thứ hạng thực tế (bắt đầu từ 2)
                                    $actualRank = $index + 1; 
                                    // Hoặc bạn có thể tính rank = $loop->iteration + 1 nếu dùng $loop
                                @endphp
                                <li class="leaderboard__list-item">
                                    <div class="leaderboard__rank">
                                        @switch($actualRank)
                                            @case(2)
                                                🥈
                                                @break
                                            @case(3)
                                                🥉
                                                @break
                                            @default
                                                {{ $actualRank }}
                                        @endswitch
                                    </div>
                                    <div class="leaderboard__user">
                                        {{-- Ảnh đại diện (tùy chỉnh) --}}
                                        <img src="{{ Setting::get('web_favicon') }}"
                                             class="leaderboard__user-avatar" 
                                             alt="{{ maskName(optional($userItem->user)->name) }}">
                                        <span class="leaderboard__user-name">
                                            {{ maskName(optional($userItem->user)->name ?? 'N/A') }}
                                        </span>
                                    </div>
                                    <div class="leaderboard__points">
                                        {{ $userItem->total_views }} views
                                    </div>
                                </li>
                            @endforeach
                            <style>
                                .divider-text {
    position: relative;
    text-align: center;
    margin: 15px 0;
}.divider-text:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    width: 42%;
    border-top: 1px dashed #ddd;
}.divider-text:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 0;
    width: 42%;
    border-top: 1px dashed #ddd;
}
                            </style>
                            <div class="divider-text">
                                <span class="px-2 bg-white text-muted">...</span>
                            </div>
                            <li class="leaderboard__list-item">
                                <div class="leaderboard__rank">12</div>
                                <div class="leaderboard__user">
                                    <img src="{{ Setting::get('web_favicon') }}"
                                         class="leaderboard__user-avatar"
                                         alt="Bạn">
                                    <span class="leaderboard__user-name">David Wick (Bạn)</span>
                                </div>
                                <div class="leaderboard__points">840 views</div>
                            </li>
                        </ul>
                            </div>
                        </div>
                 

            

                      
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
