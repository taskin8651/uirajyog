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
                    Create your admin account to manage products, enquiries, certificates,
                    sustainability content and website sections.
                </p>

                <div class="auth-points">
                    <div class="auth-point">
                        <i class="bi bi-shield-check"></i>
                        <span>Secure Registration</span>
                    </div>

                    <div class="auth-point">
                        <i class="bi bi-person-check"></i>
                        <span>Admin Access Setup</span>
                    </div>

                    <div class="auth-point">
                        <i class="bi bi-box-seam"></i>
                        <span>Manage Website Content</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="auth-card">

                <div class="auth-card-header">
                    <div class="auth-mini-logo">
                        <i class="bi bi-person-plus"></i>
                    </div>

                    <h2>{{ trans('global.register') }}</h2>

                    <p>
                        Create an account for {{ trans('panel.site_title') }}
                    </p>
                </div>

                @if($errors->any())
                    <div class="auth-alert auth-alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Please check the form details and try again.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <div class="auth-field">
                        <label for="name">
                            {{ trans('global.user_name') }}
                        </label>

                        <div class="auth-input-wrap">
                            <i class="bi bi-person"></i>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="Enter full name"
                                class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                            >
                        </div>

                        @if($errors->has('name'))
                            <p class="auth-error">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>

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
                                placeholder="Create password"
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

                    <div class="auth-field">
                        <label for="password_confirmation">
                            {{ trans('global.login_password_confirmation') }}
                        </label>

                        <div class="auth-input-wrap">
                            <i class="bi bi-lock-fill"></i>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="Confirm password"
                            >

                            <button type="button" class="auth-password-toggle" id="togglePasswordConfirm">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="auth-submit">
                        <i class="bi bi-person-plus"></i>
                        {{ trans('global.register') }}
                    </button>

                    <div class="auth-register">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            Login
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection