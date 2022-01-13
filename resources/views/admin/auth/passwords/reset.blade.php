@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Reset Password basic -->
      <div class="card mb-0">
        <div class="card-body">
            <a href="{{ route('home') }}" class="brand-logo">
                <x-images.logo/>
                <h2 class="brand-text text-primary ms-1">{{config('app.name')}}</h2>
            </a>

          <h4 class="card-title mb-1">{{ __('Reset Password 🔒') }}</h4>
          <p class="card-text mb-2">{{ __('Your new password must be different from previously used passwords') }}</p>

          <form class="auth-reset-password-form mt-2" method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-1">
              <label for="email" class="form-label">{{ __('Email') }}</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="john@example.com" aria-describedby="email" tabindex="1" value="{{ old('email') }}" required
                autofocus />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="reset-password-new">{{ __('New Password') }}</label>
              </div>
              <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                  id="reset-password-new" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="reset-password-new" tabindex="2" autofocus required />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="reset-password-confirm">{{ __('Confirm Password') }}</label>
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="reset-password-confirm"
                  name="password_confirmation" autocomplete="new-password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="reset-password-confirm" tabindex="3" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="4">{{ __('Set New Password') }}</button>
          </form>

          <p class="text-center mt-2">
            @if (Route::has('admin.login'))
              <a href="{{ route('admin.login') }}">
                <i data-feather="chevron-left"></i> {{ __('Back to login') }}
              </a>
            @endif
          </p>
        </div>
      </div>
      <!-- /Reset Password basic -->
    </div>
  </div>
@endsection
