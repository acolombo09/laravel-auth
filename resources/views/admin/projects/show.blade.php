@extends('layouts.app')
@section('content')

{{-- In questa pagina verranno visualizzati i dettagli del project selezionato --}}
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card mt-5">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h2 class="fs-4 text-lg my-4">
              {{ $project->title }}
            </h2>
            <a class="nav-link d-flex align-items-center text-primary" href="{{ Route("admin.projects.edit", $project->slug)}}">Modify</a>
          </div>
          <div class="d-flex pt-2">
            <div class="row">
              <div class="col-12 col-md-4 text-center">
                <img class="w-100 object-fit-cover" src="{{ asset('/storage/' . $project->image) }}" alt="{{ $project->title }}">
              </div>
              <div class="col-12 col-md-8 mt-5 mt-md-0 d-flex flex-column">
                <p class="text-break">{{$project->description}}</p>
                <small>Publishing Date: {{ $project->published_at?->format("d/m/Y") }}</small>
                <div class="mt-auto">
                  <div class="d-flex">
                    <div class="col-3 me-2">GitHub:</div>
                    <div>{{$project->link}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Comments section --}}
    <div class="container my-5">
      <h2 class="mb-4">Leave a Comment here</h2>
      <form>
          <div class="mb-3">
              <label for="commentTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="commentTitle">
          </div>
          <div class="mb-3">
              <label for="commentText" class="form-label">Comment</label>
              <textarea class="form-control" id="commentText" rows="4"></textarea>
          </div>
          <div class="mb-3">
              <label for="commentName" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="commentName">
          </div>
          <div class="mb-3">
              <label for="commentEmail" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="commentEmail">
          </div>
          <div class="mb-3">
              <label for="commentWebsite" class="form-label">Your Website</label>
              <input type="url" class="form-control" id="commentWebsite">
          </div>
          <button type="submit" class="btn btn-primary">Post Comment</button>
      </form>
  </div>
  
    
  </div>
</div>

@endsection