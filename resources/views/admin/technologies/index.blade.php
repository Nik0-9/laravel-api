@extends('layouts.admin')
@section('title', 'Technologies')

@section('content')
<section class="container">
  @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
  @endif
  <div class="d-flex justify-content-between align-items-center py-4">
    <h1>Technologies</h1>
    <a href="{{route('admin.technologies.create')}}" class="btn btn-primary">
      Crea nuova technology
    </a>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Created At</th>
        <th scope="col">Update At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($technologies as $technology)
      <tr>
      <td>{{$technology->id}}</td>
      <td>{{$technology->name}}</td>
      <td>{{$technology->slug}}</td>
      <td>{{$technology->created_at}}</td>
      <td>{{$technology->updated_at}}</td>
      <td>
        <div class="d-flex align-items-center gap-2">
        <a href="{{route('admin.technologies.show', $technology->slug)}}">
          <i class="fa-solid fa-eye"></i>
        </a>
        <a href="{{route('admin.technologies.edit', $technology->slug)}}">
          <i class="fa-solid fa-pen"></i>
        </a>
        <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-button btn fs-6 p-0" data-item-title="{{$technology->title}}">
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
@include('admin.partials.modal-delete')
@endsection