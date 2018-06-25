@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class = "form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','', ['class' => 'form-control', 'placeholder' => 'title'])}}
        </div>

        <div class = "form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body','', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'body'])}}
        </div>

        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>
        
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}  
    <a class="btn btn-primary btn-lg" href="{{action('PostsController@index')}}" role="button">Go Back</a>  
@endsection