<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// Importo il model
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class LoggedController extends Controller
{

    // SEARCH NAME
    public function searchName(Request $request)
    {
        $search = $request->input('searchName');

        $projects = Project::where('project_name', 'LIKE', "%$search%")->get();

        // dd($projects);

        return view('searchName', compact('projects'));
    }

    // SEARCH ID
    public function searchId(Request $request)
    {
        $search = $request->input('searchId');

        $projects = Project::where('user_id', $search)->get();

        // dd($projects);

        return view('searchId', compact('projects'));
    }


    // SHOW
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('show', compact('project'));
    }


    // CREATE
    public function create()
    {
        $types = Type::all();
        $users = User::all();
        $technologies = Technology::all();

        return view('create', compact('types', 'users', 'technologies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:64',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:64',
            'budget' => 'required|integer',
            'progress' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'user_id' => 'nullable|exists:users,id',
            'main_picture' => 'required|file|image|max:2048'
        ]);


        $data = $request->all();

        // Creo una variabile per l'inserimento dell'img da client
        $img_path = Storage::put('uploads', $data['main_picture']);

        // Carico ora il link dell'img nel record main_picture di users
        $data['main_picture'] = $img_path;

        // dd($data);

        $project = Project::create($data);

        $project->technologies()->attach($data['technologies']);

        return redirect()->route('project.show', $project->id);
    }

    // EDIT
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $types = Type::all();

        return view("edit", compact("project", "types"));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $project = Project::findOrFail($id);
        $project->update($data);
        return redirect()->route('project.show', $project->id);
    }

    // DELETE
    public function delete($id)
    {
        $project = Project::findOrFail($id);

        // Trova tutti i record correlati nella tabella "project_technology"
        $projectTechnologies = DB::table('project_technology')
            ->where('project_id', $id)
            ->get();

        // Elimina i record correlati dalla tabella "project_technology"
        foreach ($projectTechnologies as $projectTechnology) {
            DB::table('project_technology')
                ->where('id', $projectTechnology->id)
                ->delete();
        }

        // Elimina il progetto dalla tabella "projects"
        $project->delete();

        // Effettua il reindirizzamento
        return redirect()->route('project.index');
    }
}
