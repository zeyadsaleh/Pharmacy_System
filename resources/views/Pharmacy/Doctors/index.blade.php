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
    <h1>Pharmacy Main Page</h1>
    @stop


@section('content')
<p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
<script> console.log('Hi!'); </script>
@stop