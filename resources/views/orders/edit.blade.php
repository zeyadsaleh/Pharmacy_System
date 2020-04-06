@extends('layouts.app')

@section('title')
<title>Edit Post</title>
@endsection

@section('head')
@include('layouts.header')
@endsection

@section('body')

<div class="container m-5 bg-dark text-white p-5">
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group m-3">
      <h3 >Title</h3>
      <input name="title" type="text" class="form-control" aria-describedby="emailHelp" value="{{$post->title}}">
    </div>
    <div class="form-group m-3">
      <h3 for="exampleInputPassword1">Description</h3>
      <textarea name="description" class="form-control">{{$post->description}}</textarea>
    </div>

    <div class="form-group m-3">
      <h3 for="exampleInputPassword1">Category: <span class="h6"> {{$post->category}}</span></h3>
      <br>
          <input type="radio" name="category" value="art"> Art
          <input type="radio" name="category" value="social"> Social
          <input type="radio" name="category" value="sport"> Sport
    </div>

    <div class="form-group m-3">
      <h3 for="exampleInputPassword1">Users</h3>
      <select name="user_id" class="form-control">
          <option value="{{$post->user_id}}">{{$post->user->name}}</option>
        @foreach($users as $user)
        @if($post->user_id != $user->id)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endif
        @endforeach
        </select>
    </div>

    <div class="form-group m-3">
      <h3 for="exampleInputPassword1">Image</h3>
      @if ($post->image)
      <div class="d-flex justify-content-center m-3">
      <img src ="{{url('uploads/'.$post->image->filename)}}" width="300"/></div>
      @endif
      <input type="file" class="form-control" name="image"/>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection

@section('foot')
@include('layouts.footer')
@endsection
