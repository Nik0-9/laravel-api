@extends('layouts.admin')
@section('title', $project->title)

@section('content')
<section>
    @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
  @endif
    <h1>{{$project->title}}</h1>

    <p>{{$project->content}}</p>
    @if($project->image)
    <img src="{{asset('storage/'.$project->image)}}" alt="{{$project->title}}">
    @endif
    <img src="/img/user.webp" alt="{{$project->title}}" class="w-25">
    @if ($project->type)
    <p>tipo:{{$project->type->name}}</p>
    @endif
    @if ($project->tags)
    Tag:
    @foreach ($project->tags as $tag)
    <p>{{$tag->name}}</p>
    
    @endforeach
    @endif
</section>
@endsection