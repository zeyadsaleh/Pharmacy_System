{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')


@section('content_header')
<div class="container">
    <h1 class="mb-3">Edit Address</h1>
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
<form method="POST" action="{{route('admin.userAddresses.update', ['useraddress' => $userAddress->id])}}" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">User</label>
      <input readonly type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$user->name}}">
    </div>
    <div class="form-group col-md-6">
      <label for="natid">National ID</label>
      <input readonly type="text" name="natid" class="form-control" id="natid" placeholder="National ID" value="{{$user->national_id}}">
    </div>
    <div class="form-group col-md-6">
      <label for="street">Street</label>
      <input type="text" name="street" class="form-control" id="street" placeholder="Street" value="{{$userAddress->street_name}}">
    </div>
    <div class="form-group col-md-6">
      <label for="building">Building</label>
      <input type="text" name="building" class="form-control" id="building" placeholder="Building" value="{{$userAddress->building_name}}">
    </div>
    <div class="form-group col-md-6">
      <label for="floor">Floor</label>
      <input type="text" name="floor" class="form-control" id="floor" placeholder="Floor" value="{{$userAddress->floor_number}}">
    </div>
    <div class="form-group col-md-6">
      <label for="flat">Flat</label>
      <input type="text" name="flat" class="form-control" id="flat" placeholder="Flat" value="{{$userAddress->flat_number}}">
    </div>
    <div class="form-group d-block col-md-12">
      <input type="checkbox" name="is_main" id="is_main">
      <label for="is_main">Main Address</label>
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
