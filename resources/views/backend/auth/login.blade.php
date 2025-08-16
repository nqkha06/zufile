@extends('layouts.member.auth')

@section('content')

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
        <div class="w-full pt-6 z-10 bg-white border-gray-200 relative flex flex-col sm:justify-center items-center bg-white">
            <a href="/" class="flex items-center mb-4">
                    <img class="h-8 sm:h-12 w-auto mr-2 rounded-md" src="{{ asset(Setting::get('site_logo', '')) }}" alt="logo">
                    <span class="text-xl sm:text-3xl font-bold text-gray-900">{{ Setting::get('web_name', config('app.name')) }}</span>

            </a>
            <div class="w-full sm:max-w-md pt-0 p-6 bg-white sm:border border-gray-200 sm:rounded-lg ">

                <div class="mb-8 mt-6">
                <h1 class="text-center text-2xl font-medium tracking-tight text-gray-900">{{ __('auth/login.title') }}</h1>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                    <div class="text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                    <div class="text-sm text-green-600">
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('auth.login') }}" class="space-y-4">
                    @csrf
                    <div class="field space-y-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth/login.email_label') }}</label>
                        <input
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                            type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field space-y-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('auth/login.password_label') }}</label>
                        <input
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                            type="password" id="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">{{ __('auth/login.remember_me') }}</label>
                        </div>
                        <a class="text-sm text-blue-600 hover:text-blue-500" href="{{ route('auth.password.request') }}">
                            {{ __('auth/login.forgot_password') }}
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('auth/login.login_button') }}
                    </button>
                </form>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm font-medium leading-6">
                        <span class="bg-white px-6 text-gray-400">{{ __('auth/login.or_continue_with') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    {{-- <form action="{{ route('auth.google') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                        <button class="w-full flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="size-5 mr-2" viewBox="0 0 533.5 544.3" aria-hidden="true">
                                <path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"></path>
                                <path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"></path>
                                <path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"></path>
                                <path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"></path>
                            </svg>
                            <span>{{ __('auth/login.continue_with_google') }}</span>
                        </button>
                    </form> --}}

                </div>

                <div class="text-center mt-4 text-gray-600">
                    <p>{{ __('auth/login.no_account') }} <a href="{{ route('auth.register') }}"
                            class="text-blue-600 hover:text-blue-500 font-medium">{{ __('auth/login.register') }}</a></p>
                </div>
            </div>

            </div>
        </div>

        <div class="text-xs text-center text-gray-400 my-4 space-y-2">
            <p><a href="/page/privacy" class="text-gray-600 hover:text-gray-900">{{ __('auth/login.privacy_policy') }}</a> • <a href="/page/terms"
                    class="text-gray-600 hover:text-gray-900">{{ __('auth/login.terms_of_use') }}</a></p>
            <p>{{ __('auth/login.copyright', ['year' => date('Y'), 'site_name' => Setting::get("web_name", config("app.name"))]) }}</p>
        </div>
    </div>

@endsection
