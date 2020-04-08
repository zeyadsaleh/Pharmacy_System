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
    <form method="POST" action="{{route('medicines.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" id="type">
                    <option value=""></option>
                    <option value="Injections">Injections</option>
                    <option value="Drops">Drops</option>
                    <option value="Capsules">Capsules</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Liquid">Liquid</option>
                    <option value="Cream">Cream</option>
                    <option value="Inhalers">Inhalers</option>
                    <option value="Suppositories">Suppositories</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    @stop

    @section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    @stop
