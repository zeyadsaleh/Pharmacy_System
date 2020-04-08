{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Add Medicine')

@include('layouts.sidebar')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{route('medicines.update', ['medicine' => $medicine->id])}}"
        enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                    value="{{$medicine->name}}">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" id="type">
                    <option id="Injections" value="Injections">Injections</option>
                    <option id="Drops" value="Drops">Drops</option>
                    <option id="Capsules" value="Capsules">Capsules</option>
                    <option id="Tablet" value="Tablet">Tablet</option>
                    <option id="Liquid" value="Liquid">Liquid</option>
                    <option id="Cream" value="Cream">Cream</option>
                    <option id="Inhalers" value="Inhalers">Inhalers</option>
                    <option id="Suppositories" value="Suppositories">Suppositories</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  document.getElementById("{{$medicine->type}}").selected = "true";
</script>
@stop
