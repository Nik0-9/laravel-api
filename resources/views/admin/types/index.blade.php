@extends('layouts.admin')
@section('title', 'Types')

@section('content')
<section class="container">
  @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
  @endif
  <div class="d-flex justify-content-between align-items-center py-4">
    <h1>Types</h1>
    <a href="{{route('admin.types.create')}}" class="btn btn-primary">
      Crea nuovo type
    </a>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Created At</th>
        <th scope="col">Update At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($types as $type)
      <tr>
      <td>{{$type->id}}</td>
      <td>{{$type->title}}</td>
      <td>{{$type->slug}}</td>
      <td>{{$type->created_at}}</td>
      <td>{{$type->updated_at}}</td>
      <td>
        <div class="d-flex align-items-center gap-2">
        <a href="{{route('admin.types.show', $type->slug)}}">
          <i class="fa-solid fa-eye"></i>
        </a>
        <a href="{{route('admin.types.edit', $type->slug)}}">
          <i class="fa-solid fa-pen"></i>
        </a>
        <form action="{{route('admin.types.destroy', $type->slug)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-button btn fs-6 p-0" data-item-title="{{$type->title}}">
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