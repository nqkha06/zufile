<footer class="footer footer-transparent">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="#" target="_blank" class="link-secondary"
                            rel="noopener">##</a></li>
                    <li class="list-inline-item"><a href="#" class="link-secondary">##</a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" class="link-secondary"
                            rel="noopener">##</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        &copy; 2022 -
                        <span id='getYear'>
                            <script>
                                /*<![CDATA[*/
                                var d = new Date();
                                var n = d.getFullYear();
                                document.getElementById('getYear').innerHTML = n;
                                /*]]>*/
                            </script>
                        </span>
                        &#8231;
                        <bdi>
                            <a href='{{ Setting::get('web_url') }}'>{{ Setting::get('web_name', env('APP_NAME')) }}</a>
                        </bdi>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
