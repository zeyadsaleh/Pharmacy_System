{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')

@section('content_header')
@stop


@section('content')

<div class="container-fluid">
    <h1>Clients</h1>


    <a href="{{route('admin.clients.create')}}" class="btn btn-success mb-3">Add client</a>

    <table id="clients-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@stop


@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    // Create table and fetch data using ajax
        $(function() {
            $('#clients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.clients.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable:false},
                ]
            });
        });
        function deleteArea(id) {
                if(confirm('Do tou want to delete this area ?'))
                    document.querySelector(`#delete-${id}`).submit();
            }
</script>
@stop
