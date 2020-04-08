@extends('adminlte::page')

@section('title', 'Order')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('content')
<div class="container d-flex justify-content-center">
       <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 border rounded p-5">
           <div class="panel panel-info" >
                   <div class="panel-heading text-center shadow rounded">
                       <h2 class="panel-title border bg-dark mb-4 p-auto">Order Info</h2>
                   </div>
                   <div class="panel-body pt-3" >

                       <form id="order" method="POST" action="{{route('orders.update',['order' => $order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                         @method('PUT')
                         @csrf
                           <p><b>Order Username</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="username" value="{{$order->user->name}}" readonly>
                                   </div>

                           <hr>

                           <p><b>Deliverying Address</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="addres" value="{{$order->address->street_name}}" readonly>
                           </div>

                           <hr>

                            <p><b>Created by</b></p>
                            <div class="input-group">
                                        <input type="text" class="form-control" name="creation_data" value="{{$order->created_by}}" readonly>
                            </div>

                            <hr>

                            <p><b>Doctor Name</b></p>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <input type="text" class="form-control" name="dname" value="{{$order->doctor? 'Dr. '.$order->doctor->name : " "}}" readonly>
                                    </div>

                           <hr>

                           <p><b>Is Insured</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="isinsured" value="{{$order->is_insured? 'Yes':'No'}}" readonly>
                                   </div>

                          <hr>

                            <p><b>Current Order Status: </b><span style="color: green;"><u>{{$order->status}}</u></span></p>
                            <div class="input-group">
                                 <select name="status" class="form-control">
                                     <option value="{{$order->status}}">{{$order->status}}</option>
                                     @php ($i = $order->status)
                                     @switch($i)
                                       @case('New')
                                         <option value="Processing">Processing</option>
                                         @php ($i = 'Processing')
                                       @case('Processing')
                                         <option value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                                         @php ($i = 'WaitingForUserConfirmation')
                                       @case('WaitingForUserConfirmation')
                                        <option value="Delivered">Delivered</option>
                                     @endswitch

                                      @if($order->status == 'Caneled')
                                     <option value="Canceled">Canceled</option>
                                     <option value="Confirmed">Confirmed</option>
                                     <option value="Delivered">Delivered</option>
                                   @endif
                                </select>
                            </div>

                         <div class="form-group">
                             <!-- Button -->
                             <div class="d-flex justify-content-center mt-5">
                                 <button class="btn btn-lg btn-success shadow-lg">Edit iT!</button>
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
