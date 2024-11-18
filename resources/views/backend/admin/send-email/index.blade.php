
@extends('layouts.admin')

@section('title', __('Admin: Send Mail'))
@section('content')
<div class="col-12">
    <form class="card" method="POST" action="{{ route('admin.send-emails.store') }}">
        @csrf

      <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label required">Gửi đến</label>
                    <input type="email" name="email" class="form-control" placeholder="" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="subject" class="form-label required">Subject</label>
                    <input id="subject" class="form-control" placeholder="" name="subject" value="{{ old('subject') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="greeting" class="form-label">Greeting</label>
                    <input id="greeting" name="greeting" class="form-control" placeholder="" value="{{ old('greeting') }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="body" class="form-label required">Body</label>
                    <textarea id="body" name="body" class="form-control" rows="10" required>{{ old('body') }}</textarea>
                  </div>
            </div>
        </div>

      </div>
      <div class="card-footer text-end">
        <input type="submit" class="btn btn-primary">
        </a>
      </div>
    </form>
  </div>

  @endsection