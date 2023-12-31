@extends('layouts.app')

@section('content')
    <div class="container text-center">

        {{-- Versione UTENTE --}}
        @auth
       
            <h3 class="my-4 display-6" style="font-size: 1.5rem;">Create a new project</h3>
         
            {{-- Inserisco il form --}}

            <form class="p-4 mb-4" action="{{route('project.store')}}" method="POST" enctype="multipart/form-data" id="create-container">

                @csrf
                @method("POST")
                

                
                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="project_name"><b>project_name :</b></label>
                        <br>
                        <input class="text-center form-control" type="text" name="project_name">
                        
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('project_name'))
                        <br>
                        <div class="alert alert-danger">
                            {{$errors->first('project_name')}}
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="main_picture"><b>main picture :</b></label>
                        <br>
                        <input class="text-center form-control" type="file" name="main_picture" id="main_picture">

                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('main_picture'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('main_picture')}}
                            </div>
                        @endif
                    </div>
                </div>
                
                
                
                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="description"><b>description :</b></label>
                        <br>
                        <textarea class="form-control description-textarea" name="description"></textarea>
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('description'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('description')}}
                            </div>
                        @endif
                    </div>
                </div>
                
               

                <div class="row justify-content-center my-4">
                    <div class="col-md-3">
                        <label for="start_date"><b>start_date :</b></label>
                        <br>
                        <input class="text-center form-control " type="date" name="start_date">
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('start_date'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('start_date')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <label for="end_date"><b>end_date :</b></label>
                        <br>
                        <input class="text-center form-control" type="date" name="end_date">
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('end_date'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('end_date')}}
                            </div>
                        @endif
                        
                    </div>
                </div>


                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="status"><b>status :</b></label>
                        <br>
                        <input class="text-center form-control" type="text" name="status">
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('status'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('status')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="budget"><b>budget :</b></label>
                        <br>
                        <input class="text-center form-control" type="number" name="budget">
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('budget'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('budget')}}
                            </div>
                         @endif
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="progress"><b>progress :</b></label>
                        <br>
                        <input class="text-center form-control" type="number" name="progress">
                        {{-- Inserisco l'eventuale errore --}}
                        @if ($errors->has('progress'))
                            <br>
                            <div class="alert alert-danger">
                                {{$errors->first('progress')}}
                            </div>
                        @endif
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
                    <div class="col-md-6">

                        {{-- Inserisco le checkbox --}}
                        @foreach ($technologies as $technology)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$technology->id}}
                                " name="technologies[]" id="technology-{{$technology->id}}">
                                <label class="form-check-label" for="technology-{{$technology->id}}">
                                    {{$technology->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row justify-content-center my-4">
                    <div class="col-md-6">
                        <label class="my-2" for="user_id"><b>User id :</b></label>
                        <br>
                        <input class="text-center form-control" type="number" name="user_id"
                            value="@if(Auth::check()){{ Auth::user()->id }}@else{{ null }}@endif">
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