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
    <h1 class="mb-3">Edit Doctor</h1>
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
<form method="POST" action="{{route('pharmacies.doctors.update', ['doctor' => $doctor->id])}}" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$doctor->name}}">
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$doctor->email}}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{$doctor->password}}">
    </div>
    <div class="form-group col-md-6">
      <label for="nationalID">National ID</label>
      <input type="text" class="form-control" id="nationalID" name="national_id" placeholder="National ID" value="{{$doctor->national_id}}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="avatar">Avatar</label>
      <input type="file" class="d-block" id="avatar" name="avatar" accept="image/*">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
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
