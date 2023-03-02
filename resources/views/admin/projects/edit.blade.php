@extends('layouts.app')

@section('title', "Edit project n°$project->id | RF")

@section('content')
    <div class="mh-100vh pt-5">
        {{-- fai il form --}}
        @include('layouts.partials.form', ['method' => 'PUT', 'route' => 'admin.projects.update', 'orderBy' => null, 'project' => $project])
    </div>
@endsection