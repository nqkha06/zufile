<div class="section" id="main-widget">
    <div class="widget Blog" id="Blog1">
        <div class="blogTtl hm">
            <h3 class="title">Latest Posts</h3>
        </div>
        <div class="blogPts">
            @foreach ($posts as $article)
            {!! render_article($article) !!}
            @endforeach

        </div>
        <div class="blogPg" id="LoadMorePosts"><a aria-label="Tải thêm bài đăng" class="jsLd" data-text="Tải thêm bài đăng"
                href="javascript:;"></a></div>
    </div>
</div>

<script src="/fontend/js/blog/simpleAjax.js"></script>
