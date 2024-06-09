@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {!! $content !!}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#user_table').DataTable({
                "pageLength": 5,
                "lengthChange": false
            });
        });
    </script>
@endpush
