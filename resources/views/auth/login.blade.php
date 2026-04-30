@extends('custom.master')

@section('content')

<div class="auth-page">
    <div class="auth-bg-shape auth-bg-shape-1"></div>
    <div class="auth-bg-shape auth-bg-shape-2"></div>

    <div class="auth-wrapper">

        <div class="auth-brand-side">
            <div class="auth-brand-card">
                <div class="auth-logo-box">
                    <i class="bi bi-leaf"></i>
                </div>

                <h1>Raj Yog Go Green</h1>

                <p>
                    Premium admin access for managing products, enquiries, certificates,
                    sustainability sections and website content.
                </p>

                <div class="auth-points">
                    <div class="auth-point">
                        <i class="bi bi-shield-check"></i>
                        <span>Secure Admin Panel</span>
                    </div>

                    <div class="auth-point">
                        <i class="bi bi-box-seam"></i>
                        <span>Product Management</span>
                    </div>

                    <div class="auth-point">
                        <i class="bi bi-chat-dots"></i>
                        <span>Enquiry Tracking</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="auth-card">

                <div class="auth-card-header">
                    <div class="auth-mini-logo">
                        <i class="bi bi-person-lock"></i>
                    </div>

                    <h2>{{ trans('global.login') }}</h2>

                    <p>
                        Sign in to continue to {{ trans('panel.site_title') }}
                    </p>
                </div>

                @if(session('message'))
                    <div class="auth-alert auth-alert-info">
                        <i class="bi bi-info-circle"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="auth-alert auth-alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Please check your login details and try again.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <div class="auth-field">
                        <label for="email">
                            {{ trans('global.login_email') }}
                        </label>

                        <div class="auth-input-wrap">
                            <i class="bi bi-envelope"></i>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="Enter email address"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            >
                        </div>

                        @if($errors->has('email'))
                            <p class="auth-error">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="auth-field">
                        <label for="password">
                            {{ trans('global.login_password') }}
                        </label>

                        <div class="auth-input-wrap">
                            <i class="bi bi-lock"></i>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="Enter password"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            >

                            <button type="button" class="auth-password-toggle" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        @if($errors->has('password'))
                            <p class="auth-error">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <div class="auth-options">
                        <label class="auth-check">
                            <input type="checkbox" name="remember">
                            <span>{{ trans('global.remember_me') }}</span>
                        </label>

                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ trans('global.forgot_password') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="auth-submit">
                        <i class="bi bi-box-arrow-in-right"></i>
                        {{ trans('global.login') }}
                    </button>

                    @if(Route::has('register'))
                        <div class="auth-register">
                            <span>Don’t have an account?</span>
                            <a href="{{ route('register') }}">
                                {{ trans('global.register') }}
                            </a>
                        </div>
                    @endif
                </form>

            </div>
        </div>

    </div>
</div>


@endsection