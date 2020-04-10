{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

@section('content_header')
@hasrole('pharmacy')

@endhasrole

@hasanyrole('super-admin|admin')
<div class="container">
    <h1>Admin</h1>
</div>
@endhasanyrole

@hasrole('doctor')

@endhasrole
@stop

@section('content')
@hasrole('pharmacy')
<div class="container">
    <div class="card">
        <h5 class="card-header">Pharmacy Info</h5>
        <div class="card-body mx-5">
            <div class="text-center mb-5">
                <img src="{{ url('avatars').$pharmacy->avatar }}" width=100 height=100>
                <h2 class="">{{ $pharmacy->name }}</h2>
            </div>
            <div class="row my-4">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Email</h6>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">National ID</h6>
                    <p class="card-text">{{ $pharmacy->national_id }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Priority</h6>
                    <p class="card-text">{{ $pharmacy->priority }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Area</h6>
                    <p class="card-text">{{ $pharmacy->area->name }}</p>
                </div>
            </div>
            <a href="{{route('admin.pharmacies.edit', ['pharmacy' => $pharmacy->id])}}" class="btn btn-primary">Update Info</a>
        </div>
    </div>
</div>
@endhasrole

@hasanyrole('super-admin|admin')

@endhasanyrole

@hasrole('doctor')
<div class="container">
    <div class="card">
        <h5 class="card-header">Pharmacy Info</h5>
        <div class="card-body mx-5">
            <div class="text-center mb-5">
                <img src="{{ url('avatars').$doctor->avatar }}" width=100 height=100>
                <h2 class="">Dr. {{ $doctor->name }}</h2>
            </div>
            <div class="row my-4">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Email</h6>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">National ID</h6>
                    <p class="card-text">{{ $doctor->national_id }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <h6 class="font-weight-bold">Pharmacy</h6>
                    <p class="card-text">{{ $doctor->pharmacy->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endhasrole
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@stop
