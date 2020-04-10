@extends('adminlte::page')

@section('title', 'Order')
@include('layouts.sidebar')

@section('css')
@include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('content')
<div class="container d-flex justify-content-center">
       <div class="mainbox col-md-7 col-md-offset-3 col-sm-9 col-sm-offset-2 border rounded p-5">
           <div class="panel panel-info" >
                   <div class="panel-heading text-center shadow rounded">
                       <h2 class="panel-title border bg-dark mb-4 p-auto">Order Info</h2>
                   </div>
                   <div class="panel-body pt-3" >
                     <div class="panel-heading text-center shadow rounded border-dark ">
                       <h4 class="panel-title border bg-primary mb-4 p-auto">Ph. {{$order->pharmacy->name}}</h4>
                     </div>

                       <form id="order" method="POST" action="{{route('orders.update',['order' => $order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                         @method('PUT')
                         @csrf
                         @hasrole('admin')
                         <p><b>Pharmacy</b></p>
                         <div class="input-group">
                                     <select class="form-control" name="pharmacy" {{$check}}>
                                       @foreach($pharmacies as $pharmacy)
                                       @if($pharmacy->name == $order->pharmacy->name)
                                       <option disabled selected>{{$pharmacy->name}}</option>
                                       @continue
                                       @endif
                                       <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                                       @endforeach
                                     </select>
                                 </div>
                         <hr>
                         @endhasrole

                           <p><b>Order Username</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="username" value="{{$order->user->name}}" {{$check}}>
                                   </div>

                           <hr>

                           <p><b>Deliverying Address</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="addres" value="{{$order->address->street_name}}" {{$check}}>
                           </div>

                           <hr>

                            <p><b>Created by</b></p>
                            <div class="input-group">
                                        <input type="text" class="form-control" name="creation_data" value="{{$order->created_by}}" {{$check}}>
                            </div>

                            <hr>

                            <p><b>Doctor Name</b></p>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <input type="text" class="form-control" name="dname" value="{{$order->doctor? 'Dr. '.$order->doctor->name : " "}}" {{$check}}>
                                    </div>

                           <hr>

                           <p><b>Is Insured</b></p>
                           <div class="input-group">
                                       <input type="text" class="form-control" name="isinsured" value="{{$order->is_insured? 'Yes':'No'}}" {{$check}}>
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
