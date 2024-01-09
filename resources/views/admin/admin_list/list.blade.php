@extends('admin.layout.app')
@section('title', 'Admin List')
@section('admin_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List <sup style="font-size: 20px;">(Total -
                                {{ $admins->total() }})</sup></h2>
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
                    <form class="form-header" method="get">
                        <input class="form-control" type="text" name="key" value="{{ request('key') }}"
                            placeholder="Search admin..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admins->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h2 class="text-center text-muted">No data found.</h2>
                                </td>
                            </tr>
                        @else
                            @foreach ($admins as $admin)
                                <tr class="tr-shadow">
                                    <td>
                                        @if ($admin->image)
                                            <img style="width: 70px; height: 70px;"
                                                src="{{ asset('storage/profile_pic/' . $admin->image) }}" alt="">
                                        @else
                                            <img style="width: 70px; height: 70px;"
                                                src="https://ui-avatars.com/api/?name={{ $admin->name }}?background=random"
                                                alt="">
                                        @endif
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if ($admin->id != Auth::user()->id)
                                                <a href="{{ route('admin.admin.delete', $admin->id) }}" class="item"
                                                    onclick="return confirm('Are you sure, you want to delete it!')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $admins->links() }}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
