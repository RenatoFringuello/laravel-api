<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    //prova ad implementare un validated come fa Profile
    /**
     * return the data validated
     *
     * @param Request $request
     * @return Array
     */
    protected function getValidatedData(Request $request){
        $validation = [
            'type_id' => "required|exists:types,id",
            'technologies' => "array|exists:technologies,id",
            'title' => "required|max:50",
            'image' => "image",
            'content' => 'required',
            'start_date' => 'required|date|after:1990-12-20 00:00:00',
            'end_date' => 'date|nullable|after:start_date',
        ];
        $validationMessages = [
            'type_id.required' => 'Il tipo di progetto è un campo obbligatorio',
            'type_id.in' => 'Seleziona un campo fra quelli disponibili',
            'title.required' => 'Il titolo è un campo obbligatorio',
            'title.max' => 'Hai inserito troppi caratteri in title',
            'image.image' => 'Qui puoi inserire solo immagini',
            'content.required' => 'Il contenuto del progetto è un campo obbligatorio',
            'start_date.required' => 'La data di inizio è un campo obbligatorio',
            'start_date.date' => 'La data di inizio che hai scritto non esiste in nessun calendario neanche in quello dei maya',
            'start_date.after' => 'Non puoi aver iniziato a creare un sito prima della sua invenzione',
            'end_date.date' => 'La data di fine che hai scritto non esiste. Lascia il campo vuoto se il lavoro non è finito',
            'end_date.after' => 'Il progetto non può finire ancor prima che inizi',
        ];
        return $request->validate($validation, $validationMessages);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = ['Title', 'Author', 'Type', 'Start Date', 'End Date'];

        //get the oppsite of dir (direction of orderBy) passed by request [int]
        $dir = !$request->dir;

        //get the field to order the query [string]
        $orderBy = (!in_array($request->sort, $fields)) ? 'id' //sarebbe meglio la 404
                    :(($request->sort == 'author') ? 'user_id'
                    : (( $request->sort == 'type') ? 'type_id'
                    : $request->sort));

        //if logged user is a super admin or a admin
        if(Auth::user()->roles()->pluck('id')->contains(1) || Auth::user()->roles()->pluck('id')->contains(2)){
            // get all ordered and paginated by 10
            $projects = Project::orderBy($orderBy ?? 'id', ($dir) ? 'DESC' : 'ASC')
                        ->paginate(10)->withQueryString();
        }
        else{
            /**
             * get all the projects of the user 
             * sorted by something or 'id' if none passed
             * paginated by 10
             */
            $projects = Project::where('user_id', '=', Auth::user()->id)
                        ->orderBy($orderBy ?? 'id', ($dir) ? 'DESC' : 'ASC')
                        ->paginate(10)->withQueryString();
        }

        //questo serve a recuperare i projetti in base al ruolo che ha l'utente 
        //ricorda che nel where devi verificare il role dell'user loggato
        
        // $projs = Project::select('projects.*')
        //             ->join('users', 'users.id', '=', 'projects.user_id')
        //             ->join('role_user', 'role_user.user_id', '=', 'users.id')
        //             ->join('roles', 'roles.id', '=', 'role_user.role_id')
        //             ->where('roles.id', '>', '1')
        //             ->groupBy('projects.title')
        //             ->get();

        //             dd($projs);

        return view('admin.projects.index',  compact('projects', 'fields', 'orderBy', 'dir'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getValidatedData($request);
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = (!isset($data['image'])) ? 'images/projects/placeholder.jpg' : Storage::put('/images/projects',$data['image']);
        $data['user_id'] = Auth::user()->id;

        $project = new Project();
        $project->fill($data);
        $project->save();
        $project->technologies()->sync($data['technologies'] ?? []);
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->getValidatedData($request);
        $data['slug'] = Str::slug($data['title']);

        //if no image is passed use the placeholder
        $data['image'] = (!isset($data['image'])) ? 'images/projects/placeholder.jpg' : Storage::put('/images/projects', $data['image']);
        
        //se l'immagine da cambiare è diversa dal placeholder eliminala dallo storage
        if($project->image != 'images/projects/placeholder.jpg')
            Storage::delete('/images/projects', $project->image);

        $project->update($data);
        $project->technologies()->sync($data['technologies'] ?? []);
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project  $project, Request $request)
    {
        //delete the image of the project to destroy only if isn't the placeholder
        if($project->image != 'images/projects/placeholder.jpg')
            Storage::delete('/images/projects',$project->image);

        Project::destroy($project->id);

        $orderBy = $request->sort;
        return redirect()->route('admin.projects.index', ['sort' => $orderBy ?? 'id']);
    }
}
