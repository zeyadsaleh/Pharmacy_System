@extends('adminlte::page')

@section('title', 'Order')

@section('css')
  @include('layouts.ordercss')
@stop

@section('content_header')

@stop

@section('content')

<div class="container">
    <h1>Orders</h1>
    <hr>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> New Order</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Delivering Address</th>
                <th>Creation Date</th>
                <th>Creeated By</th>
                <th>DoctorName</th>
                <th>Status</th>
                <th>Total Price</th>
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

                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">UserName</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Medicine</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
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
