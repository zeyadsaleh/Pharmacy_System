@extends('adminlte::page')

@section('title', 'Order')
@include('layouts.sidebar')

@section('css')
@include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('content')

@if($order->status == 'Processing')
<div class="container d-flex justify-content-center m-auto">
    <div style="margin-top:50px;"
        class="mainbox p-3 col-md-7 col-md-offset-3 col-sm-9 col-sm-offset-2 mr-5 border rounded m-2">
        <div class="panel-body p-auto">
          <h2 class="shadow-lg rounded panel-title text-center bg-primary p-2 mb-3">Order Info</h2>
        <div class="d-flex justify-content-center">
            <img src="{{url('prescriptions/'.$order->prescriptions)}}" class="shadow rounded panel-title text-center mb-3 p-auto" width="500px"/>
        </div>
<form id="order" method="POST" action="{{route('orders.update',['order' => $order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
          @method('PUT')
          @csrf
<div class="d-none" id="actions-buttons">
    <div id="order-medicine" class="panel-heading p-3 mt-5 border border-dark rounded">
        <div class="d-flex justify-content-center">
            <h3 class="shadow rounded info-title panel-title text-center bg-primary mb-3 p-auto col-7">
                Medicines in Order</h3>
        </div>
        <br>
        <table class="table table-sm text-center p-auto">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2">Medicine</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <input type="number" class="d-none" name="items" value="0" id="items" readonly hidden>
        <div class="d-flex justify-content-center mt-5 mb-2">
            <input id="rm-medicine"
                class="col-2 shadow btn border border-danger text-center p-auto d-inline" value="Undo">
            <input id="rs-medicine"
                class="col-2 shadow btn border border-danger text-center p-auto d-inline ml-5"
                value="Reset">
            </div>
            <center><a href="{{route('stripe')}}" class="btn btn-success btn-md">PAY with Creadit Card</a></center>
    </div>
</div>
<div class="d-flex justify-content-center mt-5">
    <button type="submit" class="btn btn-primary btn-lg shadow-lg disabled border border-dark"
        id="addin"><b>Put in Order</b></button>
</div>
</div>
</form>
</div>

<div style="margin-top:50px;" class="mainbox p-3 col-md-4 col-md-offset-4 col-sm-9 col-sm-offset-2  border rounded m-1">
    <div class="panel-body p-auto">
        <h2 class="shadow-lg rounded panel-title text-center bg-dark p-2 mb-3">Add to Order</h2>
        <p><b>Medicine_Name</b></p>

        <div class="input-group">
            <select class="medicine form-control" name="medicine" id="medicine">
                @hasrole('Pharmacy')
                <input type="number" value="1" disabled hidden id="pharm" />
                @endhasrole
                <option disabled selected>Select Medicine</option>
                @foreach($medicines as $medicine)
                <option value="{{$medicine->name}}">{{$medicine->name}} || '{{$medicine->type}}'</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('medicine1', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}
        <hr>
        <p><b>Type</b></p>
        <div class="input-group">
            @hasrole('Pharmacy')
            <input type="text" id="log" hidden disabled value="1">
            @endhasrole
            <select class="type form-control" name="type" id="type">
                <option disabled selected>Select Type</option>
                <option value="Liquid">Liquid</option>
                <option value="Drops">Drops</option>
                <option value="Capsules">Capsules</option>
                <option value="Tablet">Tablet</option>
                <option value="Cream">Cream</option>
                <option value="Injections">Injections</option>
                <option value="Injections">Suppositories</option>
                <option value="Injections">Inhalers</option>
            </select>
        </div>
        {!! $errors->first('type1', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

        <hr>
        <p><b>Quantity</b></p>
        <div class="input-group">
            <input type="number" class="form-control" name="quantity" min=0 id="quantity">
        </div>
        {!! $errors->first('quantity1', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

        <hr>
        <p><b>Price/Medicine</b></p>
        <div class="input-group">
            <input type="number" class="form-control" name="price" min=0 id="price">
        </div>
        {!! $errors->first('price1', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}
    </div>

    <div class="d-flex justify-content-center mt-5">
        <button id="add-medicine" class="btn btn-warning shadow-lg">Add medicine to order</button>
    </div>
</div>
</div>

@else
<div class="container d-flex justify-content-center">
       <div class="mainbox col-md-7 col-md-offset-3 col-sm-9 col-sm-offset-2 border rounded p-5">
           <div class="panel panel-info" >
                   <div class="panel-heading text-center shadow rounded">
                       <h2 class="panel-title border bg-dark mb-4 p-auto">Order Info</h2>
                   </div>
                   <div class="panel-body pt-3" >
                     <div class="panel-heading text-center shadow rounded border-dark ">
                        @if($order->pharmacy)
                       <h4 class="panel-title border bg-primary mb-4 p-auto">Ph. {{$order->pharmacy->name}}</h4>
                       @endif
                     </div>

                       <form id="order" method="POST" action="{{route('orders.update',['order' => $order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                         @method('PUT')
                         @csrf
                         @hasrole('super-admin')
                         <p><b>Pharmacy</b></p>
                         <div class="input-group">
                                     <select class="form-control" name="pharmacy">
                                       @foreach($pharmacies as $pharmacy)
                                       @if($order->pharmacy && $pharmacy->name == $order->pharmacy->name)
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

                          @if($order->pharmacy)
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
                            </div>]
                            @endif

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
@endif

@stop

@section('js')
<script src="/js/order.js"></script>
@include('layouts.orderjs')
@stop
