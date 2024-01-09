@extends('user.layout.app')
@section('nav_home_active', 'active')
@section('content')
    <!-- category Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}" id="$category->id">All</a>
                    @foreach ($categories as $category)
                        <a class="breadcrumb-item text-dark"
                            href="home?category={{ $category->id }}">{{ $category->name }}</a>
                    @endforeach
                    <span class="breadcrumb-item active">{{ $active_cate == null ? '' : $active_cate->name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- category End -->

    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked name="price-all" id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="price-1" id="price-1">
                            <label class="custom-control-label" for="price-1">1000 - 10000</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="price-2" id="price-2">
                            <label class="custom-control-label" for="price-2">20000 - 30000</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="price-3" id="price-3">
                            <label class="custom-control-label" for="price-3">30000 - 35000</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" name="price-4" id="price-4">
                            <label class="custom-control-label" for="price-4">35000 - 40000</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" name="price-5" id="price-5">
                            <label class="custom-control-label" for="price-5">40000 - 60000</label>
                            <span class="badge border font-weight-normal">Kyats</span>
                        </div>
                        <div class="mt-3">
                            <button type="submit" id="sbp" class="btn btn-warning w-100">Search</button>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div></div>
                            <div class="ml-2">
                                <div class="btn-group mr-2 mb-1">
                                    <input type="text" id="search" class="form-control" placeholder="Search pizza...">
                                </div>
                                <div class="btn-group mr-2 mb-1">
                                    <select name="sorting" id="sorting" class="form-control">
                                        <option value="">Sorting</option>
                                        <option value="asc">Assending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <select name="showing" id="showing" class="form-control">
                                        <option value="">Showing</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0" id="product" style="width: 100%;">
                        @if ($products->count() != 0)
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 mb-3 item">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img m-auto position-relative overflow-hidden"
                                            style="height: 220px; min-width: 200px; max-width: 300px;">
                                            <img class="img-fluid w-100 h-100"
                                                src="{{ asset('storage/product_img/' . $product->image) }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('product_detail', $product->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <p class="h6 text-decoration-none text-truncate">
                                                {{ $product->name }}</p>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ number_format($product->price) }} kyats</h5>
                                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center h3 m-auto"><i class="fa-solid fa-ban text-danger m-3"></i>There is no
                                product.</p>
                        @endif
                    </div>
                </div>
                <p class="text-center h3 m-auto" style="display: none;" id="no_found"><i
                        class="fa-solid fa-ban text-danger m-3"></i>Product not found.</p>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function filter(response) {
                let list = '';
                if (response.length > 0) {
                    response.forEach(product => {
                        list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="product">
                                <div class="product-item bg-light mb-4 item">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 200px; object-fit:cover;"
                                            src="{{ asset('storage/product_img/${product.image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{ url('product/${product.id}') }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${product.name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${new Intl.NumberFormat().format(product.price)} kyats</h5>
                                            <h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    $('#no_found').css('display', 'none');
                } else {
                    $('#no_found').css('display', 'block');
                }
                $('#product').html(list);
            }
            $('#sorting').on('change', function() {
                sortingValue = $('#sorting').val();
                showingValue = $('#showing').val();

                price1 = $('#price-1').prop('checked') ? 'price1' : 0;
                price2 = $('#price-2').prop('checked') ? 'price2' : 0;
                price3 = $('#price-3').prop('checked') ? 'price3' : 0;
                price4 = $('#price-4').prop('checked') ? 'price4' : 0;
                price5 = $('#price-5').prop('checked') ? 'price5' : 0;

                if (sortingValue == 'asc') {
                    $.ajax({
                        type: 'get',
                        data: {
                            status: 'asc',
                            category_id: "{{ request('category') }}",
                            showing: showingValue,
                            price1: price1,
                            price2: price2,
                            price3: price3,
                            price4: price4,
                            price5: price5,
                        },
                        url: "ajax/sorting",
                        success: function(response) {
                            if (response.status == 'success') {
                                filter(response.data);
                            }
                        }
                    })
                }
                if (sortingValue == 'desc') {
                    $.ajax({
                        type: 'get',
                        data: {
                            status: 'desc',
                            category_id: "{{ request('category') }}",
                            showing: showingValue,
                            price1: price1,
                            price2: price2,
                            price3: price3,
                            price4: price4,
                            price5: price5,
                        },
                        url: "ajax/sorting",
                        success: function(response) {
                            if (response.status == 'success') {
                                filter(response.data);
                            }
                        }
                    })
                }
            });
            $('#showing').on('change', function() {
                showingValue = $('#showing').val();

                price1 = $('#price-1').prop('checked') ? 'price1' : 0;
                price2 = $('#price-2').prop('checked') ? 'price2' : 0;
                price3 = $('#price-3').prop('checked') ? 'price3' : 0;
                price4 = $('#price-4').prop('checked') ? 'price4' : 0;
                price5 = $('#price-5').prop('checked') ? 'price5' : 0
                $.ajax({
                    type: 'get',
                    url: 'ajax/sorting',
                    data: {
                        showing: showingValue,
                        category_id: "{{ request('category') }}",

                        price1: price1,
                        price2: price2,
                        price3: price3,
                        price4: price4,
                        price5: price5,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            filter(response.data);
                        }
                    }
                })
            });
            $('#sbp').on('click', function(e) {
                e.preventDefault();
                price1 = $('#price-1').prop('checked') ? 'price1' : 0;
                price2 = $('#price-2').prop('checked') ? 'price2' : 0;
                price3 = $('#price-3').prop('checked') ? 'price3' : 0;
                price4 = $('#price-4').prop('checked') ? 'price4' : 0;
                price5 = $('#price-5').prop('checked') ? 'price5' : 0;
                $.ajax({
                    type: 'get',
                    url: 'ajax/sorting',
                    data: {
                        category_id: "{{ request('category') }}",
                        price1: price1,
                        price2: price2,
                        price3: price3,
                        price4: price4,
                        price5: price5,
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            filter(response.data);
                        }
                    }
                })
            });

            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
