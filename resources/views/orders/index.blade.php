@extends('adminlte::page')

@section('title', 'Order')

@section('css')
@include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('sidebar')
@include('layouts.sidebar')
@stop

@section('content')

<div class="container">

  <div class="d-flex justify-content-center mb-3">
    <h1 class="text-left d-inline h1">Orders</h1>
    <hr>
    <div class="text-right d-inline">
      <a class="btn btn-success btn-lg" href="{{route('orders.create')}}" id="createNeworder">New Order</a>
    </div>
  </div>

  <hr>

  <div id="box">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @elseif($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif
  </div>
  <div class="table-responsive">
    <table id="orders-table" class="table table-bordered data-table">
      <thead class="bg-primary text-center shadow">
        <tr>
          <th>ID</th>
          <th>UserName</th>
          <th>Delivering Address</th>
          <th>is Insured</th>
          <th>Status</th>
          <th>Pharmacy</th>
          <th>Doctor Name</th>
          <th>Creation Date</th>
          @hasrole('super-admin')
          <th>Creator</th>
          @endhasrole
          <th width="280px">Action</th>

        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@stop

@section('js')
@include('layouts.orderjs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="/js/sweetalert2.all.min.js"></script>
@stop