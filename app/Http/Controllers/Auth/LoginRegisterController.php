<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Models\User;
use App\Models\ResetToken;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'forgotPassword', 'postForgotPassword', 'resetPassword', 'postResetPassword'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $data = [];
        $data['title'] = 'Đăng ký';

        return view('backend.member.auth.register', $data);
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z0-9_]+$/|min:5|max:50|unique:users',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:6|max:32|confirmed|regex:/^[a-zA-Z0-9]+$/',
        ], [
            'name.required' => 'Tên đăng nhập là trường bắt buộc',
            'name.regex' => 'Tên đăng nhập không được có dấu, khoảng trắng hoặc kí tự đặc biệt',
            'name.min' => 'Tên đăng nhập không được ngắn quá 5 kí tự',
            'name.max' => 'Tên đăng nhập không được ngắn quá 50 kí tự',
            'name.unique' => 'Tên đăng nhập này đã được sử dụng',

            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Định dạng Email không hợp lệ',
            'email.max' => 'Email không được dài quá 250 kí tự',
            'email.unique' => 'Email này đã được sử dụng',

            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu của bạn quá ngắn',
            'password.max' => 'Mật khẩu của bạn quá dài',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng',
            'password.regex' => 'Mật khẩu không được có dấu, khoảng trắng hoặc kí tự đặc biệt',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('name', 'email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('member.dashboard');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $data = [];
        $data['title'] = 'Đăng nhập';
        return view('backend.auth.login', $data);
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Tên đăng nhập không được để trống',
            'email.required' => 'Email là trường bắt buộc',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        $remember = $request->remember ? true : false;

        $loginDt = $request->only('name', 'password');

        if (filter_var($loginDt['name'], FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $loginDt['name'], 'password' => $loginDt['password']];
        } else {
            $credentials = ['name' => $loginDt['name'], 'password' => $loginDt['password']];
        }
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect('member/dashboard');
        }

        return back()->withErrors(['name' => 'Mật khẩu hoặc tên tài khoản của bạn không đúng',])->onlyInput('name');

    } 
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->withSuccess('Bạn đã đăng xuất thành công!');
    }

    public function forgotPassword()
    {
        $data['title'] = 'Quên mật khẩus';

        return view('backend.member.auth.forgot-password', $data);
    }
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:250|exists:users,email'
        ], [
            'email.exists' => 'Email này chưa được đăng ký tài khoản'
        ]);

        $email = $request->email;
        $token = Str::random(150);
        $dataUser = User::where('email', '=', $email)->firstOrFail();

        $data = [
            'user_id' => $dataUser->id,
            'email' => $email,
            'token' => $token
        ];

        if (ResetToken::create($data)) {
            Mail::to($email)->send(new ForgotPassword($dataUser, $token));
            return redirect()->back()->with('success', 'Chúng tôi vừa gửi một email đến bạn, vui lòng kiểm tra email để tiếp tục');
        }
        
        return redirect()->back()->withErrors('Rất tiếc, đã xảy ra lỗi. Vui lòng thử lại sau');
    }
    public function resetPassword(string $token)
    {
        if (empty($_GET['email'])) {
            return redirect()->route('forgot');
        }

        $data['title'] = 'Đặt lại mật khẩu';
        $data['token'] = $token;
        $data['email'] = $_GET['email'];

        return view('backend.member.auth.reset-password', $data);
    }
    public function postResetPassword(Request $request, string $token) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:64|confirmed',
        ]);
    
        $passwordReset = ResetToken::where('token', $token)->firstOrFail();
    
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();  // Remove the 'user_id' argument
    
            return redirect()->back()->withErrors('Mã token đặt lại mật khẩu này không hợp lệ.');
        }
    
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
    
        $passwordReset->delete();  // Remove the 'user_id' argument
    
        return redirect()->route('auth.login')->withSuccess('Đặt lại mật khẩu thành công!');
    }

}