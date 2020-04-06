@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')

@stop

@section('content')

<div class="container">

    <h1>Orders</h1>
    <hr>

    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
      </div>
    @elseif($message = Session::get('warning'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
    @endif

    <a class="btn btn-success" href="{{route('orders.create')}}" id="createNeworder">New Order</a>
    <table id="orders-table" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Delivering Address</th>
                <th>Creation Date</th>
                <th>Doctor Name</th>
                <th>is Insured</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Pharmacy</th>
                <th width="280px">Action</th>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">

                <form id="orderForm" name="orderForm" class="form-horizontal">
                   <input type="hidden" name="order_id" id="order_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">UserName</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Medicine</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="medicine" name="medicine" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@stop

@section('js')
  @include('layouts.orderjs')
@stop
