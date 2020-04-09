{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Revenue')

@section('content_header')
<h1>Revenue</h1>
@stop

@hasrole('pharmacy')

@section('content')
<div class="card m-3">
  <div class="card-body">
    <h3 class="card-title">Name: {{$pharmacy -> name}}</h3>
    <p class="card-text"> Total Revenue: {{$revenue}}</p>
    @if($pharmacy->avatar)
    <img class="card-img-top img-fluid" src="{{url('uploads/avatars'.$pharmacy->avatar)}}" alt="image" style="height: 200px; width:200px">
    @endif
  </div>
</div>
@stop
@endhasrole
@hasrole('admin')

@endhasrole