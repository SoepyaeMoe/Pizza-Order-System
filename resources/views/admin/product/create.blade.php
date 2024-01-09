@extends('admin.layout.app')
@section('title', 'Products')
@section('product_active', 'active')

@section('content')
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('admin.product.list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Product Create Form</h3>
                </div>
                <hr>
                <form action="{{ route('admin.product.create') }}" method="post" enctype="multipart/form-data"
                    novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                        <input id="cc-pament" name="product_name" value="{{ old('product_name') }}" type="text"
                            class="form-control" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                        @error('product_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chose Category</label>
                        <select class="form-control" name="category" id="category">
                            <option value="">Chose Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pizza Image</label>
                        <input type="file" name="pizza_image" class="form-control">
                        @error('pizza_image')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="price" name="price" value="{{ old('price') }}" type="number" class="form-control"
                            aria-required="true" aria-invalid="false" placeholder="Pizza price">
                        @error('price')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="des" class="control-label mb-1">Description</label>
                        <textarea id="des" name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
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
