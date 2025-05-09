<div class='widget FeaturedPost' data-version='2' id='FeaturedPost1'>
    <h2 class='title'>Pinned Post</h2>
    <div class='itemFt' role='feed'>
        <article class='itm'>
            <div class='iThmb pThmb'>
                <a class='thmb'
                    href='{{ route('blog.article', $article->slug) }}'>
                    <img alt='{{ $article->title }}'
                        class='imgThm lazy'
                        data-src='{{ $article->image }}'
                        src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' />
                    <noscript><img
                            alt='{{ $article->title }}'
                            class='imgThm'
                            src='{{ $article->image }}' /></noscript>
                </a>
                {{-- <div class='iFxd'>
                    <a aria-label='Comments' class='cmnt' data-text='28'
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
            <div class='iCtnt'>
                <div class='pHdr pSml'>
                    <div class='aIm'>
                        <div class='im lazy'
                            data-style='background-image: url(//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/w20-h20-p-k-no-nu/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw)'>
                        </div>
                        <noscript>
                            <div class='im'
                                style='background-image: url(//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/w20-h20-p-k-no-nu/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw)'>
                            </div>
                        </noscript>
                    </div>
                    <div class='aNm'>
                        <bdi class='nm' data-text='Link4Sub'
                            data-write='Oleh'></bdi>
                        <div class='pLbls' data-text='in'>
                            <a aria-label='{{ $article->categories()->first()->name }}' data-text='{{ $article->categories()->first()->name }}'
                                href='https://fletro.jagodesain.com/search/label/{{ $article->categories()->first()->name }}'
                                rel='tag'>
                            </a>
                            {{-- <a aria-label='Fullpage' data-text='Fullpage'
                                href='https://fletro.jagodesain.com/search/label/Fullpage'
                                rel='tag'>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <h3 class='pTtl aTtl'><a
                        href='{{ route('blog.article', $article->slug)}}'>{{ $article->title }}</a></h3>
                <div class='pSnpt'>{{ $article->description }}</div>
                <div class='pInf pSml'>
                    <time class='aTtmp pTtmp pbl' data-text='Dec 5, 2019'
                        datetime='{{ $article->created_at }}'
                        title='Published: December 5, 2019'></time>
                    <a aria-label='Read more' class='pJmp' data-text='Keep reading'
                        href='{{ route('blog.article', $article->slug)}}'></a>
                </div>
            </div>
        </article>
    </div>
</div>