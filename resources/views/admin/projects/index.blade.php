@extends('layouts.app')

@section('title', "Manage projects | RF")

@section('content')
    <div class="mh-100vh pt-5">
        {{-- table --}}
        <table class="table table-striped mt-5">
            <thead class="bg-primary text-white">
                <tr class="align-middle">
                    {{-- show all the links --}}
                    @foreach ($fields as $field)
                        <th class="text-center"><a class="text-white" href="{{route('admin.projects.index', ['sort' => Str::slug($field,'_'), 'dir' => $dir ?? 0])}}">{{$field}}</a></th>
                    @endforeach
                    <th class="text-center">
                        <a class="text-decoration-none btn btn-primary border-white" href="{{route('admin.projects.create')}}">
                            <i class="fa-solid fa-square-plus"></i> Add Project 
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- show every project in project table --}}
                @foreach ($projects as $project)
                    <tr class="align-middle">
                        <td class="text-center">{{ $project->title }}</td>
                        <td class="text-center {{($project->type->id == 1)?'text-success':(($project->type->id == 2)?'text-danger':'text-primary')}}">{{ $project->type->name }}</td>
                        <td class="text-center">{{ $project->start_date->format('Y-m-d') }}</td>
                        <td class="text-center text-success {{ $project->end_date ?? 'text-danger' }}">{{ isset($project->end_date) ? $project->end_date->format('Y-m-d'): 'work in progress' }}</td>
                        <td class="text-center">
                            <div class="btn-container">
                                <a href="{{route('admin.projects.show', $project)}}" class="text-decoration-none btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{route('admin.projects.edit', $project)}}" class="text-decoration-none btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                @include('layouts.partials.form', ['method' => 'DELETE', 'route' => 'admin.projects.destroy', 'orderBy' => $orderBy ?? 'id','project' => $project, 'extraClasses' => 'btn p-0'])
                            </div>
                        </td>
                    </tr>
                @endforeach  
            </tbody>
        </table>

        {{-- pagination --}}
        {{ $projects->links() }}
    </div>
@endsection

@section('scripts')
    <script type='module' src="{{Vite::asset('./resources/js/popUp.js')}}"></script>
@endsection
