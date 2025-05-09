@extends('layouts.blog2')

@section('title', 'Blog')
@section('sidebar')
123
@endsection
@section('content')

{{-- @include('components.blog.slider') --}}
<div class='section' id='top-widget'>
    <div class='widget HTML' data-version='2' id='HTML92'>
        <div class='widget-content'>
            @include('components.blog.adB')
        </div>
    </div>
    @include('components.blog.pinned', ['article' => $pinned])
</div>
<div class='section' id='main-widget'>
    <div class='widget HTML' data-version='2' id='HTML93'>
        <div class='widget-content'>
            @include('components.blog.adB')
        </div>
    </div>
    <div class='widget Blog' data-version='2' id='Blog1'>
        <div class='blogTtl hm'>
            <h3 class='title'>Latest Posts</h3>
            <div class='g'>
                <div class='tGr tIc bIc' data-grid='Grid' data-list='List'
                    onclick='gridMode()'>
                    <svg class='line' viewBox='0 0 24 24'>
                        <path
                            d='M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z'>
                        </path>
                        <path class='s3' d='M12 2V22'></path>
                        <path d='M2 12H22'></path>
                    </svg>
                </div>
                <script>
                    /*<![CDATA[*/
                    (localStorage.getItem('list')) === 'listmode' ? document.querySelector('#mainCont').classList.add('grD'): document
                        .querySelector('#mainCont').classList.remove('grD') /*]]>*/
                </script>
            </div>
        </div>
        <div class='blogPts'>
            @foreach ($posts as $article)
                @include('components.blog.article', ['article' => $article])
            @endforeach
            
        </div>
        <div class='blogPg' id='blogPager'>
            <div class='nPst' data-text='No results found'></div>
            <div class='nwLnk nPst' data-text='Newest'>
                <svg class='line' viewBox='0 0 24 24'>
                    <g
                        transform='translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)'>
                        <line x1='6.7743' x2='6.7743' y1='15.7501'
                            y2='0.7501'></line>
                        <path
                            d='M12.7988,9.6998 C12.7988,9.6998 9.5378,15.7498 6.7758,15.7498 C4.0118,15.7498 0.7498,9.6998 0.7498,9.6998'>
                        </path>
                    </g>
                </svg>
            </div>
            <div class='hmLnk nPst'>
                <svg class='line' viewBox='0 0 24 24'>
                    <g transform='translate(2.400000, 2.000000)'>
                        <path
                            d='M1.24344979e-14,11.713 C1.24344979e-14,6.082 0.614,6.475 3.919,3.41 C5.365,2.246 7.615,0 9.558,0 C11.5,0 13.795,2.235 15.254,3.41 C18.559,6.475 19.172,6.082 19.172,11.713 C19.172,20 17.213,20 9.586,20 C1.959,20 1.24344979e-14,20 1.24344979e-14,11.713 Z'>
                        </path>
                    </g>
                </svg>
            </div>
            <div class='olLnk nPst' data-text='Oldest'>
                <svg class='line' viewBox='0 0 24 24'>
                    <g
                        transform='translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)'>
                        <line x1='6.7743' x2='6.7743' y1='15.7501'
                            y2='0.7501'></line>
                        <path
                            d='M12.7988,9.6998 C12.7988,9.6998 9.5378,15.7498 6.7758,15.7498 C4.0118,15.7498 0.7498,9.6998 0.7498,9.6998'>
                        </path>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class='section' id='add-widget'>
    <div class='widget HTML' data-version='2' id='HTML94'>
        <div class='widget-content'>
            @include('components.blog.adB')
        </div>
    </div>
</div>
@endsection

