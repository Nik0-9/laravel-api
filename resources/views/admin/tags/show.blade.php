@extends('layouts.admin')
@section('title', $type->title)

@section('content')
<section>
    @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
  @endif
    <h1>{{$type->name}}</h1>

    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">title</th>
        <th scope="col">Slug</th>
        <th scope="col">Created At</th>
        <th scope="col">Update At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($type->projects as $project)
      <tr>
      <td>{{$project->id}}</td>
      <td>{{$project->title}}</td>
      <td>{{$project->slug}}</td>
      <td>{{$project->created_at}}</td>
      <td>{{$project->updated_at}}</td>
      <td>
        <div class="d-flex align-items-center gap-2">
        <a href="{{route('admin.projects.show', $project->slug)}}">
          <i class="fa-solid fa-eye"></i>
        </a>
        <a href="{{route('admin.projects.edit', $project->slug)}}">
          <i class="fa-solid fa-pen"></i>
        </a>
        <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-button btn fs-6 p-0" data-item-title="{{$type->name}}">
          <i class="fa-solid fa-trash" style="color: #0A58CA;"></i>
          </button>

        </form>
        </div>

      </td>
      </tr>
    @endforeach


    </tbody>
  </table>
  </section>

@endsection