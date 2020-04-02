{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('sidebar')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Orders</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('pharmacies.doctors.show')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Doctors</p>
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
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Password</label>
      <input type="password" class="form-control" id="inputEmail4" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">National ID</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="National ID">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Avatar</label>
      <input type="file" class="d-block" id="inputEmail4" accept="image/*">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
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