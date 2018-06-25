@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) !!}
        <div class = "form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$post->title, ['class' => 'form-control', 'placeholder' => 'title'])}}
        </div>

        <div class = "form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body',$post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'body'])}}
        </div>

        <div class = "form-group">
                {{Form::file('cover_image')}}
        </div>
        
        {{Form::hidden('method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}  
    <a class="btn btn-primary btn-lg" href="{{action('PostsController@index')}}" role="button">Go Back</a>  
@endsection