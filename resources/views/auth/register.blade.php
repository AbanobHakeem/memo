@extends('layouts.frontend')

@section('content')
    <!-- Start: Page Banner -->
    <section class="page-banner services-banner">
        <div class="container">
            <div class="banner-header">
                <h2>Register </h2>
                <span class="underline center"></span>
                <p class="lead">create your own account</p>
            </div>
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li>Register</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End: Page Banner -->
    <!-- Start: Cart Section -->
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="signin-main">
                    <div class="container">
                        <div class="woocommerce">
                            <div class="woocommerce-login">
                                <div class="company-info signin-register">
                                    <div class="col-md-5 col-md-offset-1 border-dark-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="company-detail bg-dark margin-left">
                                                    <div class="signin-head">
                                                        <h2>Sign in</h2>
                                                        <span class="underline left"></span>
                                                    </div>
                                                    <h3 class="text-white">If no barcode has been assigned for your
                                                        account, please contact
                                                        the library.</h3>
                                                    <br>
                                                    <a href="{{ route('login') }}" class="btn btn-primary">Login
                                                        now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 border-dark new-user">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="company-detail new-account bg-light margin-right">
                                                    <div class="new-user-head">
                                                        <h2>Create New Account</h2>
                                                        <span class="underline left"></span>
                                                        <p>If no barcode has been assigned for your account, please contact
                                                            the library.</p>
                                                    </div>
                                                    <form method="POST" action="{{ route('register') }}">
                                                        @csrf

                                                        <div class="row mb-3">
                                                            <label for="name"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="name" type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name') }}" required
                                                                    autocomplete="name" autofocus>

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="email"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    name="email" value="{{ old('email') }}" required
                                                                    autocomplete="email">

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="password"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password" type="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    name="password" required autocomplete="new-password">

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="password-confirm"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password-confirm" type="password"
                                                                    class="form-control" name="password_confirmation"
                                                                    required autocomplete="new-password">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Register') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- End: Cart Section -->

    <!-- Start: Social Network -->
    <section class="social-network section-padding">
        <div class="container">
            <div class="center-content">
                <h2 class="section-title">Follow Us</h2>
                <span class="underline center"></span>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <ul>
                <li>
                    <a class="facebook" href="#" target="_blank">
                        <span>
                            <i class="fa fa-facebook-f"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="twitter" href="#" target="_blank">
                        <span>
                            <i class="fa fa-twitter"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="google" href="#" target="_blank">
                        <span>
                            <i class="fa fa-google-plus"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="rss" href="#" target="_blank">
                        <span>
                            <i class="fa fa-rss"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="linkedin" href="#" target="_blank">
                        <span>
                            <i class="fa fa-linkedin"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="youtube" href="#" target="_blank">
                        <span>
                            <i class="fa fa-youtube"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <!-- End: Social Network -->
@endsection
