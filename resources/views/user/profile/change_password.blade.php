@extends('user.layout.app')
@section('content')
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Password</h3>
                </div>
                <hr>
                <form action="{{ route('change_password') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="old-password" class="control-label mb-1">Old Password</label>
                        <input id="old-password" name="old_password" type="password" class="form-control"
                            aria-required="true" aria-invalid="false" placeholder="Enter old password">
                        @error('old_password')
                            <small class="text-danger">
                                <div>{{ $message }}</div>
                            </small>
                        @enderror

                        <label for="new-password" class="control-label mb-1 mt-3">New Password</label>
                        <input id="new-password" name="new_password" type="password" class="form-control"
                            aria-required="true" aria-invalid="false" placeholder="Enter new password">
                        @error('new_password')
                            <small class="text-danger">
                                <div>{{ $message }}</div>
                            </small>
                        @enderror

                        <label for="c-password" class="control-label mb-1 mt-3">Confirm Password</label>
                        <input id="c-password" name="confirm_password" type="password" class="form-control"
                            aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                        @error('confirm_password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount" class="me-3">Change Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
