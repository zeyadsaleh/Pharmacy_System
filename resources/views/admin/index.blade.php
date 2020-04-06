{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('sidebar')
<li class="nav-item">
    <a href="{{route('admin.pharmacies.index')}}" class="nav-link">
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
    <a href="{{route('admin.areas.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Areas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.users.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.userAddresses.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>User Addresses</p>
    </a>
</li>
<li class="nav-item">
    {{-- {{route('admin.medicines.index')}} --}}
    <a href="" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Medicines</p>
    </a>
</li>
<li class="nav-item">
    {{-- {{route('admin.orders.index')}} --}}
    <a href="" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Orders</p>
    </a>
</li>
<li class="nav-item">
    {{-- {{route('admin.revenues.index')}} --}}
    <a href="" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Revenues</p>
    </a>
</li>
@stop

@section('content_header')
<h1>Admin Main Page</h1>
@stop


@section('content')
<p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
@stop
