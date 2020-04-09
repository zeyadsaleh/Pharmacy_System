@extends('adminlte::page')

@section('title', 'Doctors')

@section('content_header')
    <h1>Doctors</h1>
@stop

@hasrole('doctor')
@include('layouts.sidebar')
@section('content')
<div class="card m-3">
  <div class="card-body">
    <h3 class="card-title">Welcome Dr.{{$doctor -> name}}</h3>
    @if($doctor->avatar)
    <img class="card-img-top img-fluid" src="{{url('uploads'.$doctor->avatar)}}" alt="image" style="height: 200px; width:200px">
    @endif
  </div>
</div>
@stop
@endhasrole

