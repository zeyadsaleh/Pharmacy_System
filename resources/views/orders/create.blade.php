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
                  {!! $errors->first('visa', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

              </div>

              <div class="d-none" id="actions-buttons">
              <div id="order-medicine" class="panel-heading p-3 mt-5 border border-dark rounded">
                  <div class="d-flex justify-content-center">
                      <h3 class="shadow rounded info-title panel-title text-center bg-primary mb-3 p-auto col-7">Medicines in Order</h3>
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
                    <input id="rm-medicine" class="col-2 shadow btn border border-danger text-center p-auto d-inline" value="Undo">
                    <input id="rs-medicine" class="col-2 shadow btn border border-danger text-center p-auto d-inline ml-5" value="Reset">
                  </div>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center mt-5">
                  <button type="submit" class="btn btn-primary btn-lg shadow-lg disabled border border-dark" id="addin"><b>Put in Order</b></button>
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
                    <input type="number" value="1" disabled hidden id="pharm"/>
                  @endhasrole
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
        <div class="d-flex justify-content-center m-5">
            <button id="add-medicine" class="btn btn-warning shadow-lg">Add medicine to order</button>
        </div>
    </div>
    {!! $errors->first('price', '<ul class="text-danger p-1"> * <span>:message</span></ul>') !!}

    <div class="d-flex justify-content-center mt-5">
        <button id="add-medicine" class="btn btn-warning shadow-lg">Add medicine to order</button>
    </div>
</div>
</div>



@stop

@section('js')
<script src="/js/order.js"></script>
@include('layouts.orderjs')
@stop
