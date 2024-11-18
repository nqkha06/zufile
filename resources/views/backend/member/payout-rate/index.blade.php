@extends('layouts.member')

@section('title', __('payout.title'))

@section('content')
    <style>
        .level {
            padding: 2px 7px;
            border-radius: 4px;
            text-align: center;
        }

        .level.one {
            background: #efeeee;
            color: #656e77;
        }

        .level.two {
            background: #efe3fa;
            color: #6200ee;
        }

        .level.three {
            background: #e5ecf1;
            color: #015692;
        }

        .level.four {
            background: #f7ece2;
            color: #b75501;
        }

        .level.five {
            background: #edefe3;
            color: #54790d;
        }

        .level.six {
            background: #e3e9fa;
            color: #001eee;
        }
    </style>

    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-flag"></i></div>
                <div class="title">Tỷ lệ cấp độ</div>
            </div>
        </div>

        <div class="box-container">
            <div class="content" style="overflow: auto;">
                <table class="table table-mobile-md">
                    <thead>
                        <tr>
                            <th style="word-break:break-all;min-width:120px">#Cấp độ</th>
                            <th style="word-break:break-all;min-width:200px">#View/ip/24h</th>
                            <th style="word-break:break-all;min-width:350px">#Mô tả</th>
                            <th style="word-break:break-all;min-width:120px">#Tỷ lệ</th>
                            <th style="word-break:break-all;min-width:150px">#Thử nghiệm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($level_paginted as $level)
                            <tr>
                                <td data-label="#Cấp độ"><span class="level two">{{ $level['name'] }}</span></td>
                                <td data-label="#View/ip/24h">{{ $level['click_limit'] }} lượt xem</td>
                                <td data-label="#Mô tả">{{ $level['description'] }}</td>
                                <td data-label="#Tỷ lệ">${{ $level['click_value'] * 1000 }}/1000 lượt xem</td>
                                <td data-label="#Thử nghiệm"><a href="{{ $level['test_link'] }}"
                                        target="_blank">Test_link</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $level_paginted->links('pagination.default') }}
        </div>
    </div>


@endsection
