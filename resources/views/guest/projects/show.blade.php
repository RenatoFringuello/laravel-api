@extends('layouts.app')

@section('title', "Project $project->title | RF")

@section('content')
    <div class="mh-100vh d-flex">
        <div class="col-12 col-sm-8 col-md-11 col-lg-9 m-auto text-decoration-none text-black">
            <div class="card flex-md-row p-2 ">
                <div class="left w-100 w-md-50 mb-3 mb-md-0">
                    <img src="{{ asset('storage/'.$project->image) }}" class="img-fluid h-100 object-fit-cover object-position-center rounded-1" alt="{{ $project->image }}">
                </div>
                <div class="right w-100 w-md-50 px-md-3 d-flex flex-column justify-content-between">
                    <div class="top">
                        <h2>{{ $project->title }}</h2>
                        <div class="text-capitalize fs-5 {{($project->type->id == 1)?'text-success':(($project->type->id == 2)?'text-danger':'text-primary')}}">{{ $project->type->name }}</div>
                        <pre class="text-secondary fs-5 mb-3">{{ $project->user->name . ' ' . $project->user->lastname }}</pre>
                        <p class="mb-3">{{$project->content}}</p>
                    </div>
                    <div class="bottom">
                        <div>{{ $project->start_date->format('Y-m-d') }}</div>
                        <div class="mb-3 text-success {{ $project->end_date ?? 'text-danger' }}">{{ isset($project->end_date) ? $project->end_date->format('Y-m-d'): 'work in progress' }}</div>
                        <div>
                            @foreach ($project->technologies as $tech)
                                <span class="badge rounded-pill px-2" style="background-color:{{$tech->bg_color}}">{{$tech->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection