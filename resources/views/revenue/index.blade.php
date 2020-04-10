{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Revenue')

@section('content_header')
<h1>Revenue</h1>
<hr>
@stop

@hasrole('pharmacy')
@include('layouts.sidebar')
@section('content')
<div class="card m-3">
  <div class="card-body">
    <h3 class="card-title">Name: {{$pharmacy -> name}}</h3>
    <p class="card-text"> Total Revenue: {{$revenue}}</p>
    @if($pharmacy->avatar)
    <img class="card-img-top img-fluid" src="{{url('avatars'.$pharmacy->avatar)}}" alt="image" style="height: 200px; width:200px">
    @endif
  </div>
</div>
@stop
@endhasrole

@hasrole('super-admin')
@include('layouts.sidebar')

@section('content')
<div class="card m-3">
  <div class="card-body">
    <h2 class="card-title"><strong> Total revenues of all pharmacies </strong></h2>
    <p class="card-text">{{$totalRevenuesInDollers}}</p>
  </div>
</div>

<div class="container mt-3">
  <table id="revenues-table" class="table table-bordered data-table">
    <thead>
      <tr>
        <th>Pharmacy Avatar</th>
        <th>Pharmacy Name</th>
        <th>Total Orders</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@stop
@section('js')
@include('layouts.revenuesjs')
@stop
@endhasrole