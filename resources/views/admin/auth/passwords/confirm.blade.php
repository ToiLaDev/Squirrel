@extends('layouts.auth')
@section('title', 'Login Page')
@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Login basic -->
      <div class="card mb-0">
        <div class="card-body">
            <a href="{{ route('home') }}" class="brand-logo">
                <x-images.logo/>
                <h2 class="brand-text text-primary ms-1">{{config('app.name')}}</h2>
            </a>

            <h4 class="card-title mb-1">{{ __('Welcome to :name! 👋', ['name'=>'Squirrel']) }}</h4>
          <p class="card-text mb-2">{{ __('Please confirm your password before continuing.') }}</p>

          <form class="auth-login-form mt-2" method="POST" action="{{ route('admin.password.confirm') }}">
            @csrf
            <div class="mb-1">
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

            <button type="submit" class="btn btn-primary w-100" tabindex="2">{{ __('Confirm Password') }}</button>
          </form>

          <p class="text-center mt-2">
            @if (Route::has('admin.password.request'))
              <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
            @endif
          </p>

        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
