<footer>
    <div class='secIn'>
        <div class='fotIn'>
            <div class='section' id='footer-widget-1'>
                <div class='widget HTML' id='HTML77'>
                    <div class='widget-content abtU' data-text='Made with coffee by'>
                        <div>
                            <img alt="{{ Setting::get('web_name', '') }}" class="abtL" data-src="#" height="150"
                                src="{{ empty(Setting::get('web_favicon')) ? '#' : asset(Setting::get('web_favicon')) }}"
                                width="150">

                            <noscript>
                                <img alt='{{ Setting::get('web_name', '') }}' class='abtL' height='150'
                                    src='{{ empty(Setting::get('web_favicon')) ? '#' : asset(Setting::get('web_favicon')) }}'
                                    width='150'>
                                </img>
                            </noscript>
                            <div class="abtT">
                                <h2 class="tl">{{ Setting::get('web_name', '') }}</h2>
                                <p class="abtD">{{ Setting::get('web_description', '') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class='widget LinkList' id='LinkList1'>
                    <ul class='sL'>
                        @php
                            $foot_social = $menus->where('slug', 'blog-foot-social')->first();
                        @endphp
                        @if (!empty($foot_social))
                            @foreach ($foot_social->items as $item)
                                <li>
                                    @if (!empty($item->url))
                                        <a class='l' href="{{ $item->url }}"
                                            data-text='{{ $item->name }}'></a>
                                    @else
                                        <span class='l' data-text='{{ $item->name }}'></span>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class='section' id='footer-widget-2'>
                <div class='widget LinkList' id='LinkList2'>
                    @php
                        $foot_menu_1 = $menus->where('slug', 'blog-foot-menu-1')->first();
                    @endphp
                    @if (!empty($foot_menu_1))
                        <h3 class='title'>
                            {{ $foot_menu_1->name }}
                        </h3>
                        <div class='widget-content'>
                            <ul>
                                @foreach ($foot_menu_1->items as $item)
                                    <li>
                                        <a href='{{ $item->url }}'>
                                            <span>{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class='section' id='footer-widget-3'>
                <div class='widget LinkList' id='LinkList3'>
                    @php
                        $foot_menu_2 = $menus->where('slug', 'blog-foot-menu-2')->first();
                    @endphp
                    @if (!empty($foot_menu_2))
                        <h3 class='title'>
                            {{ $foot_menu_2->name }}
                        </h3>
                        <div class='widget-content'>
                            <ul>
                                @foreach ($foot_menu_2->items as $item)
                                    <li>
                                        <a href='{{ $item->url }}'>
                                            <span>{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class='section' id='footer-widget-4'>
                <div class='widget LinkList' id='LinkList4'>
                    @php
                        $foot_menu_3 = $menus->where('slug', 'blog-foot-menu-3')->first();
                    @endphp
                    @if (!empty($foot_menu_3))
                        <h3 class='title'>
                            {{ $foot_menu_3->name }}
                        </h3>
                        <div class='widget-content'>
                            <ul>
                                @foreach ($foot_menu_3->items as $item)
                                    <li>
                                        <a href='{{ $item->url }}'>
                                            <span>{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--[ Credit ]-->
        <div class='cdtIn section' id='credit-widget'>
            <div class='widget HTML' id='HTML88'>
                <div class='fotCd'>
                    <span class='credit'>

                        &#169; <span id='getYear'>
                            <script>
                                /*<![CDATA[*/
                                var d = new Date();
                                var n = d.getFullYear();
                                document.getElementById('getYear').innerHTML = n; /*]]>*/
                            </script>
                        </span> &#8231; <bdi><a href='{{ Setting::get("web_url", config("app.url")) }}'>{{ env('APP_NAME') }}</a></bdi>.
                        All rights reserved.

                    </span>
                    <span class='creator'>Developed by <a href='https://theme.jagodesain.com'>Jago
                            Desain</a></span>
                </div>
            </div>
            <div class='widget TextList' id='TextList88'>
                <div class='toTop tTop' data-text='Top' onclick='window.scrollTo({top: 0});'>
                    <svg class='line' viewBox='0 0 24 24'>
                        <g
                            transform='translate(12.000000, 12.000000) rotate(-180.000000) translate(-12.000000, -12.000000) translate(5.000000, 8.500000)'>
                            <path d='M14,0 C14,0 9.856,7 7,7 C4.145,7 0,0 0,0'></path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</footer>
