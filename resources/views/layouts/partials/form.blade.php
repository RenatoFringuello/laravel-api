<form   class="{{($method != 'DELETE')? 'w-50 mt-5 mx-auto':$extraClasses}}" 
        action="{{route($route, [$project, 'sort' => $orderBy])}}" 
        method="POST"
        enctype="multipart/form-data"> 
    @csrf
    @method($method)

    @if ($method != 'DELETE')
        {{-- project title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title *</label>
            <input  type="text" class="@error('title') border-danger @enderror form-control" 
                    placeholder="@error('title'){{$message}}@enderror" id="title" name="title"
                    value="{{old('title') ?? $project->title}}">
        </div>
        {{-- project type --}}
        <div class="mb-3">
            <label for="project-type" class="form-label">Project Type *</label>
            <select class="form-select @error('type_id') border-danger @enderror" id="project-type" name="type_id">
                <option selected>
                    @error('type_id')
                        {{$message}}
                        @else
                        Choose a project type
                    @enderror
                </option>
                @foreach ($types as $type)                    
                    <option value="{{$type->id}}" {{(old('type_id', $project->type_id) == $type->id)?'selected':''}}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        {{-- project technologies --}}
        <div class="mb-3">
            <div class="form-label">Technologies</div>
            <div class="d-flex flex-wrap justify-content-between">
                @foreach ($technologies as $tech)
                <div>
                    <label for="{{$tech->slug}}" class="form-label text-capitalize user-select-none">{{$tech->name}}</label>
                    <input  type="checkbox" class="form-check-input" 
                            name="technologies[]" value="{{$tech->id}}" id="{{$tech->slug}}"
                            @if ($errors->any()) @checked(in_array($tech->id, old('technologies',[])))
                            @else @checked($project->technologies->contains($tech->id))
                            @endif>
                </div>
                @endforeach
            </div>
        </div>
        {{-- project cover --}}
        <div class="mb-3">
            <label for="image" class="form-label">Project Cover *</label>
            <input type="file" class="@error('image') border-danger @enderror form-control" 
                        placeholder="@error('image'){{$message}}@enderror" id="image" name="image">
        </div>
        {{-- project content --}}
        <div class="mb-3">
            <label for="content" class="form-label">Content *</label>
            <textarea class="@error('content') border-danger @enderror form-control" 
                    placeholder="@error('content'){{$message}}@enderror" id="content" name="content"
                    >{{old('content', $project->content)}}</textarea>
        </div>
        {{-- project start-date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date *</label>
            <input  type="text" class="@error('start_date') border-danger @enderror form-control" 
                        placeholder="@error('start_date'){{$message}}@enderror" id="start_date" name="start_date"
                        value="{{old('start_date', $project->start_date)}}">
        </div>
        {{-- project end-date --}}
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input  type="text" class="@error('end_date') border-danger @enderror form-control" 
                        placeholder="@error('end_date'){{$message}}@enderror" id="end_date" name="end_date"
                        value="{{old('end_date', $project->end_date)}}">
        </div>
    @endif

    <button class="btn {{($method != 'DELETE')? 'btn-primary':'btn-danger'}}" type="submit">
        {{($method != 'DELETE') ? 'Send ' : ''}}
        <i class="fa-solid {{($method != 'DELETE') ? 'fa-paper-plane' : 'fa-trash'}}"></i>
    </button>
</form>