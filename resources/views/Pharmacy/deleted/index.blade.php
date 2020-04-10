{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

@section('content_header')
<h1>Pharmacy</h1>
@stop


@section('content')
<div class="container-fluid">
    <h1>Deleted Pharmacies</h1>

    <table id="pharma-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>email</th>
                <th>National ID</th>
                <th>Image</th>
                <th>Area</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
                $('#pharma-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.pharmacies.deleted') !!}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'national_id', name: 'national_id' },
                        { data: 'avatar', name:'avatar', render: function(url) {
                            return '<img src="{{url("avatars")}}'+url+'" width=100 height=100>';
                        }},
                        { data: 'area', name: 'area' },
                        { data: 'priority', name: 'priority' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
            });

</script>@stop
