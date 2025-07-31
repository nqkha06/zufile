<article class="ntry">
    <div class="pThmb">
        <a class="thmb" href="{{ route('blog.show', $article['slug']) }}">
            <img alt="{{ $article['title'] }}" class="imgThm lazy" src="{{ $article['image'] }}" lazied>
            <noscript><img alt='{{ $article['title'] }}' class='imgThm' src='{{ $article['image'] }}' /></noscript>
        </a>
        @if (count($article->views))
        <div class="iFxd">
            <a aria-label="Views" class="cmnt" data-text="{{ $article->views->sum('views') }}" role="button">
                <svg viewBox="0 0 576 512"><path d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z"></path></svg>
            </a>
        </div>
        @endif
    </div>
    <div class="pCntn">
        @if (isset($article['category']) && !empty($article['category']))
        <div class="pHdr pSml">
            <div class="aNm">
                <div class="pLbls" data-text="in">
                    <a aria-label="{{ $article['category']->name }}" data-text="{{ $article['category']->name }}" href="/search/category/{{ $article['category']->name }}"
                        rel="category">
                    </a>
                </div>
            </div>
        </div> 
        @endif

        <h2 class="pTtl aTtl">
            <a data-text="{{ $article['title'] }}"
                href="{{ route('blog.show', $article['slug']) }}" rel="bookmark"> {{ $article['title'] }} </a>
        </h2>
        <div class="pSnpt"> {{ $article['content'] }} </div>
        <div class="pInf pSml">
            <time class="aTtmp pTtmp pbl timeAgo" datetime="{{ $article['created_at'] }}"></time>
            <a aria-label="Read more" class="pJmp" data-text="Keep reading"
                href="{{ route('blog.show', $article['slug']) }}"></a>
        </div>
    </div>
</article>
