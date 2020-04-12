@extends('adminlte::page')

@section('title', 'Doctors')

@section('content_header')
    <h1>Doctors</h1>
@stop


@hasanyrole('pharmacy|super-admin')
@include('layouts.sidebar')

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
                @hasrole('super-admin')
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
    <!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="/js/sweetalert2.all.min.js"></script>
    <!-- <script src="sweetalert2.min.js"></script> -->

    <script>
        // Create table and fetch data using ajax
        $(function() {

            $.ajax({
                url: '{!! route('doctors:dt') !!}',
                success: function (data) {
                    columnNames = Object.keys(data.data[0]);
                    let columns = [];
                    for (var i in columnNames) {
                        if(columnNames[i] == 'avatar') {
                            columns.push({
                                data: columnNames[i],
                                name: columnNames[i],
                                render: function(url) {
                                    return '<img src="{{url("avatars")}}'+url+'" width=100 height=100>';
                                }
                            });
                        } else
                            columns.push({data: columnNames[i], name: columnNames[i]});
                    }

                    $('#users-table').DataTable({
                        ajax: '{!! route('doctors:dt') !!}',
                        processing: true,
                        serverSide: true,
                        columns: columns
                    } );
                }
            });
        });

        function deleteDoctor(id) {
            // var form = document.querySelector(`#delete-${id}`);

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
                            url: "{{ url('') }}" + "/pharmacies/doctors/"+id,
                            success: function (data) {
                                var table = $('#users-table').dataTable();
                                table.fnDraw(false);
                                Swal.fire(
                                    'Deleted!',
                                    'Your record has been deleted.',
                                    'success'
                                )
                            },
                            error: function (data) {
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
    </script>
@stop
@endhasrole
 

