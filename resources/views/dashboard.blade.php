@extends('layouts.app')

@section('title', "Welcome back, ". Auth::user()->username." | RF")

@section('content')
<div class="mh-100vh pt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>
                        {{ __("Welcome back ". Auth::user()->name .' '. Auth::user()->lastname ) }}
                    </p>
                    <div>
                        <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Let's get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
