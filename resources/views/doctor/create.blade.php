{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

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
    <form method="POST" action="{{route('doctors.store')}}" enctype="multipart/form-data">
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
            <div class="form-group col-md-6">
                <label for="avatar">Avatar</label>
                <input type="file" class="d-block" id="avatar" name="avatar" accept="image/*">
            </div>

            @hasanyrole('super-admin|admin')
            <div class="form-group col-md-6">
                <label for="pharmacy_id">Pharmacy</label>
                <select name="pharmacy_id" class="form-control" id="pharmacy_id">
                    @foreach ($pharmacies as $pharmacy)
                    <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                    @endforeach
                </select>
            </div>
            @endhasanyrole
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
