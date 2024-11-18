@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="auth-inner">
            <div class="form login">
                <div class="form-header">
                    <div class="form-header__title">Đặt lại mật khẩu</div>
                </div>
                <div class="form-body">
                    @if ($errors->any())
                    <div class="message wr">
                        <p>{{ ($errors->all()[0]) }}</p>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="message sc">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    <form action="{{ route('auth.password.update') }}" method="post">
                        @csrf
                        <input type="text" class="hidden" name="token" value="{{ $request->route('token') }}">

                        <label class="form-label">Địa chỉ Email <span style="color: #f1416c">*</span></label>
                        <input class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" readonly="true" required>
                        
                        <label class="form-label">Mật khẩu mới <span style="color: #f1416c">*</span></label>
                        <input class="form-control" type="password" name="password" required>

                        <label class="form-label">Xác nhận lại mật khẩu mới <span style="color: #f1416c">*</span></label>
                        <input class="form-control" type="password" name="password_confirmation" required>

                        <input class="form-btn" type="submit" name="submit" value="Xác nhận">

                    </form>
                    <div class="login-signup">
                        <span class="text">Nhớ mật khẩu? <a href="{{ route('auth.login') }}" class="text signup-link">Đăng nhập</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection