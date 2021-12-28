@extends('layout')
@section('content')

<div class="container">
     <div>
          <a href="/posts/create" class="btn btn-success btn-sm">New Post</a>
      </div>
      <br>
    <div class="card">
  <div class="card-header" style="text-align: center">
    Contents
  </div>
  <div class="card-body">

      @foreach($data as $post)
        <div>
            {{-- <i>Category:<samll>{{ $post->categories->name }}</samll></i> --}}
                <h5 class="card-title">{{ $post->name }}</h5>
                <p class="card-text">{{ $post->description }}</p>

                <div class="form-row">
                    <a style="height:38px;margin-right:5px" href="/posts/{{ $post->id}}" class="btn btn-primary">View</a>
                    <a style="height:38px;margin-right:5px" href="/posts/{{ $post->id}}/edit" class="btn btn-warning">Edit</a>
                    <form action="/posts/{{ $post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <hr>
        </div>
      @endforeach

  </div>
</div>
</div>
@endsection
