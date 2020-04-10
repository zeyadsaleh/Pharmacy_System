{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')


@section('content_header')
<div class="container">
    <h1 class="mb-3">Add an Address</h1>
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
<form method="POST" action="{{route('admin.userAddresses.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="user">User name : National ID</label>
            <!-- <div class="mb-1">user name : national ID </div> -->
            <select name="user_id" class="form-control" id="user_id">
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name .' : '. $user->national_id}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
          <label for="street">Street</label>
          <input type="text" name="street_name" class="form-control" id="street_name" placeholder="Street">
        </div>
        <div class="form-group col-md-6">
          <label for="building">Building</label>
          <input type="text" name="building_name" class="form-control" id="building_name" placeholder="Building">
        </div>
        <div class="form-group col-md-6">
          <label for="floor">Floor</label>
          <input type="text" name="floor_number" class="form-control" id="floor_number" placeholder="Floor">
        </div>
        <div class="form-group col-md-6">
          <label for="flat">Flat</label>
          <input type="text" name="flat_number" class="form-control" id="flat_number" placeholder="Flat">
        </div>
        <div class="form-group d-block col-md-12">
            <input type="checkbox" value="1" name="is_main" id="is_main">
            <label for="is_main">Main Address</label>
          </div>
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

