{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Add Pharmacy')

@section('sidebar')
    <li class="nav-item">
        <a href="{{route('admin.pharmacies.index')}}" class="nav-link">
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
                <a href="{{route('admin.areas.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Areas</p>
                </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.users.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Users</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.userAddresses.index')}}" class="nav-link">
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
<div class="container">
    <h1 class="mb-3">Add a Pharmacy</h1>
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
<form method="POST" action="{{route('admin.pharmacies.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="address"></label>
      <input type="text" name="address" class="form-control" id="address" placeholder="Address">
    </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@stop
