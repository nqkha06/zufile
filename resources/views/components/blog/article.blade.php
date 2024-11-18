<article class='ntry'>
    <div class='pThmb'>
        <a class='thmb'
            href='{{ route('blog.article', $article->slug) }}'>
            <img alt='{{ $article->title }}' class='imgThm lazy'
                data-src='{{ $article->image }}'
                src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' />
            <noscript><img alt='{{ $article->title }}' class='imgThm'
                    src='{{ $article->image }}' /></noscript>
        </a>
        {{-- <div class='iFxd'>
            <a aria-label='Comments' class='cmnt' data-text='8'
                href='{{ route('blog.article', $article->slug) }}#comment'
                role='button'>
                <svg class='line' viewBox='0 0 24 24'>
                    <g transform='translate(2.000000, 2.000000)'>
                        <path
                            d='M17.0710351,17.0698449 C14.0159481,20.1263505 9.48959549,20.7867004 5.78630747,19.074012 C5.23960769,18.8538953 1.70113357,19.8338667 0.933341969,19.0669763 C0.165550368,18.2990808 1.14639409,14.7601278 0.926307229,14.213354 C-0.787154393,10.5105699 -0.125888852,5.98259958 2.93020311,2.9270991 C6.83146881,-0.9756997 13.1697694,-0.9756997 17.0710351,2.9270991 C20.9803405,6.8359285 20.9723008,13.1680512 17.0710351,17.0698449 Z'>
                        </path>
                    </g>
                </svg>
            </a>
        </div> --}}
    </div>
    <div class='pCntn'>
        <div class='pHdr pSml'>
            <div class='aIm'>
                <div class='im lazy'
                    data-style='background-image: url({{ config('profile.avatar') }})'>
                </div>
                <noscript>
                    <div class='im'
                        style='background-image: url({{ config('profile.avatar') }})'>
                    </div>
                </noscript>
            </div>
            <div class='aNm'>
                <bdi class='nm' data-text='{{ config('profile.fullname') }}'
                    data-write='Oleh'></bdi>
                <div class='pLbls' data-text='in'>
                    <a aria-label='{{ $article->category->name }}' data-text='{{ $article->category->name }}'
                        href='{{ route('blog.category', $article->category->name) }}'
                        rel='tag'>
                    </a>
                    {{-- <a aria-label='Update' data-text='Update'
                        href='https://fletro.jagodesain.com/search/label/Update'
                        rel='tag'>
                    </a> --}}
                </div>
            </div>
        </div>
        <h2 class='pTtl aTtl'>
            <a data-text='{{ $article->title }}'
                href='{{ route('blog.article', $article->slug) }}'
                rel='bookmark'>
                {{ $article->title }}
            </a>
        </h2>
        <div class='pSnpt'>
            {{ $article->summary }}
        </div>
        <div class='pInf pSml'>
            <time class='aTtmp pTtmp pbl' data-text='{{ $article->created_at->format('M d, Y') }}'
                datetime='{{ $article->created_at }}'
                title='Published: {{ $article->created_at->format('F d, Y') }}'></time>
            <a aria-label='Read more' class='pJmp' data-text='Keep reading'
                href='{{ route('blog.article', $article->slug) }}'></a>
        </div>
        <script type='application/ld+json'>
            {
                "@context": "http://schema.org",
                "@type": "BlogPosting",
                "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ route('blog.article', $article->slug) }}"
                },
                "headline": "{{ $article->title }}",
                "description": "{{ $article->summary }}",
                
                "datePublished": "{{ $article->created_at }}",
                "dateModified": "{{ $article->updated_at }}",
                
                "image": {
                "@type": "ImageObject",
                "url": "https://link4sub.qkt{{ $article->image }}",
                "height": 630,
                "width": 1200
                },
        
                "publisher": {
                "@type": "Organization",
                "name": "{{ env('APP_NAME') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "#",
                    "width": 297,
                    "height": 45
                }
                },
        
                "author": {
                "@type": "Person",
                "name": "QK",
                "url": "https://www.facebook.com/@nqkha.06",
                "image": "https://link4sub.com/images/favicon.png"
                }
            }
        </script>
    </div>
</article>