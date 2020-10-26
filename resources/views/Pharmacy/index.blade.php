{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

@section('content_header')
<h1>Pharmacy Main Page</h1>
@stop


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@elseif($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@elseif($message = Session::get('danger'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="container-fluid">
    <h1>Pharmacies</h1>

    <a href="{{route('pharmacies.create')}}" class="btn btn-success mb-3">Add Pharmacy</a>
    <a href="{{route('pharmacies.deleted')}}" class="btn btn-danger mb-3">Show deleted Pharmacies</a>
    <div class="table-responsive">
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
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="/js/sweetalert2.all.min.js"></script>
<script>
    $(function() {
        $('#pharma-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('pharmacies.index') !!}',
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'national_id',
                    name: 'national_id'
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    render: function(url) {
                        return '<img src="{{url("avatars")}}' + url + '" width=100 height=100>';
                    }
                },
                {
                    data: 'area',
                    name: 'area'
                },
                {
                    data: 'priority',
                    name: 'priority'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });
    // check soft delete
    function deleteAddress(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    url: "{{ url('') }}" + "/admin/pharmacies/" + id,
                    success: function(data) {
                        var table = $('#pharma-table').dataTable();
                        table.fnDraw(false);
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Swal.fire(
                            'Not Deleted!',
                            'Your record can\'t be deleted',
                            'error'
                        )
                    }
                });
            }
        })
    }
</script>@stop