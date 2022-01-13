@extends('layouts.auth')
@section('title', 'Register Page')
@scripts('vendor', asset(mix('vendors/js/forms/validation/jquery.validate.min.js')))
@scripts('page', asset(mix('js/scripts/pages/auth-register.js')))
@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Register Basic -->
      <div class="card mb-0">
        <div class="card-body">
          <a href="{{ route('home') }}" class="brand-logo">
            <x-images.logo/>
            <h2 class="brand-text text-primary ms-1">{{config('app.name')}}</h2>
          </a>

          <h4 class="card-title mb-1">{{ __('Adventure starts here 🚀') }}</h4>
          <p class="card-text mb-2">{{ __('Make your app management easy and fun!') }}</p>


          <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-1">
              <label for="register-email" class="form-label">{{ __('Email') }}</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="register-email"
                name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2"
                value="{{ old('email') }}" />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <label for="register-password" class="form-label">{{ __('Password') }}</label>

              <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                  id="register-password" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="register-password" tabindex="3" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <label for="register-password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="register-password-confirm"
                  name="password_confirmation"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="register-password" tabindex="3" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
              <div class="mb-1">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms" name="terms" tabindex="4" />
                      <label class="form-check-label" for="terms">
                          I agree to the <a href="#" target="_blank">terms of service</a> and
                          <a href="#" target="_blank">privacy policy</a>
                      </label>
                  </div>
              </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="5">{{ __('Sign up') }}</button>
          </form>

          <p class="text-center mt-2">
            <span>{{ __('Already have an account?') }}</span>
            @if (Route::has('login'))
              <a href="{{ route('login') }}">
                <span>{{ __('Sign in instead') }}</span>
              </a>
            @endif
          </p>

          <div class="divider my-2">
            <div class="divider-text">{{ __('or') }}</div>
          </div>

          <div class="auth-footer-btn d-flex justify-content-center">
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
      </div>
      <!-- /Register basic -->
    </div>
  </div>
@endsection
