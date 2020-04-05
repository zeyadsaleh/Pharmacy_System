{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')


@section('sidebar')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Pharmacies</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Doctors</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Areas</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Users</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>User Addresses</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.doctors.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Medicines</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Orders</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Revenues</p>
        </a>
    </li>
@stop


@section('content_header')
    @stop


    @section('content')

    <div class="container-fluid">
        <h1>Doctors</h1>


    <a href="{{route('admin.doctors.create')}}" class="btn btn-success mb-3">Add Doctor</a>

    <table id="users-table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>National ID</th>
                    <th>Avatar</th>
                    <th>Pharmacy</th>
                    <th>Banned</th>
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
        // Create table and fetch data using ajax
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.doctors.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'national_id', name: 'national_id' },
                    { data: 'avatar', name: 'avatar' },
                    { data: 'pharmacy', name: 'pharmacy',orderable:false },
                    { data: 'is_ban', name: 'is_ban' },
                    { data: 'action', name: 'action', orderable:false},
                ]
            });
        });
</script>
@stop
