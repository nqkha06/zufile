@extends('layouts.clients.home_layout')

@section('title', $page_data['title'])

@section('meta_seo')
    <meta name="description" content="{{ $page_data['content'] }}">
    <meta name="keywords" content="{{ $page_data['meta_keywords'] }}">
    <meta property="og:title" content="{{ $page_data['title'] }}" />
    <meta property="og:description" content="{{ $page_data['content'] }}" />
    <meta property="og:image" content="{{ $page_data['image'] }}" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta name="twitter:title" content="{{ $page_data['title'] }}" />
    <meta name="twitter:description" content="{{ $page_data['content'] }}" />
    <meta name="twitter:image" content="{{ $page_data['image'] }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('content')

<main class="bg-white px-6 py-20 sm:py-24 lg:px-8 border-b">
    <article class="prose mx-auto">
        <header class="text-center">
            <h1>{{ $page_data->title }}</h1>
        </header>
        {!! $page_data->content !!}

    </article>
</main>
@endsection
