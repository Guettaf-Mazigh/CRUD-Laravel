@extends('layouts.layout')
@section('title','Index')
@section('content')
<div class="container">
  @if (session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
  @elseif(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  
  @endif
</div>
  <div class="text-center">
      <a href="{{route('posts.create')}}" class="btn btn-success mb-5">Create Post</a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Post</th>
        <th scope="col">Posted By</th>
        <th scope="col">Posted At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->created_at}}</td>
        <td>
          <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">View</a>
          <a href="{{route('posts.edit',$post->id)}}" class="btn btn-success">Edit</a>
          <form action="{{route('posts.destroy',$post->id)}}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
