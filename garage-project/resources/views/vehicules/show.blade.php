@extends('layouts.app')

@section('title', 'Détails du Véhicule - AutoManager Pro')

@section('content')
<div class="fade-in">
    <!-- Header avec navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="h2 fw-bold text-primary mb-2">
                <i class="fas fa-car me-3"></i>Détails du Véhicule
            </h1>
            <p class="text-muted mb-0">Informations complètes du véhicule {{ $vehicule->immatriculation }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('vehicules.liste') }}" class="btn btn-secondary btn-modern">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
            <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning-modern btn-modern">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
        </div>
    </div>

    <!-- Card principale avec les détails -->
    <div class="card card-modern" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header-modern text-center">
            <h3 class="mb-0">
                <i class="fas fa-id-card me-2"></i>
                {{ $vehicule->immatriculation }}
            </h3>
        </div>
        <div class="card-body p-5">
            <div class="row g-4">
                <!-- Colonne gauche -->
                <div class="col-lg-6">
                    <div class="info-section">
                        <h5 class="text-primary fw-bold mb-4">
                            <i class="fas fa-info-circle me-2"></i>Informations Générales
                        </h5>
                        
                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-industry me-2"></i>Marque
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="fs-5 fw-semibold">{{ $vehicule->marque }}</span>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-car me-2"></i>Modèle
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="fs-5 fw-semibold">{{ $vehicule->modele }}</span>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-palette me-2"></i>Couleur
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="badge badge-modern fs-6 p-2" 
                                      style="background-color: {{ $vehicule->couleur === 'Blanc' ? '#f8f9fa' : ($vehicule->couleur === 'Noir' ? '#212529' : ($vehicule->couleur === 'Rouge' ? '#dc3545' : ($vehicule->couleur === 'Bleu' ? '#0d6efd' : ($vehicule->couleur === 'Gris' ? '#6c757d' : ($vehicule->couleur === 'Vert' ? '#198754' : '#ffc107'))))) }}; 
                                             color: {{ in_array($vehicule->couleur, ['Noir', 'Bleu', 'Vert']) ? 'white' : 'black' }};">
                                    {{ $vehicule->couleur }}
                                </span>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-car-side me-2"></i>Carrosserie
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="fs-5 fw-semibold">{{ $vehicule->carrosserie }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="col-lg-6">
                    <div class="info-section">
                        <h5 class="text-primary fw-bold mb-4">
                            <i class="fas fa-cogs me-2"></i>Caractéristiques Techniques
                        </h5>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-calendar me-2"></i>Année de Fabrication
                            </label>
                            <div class="info-value bg-light p-3 rounded d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-semibold">{{ $vehicule->annee }}</span>
                                <div class="progress" style="width: 100px; height: 8px;">
                                    <div class="progress-bar bg-info" 
                                         style="width: {{ min(((date('Y') - $vehicule->annee) / 20) * 100, 100) }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-tachometer-alt me-2"></i>Kilométrage
                            </label>
                            <div class="info-value bg-light p-3 rounded d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-semibold">{{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</span>
                                <div class="progress" style="width: 100px; height: 8px;">
                                    <div class="progress-bar {{ $vehicule->kilometrage < 50000 ? 'bg-success' : ($vehicule->kilometrage < 100000 ? 'bg-warning' : 'bg-danger') }}" 
                                         style="width: {{ min(($vehicule->kilometrage / 200000) * 100, 100) }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-gas-pump me-2"></i>Type d'Énergie
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="badge bg-{{ $vehicule->energie === 'Essence' ? 'primary' : ($vehicule->energie === 'Diesel' ? 'warning' : ($vehicule->energie === 'Électrique' ? 'success' : 'info')) }} fs-6 p-2">
                                    <i class="fas fa-{{ $vehicule->energie === 'Essence' ? 'gas-pump' : ($vehicule->energie === 'Diesel' ? 'oil-can' : ($vehicule->energie === 'Électrique' ? 'bolt' : 'leaf')) }} me-2"></i>
                                    {{ $vehicule->energie }}
                                </span>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <label class="fw-bold text-secondary d-block mb-2">
                                <i class="fas fa-cogs me-2"></i>Boîte de Vitesses
                            </label>
                            <div class="info-value bg-light p-3 rounded">
                                <span class="fs-5 fw-semibold">{{ $vehicule->boite }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section métadonnées -->
            <hr class="my-5">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-primary fw-bold mb-4">
                        <i class="fas fa-clock me-2"></i>Informations Système
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted d-block">Créé le</small>
                                <span class="fw-semibold">{{ $vehicule->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted d-block">Dernière modification</small>
                                <span class="fw-semibold">{{ $vehicule->updated_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-md-4">
            <div class="card card-modern text-center h-100">
                <div class="card-body p-4">
                    <div class="text-warning fs-1 mb-3">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h5 class="fw-bold">Modifier</h5>
                    <p class="text-muted mb-3">Mettre à jour les informations de ce véhicule</p>
                    <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning-modern btn-modern">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-modern text-center h-100">
                <div class="card-body p-4">
                    <div class="text-success fs-1 mb-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h5 class="fw-bold">Nouveau</h5>
                    <p class="text-muted mb-3">Ajouter un nouveau véhicule au garage</p>
                    <a href="{{ route('vehicules.create') }}" class="btn btn-success-modern btn-modern">
                        <i class="fas fa-plus me-2"></i>Ajouter
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-modern text-center h-100">
                <div class="card-body p-4">
                    <div class="text-primary fs-1 mb-3">
                        <i class="fas fa-list"></i>
                    </div>
                    <h5 class="fw-bold">Liste</h5>
                    <p class="text-muted mb-3">Retourner à la liste complète des véhicules</p>
                    <a href="{{ route('vehicules.liste') }}" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-list me-2"></i>Voir tout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .info-item {
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        transform: translateY(-2px);
    }
    
    .info-value {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .info-item:hover .info-value {
        border-color: var(--primary-color);
        background-color: rgba(37, 99, 235, 0.05) !important;
    }
    
    .progress {
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        border-radius: 10px;
    }
</style>
@endsection