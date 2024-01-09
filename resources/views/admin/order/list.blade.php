@extends('admin.layout.app')
@section('title', 'Admin List')
@section('order_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Orders List <sup style="font-size: 20px;">(Total -
                                {{ $orders->count() }})</sup></h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
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
                            <th>Date</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h2 class="text-center text-muted">There is no order.</h2>
                                </td>
                            </tr>
                        @else
                            @foreach ($orders as $order)
                                <tr class="tr-shadow">
                                    <input type="hidden" value="{{ $order->id }}" id="order_id">
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-M-Y H:i:s') }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td><a
                                            href="{{ route('admin.order.detail', $order->order_code) }}">{{ $order->order_code }}</a>
                                    </td>
                                    <td>
                                        <select class="status form-control">
                                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Complete
                                            </option>
                                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Reject
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{-- {{ $admins->links() }} --}}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.status').on('change', function() {
                var prentTag = $(this).parents('tr');
                var orderId = prentTag.find('#order_id').val();
                $.ajax({
                    url: '/admin/ajax/status',
                    type: 'get',
                    data: {
                        order_id: orderId,
                        status: $(this).val()
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Toast.fire({
                                icon: "success",
                                title: response.message,
                            });
                        }
                    }
                })
            });
            $('#order_search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable .tr-shadow').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
