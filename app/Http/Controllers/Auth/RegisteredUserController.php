<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function handleReferral($refCode, Request $request)
    {
        $referrer = User::where('id', $refCode)->first();

        if ($referrer) {
            $request->session()->put('referrer_id', $referrer->id);

        }

        return redirect()->route('auth.register');
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data = [];
        $data['title'] = 'Đăng ký';

        return view('backend.auth.register', $data);    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $referrer_id = $request->session()->get('referrer_id', 0);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'referred_by' => $referrer_id,
        ]);

        $user->plans()->create([
            'plan_id' => config('plans.default_free_id', 1), // ví dụ ID = 1
            'started_at' => now(),
            'expires_at' => null,
            'price_paid' => 0,
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $request->session()->forget('referrer_id');

        return redirect(RouteServiceProvider::HOME);
    }
}
