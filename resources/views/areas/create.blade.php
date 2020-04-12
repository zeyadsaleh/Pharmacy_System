{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Add Area')

@include('layouts.sidebar')

@section('content_header')
<div class="container">
  <h1 class="mb-3">Add an Area</h1>
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
  <form method="POST" action="{{route('areas.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
      </div>
      <div class="form-group col-md-6">
        <label for="address">Address</label>
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