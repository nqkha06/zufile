@extends('layouts.blog2')

@section('title', $page_data['title'])

@section('og_title', $page_data['title'])
@section('og_description', $page_data['summary'])
@section('og_url', URL('/'))

@section('twitter_title', $page_data['title'])
@section('twitter_description', $page_data['summary'])
@section('twitter_url', URL('/'))

@push('styles')
    <link href="{{ asset('/fontend/stu/css/app.css') }}" rel="stylesheet" />
    <style>
      aside {
        display: none !important;
      }
    </style>
@endpush

@section('content')
    <!--[ Blog content ]-->

    <div class="section" id="main-widget">
        <div class="widget Blog" id="Blog1">

            <div class="blogPts fullP">
                <style>
                    /*<![CDATA[*/
                    .blogTopc,
                    .blogCont:before,
                    .blogCont:after {
                        display: none !important
                    }

                    /*]]>*/
                </style>

                <article class="ntry ps post">

                    <h1 class="pTtl aTtl itm">
                        <span> {{ $page_data['title'] }} </span>
                    </h1>

                    <div class="pInr">

                        <div class="pEnt" id="pageID-{{ $page_data['id'] }}">
                            <div class="pS post-body postBody" id="postBody">
                                {!! $page_data['content'] !!}
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </div>

@endsection
