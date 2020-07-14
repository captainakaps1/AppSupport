@extends('layouts.app')
@section('content')
    <h1>{{$posts->title}}</h1>
    <div>
        {!!$posts->body!!}
    </div>
    <hr>
<small>Written on {{$posts-> created_at}} by {{$posts->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $posts->user_id)
            <a href="/post/{{$posts->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action'=>['PostsController@destroy',$posts->id],'method'=>'POST','class'=>'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection