@extends('layouts.app')

@section('content')
    <div class="container text-center">

        {{-- Versione UTENTE --}}
        @auth
        <div>
            <h1 class="my-3 display-5 font-weight-bold text-primary">Welcome : {{Auth::user() -> name}}</h1>
            <div class="border-top my-3"></div>
            <h3 class="my-4 display-6 font-weight-bold text-info" style="font-size: 1.5rem;">Modify your project</h3>
        </div>
         
            {{-- Inserisco il form --}}

            <form class="bg-light p-4 mb-4" action="{{route('project.update', $project->id)}}" method="POST">

                
                @csrf
                @method("POST")

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="project_name"><b>project_name :</b></label>
                        <br>
                        <input class="text-center form-control" type="text" name="project_name" value="{{$project -> project_name}}">
                    </div>
                </div>


                {{-- Modifica della main_picture del project --}}
                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="main_picture"><b>Main picture:</b></label>
                        <br>
                        <input class="form-control" type="file" name="main_picture" accept="image/*">
                    </div>

                    

                    <div class="pt-3">
                        @if ($project->main_picture)
                            <img src="{{ asset('storage/' . $project->main_picture) }}" alt="Main project image" class="img-fluid mb-3">
                        @else
                            <img src="{{ asset('storage/images/proj.png') }}" alt="Default project image" class="img-fluid mb-3">
                        @endif
                    </div>

                    
                    
                </div>
                


                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="description"><b>description :</b></label>
                        <br>
                        <textarea class="form-control description-textarea" name="description">{{ $project->description }}</textarea>
                    </div>
                </div>


                <div class="row justify-content-center my-4">
                    <div class="col-md-3">
                        <label for="start_date"><b>start_date :</b></label>
                        <br>
                        <input class="text-center form-control " type="date" name="start_date" value="{{$project -> start_date}}">
                    </div>

                    <div class="col-md-3">
                        <label for="end_date"><b>end_date :</b></label>
                        <br>
                        <input class="text-center form-control" type="date" name="end_date" value="{{$project -> end_date}}">
                    </div>
                </div>


                <div class="row justify-content-center my-4">
                   
                </div>


                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="status"><b>status :</b></label>
                        <br>
                        <input class="text-center form-control" type="text" name="status" value="{{$project -> status}}">
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="budget"><b>budget :</b></label>
                        <br>
                        <input class="text-center form-control" type="number" name="budget" value="{{$project -> budget}}">
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="progress"><b>progress :</b></label>
                        <br>
                        <input class="text-center form-control" type="number" name="progress" value="{{$project -> progress}}">
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="type_id"><b>Type :</b></label>
                        <br>
                        <select name="type_id" id="type_id" class="form-select text-center">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                
                <div class="row justify-content-center my-4">
                    <div class="col-3">
                        <input class="btn btn-primary" type="submit">
                    </div>
                </div>


            </form>
        @endauth

    </div>
@endsection