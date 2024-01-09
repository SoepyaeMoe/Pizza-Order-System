@extends('user.layout.app')
@section('nav_cart_active', 'active')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="cartTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="price" value="{{ $cart->price }}">
                                <input type="hidden" id="cart_id" value="{{ $cart->id }}">
                                <input type="hidden" id="product_id" value="{{ $cart->product_id }}">
                                <td class="align-middle"> {{ $cart->product_name }}</td>
                                <td class="align-middle">{{ $cart->price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cart->quantity }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cart->price * $cart->quantity }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger remove_btn"><span
                                            class="d-none">{{ $cart->id }}</span><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        @if ($carts->count() == 0)
                            <tr>
                                <td colspan="5">
                                    <h2>There is no products in your cart.</h2><a class="btn btn-sm btn-warning"
                                        href="{{ route('home') }}">Shop now</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="sub_total">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delievery</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final_total">{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                            {{ $carts->count() == 0 ? 'disabled' : '' }} id="checkoutBtn">Proceed To
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            function cartFunction(t) {
                var parentTag = t.parents('tr');
                var price = parentTag.find('#price').val();
                var qty = Number(parentTag.find('#qty').val());
                var cartId = parentTag.find('#cart_id').val();

                $.ajax({
                    type: 'get',
                    url: '/ajax/plus_cart',
                    data: {
                        qty: qty,
                        cart_id: cartId
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            parentTag.find('#total').text(response.total_price + ' Kyats');
                            $('#sub_total').text(response.sub_total + ' Kyats');
                            $('#final_total').text(response.sub_total + 3000 + ' Kyats');
                        }
                    }
                });
            };

            $('.btn-plus').on('click', function() {
                cartFunction($(this));
            });

            $('.btn-minus').on('click', function() {
                cartFunction($(this));
            });
            $('.remove_btn').on('click', function() {
                var parentTag = $(this).parents('tr');
                var cartId = parentTag.find('#cart_id').val();
                $.ajax({
                    type: 'get',
                    url: '/ajax/remove_cart',
                    data: {
                        cart_id: cartId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            parentTag.remove();
                            Toast.fire({
                                icon: "success",
                                title: response.message,
                            });
                        }
                    }
                });
            });

            $('#checkoutBtn').on('click', function() {

                const orderList = [];
                var order_code = Math.floor(Math.random() * 10000000);

                $('#cartTable tbody tr').each(function(index, element) {
                    var qty = $(element).find('#qty').val();
                    var user_id = $(element).find('#user_id').val();
                    var total_price = $(element).find('#price').val() * qty;
                    orderList.push({
                        'user_id': user_id,
                        'product_id': $(element).find('#product_id').val(),
                        'quantity': qty,
                        'total_price': total_price,
                        'order_code': "00" + user_id + order_code
                    });
                });
                $.ajax({
                    type: 'get',
                    url: '/ajax/order',
                    data: Object.assign({}, orderList),
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/home";
                        }
                    }
                })
            })
        });
    </script>
@endsection
