@extends('admin.layout.app')
@section('title', 'Admin List')
@section('order_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="text-white">Order Detail</h3>
                        </div>
                        <div class="card-body pr-0">
                            <div class="d-flex justify-content-between">
                                <p><i class="fas fa-user mr-3"></i>Customer Name</p>
                                <p class="pr-3">{{ $order->user->name }}</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p><i class="fas fa-barcode mr-3"></i>Order Code</p>
                                <p class="pr-3">{{ $order->order_code }}</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p><i class="fas fa-money-bill-alt mr-3"></i>Grand Total <br><small>Include
                                        Delevery charges</small></p>
                                <p class="pr-3 mb-0">{{ $order->total_price }} Kyats</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p><i class="fas fa-clock mr-3"></i>Order Place On</p>
                                <p class="pr-3">{{ $order->created_at->format('d-M-Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-8"></div>
                <div class="col-4">
                    <input class="form-control" type="text" placeholder="Search order..." id="order_search" />
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2" id="dataTable">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetail as $od)
                            <tr class="tr-shadow">
                                <td class="col-2"><img src="{{ asset('storage/product_img/' . $od->product_image) }}"
                                        alt="" class='img-thumbnail'></td>
                                <td class="col-3">{{ $od->product_name }}</td>
                                <td>{{ $od->quantity }}</td>
                                <td>{{ $od->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#order_search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable .tr-shadow').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
