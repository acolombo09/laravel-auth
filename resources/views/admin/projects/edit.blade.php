@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="d-flex justify-content-center">
                    <h2 class="fs-4 text-lg my-4">
                        Edit {{ $project->title }}
                    </h2>
                </div>

                <form action="{{ route('admin.projects.update', $project->title) }}" method="POST">
                    @csrf()
                    @method("put")
                    {{-- title --}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <div>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title', $project->title)}}"
                                name="title">
                            @error('title')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div>
                            <textarea class="form-control @error('description') is-invalid @enderror" style="height: 150px;"
                                name="description">{{old('description', $project->description)}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- image --}}
                    <div class="mb-3">
                        <label class="form-label">Image (url)</label>
                        <div>
                            <input type="text" class="form-control @error('image') is-invalid @enderror" value="{{old('image', $project->image)}}"
                                name="image">
                            @error('image')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- link --}}
                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <div>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" value="{{old('link', $project->link)}}"
                                name="link">
                            @error('link')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="w-100 text-center my-5">
                        <a class="btn btn-secondary" href="{{ route("admin.projects.index") }}">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                    <div class="d-flex justify-content-center w-100 my-3">
                        <form action="{{ route("admin.projects.destroy", $project->title) }}" method="POST">
                            @csrf
                            @method("DELETE")
                
                            <button type="submit" class="btn btn-danger">Delete Project</button>
                
                        </form>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection