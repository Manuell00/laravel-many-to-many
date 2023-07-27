<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Recupera l'ultimo project_id dalla tabella User (dalla colonna 'project_id')
        $lastProjectId = User::max('project_id');

        // Incrementa di 1 per ottenere il nuovo project_id da assegnare
        $newProjectId = $lastProjectId + 1;

        $randomNumber = random_int(0, 100);

        $latestUser = User::latest()->first();


        // Creo ovviamente un nuovo record nella tabella project che andranno poi modificati nella edit
        $projectData = [
            'project_name' => 'Progetto_' . $request->name . '_' . $latestUser->id,
            'description' => 'Descrizione del Progetto',
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'status' => 'In progress',
            'budget' => 0.0, // 
            'progress' => 0, //
            'image' => "https://picsum.photos/id/{$randomNumber}/",
            'type_id' => rand(1, 10),
        ];

        // Creazione del nuovo progetto
        $project = Project::create($projectData);

        // Creazione dello user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'project_id' => $newProjectId
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('project.index');
    }
}
