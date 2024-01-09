@extends('admin.layout.app')
@section('title', 'Procuct detail')
@section('product_active', 'active')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <img style="width: 100%"; src="{{ asset('storage/product_img/' . $product->image) }}"
                                alt="">
                        </div>
                        <div class="col-7">
                            <div class="d-flex">
                                <div>
                                    <h3 class="m-0">{{ $product->name }}</h3>
                                    <p class="text-muted">{{ $product->category->name }}</p>
                                </div>

                                <div>
                                    <p class="btn btn-dark text-light ml-3">{{ $product->price }} MMK</p>
                                </div>

                                <div>
                                    <p class="btn btn-dark text-light ml-3">View {{ $product->view_count }}</p>
                                </div>
                            </div>

                            <h5 class="mt-3">Description</h5>
                            <p>{{ $product->description }}</p>

                        </div>
                        <div class="d-flex justify-content-end w-100">
                            <a href="{{ url('admin/product/update/' . $product->id) }}"
                                class="au-btn au-btn-icon au-btn--green au-btn--small mr-3">
                                <i class="zmdi zmdi-border-color"></i>
                                Edit
                            </a>
                        </div>
                        <div style="position: absolute; bottom: 10px; left: 13px;">
                            {{ $product->updated_at->format('d-M-Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
