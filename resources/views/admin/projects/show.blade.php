@extends('layouts.admin')
@section('title', $project->title)

@section('content')
<section>
  @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
  @endif
  <div class="d-flex justify-content-between align-items-center py-4">
    <h1>{{$project->title}}</h1>
    <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-primary">Edit project</a>
  </div>
  <p>{!!$project->content!!}</p>
  @if($project->image)
    <img src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}" class="w-50" >
  @else
  <img src="/img/place-holder.jpg" alt="{{$project->title}}" class="w-25">
  @endif
  @if ($project->type)
    <p>tipo:{{$project->type->slug}}</p>
  @endif
  <div>
    @if($project->technologies)
    @foreach ($project->technologies as $technology)
    <span class="badge text-bg-danger">{{$technology->name}}</span>
  @endforeach
  @endif
  </div>
</section>
@endsection