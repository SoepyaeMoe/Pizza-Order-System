@extends('admin.layout.app')
@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body pr-0">
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
                    <h4 class="text-center mb-4">Profile Information</h4>
                    <div class="d-flex justify-content-between">
                        <span>Name</span>
                        <span class="mr-3">{{ $user->name }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Email</span>
                        <span class="mr-3">{{ $user->email }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Phone</span>
                        <span class="mr-3">{{ $user->phone }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Address</span>
                        <span class="mr-3">{{ $user->address }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Join on</span>
                        <span class="mr-3">{{ $user->created_at->format('d-M-Y') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.profile.edit') }}"
                            class="au-btn au-btn-icon au-btn--green au-btn--small mr-3">
                            <i class="zmdi zmdi-border-color"></i>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
