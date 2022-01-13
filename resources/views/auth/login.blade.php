@extends('layouts.auth')
@section('title', __('Login'))
@scripts('vendor', asset(mix('vendors/js/forms/validation/jquery.validate.min.js')))
@scripts('page', asset(mix('js/scripts/pages/auth-login.js')))
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

          <h4 class="card-title mb-1">{{ __('Welcome to :name! 👋', ['name'=>config('app.name')]) }}</h4>
          <p class="card-text mb-2">{{ __('Please sign-in to your account and start the adventure') }}</p>

          @if (session('status'))
            <div class="alert alert-success mb-1 rounded-0" role="alert">
              <div class="alert-body">
                {{ session('status') }}
              </div>
            </div>
          @endif

          <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-1">
              <label for="login-email" class="form-label">{{ __('Email') }}</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email"
                placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus
                value="{{ old('email') }}" />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    <small>{{ __('Forgot Password?') }}</small>
                  </a>
                @endif
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="login-password" name="password"
                  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3"
                  {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="4">{{ __('Sign in') }}</button>
          </form>

          <p class="text-center mt-2">
            <span>{{ __('New on our platform?') }}</span>
            @if (Route::has('register'))
              <a href="{{ route('register') }}">
                <span>{{ __('Create an account') }}</span>
              </a>
            @endif
          </p>

          <div class="divider my-2">
            <div class="divider-text">{{ __('or') }}</div>
          </div>

          <div class="auth-footer-btn d-flex justify-content-center">
              @if(config('services.facebook.enable'))
            <a href="{{ route('social.authorize', 'facebook') }}" class="btn btn-facebook">
              <i data-feather="facebook"></i>
            </a>
              @endif
              @if(config('services.twitter.enable'))
            <a href="{{ route('social.authorize', 'twitter') }}" class="btn btn-twitter">
              <i data-feather="twitter"></i>
            </a>
              @endif
              @if(config('services.google.enable'))
            <a href="{{ route('social.authorize', 'google') }}" class="btn btn-google">
              <i data-feather="mail"></i>
            </a>
              @endif
              @if(config('services.github.enable'))
            <a href="{{ route('social.authorize', 'github') }}" class="btn btn-github">
              <i data-feather="github"></i>
            </a>
              @endif
          </div>
        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
