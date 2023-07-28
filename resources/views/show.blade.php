@extends('layouts.app')

@section('content')
    <div class="container text-center">

        {{-- Versione UTENTE --}}
        @auth
            <div class="my-4">
                <h1 class="display-5 font-weight-bold text-primary" style="text-transform :capitalize">Welcome: {{ Auth::user()->name }}</h1>
                <div class="border-top my-3"></div>
                <h3 class="display-6 font-weight-bold text-info">Project details</h3>

                <div class="bg-light p-4 rounded shadow-sm mt-4">
                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Id:</span>
                        </div>
                        <div class="col-md-6">{{ $project->id }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Project name:</span>
                        </div>
                        <div class="col-md-6">{{ $project->project_name }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Image:</span>
                        </div>
                        <div class="col-md-6" id="photo">
                            <div class="image-container">
                                <img src="{{ $project->image }}" alt="ImmagineRand">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Description:</span>
                        </div>
                        <div class="col-md-6">{{ $project->description }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Start Date:</span>
                        </div>
                        <div class="col-md-6">{{ $project->start_date }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">End Date:</span>
                        </div>
                        <div class="col-md-6">{{ $project->end_date }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Status:</span>
                        </div>
                        <div class="col-md-6">{{ $project->status }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Budget:</span>
                        </div>
                        <div class="col-md-6">{{ $project->budget }}</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Progress:</span>
                        </div>
                        <div class="col-md-6">{{ $project->progress }}%</div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Technologies:</span>
                        </div>
                        <div class="col-md-6">
                            <ol class="list-unstyled">
                                @foreach ($project->technologies as $technology)
                                    <li>{{$technology -> name}}
                                        @if (!$loop->last)
                                            <span>,</span>
                                        @endif
                                    </li>
                                    
                                @endforeach
                            </ol>
                        </div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-md-3 font-weight-bold">
                            <span class="label">Type of project:</span>
                        </div>
                        <div class="col-md-6">{{ $project->type->type_name }}</div>
                    </div>
                </div>

            </div>
        @endauth
    </div>
@endsection

