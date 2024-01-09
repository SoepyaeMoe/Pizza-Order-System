@extends('admin.layout.app')
@section('title', 'Customer List')
@section('customer_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Customer List <sup
                                style="font-size: 20px;">(Total-{{ $customers->count() }})</sup>
                        </h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                </div>
            </div>
            <div class="row">
                <div class="offset-8"></div>
                <div class="col-4">
                    <input class="form-control" id="search_box" type="text" name="key"
                        placeholder="Search customer..." />
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                @if ($customers->count() != 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th style="width: 200px;">Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th style="width: 200px;">Join on</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr class="tr-shadow customers">
                                    <input type="hidden" id="customer_id" value="{{ $customer->id }}">
                                    <td>
                                        @if ($customer->image)
                                            <img src="{{ asset('storage/profile_pic/' . $customer->image) }}"
                                                class="img-thumbnail" alt=""
                                                style="min-width: 100px; min-height: 100px; max-width: 100px; min-height: 100px;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ $customer->name }}?background=random"
                                                class="img-thumbnail" alt=""
                                                style="min-width: 100px; min-height: 100px; max-width: 100px; min-height: 100px;">
                                        @endif
                                    </td>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->created_at->format('d-M-Y H:i:s') }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item delete_btn" data-toggle="tooltip" data-placement="top"
                                                title="Delete"> <i class="zmdi zmdi-delete text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center text-muted">There is no customer.</h4>
                @endif
            </div>
            {{-- <div class="mt-2 d-flex justify-content-end">
                {{ $customers->links() }}
            </div> --}}
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.delete_btn').on('click', function() {
                var parentTag = $(this).parents('tr');
                var customerId = parentTag.find('#customer_id').val();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger m-3"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/ajax/user_delete',
                            type: 'get',
                            data: {
                                'customer_id': customerId
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    parentTag.remove();
                                    swalWithBootstrapButtons.fire({
                                        title: "Deleted!",
                                        text: "Customer has been deleted.",
                                        icon: "success"
                                    });
                                }
                            }
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            icon: "error"
                        });
                    }
                });
            });
            $('#search_box').on('keyup', function() {
                $('.customers').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf($('#search_box').val()
                        .toLowerCase()) > -1);
                });
            });
        });
    </script>
@endsection
