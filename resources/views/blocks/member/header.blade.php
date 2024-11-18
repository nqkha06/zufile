<header class="header">
    <div class="hd-left">
        <label for="pNav">
            <svg class="line sidebar-toggle" viewBox="0 0 24 24">
                <line x1="3" x2="21" y1="12" y2="12"></line>
                <line x1="3" x2="21" y1="5" y2="5"></line>
                <line x1="3" x2="21" y1="19" y2="19"></line>
            </svg>
        </label>
        {{-- <input class="forCreate hidden" id="forCreate" type="checkbox" /> --}}
        
        <label for="forCreate" class="forCreate fc-ovl">
            <div class="create-link hIn" id="CREATE_NEW"><i class="bi bi-box-arrow-up-right"></i>{{ __('header.create_new') }}</div>
        </label>
        <style>
            .forCreate .h {
                display: inline-flex;
                align-items: center;
                align-self: flex-start;
                gap: 6px;
                font-size: small;
                opacity: .8;
            }
            .forCreate .h svg {
                height: 13px;
                width: 13px;
            }
            .forCreate .h::after {
                content: attr(data-text);
            }
            .forCreate .inn {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center
            }
            .forCreate .inn >*::after {
                content: attr(data-text);
                display: block;
            }
            .forCreate .inn span {
                display: block;
                text-align: center;
                margin: 10px 0;
                width: 65px;
                font-size: small;
                background: #f2f2f2;
                padding: 10px 7px;
                border-radius: 10px
            }
            .forCreate .f {
                font-size: small;
            }
        </style>
        <div class="forCreate iPu l">
            <label class="h" data-text="Quay lại" for="forCreate">
                <svg class="line r" viewBox="0 0 24 24"><path d="M15 19.9201L8.47997 13.4001C7.70997 12.6301 7.70997 11.3701 8.47997 10.6001L15 4.08008"></path></svg>
            </label>
            <div class="inn">
                <span class="S" data-text="STU" role="button">
                    <svg class="line" viewBox="0 0 24 24"><path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10"></path><path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z"></path><path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z"></path></svg>
                </span>
                <span class="N" data-text="NOTE" role="button">
                    <svg class="line" viewBox="0 0 24 24"><path d="M8 16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43"></path><path d="M18.57 22H14C11.71 22 10.57 20.86 10.57 18.57V11.43C10.57 9.14 11.71 8 14 8H18.57C20.86 8 22 9.14 22 11.43V18.57C22 20.86 20.86 22 18.57 22Z"></path><path d="M14.87 15H18.13"></path><path d="M16.5 16.6301V13.3701"></path></svg>
                </span>
                <span class="S" data-text="SHORT" role="button">
                    <svg class="line" viewBox="0 0 24 24"><path d="M14.99 17.5H16.5C19.52 17.5 22 15.03 22 12C22 8.98 19.53 6.5 16.5 6.5H14.99"></path><path d="M9 6.5H7.5C4.47 6.5 2 8.97 2 12C2 15.02 4.47 17.5 7.5 17.5H9"></path><path d="M8 12H16"></path></svg>
                </span>
            </div>
            <span class="f">Chọn kiểu liên kết muốn tạo ~</span>
        </div>
    </div>

    <div class="hd-right">
        <input class="cbLang hidden" id="pLang" type="checkbox" />
        <input class="cbProfil hidden" id="pProfil" type="checkbox" />

        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('super-admin'))
        <a class="button" href="{{ route('admin.index') }}" style="width: 100%;padding: 7px;stroke: #fff;border-radius: 8px;"><svg style="stroke: currentColor;" class="line" viewBox="0 0 24 24"><path d="M17.28 10.45L21 6.72998L17.28 3.01001"></path><path d="M3 6.72998H21"></path><path d="M6.71997 13.55L3 17.2701L6.71997 20.9901"></path><path d="M21 17.27H3"></path></svg></a>
        @endif

        <button class="current-amount">${{ round($user_metric['total_balance'], 3) }}<span class="bullet-dot bg-success animation-blink" style="position: absolute; right: 1px; top: 2px"></span></button>
        
        <label for="pLang" class="language fc-ovl">
            <i class="bi bi-translate hIn"></i>
        </label>
        <label for="pProfil" class="profile fc-ovl" style="display: flex">
            <img src="{{ URL('/') }}/images/user.png" alt="">
        </label>
        <div class="Iprofil iPu r">
            <div class="ipopUp-header">
                <div class="accountPhoto" style="align-items: center;display: flex;">
                    <img src="{{ URL('/') }}/images/user.png" alt="user" style="width: 45px;margin-left: 0;margin-right: 8px">
                </div>
                <div class="accountInfo">
                    <div class="accountInfoName">{{ Auth::user()->name }}</div>
                    <div class="accountInfoEmail">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="accountBody">
                <div class="description"><span class="icon"><i class="bi bi-wallet"></i></span>
                    <p>{{ __('header.total_income') }} <strong>${{ round($user_metric['total_revenue'], 3) }}</strong></p>
                </div>
                <div class="description"><span class="icon"><i class="bi bi-eye"></i></span>
                    <p>{{ __('header.total_views') }} <strong>{{ $user_metric['total_views'] }}</strong></p>
                </div>
                <div class="description"><span class="icon"><i class="bi bi-people"></i></span>
                    <p>{{ __('header.total_referral') }} <strong>$0</strong></p>
                </div>
                <div class="description"><span class="icon"><i class="bi bi-cash-stack"></i></span>
                    <p>{{ __('header.balance_amount') }} <strong>${{ round($user_metric['total_balance'], 3) }}</strong></p>
                </div>
            </div>
            <div class="accountFooter">
                <div class="description" onclick="logout()"><span class="icon"><i
                            class="bi bi-box-arrow-right"></i></span>
                    <p>{{ __('header.logout') }}</p>
                </div>
            </div>
        </div>
        <div class="Ilang iPu r">
            <div class="ipopUp-lang">
                <?php
                    $availableLanguages = array(
                        'en' => 'English',
                        'vi' => 'VietNam'
                    );
                    
                    foreach ($availableLanguages as $code => $language) {
                        $mark = (App::currentLocale() == $code) ? 'nLang a' : 'nLang';
                        echo "<a class='$mark' href='".URL('/')."/lang/$code'>$language</a>";
                    }
                ?>

            </div>
        </div>

    </div>
</header>
