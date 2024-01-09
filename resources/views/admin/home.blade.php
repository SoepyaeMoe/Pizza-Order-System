@extends('admin.layout.app')
@section('title', 'Admin Panel')
@section('home_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List <sup style="font-size: 20px;">(Total-{{ $products->total() }})</sup>
                        </h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.product.create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add product
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="offset-8"></div>
                <div class="col-4">
                    <form class="form-header" method="get">
                        <input class="form-control" type="text" name="key" value="{{ request('key') }}"
                            placeholder="Search product..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                @if ($products->count() != 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Pizza</th>
                                <th style="width: 200px;">Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th style="width: 200px;">Description</th>
                                <th>View Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="tr-shadow">
                                    <td>
                                        <img src="{{ asset('storage/product_img/' . $product->image) }}"
                                            class="img-thumbnail" alt=""
                                            style="min-width: 100px; min-height: 100px; max-width: 100px; min-height: 100px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }} MMK</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ Str::limit($product->description, 60, '...') }}</td>
                                    <td class="text-center">{{ $product->view_count }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin.product.detail', $product->id) }}" class="item"
                                                data-toggle="tooltip" data-placement="top" title="detail">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/product/update/' . $product->id) }}" class="item"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit text-primary"></i>
                                            </a>
                                            <a href="{{ route('admin.product.delete', $product->id) }}" class="item"
                                                data-toggle="tooltip" data-placement="top" title="Delete"
                                                onclick="return confirm('Are you sure, you want to delete it!')">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center text-muted">There is no products.</h4>
                @endif
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $products->links() }}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
