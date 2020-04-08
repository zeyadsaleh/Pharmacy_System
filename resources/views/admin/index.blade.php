
{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@include('layouts.sidebar')

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
