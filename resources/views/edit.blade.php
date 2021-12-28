@extends('layout')
@section('content')

<div class="container">
    <div class="card">
  <div class="card-header" style="text-align: center">
    Create New Post
  </div>
  <div class="card-body">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="/posts/{{ $post->id }}" method="post">
        @csrf
        @method('PUT')
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{  old('name',$post->name)}}"name="name" id="name" placeholder=""class="form-control" id="name" placeholder="Enter name">
        </div>
   <div class="form-group">
        <label for="desc">Description</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Description">
              {{ old('description',$post->description) }}
          </textarea>
    </div>
    <div class="form-group">
        <select name="category_id" id="" class="form-control">
            <option value="">Select Category</option>
            @foreach ($category as $cat)
                <option value="{{$cat->id}}" {{ $cat->id==$post->category_id ? ' selected="selected"' : '' }}>{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Update</button>
    <a href="/posts/" class="btn btn-success"> Back</a>
</form>
  </div>
</div>
</div>
@endsection
