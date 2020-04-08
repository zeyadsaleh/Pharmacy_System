{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- @section('sidebar')
    <li class="nav-item">
        <a href="{{route('orders.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Orders</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('pharmacies.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Doctors</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('revenues.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Revenues</p>
        </a>
    </li>
@stop -->
@include('layouts.sidebar')

@section('content_header')
<div class="container">
    <h1>Doctors</h1>
</div>
@stop

@section('content')

<div class="container">

<a href="{{route('pharmacies.doctors.create')}}" class="btn btn-success mb-3">Create Doctor</a>

<table id="users-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>National ID</th>
                <th>Avatar</th>
                @hasrole('admin')
                <th>Pharmacy</th>
                @endhasrole
                <th>Banned</th>
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

            $.ajax({
                url: '{!! route('pharmacies:doctors:dt') !!}',
                success: function (data) {
                    columnNames = Object.keys(data.data[0]);
                    let columns = [];
                    for (var i in columnNames) {
                        if(columnNames[i] == 'avatar') {
                            columns.push({
                                data: columnNames[i],
                                name: columnNames[i],
                                render: function(url) {
                                    return '<img src="{{url("uploads")}}'+url+'" width=100 height=100>';
                                }
                            });
                        } else 
                            columns.push({data: columnNames[i], name: columnNames[i]});
                    }

                    $('#users-table').DataTable({
                        ajax: '{!! route('pharmacies:doctors:dt') !!}',
                        processing: true,
                        serverSide: true,
                        columns: columns
                    } );
                }
            });
        });

        function deleteDoctor(id) {
            if(confirm('Do you want to delete this doctor ?'))
                document.querySelector(`#delete-${id}`).submit();
        }
    </script>
@stop
