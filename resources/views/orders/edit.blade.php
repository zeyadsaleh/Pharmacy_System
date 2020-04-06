@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')

@stop

@section('content')
<div class="container d-flex justify-content-center">
       <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
           <div class="panel panel-info" >
                   <div class="panel-heading">
                       <h2 class="panel-title">Order Info</h2>
                   </div>
                   <div style="padding-top:30px" class="panel-body" >

                       <form id="order" method="POST" action="{{route('orders.update',['order' => $order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                         @method('PUT')
                         @csrf
                           <p><b>Order Username</b></p>
                           <div style="margin-bottom: 25px" class="input-group">
                                       <input type="text" class="form-control" name="username" value="{{$order->user->name}}" disabled>
                                   </div>

                          <hr>

                           <p><b>Deliverying Address</b></p>
                           <div style="margin-bottom: 25px" class="input-group">
                                       <input type="text" class="form-control" name="addres" value="{{$order->delivering_address}}" disabled>
                           </div>

                           <hr>

                            <p><b>Creation Data</b></p>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <input type="text" class="form-control" name="creation_data" value="{{$order->created_at}}" disabled>
                            </div>

                            <hr>

                             <p><b>Current Order Status: </b><span style="color: green;"><u>{{$order->status}}</u></span></p>

                            <div style="margin-bottom: 25px" class="input-group">
                                 <select name="status" class="form-control">
                                     <option value="{{$order->status}}">{{$order->status}}</option>
                                   @if($order->status != 'New')
                                     <option value="New">New</option>
                                   @endif
                                   @if($order->status != 'Processing')
                                     <option value="Processing">Processing</option>
                                   @endif
                                   @if($order->status != 'WaitingForUserConfirmation')
                                     <option value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                                   @endif
                                   @if($order->status != 'Canceled')
                                     <option value="Canceled">Canceled</option>
                                   @endif
                                   @if($order->status != 'Confirmed')
                                     <option value="Confirmed">Confirmed</option>
                                   @endif
                                   @if($order->status != 'Delivered')
                                     <option value="Delivered">Delivered</option>
                                   @endif
                                </select>
                            </div>

                         <div style="margin-top:10px" class="form-group">
                             <!-- Button -->
                             <div class="col-sm-12 controls">
                               <button type="submit" class="btn btn-success">Edit</button>
                             </div>
                         </div>

                   </div>
          </div>
       </div>
   </div>

@stop

@section('js')
  @include('layouts.orderjs')
@stop
