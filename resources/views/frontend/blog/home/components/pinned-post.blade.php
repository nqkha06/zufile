
<div class="section" id="top-widget">
    <div class="widget FeaturedPost" data-version="2" id="FeaturedPost1">
        <h2 class="title">Pinned Post</h2>
        <div class="itemFt" role="feed">
            <article class="itm">
                <div class="iThmb pThmb">
                    <a class="thmb" href="/blog/{{ $pinned['slug'] }}">
                        <img alt="{{ $pinned['title'] }}" class="imgThm lazy loaded"
                            data-src="{{ $pinned['image'] }}"
                            src="{{ $pinned['image'] }}">
                        <noscript><img alt='{{ $pinned['title'] }}' class='imgThm'
                                src='{{ $pinned['image'] }}' /></noscript>
                    </a>

                </div>
                <div class="iCtnt">
                    @if (isset($pinned['category']) && !empty($pinned['category']))
                    <div class="pHdr pSml">
                        <div class="aNm">
                            <div class="pLbls" data-text="in">
                                <a aria-label="{{ $pinned['category']->name }}" data-text="{{ $pinned['category']->name }}" href="{{ route('blog.categories', $pinned['category']->slug) }}"
                                    rel="category">
                                </a>
                            </div>
                        </div>
                    </div> 
                    @endif
                    <h3 class="pTtl aTtl"><a href="/blog/{{ $pinned['slug'] }}">{{ $pinned['title'] }}</a></h3>
                    <div class="pSnpt">{{ $pinned['content'] }}</div>
                    <div class="pInf pSml">
                        <time class="aTtmp pbl timeAgo" datetime="{{ $pinned['created_at'] }}"></time>
                        <a aria-label="Read more" class="pJmp" data-text="Keep reading" href="/blog/{{ $pinned['slug'] }}"></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>