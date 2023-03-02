@extends('layouts.app')

@section('title', "Manage project n°$project->id | RF")

@section('content')
    <div class="mh-100vh d-flex">
        <div class="col-12 col-sm-8 col-md-11 col-xl-9 m-auto text-decoration-none text-black">
            <div class="card flex-md-row p-2">
                <div class="left w-md-50 mb-3 mb-md-0">
                    <img src="{{ asset('storage/'.$project->image) }}" class="img-fluid h-100 object-fit-cover object-position-center rounded-1" alt="{{ $project->image }}">
                </div>
                <div class="right w-100 w-md-50 ps-md-4 d-flex flex-column justify-content-between">
                    <div class="top">
                        <h2>{{ $project->title }}</h2>
                        <div class="fs-5 {{($project->type->id == 1)?'text-success':(($project->type->id == 2)?'text-danger':'text-primary')}}">{{ $project->type->name }}</div>
                        <pre class="text-secondary fs-5 mb-3">{{ $project->user->name . ' ' . $project->user->lastname }}</pre>
                        <p class="mb-3">{{$project->content}}</p>
                    </div>
                    <div class="bottom row m-0 align-items-end justify-content-between">
                        <div class="dates-container p-0 mb-2 mb-lg-0 col-lg-8 col-xl-8">
                            <div>{{ $project->start_date->format('Y-m-d') }}</div>
                            <div class="text-success {{ $project->end_date ?? 'text-danger' }}">{{ isset($project->end_date) ? $project->end_date->format('Y-m-d'): 'work in progress' }}</div>
                            <div>
                                @foreach ($project->technologies as $tech)
                                    <span class="badge rounded-pill px-2" style="background-color:{{$tech->bg_color}}">{{$tech->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-container col p-0 d-flex justify-content-lg-end">
                            <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary me-2 ">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @include('layouts.partials.form', ['method' => 'DELETE', 'route' => 'admin.projects.destroy', 'orderBy'=> null, 'project' => $project, 'extraClasses' => 'btn p-0'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script type='module' src="{{Vite::asset('./resources/js/popUp.js')}}"></script>
@endsection