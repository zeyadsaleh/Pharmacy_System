{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')

@section('content_header')
@stop


@section('content')

<div class="container-fluid">
    <h1>Medicines</h1>


    <a href="{{route('medicines.create')}}" class="btn btn-success mb-3">Add Medicine</a>

    <table id="medicines-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Type</th>
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
            $('#medicines-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('medicines.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'action', name: 'action', orderable:false},
                ]
            });
        });
        function deleteMedicine(id) {
                if(confirm('Do tou want to delete this Medicine ?'))
                    document.querySelector(`#delete-${id}`).submit();
            }
</script>
@stop
