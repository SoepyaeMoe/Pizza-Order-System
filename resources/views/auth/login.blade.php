@extends('auth.layout.app')
@section('title', 'Login')
@section('content')
    @include('auth.layout.flash')
    <div class="login-form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{ old('email') }}"
                    placeholder="Email">
                <small class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" value="{{ old('value') }}"
                    placeholder="Password">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign
                in</button>

            <a href="{{ url('auth/google/redirect') }}"
                class="au-btn au-btn--block au-btn--green m-b-20 text-center text-white">
                <i class="zmdi zmdi-google text-danger"></i><span class="m-2">Sign in with google</span>
            </a>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('register_page') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
