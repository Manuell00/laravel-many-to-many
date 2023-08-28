@extends('layouts.app')

@section('content')
    <div class="container text-center">

        {{-- Versione UTENTE --}}
        @auth
            <h1 class="my-3 display-5">Welcome : 
                <span class="capitalize">{{Auth::user()->name}}</span>
            </h1>

            <div class="border-top my-3"></div>

            <div class="row justify-content-center">

                <h3 class="my-4 display-6 ">Find Your Project :</h3>

                {{-- Search form name--}}
                <form action="{{route('project.searchName')}}" method="GET" class="my-3 w-50">
                    @csrf
                    @method('GET')
                    
                    <div class="input-group">
                        <input type="text" name="searchName" class="form-control" placeholder="Search by project name" aria-label="Search by project name">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                {{-- Search form id --}}
                <form action="{{ route('project.searchId') }}" method="GET" class="my-3 w-25">
                    @csrf
                    <div class="input-group">
                        <input type="number" name="searchId" class="form-control" placeholder="Search by User ID" aria-label="Search by ID">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                
            </div>




            {{-- Container dei progetti --}}
            <div class="project-container">

                {{-- List --}}
               <h3 class="my-4 display-6 ">Project List :
                   <span class="pl-3">
                       @if ($showAll)
                          <a href="?showAll=false" type="button" class="btn-custom">
                           See less <i class="fa-solid fa-chevron-up"></i>
                           </a>
           
                       @else
                           <a href="?showAll=true" type="button" class="btn-custom">
                               See more <i class="fa-solid fa-chevron-down"></i>
                           </a>
                       @endif
                   </span>
               </h3>

                {{-- SHOW --}}
                @foreach ($projects as $project)
                    <li class="row justify-content-center my-3">
                        <div class="col-2 p-name">
                            <a href="{{ route('project.show', $project->id) }}">{{ $project->project_name }}</a>
                        </div>

                        {{-- EDIT e DELETE --}}
                        <div class="col-2">
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <form action="{{ route('project.edit', $project->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>
                                </div>
    
                                <div class="col-3">
                                    <form action="{{ route('project.delete', $project->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                @endforeach

            </div> 
            {{-- Chiusura del container dei progetti --}}

             {{-- Add project --}}
             <h3 class="my-4 display-6 ">Add new project</h3>
             <a id="add-btn" class="btn btn-primary my-3" href="{{ route('project.create') }}">+</a>

        @endauth

        {{-- Versione OSPITE --}}
        @guest
            <h1>Welcome</h1>

            {{-- Creo una lista senza link visibile a tutti --}}
            <ol class="list-unstyled">
                @foreach ($projects as $project)
                    <li>{{ $project->project_name }}</li>
                    
                @endforeach
            </ol>
        @endguest

    </div>
@endsection
