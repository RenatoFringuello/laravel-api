@extends('layouts.app')

@section('title', "Create a new project | RF")

@section('content')
    <div class="mh-100vh pt-5">
        {{-- fai il form --}}
        @include('layouts.partials.form', ['method' => 'post', 'route' => 'admin.projects.store', 'orderBy' => '', 'project'])
    </div>
@endsection