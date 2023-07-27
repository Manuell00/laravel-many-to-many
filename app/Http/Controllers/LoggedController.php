<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Importo il model
use App\Models\Project;
use App\Models\Type;


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

        $projects = Project::where('id', $search)->get();

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

        return view('create', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // dd($data);

        $project = Project::create($data);

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

        $project->delete();

        return redirect()->route('project.index');
    }
}
