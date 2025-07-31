@extends('layouts.clients.home_layout')

@section('content')
<main class="bg-white px-6 py-20 sm:py-24 lg:px-8 border-b">
        <div class="prose mx-auto">
    <header class="text-center">
        <h1>Report an Issue</h1>
    </header>
    <div class="not-prose">
            </div>
    <form method="POST" action="/report" class="space-y-4">
        <input type="hidden" name="_token" value="YXj76MJpnr30DgmwbpfRP2waIc2SJ98svGiItqzu" autocomplete="off">        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="name">Name / Company name<span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="email">Email Address<span class="text-red-600">*</span></label>
                <input type="email" name="email" id="email" required>
            </div>
        </div>
        <div>
            <label for="url">Reported Link<span class="text-red-600">*</span></label>
            <input type="text" name="url" id="url" value="{{ isset($alias) ? $alias : '' }}" required>
        </div>
        <div>
            <label for="message">Message<span class="text-red-600">*</span></label>
            <textarea name="message" id="message" rows="6" required></textarea>
        </div>
        <p class="text-gray-600 text-xs"><span class="text-red-600">*</span> is required</p>
        <div>
            <div class="g-recaptcha" data-sitekey="0x4AAAAAAALLuQFUOnh41Bqj" data-size="normal" data-theme="light" id="recaptcha-element"></div>
        </div>
        <button type="submit" class="button">Send</button>
    </form>
    <div>
        <p>Or, email us directly at: <a href="/cdn-cgi/l/email-protection#eb8a899e988eab988a8d8e8d82878e809ec5888486"><span class="__cf_email__" data-cfemail="c5a4a7b0b6a085b6a4a3a0a3aca9a0aeb0eba6aaa8">[email&#160;protected]</span></a></p>
    </div>
</div>

    </main>

@endsection
