{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')

@section('content')

<div class="container-fluid">
    <h1>User Addresses</h1>


    <a href="{{route('admin.userAddresses.create')}}" class="btn btn-success mb-3">Add Address</a>

    <table id="clients-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Client</th>
                <th>National ID</th>
                <th>street</th>
                <th>Building</th>
                <th>Floor</th>
                <th>flat</th>
                <th>Action</th>
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
    $(function() {
                $('#clients-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.userAddresses.index') !!}',
                    columns: [
                        { data: 'client', name: 'client' },
                        { data: 'nat', name: 'nat' },
                        { data: 'street', name: 'street' },
                        { data: 'building', name: 'building' },
                        { data: 'floor', name: 'floor' },
                        { data: 'flat', name: 'flat' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
            });
            function deleteAddress(id) {
                if(confirm('Do tou want to delete this Address ?'))
                    document.querySelector(`#delete-${id}`).submit();
            }

</script>
@stop
