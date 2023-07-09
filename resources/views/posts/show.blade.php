@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-dark">Back to List</a>
    <h1>{{$post->title}}</h1>
    <p>{{$post->body}}</p>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <img style="width: 100%" src="/storage/gal_img/{{$post->gal_img}}" alt="">
        </div>
    </div>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-warning">Edit</a>
            {!!Form::open(['action' => ['\App\Http\Controllers\PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-dark'])}}
            {!!Form::close()!!}
        @endif
    @endif

@endsection
