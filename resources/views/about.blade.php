@extends('layout')
@section('content')
<h3>This is the about page</h3>
@foreach ($data as $key => $value)
    {{ $key .'='.$value }}<br>
@endforeach
@endsection()
