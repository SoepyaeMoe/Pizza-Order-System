@extends('admin.layout.app')
@section('title', 'Profile Update')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">

                        @if ($user->image)
                            <a href="#" class="img-radius">
                                <img src="{{ asset('storage/profile_pic/' . $user->image) }}" alt=""
                                    style="width: 100px; height: 100px;">
                            </a>
                        @else
                            <a href="#" class="img-radius"><img
                                    src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random"></a>
                        @endif
                    </div>
                    <h4 class="text-center mb-4">Profile Edit</h4>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="profile_pic">Profile Picture</label>
                            <input id="profile_pic" name="profile_pic" type="file" class="form-control">
                            @error('profile_pic')
                                <small class="text-danger">
                                    <div>{{ $message }}</div>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" aria-required="true"
                                aria-invalid="false" placeholder="Enter name" value="{{ $user->name }}">
                            @error('name')
                                <small class="text-danger">
                                    <div>{{ $message }}</div>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input id="email" name="email" type="text" class="form-control" aria-required="true"
                                aria-invalid="false" placeholder="Enter email" value="{{ $user->email }}">
                            @error('email')
                                <small class="text-danger">
                                    <div>{{ $message }}</div>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label mb-1">Phone</label>
                            <input id="phone" name="phone" type="number" class="form-control" aria-required="true"
                                aria-invalid="false" placeholder="Enter phone" value="{{ $user->phone }}">
                            @error('phone')
                                <small class="text-danger">
                                    <div>{{ $message }}</div>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label mb-1">Address</label>
                            <input id="address" name="address" type="text" class="form-control" aria-required="true"
                                aria-invalid="false" placeholder="Address..." value="{{ $user->address }}">
                            @error('address')
                                <small class="text-danger">
                                    <div>{{ $message }}</div>
                                </small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small mr-3">
                                <i class="zmdi zmdi-border-color"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
