<header class='header' id='header'>
    <!--[ Header content ]-->
    <div class='headCn'>
        <div class='headIn secIn'>
            <div class='headD headL'>
                <div class='headIc'>
                    <label class='tNav tIc bIc' for='offNav'>
                        <svg class='line' viewBox='0 0 24 24'>
                            <line x1='3' x2='21' y1='12' y2='12'></line>
                            <line x1='3' x2='21' y1='5' y2='5'></line>
                            <line x1='3' x2='21' y1='19' y2='19'></line>
                        </svg>
                    </label>
                </div>
                <!--[ Header widget ]-->
                <div class='headN section' id='header-title'>
                    <div class='widget Header' data-version='2' id='Header1'>
                        <div class='headInnr'>
                            <h1 class='headH hasSub'>
                                <span class='headTtl'>
                                    @if (request()->routeIs('blog'))
                                    {{ Setting::get('web_name', env('APP_NAME')) }}
                                    @else
                                    <a href="{{ route('blog') }}">{{ Setting::get('web_name', env('APP_NAME')) }}</a>
                                    @endif
                                </span>
                                <span class='headSub' data-text='blog'></span>
                            </h1>
                        </div>
                        <div class='headDsc hidden'>blog</div>
                    </div>
                </div>
            </div>
            <!--[ Header menu ]-->
            <div class='headD headM'>
                <div class='mnBr'>
                    <div class='mnBrs'>
                        <div class='mnH'>
                            <label aria-label='Close' class='c' data-text='Close'
                                for='offNav'></label>
                        </div>
                        <!--[ Mobile additional menu(only shown in mobile view) ]-->
                        <div class='mnMob section' id='header-Menu-mobile'>
                            <div class='widget PageList' data-version='2' id='PageList002'>
                                <ul class='mMenu'>
                                    <li>
                                        <a href='https://fletro.jagodesain.com/p/sitemap.html'>
                                            Sitemap
                                        </a>
                                    </li>
                                    <li>
                                        <span>
                                            Disclaimer
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Privacy
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class='widget LinkList' data-version='2' id='LinkList002'>
                                <ul class='mSoc'>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H17V18h4a1,1,0,0,0,0-2H17V14a2,2,0,0,1,2-2h2a1,1,0,0,0,0-2H19a4,4,0,0,0-4,4v2H12a1,1,0,0,0,0,2h3v9H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M22,3H10a7,7,0,0,0-7,7V22a7,7,0,0,0,7,7H22a7,7,0,0,0,7-7V10A7,7,0,0,0,22,3Zm5,19a5,5,0,0,1-5,5H10a5,5,0,0,1-5-5V10a5,5,0,0,1,5-5H22a5,5,0,0,1,5,5Z'>
                                                </path>
                                                <path
                                                    d='M16,9.5A6.5,6.5,0,1,0,22.5,16,6.51,6.51,0,0,0,16,9.5Zm0,11A4.5,4.5,0,1,1,20.5,16,4.51,4.51,0,0,1,16,20.5Z'>
                                                </path>
                                                <circle cx='23' cy='9' r='1'></circle>
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M13.35,28A13.66,13.66,0,0,1,2.18,22.16a1,1,0,0,1,.69-1.56l2.84-.39A12,12,0,0,1,5.44,4.35a1,1,0,0,1,1.7.31,9.87,9.87,0,0,0,5.33,5.68,7.39,7.39,0,0,1,7.24-6.15,7.29,7.29,0,0,1,5.88,3H29a1,1,0,0,1,.9.56,1,1,0,0,1-.11,1.06L27,12.27c0,.14,0,.28-.05.41a12.46,12.46,0,0,1,.09,1.43A13.82,13.82,0,0,1,13.35,28ZM4.9,22.34A11.63,11.63,0,0,0,13.35,26,11.82,11.82,0,0,0,25.07,14.11,11.42,11.42,0,0,0,25,12.77a1.11,1.11,0,0,1,0-.26c0-.22.05-.43.06-.65a1,1,0,0,1,.22-.58l1.67-2.11H25.06a1,1,0,0,1-.85-.47,5.3,5.3,0,0,0-4.5-2.51,5.41,5.41,0,0,0-5.36,5.45,1.07,1.07,0,0,1-.4.83,1,1,0,0,1-.87.2A11.83,11.83,0,0,1,6,7,10,10,0,0,0,8.57,20.12a1,1,0,0,1,.37,1.05,1,1,0,0,1-.83.74Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z'>
                                                </path>
                                                <path
                                                    d='M22,12a3,3,0,0,1-3-3,1,1,0,0,0-2,0V19a3,3,0,1,1-3-3,1,1,0,0,0,0-2,5,5,0,1,0,5,5V13a4.92,4.92,0,0,0,3,1,1,1,0,0,0,0-2Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M16,2A13,13,0,0,0,8,25.23V29a1,1,0,0,0,.51.87A1,1,0,0,0,9,30a1,1,0,0,0,.51-.14l3.65-2.19A12.64,12.64,0,0,0,16,28,13,13,0,0,0,16,2Zm0,24a11.13,11.13,0,0,1-2.76-.36,1,1,0,0,0-.76.11L10,27.23v-2.5a1,1,0,0,0-.42-.81A11,11,0,1,1,16,26Z'>
                                                </path>
                                                <path
                                                    d='M19.86,15.18a1.9,1.9,0,0,0-2.64,0l-.09.09-1.4-1.4.09-.09a1.86,1.86,0,0,0,0-2.64L14.23,9.55a1.9,1.9,0,0,0-2.64,0l-.8.79a3.56,3.56,0,0,0-.5,3.76,10.64,10.64,0,0,0,2.62,4A8.7,8.7,0,0,0,18.56,21a2.92,2.92,0,0,0,2.1-.79l.79-.8a1.86,1.86,0,0,0,0-2.64Zm-.62,3.61c-.57.58-2.78,0-4.92-2.11a8.88,8.88,0,0,1-2.13-3.21c-.26-.79-.25-1.44,0-1.71l.7-.7,1.4,1.4-.7.7a1,1,0,0,0,0,1.41l2.82,2.82a1,1,0,0,0,1.41,0l.7-.7,1.4,1.4Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class='a tIc bIc'>
                                            <svg viewBox='0 0 32 32'>
                                                <path
                                                    d='M24,28a1,1,0,0,1-.62-.22l-6.54-5.23a1.83,1.83,0,0,1-.13.16l-4,4a1,1,0,0,1-1.65-.36L8.2,18.72,2.55,15.89a1,1,0,0,1,.09-1.82l26-10a1,1,0,0,1,1,.17,1,1,0,0,1,.33,1l-5,22a1,1,0,0,1-.65.72A1,1,0,0,1,24,28Zm-8.43-9,7.81,6.25L27.61,6.61,5.47,15.12l4,2a1,1,0,0,1,.49.54l2.45,6.54,2.89-2.88-1.9-1.53A1,1,0,0,1,13,19a1,1,0,0,1,.35-.78l7-6a1,1,0,1,1,1.3,1.52Z'>
                                                </path>
                                            </svg>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class='mnMen section' id='header-Menu'>
                            <div class='widget HTML' data-version='2' id='HTML000'>
                                <ul class='mnMn' itemscope='itemscope'
                                    itemtype='https://schema.org/SiteNavigationElement'>
                                    @php 
                                    $header_menu = $menus->where('slug', 'blog-header-menu')->first()
                                    @endphp
                                    @if (!empty($header_menu))
                                    @foreach ($header_menu->items as $item)
                                    @if ($item->children->count())
                                    <li class='drp'>
                                        <input class='drpI hidden' id='drpDwn-{{ $item->id }}' name='drpDwn'
                                            type='checkbox' />
                                        <label class='a' for='drpDwn-{{ $item->id }}'>
                                            <svg class='line' viewBox='0 0 24 24'>
                                                <g transform='translate(2.500000, 2.500000)'>
                                                    <line x1='6.6787' x2='12.4937' y1='12.0742685'
                                                        y2='12.0742685'></line>
                                                    <path
                                                        d='M-1.13686838e-13,5.29836453 C-1.13686838e-13,2.85645977 1.25,0.75931691 3.622,0.272650243 C5.993,-0.214968804 7.795,-0.0463973758 9.292,0.761221672 C10.79,1.56884072 10.361,2.76122167 11.9,3.63645977 C13.44,4.51265024 15.917,3.19645977 17.535,4.94217405 C19.229,6.7697931 19.2200005,9.57550739 19.2200005,11.3640788 C19.2200005,18.1602693 15.413,18.6993169 9.61,18.6993169 C3.807,18.6993169 -1.13686838e-13,18.2288407 -1.13686838e-13,11.3640788 L-1.13686838e-13,5.29836453 Z'>
                                                    </path>
                                                </g>
                                            </svg>
                                            <span class='n'>{{ $item->name }}</span>
                                            <svg class='line d' viewBox='0 0 24 24'>
                                                <g transform='translate(5.000000, 8.500000)'>
                                                    <path d='M14,0 C14,0 9.856,7 7,7 C4.145,7 0,0 0,0'></path>
                                                </g>
                                            </svg>
                                        </label>
                                        <ul>
                                            @foreach ($item->children as $child)
                                            <li itemprop='name'><a href='{{ $child->url }}' itemprop='url'>{{ $child->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @else
                                    <li>
                                        <a class='a' href='{{ $item->url }}' itemprop='url'>
                                            <svg class='line' viewBox='0 0 24 24'>
                                                <g transform='translate(2.749500, 2.549500)'>
                                                    <path
                                                        d='M6.809,18.9067 C3.137,18.9067 9.41469125e-14,18.3517 9.41469125e-14,16.1277 C9.41469125e-14,13.9037 3.117,11.8997 6.809,11.8997 C10.481,11.8997 13.617,13.8847 13.617,16.1077 C13.617,18.3307 10.501,18.9067 6.809,18.9067 Z'>
                                                    </path>
                                                    <path
                                                        d='M6.809,8.728 C9.219,8.728 11.173,6.774 11.173,4.364 C11.173,1.954 9.219,-2.48689958e-14 6.809,-2.48689958e-14 C4.399,-2.48689958e-14 2.44496883,1.954 2.44496883,4.364 C2.436,6.766 4.377,8.72 6.778,8.728 L6.809,8.728 Z'>
                                                    </path>
                                                    <path
                                                        d='M14.0517,7.5293 C15.4547,7.1543 16.4887007,5.8753 16.4887007,4.3533 C16.4897,2.7653 15.3627,1.4393 13.8647,1.1323'>
                                                    </path>
                                                    <path
                                                        d='M14.7113,11.104 C16.6993,11.104 18.3973,12.452 18.3973,13.655 C18.3973,14.364 17.8123,15.092 16.9223,15.301'>
                                                    </path>
                                                </g>
                                            </svg>
                                            <span class='n' itemprop='name'>{{ $item->name }}</span>
                                        </a>
                                    </li>
                                    @endif

                                    @endforeach
                                    @endif
                               
                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <label class='fCls' for='offNav'></label>
            </div>
            <div class='headD headR'>
                <div class='headI'>
                    <div class='headP section' id='header-icon'>
                        <div class='widget TextList' data-version='2' id='TextList000'>
                            <ul class='headIc'>
                                
                                <li class='isDrk'>
                                    <span aria-label='Dark' class='tDark tIc tDL bIc' onclick='darkMode()'
                                        role='button'>
                                        <svg class='line' viewBox='0 0 24 24'>
                                            <g class='d1'>
                                                <path
                                                    d='M183.72453,170.371a10.4306,10.4306,0,0,1-.8987,3.793,11.19849,11.19849,0,0,1-5.73738,5.72881,10.43255,10.43255,0,0,1-3.77582.89138,1.99388,1.99388,0,0,0-1.52447,3.18176,10.82936,10.82936,0,1,0,15.118-15.11819A1.99364,1.99364,0,0,0,183.72453,170.371Z'
                                                    transform='translate(-169.3959 -166.45548)'></path>
                                            </g>
                                            <g class='d2'>
                                                <path class='f'
                                                    d='M12 18.5C15.5899 18.5 18.5 15.5899 18.5 12C18.5 8.41015 15.5899 5.5 12 5.5C8.41015 5.5 5.5 8.41015 5.5 12C5.5 15.5899 8.41015 18.5 12 18.5Z'>
                                                </path>
                                                <path
                                                    d='M19.14 19.14L19.01 19.01M19.01 4.99L19.14 4.86L19.01 4.99ZM4.86 19.14L4.99 19.01L4.86 19.14ZM12 2.08V2V2.08ZM12 22V21.92V22ZM2.08 12H2H2.08ZM22 12H21.92H22ZM4.99 4.99L4.86 4.86L4.99 4.99Z'
                                                    stroke-width='2'></path>
                                            </g>
                                        </svg>
                                    </span>
                                </li>
                                <li class='isSrh'>
                                    <label aria-label='Search' class='tSrch tIc bIc' for='offSrh'>
                                        <svg class='line' viewBox='0 0 24 24'>
                                            <g transform='translate(2.000000, 2.000000)'>
                                                <circle cx='9.76659044' cy='9.76659044' r='8.9885584'>
                                                </circle>
                                                <line x1='16.0183067' x2='19.5423342' y1='16.4851259'
                                                    y2='20.0000001'></line>
                                            </g>
                                        </svg>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>