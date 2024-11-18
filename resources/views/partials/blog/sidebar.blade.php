<aside class='blogItm sidebar'>
    <div class='sideIn'>
        <div class='section' id='side-widget'>
            {{-- <div class='widget Profile' id='Profile1'>
                <h3 class='title'>
                    Contributors
                </h3>
                <div class='wPrf sl nLoc'>
                    <div class='sIm'>
                        <div class='im lazy'
                            data-style='background-image: url(//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/w60/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw)'>
                        </div>
                        <noscript>
                            <div class='im'
                                style='background-image: url(//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/w60/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw)'>
                            </div>
                        </noscript>
                    </div>
                    <dl class='sInf'>
                        <dt class='sDt'>
                            <a class='l extL'
                                href='https://www.blogger.com/profile/08446403296417996016'
                                rel='author noreferrer' target='_blank'
                                title='View my complete profile'>
                                <bdi>Maki M.</bdi>
                            </a>
                        </dt>
                        <dd class='sTxt'>
                            I like to read and learn new things, especially about UI and UX and
                            then applying them in my work
                        </dd>
                        <dd class='lc' data-text='Indonesia'>
                            <svg class='line' viewBox='0 0 24 24'>
                                <path
                                    d='M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z'>
                                </path>
                                <path
                                    d='M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z'>
                                </path>
                            </svg>
                        </dd>
                    </dl>
                </div>
            </div> --}}
            <div class="widget PopularPosts" id="PopularPosts00">
                <h2 class="title">Popular Posts</h2>
                <div class="itemPp" role="feed">
                    @foreach ($popular_posts as $key => $val)
                        @php
                            $flag = $key == 0 ? true : false;
                        @endphp
                        <article class="itm mostP">
                            @if ($flag)
                                <div class="iThmb pThmb">
                                    <a class="thmb"
                                        href="{{ route('blog.article', $val->slug) }}">
                                        <img alt="{{ $val->title }}" class="imgThm lazy"
                                            data-src="{{ $val->image }}">
                                        <noscript><img alt='{{ $val->title }}'
                                                class='imgThm'
                                                src='{{ $val->image }}' /></noscript>
                                    </a>
                                    {{-- @if ($val->views)
                                        <div class="iFxd">
                                            <a aria-label="Views" class="cmnt"
                                                data-text="{{ $val->views }}"
                                                role="button">
                                                <svg viewBox="0 0 576 512">
                                                    <path
                                                        d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif --}}
                                </div>
                            @endif
                            <div class="iInf pSml">
                                <time class="aTtmp iTtmp pbl"
                                    data-text="{{ date('F j', strtotime($val->created_at)) }}"
                                    datetime="{{ $val->created_at }}"
                                    title="Published: {{ date('F j, Y', strtotime($val->created_at)) }}"></time>
                                <div class="pLbls" data-text="in">
                                    <a aria-label="{{ $val->category->name }}"
                                        data-text="{{ $val->category->name }}"
                                        href="#" rel="tag">
                                    </a>
                                </div>
                            </div>
                            <div class="iCtnt">
                                <div class="iInr">
                                    <h3 class="iTtl aTtl"><a
                                            href="{{ route('blog.article', $val->slug) }}">{{ $val->title }}</a>
                                    </h3>
                                    @if ($flag)
                                        {{-- <div class="pSnpt">{{ $val->content }}</div> --}}
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class='widget Label' id='Label00'>
                <h3 class='title'>
                    Categories
                </h3>
                <div class='wL pSml bg ls'>
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            <a aria-label='{{ $category->name }}' class='lbN'
                                href='{{ route('blog.category', $category->slug) }}'>
                                <span class='lbT'>{{ $category->name }}</span>
                                <span class='lbR'>
                                    <span class='lbC' data-text='{{ $category->publishedPosts->count() }}'></span>
                                    <svg class='line' viewBox='0 0 24 24'>
                                        <g transform='translate(4.500000, 2.500000)'>
                                            <path
                                                d='M7.47024319,0 C1.08324319,0 0.00424318741,0.932 0.00424318741,8.429 C0.00424318741,16.822 -0.152756813,19 1.44324319,19 C3.03824319,19 5.64324319,15.316 7.47024319,15.316 C9.29724319,15.316 11.9022432,19 13.4972432,19 C15.0932432,19 14.9362432,16.822 14.9362432,8.429 C14.9362432,0.932 13.8572432,0 7.47024319,0 Z'>
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    {{-- <div class='lbSh'>
                        <input class='lbIn hidden' id='lbAl-2' type='checkbox' />
                        <ul class='lbAl'>
                            <li>
                                <a aria-label='Tabs' class='lbN'
                                    href='https://fletro.jagodesain.com/search/label/Tabs'>
                                    <span class='lbT'>Tabs</span>
                                    <span class='lbR'>
                                        <span class='lbC' data-text='1'></span>
                                        <svg class='line' viewBox='0 0 24 24'>
                                            <g transform='translate(4.500000, 2.500000)'>
                                                <path
                                                    d='M7.47024319,0 C1.08324319,0 0.00424318741,0.932 0.00424318741,8.429 C0.00424318741,16.822 -0.152756813,19 1.44324319,19 C3.03824319,19 5.64324319,15.316 7.47024319,15.316 C9.29724319,15.316 11.9022432,19 13.4972432,19 C15.0932432,19 14.9362432,16.822 14.9362432,8.429 C14.9362432,0.932 13.8572432,0 7.47024319,0 Z'>
                                                </path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a aria-label='Update' class='lbN'
                                    href='https://fletro.jagodesain.com/search/label/Update'>
                                    <span class='lbT'>Update</span>
                                    <span class='lbR'>
                                        <span class='lbC' data-text='1'></span>
                                        <svg class='line' viewBox='0 0 24 24'>
                                            <g transform='translate(4.500000, 2.500000)'>
                                                <path
                                                    d='M7.47024319,0 C1.08324319,0 0.00424318741,0.932 0.00424318741,8.429 C0.00424318741,16.822 -0.152756813,19 1.44324319,19 C3.03824319,19 5.64324319,15.316 7.47024319,15.316 C9.29724319,15.316 11.9022432,19 13.4972432,19 C15.0932432,19 14.9362432,16.822 14.9362432,8.429 C14.9362432,0.932 13.8572432,0 7.47024319,0 Z'>
                                                </path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <label aria-label='Show labels' class='lbM'
                            data-hide='Show less' data-show='Show more' data-text='(+2)'
                            for='lbAl-2' role='button'></label>
                    </div> --}}
                </div>
            </div>
        </div>
        <!--[ Sidebar sticky ]-->
        <div class='sideSticky section' id='side-sticky'>
            <div class='widget HTML' id='HTML95'>
                <div class='adB' data-text='Ads go here'></div>
            </div>
        </div>
    </div>
</aside>