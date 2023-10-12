@extends('layouts.app')
@section('content')

<div class="container py-5">
  <div class="text-end my-3">
    <a href=" {{ route('admin.projects.create') }}" class="btn btn-primary">Create Project</a>
  </div>

  <div class="row gy-5">

    @foreach ($projects as $project)
    <div class="col d-flex justify-content-center">

      <div class="card">
        <div class="card h-100" style="width: 300px;">
          <img src="{{ asset('/storage/' . $project->image) }}" class="card-img-top object-fit-cover h-100" alt="{{$project->title}}">
          <div class="card-body">
            <h5 class="card-title text-center"><a class="text-decoration-none" href="{{route("admin.projects.show", $project->slug)}}">{{$project->title}}</a></h5>
            <p class="card-text">{{ $project->description }}</p>
            <p class="card-text">{{ $project->published_at?->format("d/m/Y") }}</p>
          </div>
        </div>
      </div>

    </div>
    @endforeach
    
  </div>

</div>

@endsection