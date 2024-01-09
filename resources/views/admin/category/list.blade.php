@extends('admin.layout.app')
@section('title', 'Category')
@section('category_active', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List <sup style="font-size: 20px;">(Total -
                                {{ $categories->total() }})</sup></h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.category.add') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add item
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
                            placeholder="Search categories..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                @if ($categories->count() != 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="tr-shadow">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('d-M-Y H:i:s') }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ url('admin/category/update/' . $category->id) }}" class="item"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit text-primary"></i>
                                            </a>
                                            <a href="{{ route('admin.category.delete', $category->id) }}" class="item"
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
                    <h4 class="text-center text-muted">There is no categories.</h4>
                @endif
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
