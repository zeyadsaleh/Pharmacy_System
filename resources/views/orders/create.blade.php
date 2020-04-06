@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')

@stop

@section('content')
<div class="container d-flex justify-content-center">

       <div style="margin-top:50px;" class="mainbox p-3 col-md-7 col-md-offset-3 col-sm-9 col-sm-offset-2  border border-dark rounded m-1">

         <form id="order" method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
              @csrf
                   <div class="panel-body p-1" >
                     <h1 class="panel-title text-center bg-dark p-2 mb-5">Order Info</h1>
                           <div class="panel-heading border border-dark rounded p-3 m-4">

                             <div class="d-flex justify-content-center">
                               <h4 class="panel-title text-center bg-primary p-2 col-6">Medicine Info</h4>
                             </div>
                                                          <p><b>Medicine_Name</b></p>
                                                          <div class="input-group">
                                                                      <select class="medicine form-control" name="medicine">
                                                                        <option disabled selected>Select Medicine</option>
                                                                        @foreach($medicines as $medicine)
                                                                          <option value="{{$medicine->name}}">{{$medicine->name}}</option>
                                                                         @endforeach
                                                                      </select>
                                                          </div>
                                                          <hr>
                                                          <p><b>Quantity</b></p>
                                                          <div class="input-group">
                                                                      <input type="number" class="form-control" name="quantity">
                                                          </div>
                                                          <hr>
                                                           <p><b>Price/Medicine</b></p>
                                                           <div class="input-group">
                                                                       <input type="number" class="form-control" name="price">
                                                           </div>
                                                           <hr>
                                                           <p><b>Type</b></p>
                                                           <div class="input-group">
                                                             <select class="type form-control" name="type">
                                                                    <option disabled selected>Select Type</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    <option value="E">E</option>
                                                                    <option value="F">F</option>
                                                               </select>
                                                           </div>
                                                           <br>
                            </div>

                           <div class="panel-heading mt-5">
                             <div class="d-flex justify-content-center">
                               <h4 class="panel-title text-center bg-primary p-2 col-6">User Info</h4>
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
                                <hr>
                                <p><b>VisaCard Number</b></p>
                                <div class="input-group">
                                  <input type="password" class="form-control" name="visa" value="">
                                </div>
                          </div>
                            <div class="form-group row">
                              <div class="col-sm-12 controls  mt-2 text-center">
                                <button type="submit" class="btn btn-success h1 mt-2">Order It!</button>
                              </div>
                            </div>
                   </div>
       </div>


   </div>

<br>

@stop

@section('js')
@include('layouts.orderjs')
@stop
