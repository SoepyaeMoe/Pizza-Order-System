@extends('auth.layout.app')
@section('title', 'Register')
@section('content')
    <div class="login-form m-5">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @error('terms')
                {{ $message }}
            @enderror
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" value="{{ old('name') }}"
                    placeholder="Username">
                @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{ old('email') }}"
                    placeholder="Email">
                @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="number" name="phone" value="{{ old('phone') }}"
                    placeholder="Phone number">
                @error('phone')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" value="{{ old('address') }}"
                    placeholder="Address..">
                @error('address')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('login_page') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
