@extends('layouts.app')

@section('title', count($projects). ' projects | RF')

@section('content')
    <div class="mh-100vh pt-4">
        <div class="mt-5">
            {{-- homepage --}}
            {{ $projects->links()}}
        </div>
        <div class="row g-3 mb-3">
            @forelse ($projects as $project)
                <a  href="{{route('guest.projects.show', $project)}}" 
                    class="col-12 col-sm-6 col-lg-4 col-xl-3 text-decoration-none text-black">

                    <div class="card p-2 h-100 d-flex flex-column justify-content-between">
                        <div class="top">
                            <h4>{{ $project->title }}</h4>
                            <div class="text-capitalize {{($project->type->id == 1)?'text-success':(($project->type->id == 2)?'text-danger':'text-primary')}}">{{ $project->type->name }}</div>
                            <pre class="text-secondary">{{ $project->user->name . ' ' . $project->user->lastname }}</pre>
                            <p>{{ $project->content }}</p>
                        </div>
                        <div class="bottom">
                            <div>{{ $project->start_date->format('Y-m-d') }}</div>
                            <div class="text-success {{ $project->end_date ?? 'text-danger' }}">{{ isset($project->end_date) ? $project->end_date->format('Y-m-d'): 'work in progress' }}</div>
                        </div>
                    </div>
                
                </a>

                @empty

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 w-100 pt-5 text-secondary">
                    <h1 class="text-center pt-5">
                        Non ci sono progetti da visualizzare
                    </h1>
                </div>
            @endforelse
        </div>
        {{ $projects->links()}}
    </div>
@endsection
