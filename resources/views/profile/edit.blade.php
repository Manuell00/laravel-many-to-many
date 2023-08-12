@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Profile') }}
    </h2>
    <div class="card p-4 mb-4 bg-white shadow rounded-lg">

        @include('profile.partials.update-profile-information-form')

    </div>

    {{-- Inserimento immagine profilo --}}
    <div class="card p-4 mb-4 bg-white shadow rounded-lg">
        <h2>Change your user image</h2>

        {{-- Inserisco la form per l'input dell'img --}}
        <form  action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data">
            <div class="col-3">
                <input type="file" name="profile_image" id="profile_image">
            </div>
            <div class="col-3">
                <input class="btn btn-primary" type="submit">
            </div>

        </form>
    </div>

    <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.update-password-form')

    </div>

    <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
