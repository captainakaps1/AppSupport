@extends('layouts.app')
@section('content')
<h2>Activity</h2>
    @if (count($post)>0)
        @foreach ($post as $posts)
            <div class="list-group-item">
            <h4><a href="/post/{{$posts->id}}">{{$posts->title}}</a></h4>
            <small>Written on {{$posts-> created_at}}  by {{$posts->user->name}}</small>
            </div>
        @endforeach
        {{$post->links()}}
    @else
        <p> No Post Please</p>    
    @endif
    
@endsection