<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Importo il model
use App\Models\Project;

class GuestController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view("home", compact("projects"));
    }
}
