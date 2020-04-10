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

<div class="container m-5 p-2">
  <div class="row justify-content-md-center">
    <div class="card col-12 text-center shadow" style="opacity: 0.95;">
      <h1 class="border bg-dark shadow m-3 p-2 rounded">Order Details</h1>
        <div class="card-body border border-dark rounded p-3 m-5">
          <table class="table table-hover text-center align-middle">
            <tbody>
              <tr>
                <th width="220px" class="bg-dark h3 align-middle">User Name</th>
                <td class="h5 align-middle border rounded pl-4 text-left">{{$order->user->name}}</td>
              </tr>
              <tr>
                <th width="220px" class="bg-dark h3 align-middle" rowspan="4">Address</th>
                <td class="h5 align-middle border rounded pl-4 text-left"><u>Street Name</u>&nbsp;&nbsp; {{$order->address->street_name}}</td>
              </tr>
              <tr>
                <td class="h5 align-middle border rounded pl-4 text-left"><u>Building Name</u>&nbsp;&nbsp; {{$order->address->building_name}}</td>
              </tr>
              <tr>
                <td class="h5 align-middle border rounded pl-4 text-left"><u>Floor Number</u>&nbsp;&nbsp; {{$order->address->floor_number}}</td>
              </tr>
              <tr>
                <td class="h5 align-middle border rounded pl-4 text-left"><u>Flat Number</u>&nbsp;&nbsp; {{$order->address->flat_number}}</td>
              </tr>
              @if( $order->pharmacy )
              <tr>
                <th width="220px" class="bg-dark h3 align-middle">Pharmacy</th>
                <td class="h5 align-middle border rounded pl-4 text-left">{{$order->pharmacy->name}}</td>
              </tr>
              @endif
              <tr>
                <th width="220px" class="bg-dark h3 align-middle">Status</th>
                <td class="h5 align-middle border rounded pl-4 text-left">{{$order->status}}</td>
              </tr>
              <tr>
                <th width="220px" class="bg-dark h3 align-middle">Medicine Details</th>
                <td class="h5 align-middle border rounded pl-4 text-left">
                  @foreach($order->medicines as $medicine)
                  <p>{{$medicine->name}} </p>
                  @endforeach
                </td>
              </tr>
              <tr>
                <th width="220px" class="bg-dark h3 align-middle">Total Price</th>
                <td class="h5 align-middle border rounded pl-4 text-left">{{$order->total_price / 100}} $</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

@stop

@section('js')
  @include('layouts.orderjs')
@stop
