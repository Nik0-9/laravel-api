@extends('layouts.admin')

@section('title', 'Edit project')

@section('content')
<section>
    <h2>Edit projects</h2>
    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{$project->title}}" minlength="3" maxlength="200" required>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div>
        </div>

        <div class="mb-3">
            <!-- nuova riga -->
            <div class="media me-4">
                <img src="{{asset('storage/'.$project->image)}}" id="upload_preview" class="w-50 mb-3">
            </div>
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{$project->image}}" maxlength="255">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div id="imageHelp" class="form-text text-white">Inserire url dell'immagine</div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required> {{$project->content}} </textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

        </div>
    </form>
</section>
@endsection