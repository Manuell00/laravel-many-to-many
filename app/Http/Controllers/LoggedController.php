<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



// Importo il model
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class LoggedController extends Controller
{

    // // UPDATE USER IMAGE
    // public function updateImage(Request $request)
    // {
    //     // Ottieni l'utente autenticato
    //     $user = Auth::user();

    //     // Controlla se è stata fornita un'immagine
    //     if ($request->hasFile('profile_image')) {
    //         // Salva l'immagine e ottieni il percorso
    //         $imagePath = Storage::put('uploads', $request->file('profile_image'));

    //         // Aggiorna il campo profile_image dell'utente
    //         $user->user_image = $imagePath;

    //         // Salva le modifiche
    //         $user->save();
    //     } else {
    //         // Output di debug
    //         dd("No profile image provided.");
    //     }

    //     return redirect()->route('home');
    // }


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
        $validator = $request->validate([
            'project_name' => 'required|string|max:64',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:64',
            'budget' => 'required|integer',
            'progress' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'user_id' => 'nullable|exists:users,id',
            'main_picture' => 'nullable|image|max:2048'
        ]);


        $data = $request->all();

        // Verifica se è stata fornita un'immagine
        if ($request->hasFile('main_picture')) {
            $img_path = Storage::put('uploads', $data['main_picture']);
            $data['main_picture'] = $img_path;
        } else {
            $data['main_picture'] = null; // Nessun'immagine fornita, impostiamo a null
        }

        // dd($data);

        $project = Project::create($data);

        $project->technologies()->attach($data['technologies']);

        return redirect()->route('project.show', $project->id)->withErrors($validator);
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

        if ($request->hasFile('main_picture')) {
            // Elimina l'immagine vecchia se esiste
            if ($project->main_picture) {
                Storage::delete($project->main_picture);
            }

            // Salva la nuova immagine e ottieni il percorso
            $imagePath = Storage::put('public/uploads', $request->file('main_picture'));

            // Rimuovi il prefisso "public/" dal percorso dell'immagine
            $data['main_picture'] = str_replace('public/', '', $imagePath);
        }

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
