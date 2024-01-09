@extends('admin.layout.app')
@section('contact_active', 'active')
@section('title', 'Content')
@section('content')
    <div class="content">
        <i class="fas fa-arrow-left" id="back" style="cursor: pointer;"></i>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Message
                    </div>
                    <div class="card-body">
                        <p>{{ $contact->message }}</p>
                        <div>
                            <p class="text-right" style="font-size: 13px; font-weight: bold;">{{ $contact->name }}</p>
                            <p class="text-right" style="font-size: 13px; font-weight: bold;">{{ $contact->email }}</p>
                            <p class="text-right" style="font-size: 13px; font-weight: bold;">{{ $contact->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#back').on('click', function() {
                window.history.back();
            });
        });
    </script>
@endsection
