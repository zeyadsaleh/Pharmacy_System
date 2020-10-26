{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

@section('content_header')
<h1>Admin Main Page</h1>
@stop

@section('content')
<div class="row justift-content-center">
	<div class="col-lg-12 col-md-12 text-center">
		<div class="full-image">
			<img src="pic/admin.png" alt="admin" height="350">
		</div>
	</div>
</div>
<div class="row justift-content-center">
	<div class="col-lg-12 col-md-12">
		<p>Welcome to this beautiful admin panel.</p>
	</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="icon" href="https://image.flaticon.com/icons/svg/2786/2786163.svg">
@stop

@section('js')
@stop