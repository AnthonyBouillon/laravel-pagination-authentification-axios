@extends('layouts.app')

@section('content')
    <main class="container">
        <header>
            <h1 class="text-center">Ajouter une annonce</h1>
        </header>
        {{-- Provient du controleur Ads de la méthode store, si l'insertion à  réussi ou échoué, message --}}
        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @elseif (session('error'))
            <p class="alert alert-danger">{{ session('error') }}</p>
        @endif
        {{-- Renvoie les données sur la même page --}}
        <form method="POST" action="{{ route('create_ads') }}">
            {{-- Protège contre une faille de sécurité --}}
            @csrf
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                {{-- Affiche une erreur  si la validation du champ à échoué qui provient de la méthode store du controleur AdsController --}}
                @error('title')
                <div class="invalid-feedback">
                    Titre requis
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
            @error('description')
                <div class="invalid-feedback">
                    Description requis
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="localisation">Localisation</label>
                <input type="text" class="form-control @error('localisation') is-invalid @enderror" id="localisation" name="localisation" value="{{ old('localisation') }}">
            @error('localisation')
                <div class="invalid-feedback">
                    Localisation requis
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="price">Prix</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">
                    Prix requis et cela doit être un nombre ou un chiffre
                </div>
            @enderror
            </div>
            <button type="submit" class="btn btn-dark">Ajouter une annonce</button>
        </form>
    </main>
@endsection