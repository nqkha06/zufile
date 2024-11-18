@extends('layouts.member.auth')

@section('content')
<div class="container">
  <div class="auth-wrapper">
    <div class="auth-inner">
      <div class="form login">
        <div class="form-header">
            <div class="form-header__title">Quên mật khẩu?</span>
        </div>
        <div class="form-body">
          @if ($errors->any())
          <div class="message wr">
            <p>{{ ($errors->all()[0]) }}</p>
          </div>
          @elseif (session('success'))
          <div class="message sc">
            <p>{{ session('success') }}</p>
          </div>
          @else
          <p style="margin-bottom: 15px;margin-bottom: 32px;color: rgb(107 114 128/1);">
            Đừng lo lắng! Chỉ cần nhập email của bạn và chúng tôi sẽ gửi cho bạn một mã để đặt lại mật khẩu của bạn!</p>
          @endif
          <form action="{{ route('auth.password.email') }}" method="post">
            @csrf
            <label class="form-label">Địa chỉ Email <span style="color: #f1416c">*</span></label>
            <input class="form-control" type="email" name="email" placeholder="Nhập địa chỉ Email.." value="{{ old('email') }}" required>

            <input class="form-btn" type="submit" name="forgot-password" value="Xác nhận">
          </form>
          <div class="login-signup">
            <span class="text">Nhớ mật khẩu? <a href="{{ route('auth.login') }}" class="text signup-link">Đăng nhập</a>
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>
  @endsection