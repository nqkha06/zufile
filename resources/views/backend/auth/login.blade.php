@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="auth-inner">
            <div class="form login">
                <div class="form-header">
                    <div class="form-header__title">Đăng nhập</div>
                </div>

                <div class="form-body">
                    @if ($errors->any())
                        <div class="message">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                    <div class="message sc">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    <form action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <label class="form-label" for="email">Địa chỉ Email <span style="color: #f1416c">*</span></label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="" value="{{ old('email') }}" required>
                        
                        <label class="form-label">Mật khẩu <span style="color: #f1416c">*</span></label>
                        <div class="input-icon">
                            <input class="form-control password-input" type="password" name="password" placeholder="" required="">
                            <div class="input-icon-addon toggle-password">
                                <svg class="line show-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                </svg>
                                <svg class="line hide-icon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                    <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path>
                                    <path d="M3 3l18 18"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input id="remember" accept=""type="checkbox" name="remember">
                                <label for="remember" class="text">Ghi nhớ</label>
                            </div>

                            <a href="{{ route('auth.password.request') }}" class="text">Quên mật khẩu?</a>
                        </div>
                        <input class="form-btn" type="submit" name="submit" value="Đăng nhập">
                    </form>
                    <div class="login-signup">
                        <span class="text">Chưa có tài khoản? <a href="{{ route('auth.register') }}" class="text signup-link">Đăng ký</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection