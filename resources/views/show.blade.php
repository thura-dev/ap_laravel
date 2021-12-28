@extends('layout')
@section('content')

<div class="container">

      <br>
    <div class="card">
  <div class="card-header" style="text-align: center">
    Contents
  </div>
  <div class="card-body">


        <div>
                <h5 class="card-title">{{ $post->name }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text" style="font-style:italic">{{ 'Category :'.$post->categories->name }}</p>
                <a href="/posts" class="btn btn-success">Back</a>

                <hr>
        </div>

  </div>
</div>
</div>
@endsection
