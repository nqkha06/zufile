    @php
    $segment = request()->segment(2);
    $path = Request::path();
    @endphp
    <nav class="mainL">
        <div class="leftN">
            <div class="navH">
                <div class="nHC">
                    <div class="hC-left">
                        <div class="l-image">
                            <img src="{{ Setting::get('web_favicon') }}" alt="Logo">
                        </div>
                        <span class="l-name">{{ Setting::get('web_name', env('APP_NAME')) }}</span>
                    </div>
                    <div class="hC-right">
                        <div class="r-close">
                            <label for="pNav" class="sidebar-close"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navB">
                <ul class="nBC">
                    @php
                    $cntDrp = 0;
                    @endphp
                    @foreach (__('sidebar_member.module') as $item)
                    @if (isset($item['sub_module']))
                    <li class="drp">
                        <input class="drpI hidden" id="drpDwn-{!! $cntDrp !!}" name="drpDwn" type="checkbox" {{ in_array($segment, $item['name']) ? 'checked' : '' }}>
                        <label class="a" for="drpDwn-{!! $cntDrp !!}">
                            {!! $item['icon'] !!}
                            <span class="n">{{ $item['title'] }}</span>
                            <svg class="line d" viewBox="0 0 24 24"><g transform="translate(5.000000, 8.500000)"><path d="M14,0 C14,0 9.856,7 7,7 C4.145,7 0,0 0,0"></path></g></svg>
                        </label>
                        <ul>
                            @foreach ($item['sub_module'] as $module)
                            <li>
                                <a <?= ($path == $module['route']) ? 'class="active"' : '' ?> href="/{{ $module["route"] }}">
                                    <span>{{ $module["title"] }}</span>
                                </a>
                            </li>
                            @endforeach
       
                        </ul>
                    </li>
                    @php
                    $cntDrp += 1;
                    @endphp
                    @else
                    <li>
                        <a class="a {{ in_array($segment, $item['name']) ? 'active' : '' }}" {{ isset($item['route']) ? 'href='.$item["route"].'' : '' }}>
                            {!! $item['icon'] !!}
                            <span class="n">{{ $item['title'] }}</span>
                        </a>
                    </li> 
                    @endif

                    @endforeach
    
    
                    <li>
                        <a class="a" href="#">
                            <svg class="line" viewBox="0 0 24 24"><path d="M17 18.4301H13L8.54999 21.39C7.88999 21.83 7 21.3601 7 20.5601V18.4301C4 18.4301 2 16.4301 2 13.4301V7.42999C2 4.42999 4 2.42999 7 2.42999H17C20 2.42999 22 4.42999 22 7.42999V13.4301C22 16.4301 20 18.4301 17 18.4301Z" stroke-miterlimit="10"></path><path d="M12.0001 11.36V11.15C12.0001 10.47 12.4201 10.11 12.8401 9.82001C13.2501 9.54001 13.66 9.18002 13.66 8.52002C13.66 7.60002 12.9201 6.85999 12.0001 6.85999C11.0801 6.85999 10.3401 7.60002 10.3401 8.52002"></path><path d="M11.9955 13.75H12.0045"></path></svg>
                            <span class="n">Hỗ trợ <span class="badge new">new</span></span>
                        </a>
                    </li>
                    </ul>
            </div>
            <div class="navF">
                <ul class="nBC">
                    <li>
                        <a class="a" onclick="logout()">
                            <svg class="line" viewBox="0 0 24 24"><path d="M8.90002 7.55999C9.21002 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24002 20.08 8.91002 16.54"></path><path d="M15 12H3.62"></path><path d="M5.85 8.6499L2.5 11.9999L5.85 15.3499"></path></svg>
                            <span class="n">{{ __('app.member.logout') }}</span>
                        </a>
                    </li>
    
                    <li>
                        <a class="a" href="#">
                            <svg class="line" viewBox="0 0 24 24"><path d="M2.03009 12.42C2.39009 17.57 6.76009 21.76 11.9901 21.99C15.6801 22.15 18.9801 20.43 20.9601 17.72C21.7801 16.61 21.3401 15.87 19.9701 16.12C19.3001 16.24 18.6101 16.29 17.8901 16.26C13.0001 16.06 9.00009 11.97 8.98009 7.13996C8.97009 5.83996 9.24009 4.60996 9.73009 3.48996C10.2701 2.24996 9.62009 1.65996 8.37009 2.18996C4.41009 3.85996 1.70009 7.84996 2.03009 12.42Z"></path></svg>
                            <span class="n">{{ __('app.member.dark_mode') }}</span>
                            <div class="mode-toggle">
                                <span class="switch"></span>
                            </div>
                        </a>
                        
                    </li>
                    </ul>
                </div>
    
        </div>
    </nav>
    <label class="fc" for="pNav"></label>
    <script>
            const body = document.querySelector("body")
        , getMode = localStorage.getItem("mode") || (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches ? "light" : "");
    body.classList.toggle(getMode);
        const modeToggle = body.querySelector(".mode-toggle");
        modeToggle.addEventListener("click", () => {
            body.classList.toggle("dark"), body.classList.contains("dark") ? localStorage.setItem("mode", "dark") : localStorage.setItem("mode", "light")
        });
    </script>