@extends('layouts.blog2')

@section('title', $article_data['title'])
@section('meta_description', $article_data['meta_description'] ?? $article_data['summary'])
@section('meta_keywords', $article_data['meta_keywords'])
@section('meta_author', 'QK06')

@section('og_title', $article_data['meta_title'] ?? $article_data['title'])
@section('og_description', $article_data['meta_description'] ?? $article_data['summary'])
@section('og_image', URL('/') . $article_data['image'])
@section('og_url', URL('/'))

@section('twitter_title', $article_data['meta_title'] ?? $article_data['title'])
@section('twitter_description', $article_data['meta_description'] ?? $article_data['summary'])
@section('twitter_image', URL('/') . $article_data['image'])
@section('twitter_url', URL('/'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('fontend/blog/css/postRelated.css') }}">
    <link href="{{ asset('/fontend/stu/css/app.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('/fontend/stu/js/app.js?v=' . time()) }}"></script>
@endpush

@section('content')
    <!--[ Blog content ]-->
    <div class="section" id="main-widget">
        <div class="widget Blog" id="Blog1">
            <div class="bg_stu">

                <div id="topAd"></div>
                {{-- <div class="adStu" id="topAd">
                    <ins class='adsbygoogle' data-ad-client='ca-pub-7690117028047118' data-ad-slot='2105802205' data-ad-status='filled' style='display:inline-block;width:100%;height:300px'></ins>
                </div> --}}
                <div class="stu-container" id="stuC">
                    <div class='stu-box-wrap '>
                        <div class="loading-stu"></div>
                    </div>
                </div>
                <div style="margin: 25px 0" id="botAd"></div>
            </div>

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

                    {{ Breadcrumbs::view('partials.blog.breadcrumbs', 'blog.article', $article_data) }}

                    <h1 class="pTtl aTtl itm">
                        <span> {{ $article_data['title'] }} </span>
                    </h1>
                    <div class="pDesc">{{ $article_data['summary'] }}</div>
                    <div class="pInf pSml ps">
                        <div class="pIm">
                            <div class="im lazy lazy loaded" data-style="background-image: url({{ config('profile.avatar') }});">
                            </div>
                            <noscript><div class='im' style='background-image: url({{ config('profile.avatar') }})'></div></noscript>
                            </div>
                        <div class="pNm">
                            <bdi class="nm" data-text="{{ config('profile.fullname') }}" data-write="Oleh"></bdi>
                            <div class="pDr">
                                <bdi class="pDt pIn">
                                    <time class="aTtmp upd timeAgo" datetime="{{ $article_data['created_at'] }}"></time>
                                </bdi>
                                <div class="pRd pIn"><bdi id="rdTime">0 min read</bdi></div>
                            </div>
                        </div>
                    </div>
                    <div class="pSh">
                        <div class="pShc" data-text="Share:">
                            <a aria-label="Facebook" class="c fb" data-text="Share"
                                href="https://www.facebook.com/sharer.php?u={{ route('blog.article', $article_data['slug']) }}"
                                rel="noopener" role="button" target="_blank">
                                <svg viewBox="0 0 64 64">
                                    <path
                                        d="M20.1,36h3.4c0.3,0,0.6,0.3,0.6,0.6V58c0,1.1,0.9,2,2,2h7.8c1.1,0,2-0.9,2-2V36.6c0-0.3,0.3-0.6,0.6-0.6h5.6 c1,0,1.9-0.7,2-1.7l1.3-7.8c0.2-1.2-0.8-2.4-2-2.4h-6.6c-0.5,0-0.9-0.4-0.9-0.9v-5c0-1.3,0.7-2,2-2h5.9c1.1,0,2-0.9,2-2V6.2 c0-1.1-0.9-2-2-2h-7.1c-13,0-12.7,10.5-12.7,12v7.3c0,0.3-0.3,0.6-0.6,0.6h-3.4c-1.1,0-2,0.9-2,2v7.8C18.1,35.1,19,36,20.1,36z">
                                    </path>
                                </svg>
                            </a>
                            <a aria-label="Whatsapp" class="c wa" data-text="Share"
                                href="https://api.whatsapp.com/send?text={{ route('blog.article', $article_data['slug']) }}"
                                rel="noopener" role="button" target="_blank">
                                <svg viewBox="0 0 64 64">
                                    <path
                                        d="M6.9,48.4c-0.4,1.5-0.8,3.3-1.3,5.2c-0.7,2.9,1.9,5.6,4.8,4.8l5.1-1.3c1.7-0.4,3.5-0.2,5.1,0.5 c4.7,2.1,10,3,15.6,2.1c12.3-1.9,22-11.9,23.5-24.2C62,17.3,46.7,2,28.5,4.2C16.2,5.7,6.2,15.5,4.3,27.8c-0.8,5.6,0,10.9,2.1,15.6 C7.1,44.9,7.3,46.7,6.9,48.4z M21.3,19.8c0.6-0.5,1.4-0.9,1.8-0.9s2.3-0.2,2.9,1.2c0.6,1.4,2,4.7,2.1,5.1c0.2,0.3,0.3,0.7,0.1,1.2 c-0.2,0.5-0.3,0.7-0.7,1.1c-0.3,0.4-0.7,0.9-1,1.2c-0.3,0.3-0.7,0.7-0.3,1.4c0.4,0.7,1.8,2.9,3.8,4.7c2.6,2.3,4.9,3,5.5,3.4 c0.7,0.3,1.1,0.3,1.5-0.2c0.4-0.5,1.7-2,2.2-2.7c0.5-0.7,0.9-0.6,1.6-0.3c0.6,0.2,4,1.9,4.7,2.2c0.7,0.3,1.1,0.5,1.3,0.8 c0.2,0.3,0.2,1.7-0.4,3.2c-0.6,1.6-2.1,3.1-3.2,3.5c-1.3,0.5-2.8,0.7-9.3-1.9c-7-2.8-11.8-9.8-12.1-10.3c-0.3-0.5-2.8-3.7-2.8-7.1 C18.9,22.1,20.7,20.4,21.3,19.8z">
                                    </path>
                                </svg>
                            </a>
                            <a aria-label="Twitter" class="c tw" data-text="Tweet"
                                href="https://twitter.com/share?url={{ route('blog.article', $article_data['slug']) }}"
                                rel="noopener" role="button" target="_blank">
                                <svg viewBox="0 0 64 64">
                                    <path
                                        d="M11.4,26.6C11.5,26.6,11.5,26.6,11.4,26.6c-0.9,0-1.8-0.2-2.6-0.4c-1.3-0.4-2.5,0.8-2.1,2 c1.1,4.3,4.5,7.7,8.8,8.6c-1,0.3-2,0.4-3,0.4c-1,0-1.7,1.1-1.2,2c1.9,3.5,5.6,5.9,9.7,6h1c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2 c-1.3,0-2.9-0.1-4.5-0.5c-1-0.2-2-0.2-2.9,0.1c-1.7,0.6-3.5,1.1-5.4,1.3C8.5,50.2,8,50.7,8,51.4v0c0,0.5,0.3,1,0.8,1.2 c3.9,1.7,8.3,2.7,12.9,2.7c21.1,0,32.7-17.9,32.7-33.5v0c0-0.9,0.4-1.8,1.1-2.4c1.2-1,2.3-2.1,3.3-3.4c0.4-0.5-0.1-1.2-0.7-1 c-1.2,0.4-2.4,0.7-3.7,0.9c-0.2,0-0.3-0.2-0.1-0.4c1.5-1.1,2.8-2.6,3.6-4.3c0.3-0.6-0.3-1.2-0.9-0.9c-1.1,0.6-2.3,1-3.5,1.4 c-1.2,0.4-2.6,0.1-3.6-0.7c-1.9-1.5-4.4-2.4-7-2.4c-5.3,0-9.8,3.7-11.1,8.8c-0.2,0.9,0.5,1.7,1.4,1.7c1.6-0.1,3.2-0.3,4.4-0.5 c1-0.2,2,0.3,2.4,1.2c0.5,1.2-0.2,2.4-1.3,2.7c-4.6,1.3-9.7,0.4-9.7,0.4l0,0C21.2,21.8,14.3,18,9.3,12.5C8.6,11.7,7.3,12,7,12.9 c-0.4,1.2-0.6,2.5-0.6,3.9C6.4,20.9,8.4,24.5,11.4,26.6z">
                                    </path>
                                </svg>
                            </a>
                            <label aria-label="Share to other apps" for="forShare">
                                <svg viewBox="0 0 512 512">
                                    <path
                                        d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256 c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32 C448,238.3,434.3,224,417.4,224z">
                                    </path>
                                </svg>
                            </label>
                        </div>
                    </div>
                    <div class="pInr">
                        <div class="pAd">
                        </div>
                        <div class="pEnt" id="postID-{{ $article_data['id'] }}">
                            <div class="pS post-body postBody" id="postBody">
                                {!! $article_data['content'] !!}
                            </div>
                        </div>
                        <style>
                            .tagsHt {
                                position: relative;
                                display: block;
                                width: calc(100% + 40px);
                                right: -20px;
                                left: -20px;
                                padding: 8px 17px 0;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                            }

                            .tagsHt>* {
                                color: #08102b;
                                padding: 7px 12px;
                                background: #fffdfc;
                                font-size: 13px;
                                border-radius: 10px;
                                border: var(--fotL) solid var(--contentL);
                                display: inline-flex;
                                margin: 0 3px;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                opacity: .8;
                            }
                        </style>

                        <div class="tagsCtn">
                            <input class="li hidden" id="forLabel" type="checkbox">
                            <div class="tagsHt">
                                @foreach (array_map('trim', explode(',', $article_data['tags'])) as $tag)
                                    <a>#{{ $tag }}</a>
                                @endforeach
                                <label aria-label="Show all labels" class="s" data-hide="Show less"
                                    data-show="+1 More…" for="forLabel" role="button">More…</label>
                            </div>
                        </div>
                        <div class="pAd">
                        </div>
                        <script type="application/ld+json">
                        {
                          "@context": "http://schema.org"
                          , "@type": "BlogPosting"
                          , "mainEntityOfPage": {
                            "@type": "WebPage"
                            , "@id": "{{ route('blog.article', $article_data['slug']) }}"
                          }
                          , "headline": "{{ $article_data['title'] }}"
                          , "description": "{{ $article_data['summary'] }}"
                          , "articleBody": "{{ $article_data['summary'] }}"
                          , "datePublished": "{{ $article_data['created_at'] }}"
                          , "dateModified": "{{ $article_data['updated_at'] }}"
                          , "image": {
                            "@type": "ImageObject"
                            , "url": "{{ $article_data['image'] }}"
                            , "height": 630
                            , "width": 1200
                          }
                          , "publisher": {
                            "@type": "Organization"
                            , "name": "Link4Sub"
                            , "logo": {
                              "@type": "ImageObject"
                              , "url": "https://link4sub.qkt/images/1721055856.png"
                              , "width": 297
                              , "height": 45
                            }
                          }
                          , "author": {
                            "@type": "Person"
                            , "name": "{{ config('profile.fullname') }}"
                            , "url": "https://www.facebook.com/nqckha.06/"
                            , "image": "https://link4sub.qkt/images/1721055856.png"
                          }
                        }
          
                      </script>
                        <script>
                            /*<![CDATA[*/
                            function get_text(el) {
                                ret = '';
                                var length = el.childNodes.length;
                                for (var i = 0; i < length; i++) {
                                    var node = el.childNodes[i];
                                    if (node.nodeType != 8) {
                                        ret += node.nodeType != 1 ? node.nodeValue : get_text(node);
                                    }
                                }
                                return ret;
                            }
                            var words = get_text(document.getElementById('postBody'));
                            var count = words.split(' ')
                                .length;
                            var avg = 200;
                            var counted = count / avg;
                            var maincount = Math.round(counted);
                            document.getElementById('rdTime')
                                .innerHTML = maincount + ' min read'; /*]]>*/
                        </script>
                        <div class="admPs">
                            <div class="admIm">
                                <div class="im lazy lazy"
                                    data-style="background-image: url({{ config('profile.avatar') }})">
                                </div>
                                <noscript>
                                    <div class='im'
                                        style='background-image: url({{ config('profile.avatar') }})'>
                                    </div>
                                </noscript>
                            </div>
                            <div class="admI">
                                <bdi class="admN" data-text="{{ config('profile.fullname') }}" data-write="Posted by"></bdi>
                                <div class="admA">Không phải mọi tình cảm chân thành và âm thầm đều được đáp lại. Vậy
                                    nên, anh quyết định giữ cho mình mảnh cảm xúc này..?</div>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="pFoot">
                    <input class="shIn fixi hidden" id="forShare" type="checkbox">
                    <div class="shBr fixL">
                        <div class="shBri fixLi">
                            <div class="shBrs fixLs">
                                <div class="shH fixH fixT" data-text="Share to other apps">
                                    <label aria-label="Close" class="c cl" for="forShare"></label>
                                </div>
                                <div class="shC">
                                    <div class="shL">
                                        <div data-text="Facebook">
                                            <a aria-label="Facebook"
                                                href="https://www.facebook.com/sharer.php?u={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M20.1,36h3.4c0.3,0,0.6,0.3,0.6,0.6V58c0,1.1,0.9,2,2,2h7.8c1.1,0,2-0.9,2-2V36.6c0-0.3,0.3-0.6,0.6-0.6h5.6 c1,0,1.9-0.7,2-1.7l1.3-7.8c0.2-1.2-0.8-2.4-2-2.4h-6.6c-0.5,0-0.9-0.4-0.9-0.9v-5c0-1.3,0.7-2,2-2h5.9c1.1,0,2-0.9,2-2V6.2 c0-1.1-0.9-2-2-2h-7.1c-13,0-12.7,10.5-12.7,12v7.3c0,0.3-0.3,0.6-0.6,0.6h-3.4c-1.1,0-2,0.9-2,2v7.8C18.1,35.1,19,36,20.1,36z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="WhatsApp">
                                            <a aria-label="Whatsapp"
                                                href="https://api.whatsapp.com/send?text={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M6.9,48.4c-0.4,1.5-0.8,3.3-1.3,5.2c-0.7,2.9,1.9,5.6,4.8,4.8l5.1-1.3c1.7-0.4,3.5-0.2,5.1,0.5 c4.7,2.1,10,3,15.6,2.1c12.3-1.9,22-11.9,23.5-24.2C62,17.3,46.7,2,28.5,4.2C16.2,5.7,6.2,15.5,4.3,27.8c-0.8,5.6,0,10.9,2.1,15.6 C7.1,44.9,7.3,46.7,6.9,48.4z M21.3,19.8c0.6-0.5,1.4-0.9,1.8-0.9s2.3-0.2,2.9,1.2c0.6,1.4,2,4.7,2.1,5.1c0.2,0.3,0.3,0.7,0.1,1.2 c-0.2,0.5-0.3,0.7-0.7,1.1c-0.3,0.4-0.7,0.9-1,1.2c-0.3,0.3-0.7,0.7-0.3,1.4c0.4,0.7,1.8,2.9,3.8,4.7c2.6,2.3,4.9,3,5.5,3.4 c0.7,0.3,1.1,0.3,1.5-0.2c0.4-0.5,1.7-2,2.2-2.7c0.5-0.7,0.9-0.6,1.6-0.3c0.6,0.2,4,1.9,4.7,2.2c0.7,0.3,1.1,0.5,1.3,0.8 c0.2,0.3,0.2,1.7-0.4,3.2c-0.6,1.6-2.1,3.1-3.2,3.5c-1.3,0.5-2.8,0.7-9.3-1.9c-7-2.8-11.8-9.8-12.1-10.3c-0.3-0.5-2.8-3.7-2.8-7.1 C18.9,22.1,20.7,20.4,21.3,19.8z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="Twitter">
                                            <a aria-label="Twitter"
                                                href="https://twitter.com/share?url={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M11.4,26.6C11.5,26.6,11.5,26.6,11.4,26.6c-0.9,0-1.8-0.2-2.6-0.4c-1.3-0.4-2.5,0.8-2.1,2 c1.1,4.3,4.5,7.7,8.8,8.6c-1,0.3-2,0.4-3,0.4c-1,0-1.7,1.1-1.2,2c1.9,3.5,5.6,5.9,9.7,6h1c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2 c-1.3,0-2.9-0.1-4.5-0.5c-1-0.2-2-0.2-2.9,0.1c-1.7,0.6-3.5,1.1-5.4,1.3C8.5,50.2,8,50.7,8,51.4v0c0,0.5,0.3,1,0.8,1.2 c3.9,1.7,8.3,2.7,12.9,2.7c21.1,0,32.7-17.9,32.7-33.5v0c0-0.9,0.4-1.8,1.1-2.4c1.2-1,2.3-2.1,3.3-3.4c0.4-0.5-0.1-1.2-0.7-1 c-1.2,0.4-2.4,0.7-3.7,0.9c-0.2,0-0.3-0.2-0.1-0.4c1.5-1.1,2.8-2.6,3.6-4.3c0.3-0.6-0.3-1.2-0.9-0.9c-1.1,0.6-2.3,1-3.5,1.4 c-1.2,0.4-2.6,0.1-3.6-0.7c-1.9-1.5-4.4-2.4-7-2.4c-5.3,0-9.8,3.7-11.1,8.8c-0.2,0.9,0.5,1.7,1.4,1.7c1.6-0.1,3.2-0.3,4.4-0.5 c1-0.2,2,0.3,2.4,1.2c0.5,1.2-0.2,2.4-1.3,2.7c-4.6,1.3-9.7,0.4-9.7,0.4l0,0C21.2,21.8,14.3,18,9.3,12.5C8.6,11.7,7.3,12,7,12.9 c-0.4,1.2-0.6,2.5-0.6,3.9C6.4,20.9,8.4,24.5,11.4,26.6z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="Telegram">
                                            <a aria-label="Telegram"
                                                href="https://t.me/share/url?url={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M56.4,8.2l-51.2,20c-1.7,0.6-1.6,3,0.1,3.5l9.7,2.9c2.1,0.6,3.8,2.2,4.4,4.3l3.8,12.1c0.5,1.6,2.5,2.1,3.7,0.9 l5.2-5.3c0.9-0.9,2.2-1,3.2-0.3l11.5,8.4c1.6,1.2,3.9,0.3,4.3-1.7l8.7-41.8C60.4,9.1,58.4,7.4,56.4,8.2z M50,17.4L29.4,35.6 c-1.1,1-1.9,2.4-2,3.9c-0.2,1.5-2.3,1.7-2.8,0.3l-0.9-3c-0.7-2.2,0.2-4.5,2.1-5.7l23.5-14.6C49.9,16.1,50.5,16.9,50,17.4z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="Pinterest">
                                            <a aria-label="Pinterest" data-pin-config="beside"
                                                href="https://pinterest.com/pin/create/button/?url={{ route('blog.article', $article_data['slug']) }}&amp;media=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhsWnb66ryd6M6iz1jnKdfy12i6Bocg5BMBIBP5bBHf9hv5x_revIkYugbz0h2zwhXpyDiN2xWIiDeKXahdvMElqppiod-u_0mRh8m5ykqJtx6PSn7pbJ6xeD80KgocQsb-AiXu0MMoc-o/w1600/imagz-all-style.png"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M14.4,53.8c2.4,2,6.1,0.6,6.8-2.4l0-0.1c0.4-1.8,2.4-10.2,3.2-13.7c0.2-0.9,0.2-1.8-0.1-2.7 C24.2,34,24,32.8,24,31.5c0-4.1,2.4-7.2,5.4-7.2c2.5,0,3.8,1.9,3.8,4.2c0,2.6-1.6,6.4-2.5,9.9c-0.7,3,1.5,5.4,4.4,5.4 c5.3,0,8.9-6.8,8.9-14.9c0-6.1-4.1-10.7-11.6-10.7c-8.5,0-13.8,6.3-13.8,13.4c0,2.4,0.7,4.2,1.8,5.5c0.5,0.6,0.6,0.9,0.4,1.6 c-0.1,0.5-0.4,1.8-0.6,2.2c-0.2,0.7-0.8,1-1.4,0.7c-3.9-1.6-5.7-5.9-5.7-10.7c0-8,6.7-17.5,20-17.5c10.7,0,17.7,7.7,17.7,16 c0,11-6.1,19.2-15.1,19.2c-1.9,0-3.8-0.7-5.2-1.6c-0.9-0.6-2.1-0.1-2.4,0.9c-0.5,1.9-1.1,4.3-1.3,4.9c-0.1,0.5-0.3,0.9-0.4,1.4 c-1,2.7,0.9,5.5,3.7,5.7c2.1,0.1,4.2,0,6.3-0.3c12.4-2,22.1-12.2,23.4-24.7C61.5,18.1,48.4,4,32,4C16.5,4,4,16.5,4,32 C4,40.8,8.1,48.6,14.4,53.8z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="LinkedIn">
                                            <a aria-label="Linkedin"
                                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 64 64">
                                                    <path
                                                        d="M8,54.7C8,55.4,8.6,56,9.3,56h9.3c0.7,0,1.3-0.6,1.3-1.3V23.9c0-0.7-0.6-1.3-1.3-1.3H9.3 c-0.7,0-1.3,0.6-1.3,1.3V54.7z">
                                                    </path>
                                                    <path
                                                        d="M46.6,22.3c-4.5,0-7.7,1.8-9.4,3.7c-0.4,0.4-1.1,0.1-1.1-0.5l0-1.6c0-0.7-0.6-1.3-1.3-1.3h-9.4 c-0.7,0-1.3,0.6-1.3,1.3c0.1,5.7,0,25.4,0,30.7c0,0.7,0.6,1.3,1.3,1.3h9.5c0.7,0,1.3-0.6,1.3-1.3V37.9c0-1,0-2,0.3-2.7 c0.8-2,2.6-4.1,5.7-4.1c4.1,0,6,3.1,6,7.6v15.9c0,0.7,0.6,1.3,1.3,1.3h9.3c0.7,0,1.3-0.6,1.3-1.3V37.4C60,27.1,54.1,22.3,46.6,22.3 z">
                                                    </path>
                                                    <path
                                                        d="M13.9,18.9L13.9,18.9c3.8,0,6.1-2.4,6.1-5.4C19.9,10.3,17.7,8,14,8c-3.7,0-6,2.3-6,5.4 C8,16.5,10.3,18.9,13.9,18.9z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="Line">
                                            <a aria-label="Line"
                                                href="https://timeline.line.me/social-plugin/share?url={{ route('blog.article', $article_data['slug']) }}"
                                                rel="noopener" target="_blank">
                                                <svg viewBox="0 0 24 24">
                                                    <path
                                                        d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div data-text="Email">
                                            <a aria-label="Email"
                                                href="mailto:?body={{ route('blog.article', $article_data['slug']) }}"
                                                target="_blank">
                                                <svg viewBox="0 0 500 500">
                                                    <path
                                                        d="M468.051,222.657c0-12.724-5.27-24.257-13.717-32.527 L282.253,45.304c-17.811-17.807-46.702-17.807-64.505,0L45.666,190.129c-8.448,8.271-13.717,19.803-13.717,32.527v209.054 c0,20.079,16.264,36.341,36.34,36.341h363.421c20.078,0,36.34-16.262,36.34-36.341V222.657z M124.621,186.402h250.758 c11.081,0,19.987,8.905,19.987,19.991v34.523c-0.088,4.359-1.818,8.631-5.181,11.997l-55.966,56.419l83.224,83.127 c6.904,6.904,6.904,18.081,0,24.985s-18.085,6.904-24.985,0l-85.676-85.672H193.034l-85.492,85.672 c-6.907,6.904-18.081,6.904-24.985,0c-6.906-6.904-6.906-18.081,0-24.985l83.131-83.127l-55.875-56.419 c-3.638-3.638-5.363-8.358-5.181-13.177v-33.343C104.632,195.307,113.537,186.402,124.621,186.402z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cpL" data-message="Copy to clipboard" data-text="or copy link">
                                        <div class="cpLb">
                                            <svg class="line" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399">
                                                </path>
                                                <path
                                                    d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099">
                                                </path>
                                            </svg>
                                            <input id="getlink" onclick="this.select()" readonly="readonly"
                                                value="{{ route('blog.article', $article_data['slug']) }}">
                                            <label for="getlink" onclick="copyFunction()">Copy</label>
                                        </div>
                                        <div class="cpLn" id="cpNotif"></div>
                                        <script>
                                            function copyFunction() {
                                                document.getElementById('getlink')
                                                    .select(), document.execCommand('copy'), document.getElementById('cpNotif')
                                                    .innerHTML = '<span>Link copied to clipboard!</span>'
                                            };
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="fCls" for="forShare"></label>
                    </div>
                    @if (count($related_articles))
                        <div class="rPst" id="rPst">
                            <h2 class="title">Bạn có thể thích những bài viết này!</h2>
                            <ul class="s-4 scrlH">
                                @foreach ($related_articles as $key => $val)
                                    <li>
                                        <div class="i">
                                            <div class="pThmb">
                                                <a class="thmb" aria-label="{{ $val->title }}"
                                                    href="{{ route('blog.article', $val->slug) }}"
                                                    title="{{ $val->title }}">
                                                    <div class="lazy"
                                                        data-style="background-image: url({{ $val->image }})"></div>
                                                </a>
                                            </div>
                                            <div class="iTtl aTtl"><a
                                                    href="{{ route('blog.article', $val->slug) }}">{{ $val->title }}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="pCmnts" id="comment">
                        <input class="cmSh fixi hidden" id="forComments" type="checkbox">
                        <input class="cmAl hidden" id="forAllCm" type="checkbox">
                        <div class="cmShw">
                            <label class="cmBtn button ln" for="forComments">
                                <span>Join the conversation (0)</span>
                            </label>
                        </div>
                        <section class="cm cmBr fixL" data-embed="true" data-num-comments="13" id="comments">
                            <div class="cmBri">
                                <div class="cmBrs fixLs">
                                    <div class="cmH fixH">
                                        <h3 class="title"> 0 comments </h3>
                                        <div class="cmI cl">
                                            <label aria-label="" class="s" data-new="Newest" data-text="Oldest"
                                                for="forAllCm"></label>
                                            <label aria-label="Close" class="c" for="forComments"></label>
                                        </div>
                                    </div>
                                    <div class="cmC">
                                        <div class="cmCn">

                                        </div>
                                        <script>
                                            var comment = true;
                                        </script>
                                        <div class="cmFrm">
                                            <div class="cmDis">New comments are not allowed.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="fCls" for="forComments"></label>
                        </section>
                        <script>
                            /*<![CDATA[*/ /* Comment tag, license: dte.web.id/teknis/paket-javascript-fitur-manipulasi */
                            function repText(id) {
                                var a = document.getElementById(id);
                                if (!a) return;
                                var b = a.innerHTML;
                                b = b.replace(/<i rel="image">(.*?)<\/i>/ig,
                                    "<img class='lazy' data-src='$1' src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' alt='Image Comment' \/>"
                                );
                                a.innerHTML = b;
                            }
                            repText('cmHolder'); /*]]>*/
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
