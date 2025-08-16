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
                    <h1 class="text-center text-2xl font-medium tracking-tight text-gray-900">{{ __('auth/register.title') }}</h1>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div class="text-sm text-red-600 space-y-1">
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
                    <form method="POST" action="{{ route('auth.register') }}" class="space-y-4">
                        @csrf
                        <div class="field space-y-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('auth/register.name_label') }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                                   placeholder="{{ __('auth/register.name_label') }}.."
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field space-y-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth/register.email_label') }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   placeholder="{{ __('auth/register.email_label') }}.."
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field space-y-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('auth/register.password_label') }}</label>
                            <input id="password" name="password" type="password" required
                                   placeholder="{{ __('auth/register.password_label') }}.."
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field space-y-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('auth/register.password_confirmation_label') }}</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   placeholder="{{ __('auth/register.password_confirmation_label') }}.."
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="confirm" name="confirm" type="checkbox" value="1"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="confirm" class="font-medium text-gray-700">{!! __('auth/register.agree_terms', [
                                    'terms_link' => '<a href="/page/terms" class="text-blue-600 hover:text-blue-500">' . __('auth/register.terms_of_service') . '</a>',
                                    'privacy_link' => '<a href="/page/privacy" class="text-blue-600 hover:text-blue-500">' . __('auth/register.privacy_policy') . '</a>'
                                ]) !!}</label>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('auth/register.register_button') }}
                        </button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm font-medium leading-6">
                            <span class="bg-white px-6 text-gray-400">{{ __('auth/register.or_continue_with') }}</span>
                        </div>
                    </div>

                    {{-- Social auth buttons (optional, commented) --}}
                    {{-- <div class="grid grid-cols-1 gap-4">
                        <button disabled class="w-full flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700">
                            <span>Google (coming soon)</span>
                        </button>
                    </div> --}}

                    <div class="text-center mt-2 text-gray-600">
                        <p>{{ __('auth/register.already_have_account') }} <a href="{{ route('auth.login') }}" class="text-blue-600 hover:text-blue-500 font-medium">{{ __('auth/register.sign_in') }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-xs text-center text-gray-400 my-4 space-y-2">
            <p><a href="/page/privacy" class="text-gray-600 hover:text-gray-900">{{ __('auth/login.privacy_policy') }}</a> • <a href="/page/terms" class="text-gray-600 hover:text-gray-900">{{ __('auth/login.terms_of_use') }}</a></p>
            <p>{{ __('auth/login.copyright', ['year' => date('Y'), 'site_name' => Setting::get('web_name', config('app.name'))]) }}</p>
        </div>
    </div>

@endsection
