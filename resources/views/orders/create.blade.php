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

                       <form id="order" method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                         @csrf
                           <p><b>Medicine_Name</b></p>
                           <div style="margin-bottom: 25px" class="input-group">
                                       <select class="medicine-search form-control" name="states[]" multiple="multiple">
                                         @foreach($medicines as $medicine)
                                           <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                                          @endforeach
                                       </select>

                           </div>

                          <hr>
                           <p><b>Quantity</b></p>
                           <div style="margin-bottom: 25px" class="input-group">
                                       <input type="number" class="form-control" name="quantity" value="">
                           </div>

                            <hr>

                             <p><b>Type</b></p>
                            <div style="margin-bottom: 25px" class="input-group">
                                 <select name="type" class="form-control">
                                     <option value="A">A</option>
                                     <option value="B">B</option>
                                     <option value="C">C</option>
                                     <option value="D">D</option>
                                     <option value="E">E</option>
                                     <option value="F">F</option>
                                </select>
                            </div>

                            <hr>

                            <p><b>VisaCard Number</b></p>
                            <div style="margin-bottom: 25px" class="input-group">
                              <input type="password" class="form-control" name="visa" value="">
                            </div>

                            <p><b>UserName</b></p>
                           <div style="margin-bottom: 25px" class="input-group">
                                <select name="user" class="form-control">
                                  @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                               </select>
                           </div>
                         <div style="margin-top:10px" class="form-group">
                             <!-- Button -->
                             <div class="col-sm-12 controls">
                               <button type="submit" class="btn btn-success">Order</button>
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
