@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Forgot Password basic -->
      <div class="card mb-0">
        <div class="card-body">
            <a href="{{ route('home') }}" class="brand-logo">
                <x-images.logo/>
                <h2 class="brand-text text-primary ms-1">{{config('app.name')}}</h2>
            </a>

          <h4 class="card-title mb-1">{{ __('Forgot Password? 🔒') }}</h4>
          <p class="card-text mb-2">{{ __('Enter your email and we\'ll send you instructions to reset your password') }}</p>

          @if (session('status'))
            <div class="mb-1 text-success">
              {{ session('status') }}
            </div>
          @endif

          <form class="auth-forgot-password-form mt-2" method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <div class="mb-1">
              <label for="forgot-password-email" class="form-label">{{ __('Email') }}</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="forgot-password-email"
                name="email" value="{{ old('email') }}" placeholder="john@example.com"
                aria-describedby="forgot-password-email" tabindex="1" autofocus />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="2">{{ __('Send reset link') }}</button>
          </form>

          <p class="text-center mt-2">
            @if (Route::has('admin.login'))
              <a href="{{ route('admin.login') }}"> <i data-feather="chevron-left"></i> {{ __('Back to login') }} </a>
            @endif
          </p>
        </div>
      </div>
      <!-- /Forgot Password basic -->
    </div>
  </div>
@endsection
