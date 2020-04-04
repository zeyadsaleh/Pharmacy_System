{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Create Doc')

@section('sidebar')
    <li class="nav-item">
        <a href="admin.pharmacies.index" class="nav-link">
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
<div class="container">
    <h1 class="mb-3">Create a Doctor</h1>
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
<form method="POST" action="{{route('admin.doctors.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="nationalID">National ID</label>
      <input type="text" class="form-control" id="nationalID" name="national_id" placeholder="National ID">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="avatar">Avatar</label>
      <input type="file" class="d-block" id="avatar" name="avatar" accept="image/*">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Users</label>
    <select name="pharmacy_id" class="form-control">
      @foreach($pharmacies as $pharmacy)
        <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
      @endforeach
      </select>
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
