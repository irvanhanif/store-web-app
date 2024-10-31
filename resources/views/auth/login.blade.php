@extends('layouts.app')

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center row-login">
                <div class="col-lg-6 text-center">
                    <img
                    src="/images/login-placeholder.png"
                    class="w-50 mb-4 mb-lg-none"
                    alt=""
                    />
                </div>
                <div class="col-lg-6">
                    <h2>
                        Belanja kebutuhan utama, <br />
                        menjadi lebih mudah
                    </h2>
                    <form method="POST" class="mt-3" 
                    action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success btn-block w-75 mt-4"
                        >
                            Sign In to My Account
                        </button>
                        <a
                            href="{{ route('register') }}"
                            class="btn btn-signup btn-block w-75 mt-2"
                            >Sign Up</a
                        >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
