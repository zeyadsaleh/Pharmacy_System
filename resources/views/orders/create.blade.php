@extends('adminlte::page')

@section('title', 'Order')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')
@stop

@section('content')
<div class="container d-flex justify-content-center m-auto">
  <div style="margin-top:50px;" class="mainbox p-3 col-md-7 col-md-offset-3 col-sm-12 col-sm-offset-2 mr-5 border rounded m-2">

      <form id="order" method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
          @csrf
          <div class="panel-body p-auto">
              <h3 class="shadow-lg rounded panel-title text-center bg-primary p-auto mb-5">Order Info</h3>

              <div class="panel-heading p-3 border border-dark rounded">
                  <div class="d-flex justify-content-center">
                      <h4 class="shadow rounded panel-title text-center bg-primary mb-3 p-auto col-9">User Info</h4>
                  </div>
                  <p><b>UserName</b></p>
                  <div class="input-group">
                      <select class="user form-control" name="user">
                          <option disabled selected>Select User</option>
                          @foreach($users as $user)
                          <option value="{{$user->name}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  {!! $errors->first('user_id', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}
                  <hr>
                  <p><b>VisaCard Number</b></p>
                  <div class="input-group">
                      <input type="password" class="form-control" name="visa" value="">
                  </div>
                  {!! $errors->first('user_id', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

              </div>

              <div class="d-none" id="actions-buttons">
              <div id="order-medicine" class="panel-heading p-3 mt-5 border border-dark rounded">
                  <div class="d-flex justify-content-center">
                      <h4 class="shadow rounded info-title panel-title text-center bg-primary mb-3 p-auto col-9">Medicines in Order</h4>
                  </div>

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
                  <input type="number" class="form-control text-center d-none" name="items" value="0" id="items" readonly >
                    <div class="d-flex justify-content-center mt-3">
                    <p id="rm-medicine" class="text-left d-inline"><u>Remove Last Medicines in Order</u> <span class="bg-danger p-1"> <b> -</b></span></p>
                    <p id="rs-medicine" class="text-right d-inline ml-5"><u>Reset Medicines in Order</u> <span class="bg-danger p-1"> <b> --</b></span></p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center mt-5">
                  <button type="submit" class="btn btn-success text-dark btn-lg shadow-lg">Put in Order</button>
              </div>
            </form>
          </div>
  </div>

    <div style="margin-top:50px;" class="mainbox p-3 col-md-4 col-md-offset-4 col-sm-9 col-sm-offset-2  border rounded m-1">
        <div class="panel-body p-auto">
            <h3 class="shadow-lg rounded panel-title text-center bg-dark p-auto mb-3">Add to Order</h3>

            <p><b>Medicine_Name</b></p>
            <div class="input-group">
                <select class="medicine form-control" name="medicine" id="medicine">
                    <option disabled selected>Select Medicine</option>
                    @foreach($medicines as $medicine)
                    <option value="{{$medicine->name}}">{{$medicine->name}}</option>
                    @endforeach
                </select>
            </div>
            {!! $errors->first('name', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}
            <hr>
            <p><b>Type</b></p>
            <div class="input-group">
                <select class="type form-control" name="type" id="type">
                    <option disabled selected>Select Type</option>
                    <option value="Liquid">Liquid</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Capsules">Capsules</option>
                    <option value="Cream">Cream</option>
                    <option value="Drop">Drop</option>
                    <option value="Injection">Injection</option>
                </select>
            </div>
            {!! $errors->first('type', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

            <hr>
            <p><b>Quantity</b></p>
            <div class="input-group">
                <input type="number" class="form-control" name="quantity" id="quantity">
            </div>
            <hr>
            <p><b>Price/Medicine</b></p>
            <div class="input-group">
                <input type="number" class="form-control" name="price" id="price">
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button id="add-medicine" class="btn btn-warning shadow-lg">Add medicine to order</button>
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
@include('layouts.orderjs')
@stop
