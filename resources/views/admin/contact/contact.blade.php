@extends('admin.layout.app')
@section('title', 'Contact')
@section('contact_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Contacts <sup style="font-size: 20px;"></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-8"></div>
                <div class="col-4">
                    <form class="form-header" method="get">
                        <input class="form-control" type="text" id='search_box' name="key"
                            placeholder="Search contact..." />
                        <button class="au-btn--submit" type="button">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2" id="contactTable">
                    <thead>
                        <tr>
                            <th style="width: 0px;"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr class="tr-shadow contacts">
                                <input type="hidden" id="contact_id" value="{{ $contact->id }}">
                                <td></td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td><a
                                        href="{{ route('admin.contact.detail', $contact->id) }}">{{ Str::limit($contact->message, 150, '.....') }}</a>
                                </td>
                                <td>{{ $contact->created_at->format('d-M-Y H:i:s') }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item delete" data-toggle="tooltip" data-placement="top"
                                            title="Delete">
                                            <i class="zmdi zmdi-delete text-danger"></i>
                                        </button>
                                    </div>
                                </td>
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
            $('#search_box').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#contactTable .contacts').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('.delete').on('click', function() {
                const parent = $(this).parents('tr');
                const contactId = parent.children('#contact_id').val();
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
                            url: '/admin/ajax/contact_delete',
                            type: 'get',
                            data: {
                                contact_id: contactId
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    var message = response.message
                                    parent.remove();
                                    swalWithBootstrapButtons.fire({
                                        title: "Deleted!",
                                        text: message,
                                        icon: "success"
                                    });
                                }
                            }
                        });
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
@endsection
