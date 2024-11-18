@extends('layouts.clients.home_layout')

@section('content')
    <div class="landing-page">
        <div class="section" id="lPage-Top">
            <div class="page-1">
                <div class="bg"></div>
                <div class="hero">
                    <div class="anim-elements">
                        <div class="anim-element"></div>
                        <div class="anim-element"></div>
                        <div class="anim-element"></div>
                        <div class="anim-element"></div>
                        <div class="anim-element"></div>
                    </div>
                    <div class="landing-absolute" id="gStu">
                        <div class="stu_cnt" id="stuCnt"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section" id="lPage-Center">
            <div class="page-3" id="Featured">
                <div class="landing-content">
                    <div class="titlex">
                        <h2>{{ __('landing.why', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</h2>
                        <span>{{ __('landing.sub_why', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</span>
                    </div>
                    <ul class="featured">
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_1') }}</div>
                                <div class="content">{{ __('landing.adv_desc_1') }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_2') }}</div>
                                <div class="content">{{ __('landing.adv_desc_2') }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_3') }}</div>
                                <div class="content">{{ __('landing.adv_desc_3') }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_4') }}</div>
                                <div class="content">{{ __('landing.adv_desc_4') }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_5') }}</div>
                                <div class="content">{{ __('landing.adv_desc_5') }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="featuredSc-content">
                                <div class="featuredSc-title">{{ __('landing.adv_6') }}</div>
                                <div class="content">{{ __('landing.adv_desc_6') }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="widget HTML" id="HTML52">
                <div class="page-4">
                    <div class="landing-content">
                        <div class="titlex">
                            <h2>{{ __('landing.how_work') }}</h2>
                            <span>{{ __('landing.sub_how', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</span>
                        </div>
                        <div class="how">
                            <div class="how-item">
                                <div class="how-icon">
                                    <svg class="line" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g transform="translate(3.500000, 3.500000)">
                                            <line x1="9.8352" x2="16.2122" y1="16.0078" y2="16.0078"></line>
                                            <path
                                                d="M12.5578,1.3589 L12.5578,1.3589 C11.2138,0.3509 9.3078,0.6229 8.2998,1.9659 C8.2998,1.9659 3.2868,8.6439 1.5478,10.9609 C-0.1912,13.2789 1.4538,16.1509 1.4538,16.1509 C1.4538,16.1509 4.6978,16.8969 6.4118,14.6119 C8.1268,12.3279 13.1638,5.6169 13.1638,5.6169 C14.1718,4.2739 13.9008,2.3669 12.5578,1.3589 Z">
                                            </path>
                                            <line x1="7.0041" x2="11.8681" y1="3.7114" y2="7.3624"></line>
                                        </g>
                                    </svg>
                                    <div class="process-number">1</div>
                                </div>
                                <div class="how-title">

                                    <span>{{ __('landing.step_1') }}</span>
                                    <p>{{ __('landing.step_desc_1') }}</p>

                                </div>
                            </div>
                            <div class="how-item">
                                <div class="how-icon">
                                    <svg class="line" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path
                                                d="M92.30583,264.72053a3.42745,3.42745,0,0,1-.37,1.57,3.51,3.51,0,1,1,0-3.13995A3.42751,3.42751,0,0,1,92.30583,264.72053Z"
                                                transform="translate(-83.28571 -252.73452)"></path>
                                            <circle cx="18.48892" cy="5.49436" r="3.51099"></circle>
                                            <circle cx="18.48892" cy="18.50564" r="3.51099"></circle>
                                            <line x1="12.53012" x2="8.65012" y1="8.476" y2="10.416"></line>
                                            <line x1="12.53012" x2="8.65012" y1="15.496" y2="13.556"></line>
                                        </g>
                                    </svg>
                                    <div class="process-number">2</div>
                                </div>
                                <div class="how-title">

                                    <span>{{ __('landing.step_2') }}</span>
                                    <p>{{ __('landing.step_desc_2') }}</p>

                                </div>
                            </div>
                            <div class="how-item">
                                <div class="how-icon">
                                    <svg class="line" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g transform="translate(2.850300, 2.150000)">
                                            <path
                                                d="M7.072,19.6583 C3.258,19.6583 1.15463195e-13,19.0813 1.15463195e-13,16.7713 C1.15463195e-13,14.4613 3.237,12.3603 7.072,12.3603 C10.886,12.3603 14.144,14.4413 14.144,16.7503 C14.144,19.0593 10.907,19.6583 7.072,19.6583 Z">
                                            </path>
                                            <path
                                                d="M7.07200002,9.066 C9.57500002,9.066 11.605,7.036 11.605,4.533 C11.605,2.029 9.57500002,1.50990331e-14 7.07200002,1.50990331e-14 C4.56900002,1.50990331e-14 2.53897,2.029 2.53897,4.533 C2.53000002,7.027 4.54600002,9.057 7.04000002,9.066 L7.07200002,9.066 Z">
                                            </path>
                                            <line x1="16.281" x2="16.281" y1="5.9791" y2="9.9891"></line>
                                            <line x1="18.3273" x2="14.2373" y1="7.9839" y2="7.9839"></line>
                                        </g>
                                    </svg>
                                    <div class="process-number">3</div>
                                </div>
                                <div class="how-title">

                                    <span>{{ __('landing.step_3') }}</span>
                                    <p>{{ __('landing.step_desc_3') }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget HTML" id="HTML53">
                <div class="page-5">
                    <div class="landing-content">
                        <div class="titlex">
                            <h2>{{ __('landing.saying') }}</h2>
                            <span>{{ __('landing.sub_saying', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</span>
                        </div>
                        <ul class="review">
                            <li>
                                <div class="review-content">

                                    <!-- text -->
                                    {{ __('landing.saying_1', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}
                                </div>
                            </li>
                            <li class="color">
                                <div class="review-content">

                                    <!-- text -->
                                    {{ __('landing.saying_2') }}
                                </div>
                            </li>
                            <li class="color">
                                <div class="review-content">

                                    <!-- text -->
                                    {{ __('landing.saying_3') }}
                                </div>
                            </li>
                            <li>
                                <div class="review-content">

                                    <!-- text -->
                                    {{ __('landing.saying_4', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget HTML" id="HTML54">
                <div class="page-6">
                    <div class="landing-content">
                        <div class="titlex">
                            <h2>{{ __('landing.increase', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</h2>
                            <span>{{ __('landing.sub_increase', ['name' => Setting::get('web_name', env('APP_NAME'))]) }}</span>
                        </div>
                        <a class="button outline" href="#gStu">
                            <!-- text -->
                            {{ __('landing.start') }}
                            <svg style="width:20px; height:20px; margin-left: 5px" viewBox="0 0 24 24">
                                <path
                                    d="M13.13 22.19L11.5 18.36C13.07 17.78 14.54 17 15.9 16.09L13.13 22.19M5.64 12.5L1.81 10.87L7.91 8.1C7 9.46 6.22 10.93 5.64 12.5M19.22 4C19.5 4 19.75 4 19.96 4.05C20.13 5.44 19.94 8.3 16.66 11.58C14.96 13.29 12.93 14.6 10.65 15.47L8.5 13.37C9.42 11.06 10.73 9.03 12.42 7.34C15.18 4.58 17.64 4 19.22 4M19.22 2C17.24 2 14.24 2.69 11 5.93C8.81 8.12 7.5 10.53 6.65 12.64C6.37 13.39 6.56 14.21 7.11 14.77L9.24 16.89C9.62 17.27 10.13 17.5 10.66 17.5C10.89 17.5 11.13 17.44 11.36 17.35C13.5 16.53 15.88 15.19 18.07 13C23.73 7.34 21.61 2.39 21.61 2.39S20.7 2 19.22 2M14.54 9.46C13.76 8.68 13.76 7.41 14.54 6.63S16.59 5.85 17.37 6.63C18.14 7.41 18.15 8.68 17.37 9.46C16.59 10.24 15.32 10.24 14.54 9.46M8.88 16.53L7.47 15.12L8.88 16.53M6.24 22L9.88 18.36C9.54 18.27 9.21 18.12 8.91 17.91L4.83 22H6.24M2 22H3.41L8.18 17.24L6.76 15.83L2 20.59V22M2 19.17L6.09 15.09C5.88 14.79 5.73 14.47 5.64 14.12L2 17.76V19.17Z"
                                    fill="currentColor"></path>
                            </svg></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="lPage-Bot">
            <div class="widget HTML" id="HTML55">
                <div class="page-2">
                    <div class="pgCont">
                        <div class="secIn">
                            <h2 class="title">{{ __('landing.faq') }}</h2>
                            <div class="content">
                                <p id="FAQ">{{ __('landing.sub_faq') }}</p>

                                <!--[ Accordion start ]-->
                                <div class="showH">
                                    <!--[ Accordion line 1 ]-->
                                    <details class="ac">
                                        <summary>{{ __('landing.question_1') }}</summary>
                                        <div class="aC">
                                            <p>{{ __('landing.answer_1') }}</p>
                                        </div>
                                    </details>

                                    <!--[ Accordion line 2 ]-->
                                    <details class="ac">
                                        <summary>{{ __('landing.question_2') }}</summary>
                                        <div class="aC">
                                            <p>{{ __('landing.answer_2') }}</p>
                                        </div>
                                    </details>

                                    <!--[ Accordion line 3 ]-->
                                    <details class="ac">
                                        <summary>{{ __('landing.question_3') }}</summary>
                                        <div class="aC">
                                            <p>{{ __('landing.answer_3') }}</p>
                                        </div>
                                    </details>

                                    <!--[ Accordion line 4 ]-->
                                    <details class="ac">
                                        <summary>{{ __('landing.question_4') }}</summary>
                                        <div class="aC">
                                            <p>{{ __('landing.answer_4') }}</p>
                                        </div>
                                    </details>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--[ Content section ]-->
@endsection
