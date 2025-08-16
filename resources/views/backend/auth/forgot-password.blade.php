@extends('layouts.member.auth')

@section('content')

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
        <div class="w-full pt-6 z-10 bg-white border-gray-200 relative flex flex-col sm:justify-center items-center bg-white">
            <a href="/" class="flex items-center mb-4">
                <img class="h-8 sm:h-12 w-auto mr-2 rounded-md" src="{{ asset(Setting::get('site_logo', '')) }}" alt="logo">
                <span class="text-xl sm:text-3xl font-bold text-gray-900">{{ Setting::get('web_name', config('app.name')) }}</span>
            </a>
            <div class="w-full sm:max-w-md pt-0 p-6 bg-white sm:border border-gray-200 sm:rounded-lg ">

                <div class="mb-6 mt-6">
                    <h1 class="text-center text-2xl font-medium tracking-tight text-gray-900">{{ __('auth/forgot_password.title') }}</h1>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @elseif (session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                        <div class="text-sm text-green-600">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @else
                    <p class="mb-6 text-sm leading-6 text-gray-600">{{ __('auth/forgot_password.description') }}</p>
                @endif

                <form method="POST" action="{{ route('auth.password.email') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth/forgot_password.email_label') }}</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                               placeholder="{{ __('auth/forgot_password.email_label') }}.."
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('auth/forgot_password.send_link_button') }}
                    </button>
                </form>

                <div class="text-center mt-6 text-gray-600">
                    <p>{{ __('auth/forgot_password.back_to_login') }}? <a href="{{ route('auth.login') }}" class="text-blue-600 hover:text-blue-500 font-medium">{{ __('auth/login.login_button') }}</a></p>
                </div>
            </div>
        </div>

        <div class="text-xs text-center text-gray-400 my-4 space-y-2">
            <p><a href="/page/privacy" class="text-gray-600 hover:text-gray-900">{{ __('auth/login.privacy_policy') }}</a> • <a href="/page/terms" class="text-gray-600 hover:text-gray-900">{{ __('auth/login.terms_of_use') }}</a></p>
            <p>{{ __('auth/login.copyright', ['year' => date('Y'), 'site_name' => Setting::get('web_name', config('app.name'))]) }}</p>
        </div>
    </div>
@endsection
