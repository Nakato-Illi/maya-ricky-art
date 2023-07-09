@extends('layouts.app')

@section('content')
    <h1>Edit Posts</h1>
    {!! Form::open(['action' => ['\App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group" style="padding-bottom: 20px">
        {{Form::label('title', 'Title:')}}
        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group" style="padding-bottom: 20px">
        {{Form::label('price', 'Price:')}}
        {{Form::text('price', $post->price, ['class' => 'form-control', 'placeholder' => 'Price'])}}
    </div>
    <div class="form-group" style="padding-bottom: 20px">
        {{Form::label('body', 'Body:')}}
        {{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body'])}}
    </div>
    <div class="card-group">
        {{Form::file('gal_img')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection

