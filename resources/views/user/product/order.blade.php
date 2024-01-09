@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Shop</a>
                    <span class="breadcrumb-item active">Order List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="orderTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="align-middle thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Total Price</th>
                            <th>Order Code</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d-M-Y H:i:s') }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="text-primary">Pending</span>
                                    @elseif($order->status == 1)
                                        <span class="text-success">Completed</span>
                                    @elseif($order->status == 2)
                                        <span class="text-danger">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class="m-3 float-right">{{ $orders->links() }}</span>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
