{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin Panel')

@include('layouts.sidebar')


@section('content_header')
<div class="container">
    <h1 class="mb-3">Add an Pharmacy</h1>
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
    <form method="POST" action="{{route('pharmacies.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Pharmacy Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="E-mail">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group col-md-6">
                <label for="national_id">National Id</label>
                <input type="text" name="national_id" class="form-control" id="national_id" placeholder="National ID">
            </div>
            <div class="form-group col-md-4">
                <label for="area_id">Area</label>
                <select name="area_id" class="form-control" id="area_id">
                    @foreach ($areas as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="priority">Priority</label>
                <select name="priority" class="form-control" id="priority">
                    <option value="3">medium</option>
                    <option value="1">very high</option>
                    <option value="2">high</option>
                    <option value="4">low</option>
                    <option value="5">very low</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <div class="form-group col-md-12">
                    <label for="avatar">Image</label>
                    <input type="file" class="d-block" id="avatar" name="avatar" accept="image/*">
                </div>
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