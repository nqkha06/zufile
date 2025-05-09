@extends('layouts.blog2')

@section('title', $category->name)

@section('title', $category['meta_title'] ?? $category['name'])
@section('meta_description', $category['meta_description'] ?? $category['description'])
@section('meta_keywords', $category['meta_keywords'])
@section('meta_author', 'QK06')

@section('og_title', $category['meta_title'] ?? $category['name'])
@section('og_description', $category['meta_description'] ?? $category['description'])
@section('og_image', URL('/') . $category['image'])
@section('og_url', URL('/'))

@section('twitter_title', $category['meta_title'] ?? $category['name'])
@section('twitter_description', $category['meta_description'] ?? $category['description'])
@section('twitter_image', URL('/') . $category['image'])
@section('twitter_url', URL('/'))


@section('content')
    <div class="section" id="main-widget">
        <div class="widget Blog" data-version="2" id="Blog1">
            <div class="blogTtl">
                <div class="t srch">
                    <span class="hm" data-text="Home"></span> {{ $category->name }}
                </div>
            </div>
            <div class="blogPts">
				@foreach ($category->publishedPosts as $post)
				<article class="ntry">
					<div class="pThmb">
						<a class="thmb" href="{{ route('blog.article', $post['slug']) }}">
							<img alt="{{ $post['title'] }}" class="imgThm lazy" src="{{ $post['image'] }}" lazied>
							<noscript><img alt='{{ $post['title'] }}' class='imgThm' src='{{ $post['image'] }}' /></noscript>
						</a>
						@if (count($post->views))
						<div class="iFxd">
							<a aria-label="Views" class="cmnt" data-text="{{ $post->views->sum('views') }}" role="button">
								<svg viewBox="0 0 576 512"><path d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z"></path></svg>
							</a>
						</div>
						@endif
					</div>
					<div class="pCntn">
						@if (isset($post['category']) && !empty($post['category']))
						<div class="pHdr pSml">
							<div class="aNm">
								<div class="pLbls" data-text="in">
									<a aria-label="{{ $post['category']->name }}" data-text="{{ $post['category']->name }}" href="{{ route('blog.category', $post['category']->slug) }}"
										rel="category">
									</a>
								</div>
							</div>
						</div> 
						@endif
				
						<h2 class="pTtl aTtl">
							<a data-text="{{ $post['title'] }}"
								href="{{ route('blog.article', $post['slug']) }}" rel="bookmark"> {{ $post['title'] }} </a>
						</h2>
						<div class="pSnpt"> {{ $post['description'] ?? Str::words(strip_tags($post['content']), 255, '...')  }} </div>
						<div class="pInf pSml">
							<time class="aTtmp pTtmp pbl timeAgo" datetime="{{ $post['created_at'] }}"></time>
							<a aria-label="Read more" class="pJmp" data-text="Keep reading"
								href="{{ route('blog.article', $post['slug']) }}"></a>
						</div>
					</div>
				</article>
				
				@endforeach
            </div>
            <div class="blogPg" id="blogPager">
                <div class="nwLnk nPst" data-text="Newest">
                    <svg class="line" viewBox="0 0 24 24">
                        <g
                            transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)">
                            <line x1="6.7743" x2="6.7743" y1="15.7501" y2="0.7501"></line>
                            <path
                                d="M12.7988,9.6998 C12.7988,9.6998 9.5378,15.7498 6.7758,15.7498 C4.0118,15.7498 0.7498,9.6998 0.7498,9.6998">
                            </path>
                        </g>
                    </svg>
                </div>
                <a aria-label="Home" class="hmLnk" href="{{ route('blog') }}">
                    <svg class="line" viewBox="0 0 24 24">
                        <g transform="translate(2.400000, 2.000000)">
                            <path
                                d="M1.24344979e-14,11.713 C1.24344979e-14,6.082 0.614,6.475 3.919,3.41 C5.365,2.246 7.615,0 9.558,0 C11.5,0 13.795,2.235 15.254,3.41 C18.559,6.475 19.172,6.082 19.172,11.713 C19.172,20 17.213,20 9.586,20 C1.959,20 1.24344979e-14,20 1.24344979e-14,11.713 Z">
                            </path>
                        </g>
                    </svg>
                </a>
                <div class="olLnk nPst" data-text="Oldest">
                    <svg class="line" viewBox="0 0 24 24">
                        <g
                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)">
                            <line x1="6.7743" x2="6.7743" y1="15.7501" y2="0.7501"></line>
                            <path
                                d="M12.7988,9.6998 C12.7988,9.6998 9.5378,15.7498 6.7758,15.7498 C4.0118,15.7498 0.7498,9.6998 0.7498,9.6998">
                            </path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
