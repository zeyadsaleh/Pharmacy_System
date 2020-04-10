@extends('adminlte::page')

@section('title', 'Order')

@include('layouts.sidebar')

@section('css')
@include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('content')
<div class="container d-flex justify-content-center m-auto">
    <div style="margin-top:50px;"
        class="mainbox p-3 col-md-7 col-md-offset-3 col-sm-12 col-sm-offset-2 mr-5 border rounded m-2">

        <form id="order" method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data"
            class="form-horizontal" role="form">
            @csrf
            <div class="panel-body p-auto">
                <h2 class="shadow-lg rounded panel-title text-center bg-primary p-2 mb-5">Order Info</h2>

                <div class="panel-heading p-3 border border-dark rounded">
                    <div class="d-flex justify-content-center">
                        <h3 class="shadow rounded panel-title text-center bg-primary mb-3 p-auto col-7">User Info</h3>
                    </div>
                    <br>
                    <p><b>UserName</b></p>
                    <div class="input-group">
                        <select class="user form-control" name="user">
                            <option disabled selected>Select User</option>
                            @foreach($clients as $client)
                            <option value="{{$client->name}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    {!! $errors->first('user', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}
                    <hr>
                </div>

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
                <hr>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg shadow-lg disabled border border-dark"
                        id="addin"><b>Put in Order</b></button>
                </div>
        </form>
    </div>
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
                <option value="{{$medicine->name}}">{{$medicine->name}}</option>
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
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@stop

@section('js')
<script src="/js/order.js"></script>
@include('layouts.orderjs')
@stop
