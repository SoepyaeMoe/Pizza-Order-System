@extends('admin.layout.app')
@section('title', 'Category')
@section('category_active', 'active')

@section('content')
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('admin.category.list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Category Form</h3>
                </div>
                <hr>
                <form action="{{ route('admin.category.add') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="category_name" value="{{ old('category_name') }}" type="text"
                            class="form-control" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                        @error('category_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Add Category</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
