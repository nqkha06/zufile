@extends('layouts.member')

@section('title', __('profile.title'))

@section('content')
    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-person"></i></div>
                <div class="title">Thông tin cá nhân</div>
            </div>
        </div>
        <div class="box-container">
            <div class="content">
                <div class="account-profile">
                    <div class="account-content">
                        <form action="" method="post" class="form">
                            @csrf
                            <div class="column">
                                <div class="input-box">
                                    <label>{{ __('profile.fullname') }} <span style="color: #f1416c">*</span></label>
                                    <input type="text" name="fullname" placeholder="{{ __('profile.enter_fullname') }}"
                                        value="{{ Auth::user() && Auth::user()->address->fullname ? Auth::user()->address->fullname : '' }}"
                                        required />
                                </div>
                                <div class="input-box">
                                    <label>{{ __('profile.email') }} <span style="color: #f1416c">*</span></label>
                                    <input type="text" name="email" placeholder="{{ __('profile.enter_email') }}"
                                        value="{{ Auth::user() && Auth::user()->email ? Auth::user()->email : '' }}"
                                        required />
                                </div>

                                <div class="input-box">
                                    <label>{{ __('profile.phone_number') }} <span style="color: #f1416c">*</span></label>
                                    <input type="text" name="phonenumber"
                                        placeholder="{{ __('profile.enter_phone_number') }}"
                                        value="{{ Auth::user() && Auth::user()->address->number_phone ? Auth::user()->address->number_phone : '' }}"
                                        required />
                                </div>
                                <div class="input-box">
                                    <label>{{ __('profile.membership') }}</label>
                                    <input type="text" name="membership"
                                        placeholder="{{ __('profile.enter_membership') }}" value="Default member" required
                                        readonly />
                                </div>

                                <div class="input-box">
                                    <label>{{ __('profile.address') }} <span style="color: #f1416c">*</span></label>
                                    <input type="text" name="address_1" placeholder="{{ __('profile.enter_address') }}"
                                        value="{{ Auth::user() && Auth::user()->address->address_1 ? Auth::user()->address->address_1 : '' }}"
                                        required />
                                </div>
                                <div class="input-box">
                                    <label>{{ __('profile.address_2') }}</label>
                                    <input type="text" name="address_2"
                                        placeholder="{{ __('profile.enter_address_2') }}"
                                        value="{{ Auth::user() && Auth::user()->address->address_2 ? Auth::user()->address->address_2 : '' }}" />
                                </div>

                                <div class="input-box">
                                    <label>{{ __('profile.country') }} <span style="color: #f1416c">*</span></label>

                                    <div class="select-box">
                                        <select name="country">
                                            <option hidden="">{{ __('profile.enter_country') }}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <label>{{ __('profile.city') }}</label>
                                    <input type="text" name="city" placeholder="{{ __('profile.enter_city') }}"
                                        value="{{ Auth::user() && Auth::user()->address->city ? Auth::user()->address->city : '' }}" />
                                </div>

                                <div class="input-box">
                                    <label>{{ __('profile.region') }}</label>
                                    <input type="text" name="region" placeholder="{{ __('profile.enter_region') }}"
                                        value="{{ Auth::user() && Auth::user()->address->region ? Auth::user()->address->region : '' }}" />
                                </div>
                                <div class="input-box">
                                    <label>{{ __('profile.zipcode') }}</label>
                                    <input type="text" name="zipcode" placeholder="{{ __('profile.enter_zipcode') }}"
                                        value="{{ Auth::user() && Auth::user()->address->zipcode ? Auth::user()->address->zipcode : '' }}" />
                                </div>
                            </div>
                            <input class="btn-submit" type="submit" name="submit-info" value="{{ __('profile.save') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /*input*/
        input[disabled],
        input[readonly] {
            background: #f8f8f8;
            cursor: not-allowed
        }

        .input-box {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x)* .5);
            padding-left: calc(var(--bs-gutter-x)* .5);
            margin-top: var(--bs-gutter-y)
        }

        @media (min-width:768px) {
            .input-box {
                flex: 0 0 auto;
                width: 50%
            }
        }

        div :where(.input-box input, .select-box) {
            position: relative;
            height: 40px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: var(--color-input);
            background: var(--bg-input);
            margin-top: 7px;
            margin-bottom: 10px;
            border: 1px solid var(--border-input);
            border-radius: 6px;
            padding: 0 15px;
        }

        .input-box input:focus {
            box-shadow: 0 1px 0 var(--bgsd-input-fc)
        }

        .column {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1* var(--bs-gutter-y));
            margin-right: calc(-.5* var(--bs-gutter-x));
            margin-left: calc(-.5* var(--bs-gutter-x))
        }

        .address:where(input, .select-box) {
            margin-top: 15px
        }

        .select-box select {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            color: var(--color-input);
            background-color: var(--bg-input);
            font-size: 1rem
        }
    </style>

@endsection
