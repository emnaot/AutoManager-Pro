@extends('layouts.app')

@section('title', 'Accueil - Garage Manager')

@section('content')
<div class="text-center">
    <div class="jumbotron bg-primary text-white p-5 rounded mb-4">
        <h1 class="display-4">🚗 Garage Manager</h1>
        <p class="lead">Système de gestion des véhicules pour garage de réparation</p>
        <hr class="my-4 bg-white">
        <p>Gérez facilement votre inventaire de véhicules avec notre interface moderne et intuitive.</p>
        <a class="btn btn-light btn-lg" href="{{ route('vehicules.liste') }}" role="button">
            Voir les véhicules
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📋 Liste des Véhicules</h5>
                    <p class="card-text">Consultez tous les véhicules enregistrés dans votre garage avec des filtres avancés.</p>
                    <a href="{{ route('vehicules.liste') }}" class="btn btn-primary">Voir la liste</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">➕ Ajouter un Véhicule</h5>
                    <p class="card-text">Enregistrez un nouveau véhicule dans votre système de gestion.</p>
                    <a href="{{ route('vehicules.create') }}" class="btn btn-success">Ajouter</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🔧 API REST</h5>
                    <p class="card-text">Accédez aux données via notre API REST complète pour les intégrations.</p>
                    <a href="/api/vehicules" class="btn btn-info" target="_blank">Voir l'API</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Fonctionnalités</h3>
        <div class="row mt-4">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Gestion complète des véhicules</li>
                    <li class="list-group-item">✅ Interface Vue.js moderne</li>
                    <li class="list-group-item">✅ API REST complète</li>
                    <li class="list-group-item">✅ Filtres et recherche avancés</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Validation des données</li>
                    <li class="list-group-item">✅ Interface responsive</li>
                    <li class="list-group-item">✅ Gestion des erreurs</li>
                    <li class="list-group-item">✅ Base de données MySQL</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection