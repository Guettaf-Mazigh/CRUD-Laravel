@extends('layouts.layout')
@section('title','Edit')
@section('content')
<form action="{{route("posts.update",$postId)}}" method="POST">
  @method('PUT')
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
  @endif
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{$post->description}}</textarea>
  </div>
  <label class="form-label">Creator</label>
  <select class="form-select" aria-label="Default select example" name="creatorPost">
    @foreach($users as $user)
      <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-success mt-3">Update</button>
</form>
@endsection
    