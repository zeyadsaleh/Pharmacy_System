{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Edit User')

@include('layouts.sidebar')


@section('content_header')
<div class="container">
    <h1 class="mb-3">Edit User</h1>
</div>
@stop

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{route('admin.clients.update', ['client' => $client->id])}}"
        enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$client->name}}"
                    placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="email">e-mail</label>
                <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}"
                    placeholder="email">
            </div>
            <div class="form-group col-md-6">
                <label for="password">password</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="password">
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">confirm password</label>
                <input type="password" name="password_confirmation" class="form-control"
                    id="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" value="{{$client->gender}}" id="gender">
                    <option id="Female" value="Female">Female</option>
                    <option id="Male" value="Male">Male</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="national_id">National ID</label>
                <input type="text" name="national_id" class="form-control" id="national_id"
                    value="{{$client->national_id}}" placeholder="national_id">
            </div>
            <div class="form-group col-md-6">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" value="{{$client->mobile_number}}"
                    id="mobile_number" placeholder="mobile number">
            </div>
            <div class="form-group col-md-6">
                <label for="date_of_birth">Birth Date</label>
                <input type="date" id="date_of_birth" value="{{$client->date_of_birth}}" name="date_of_birth"
                min="1930-01-01">
            </div>
            <div class="form-group col-md-4">
                <div class="form-group col-md-12">
                    <label for="avatar">Image</label>
                    <input type="file" class="d-block" id="avatar" name="avatar" value="{{$client->avatar}}"
                        accept="image/*">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    @stop

    @section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        document.getElementById("{{$client->gender}}").selected = "true";
        document.querySelector('#date_of_birth').max = new Date().toISOString().split("T")[0];
    </script>
    @stop
