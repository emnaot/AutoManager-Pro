@extends('layouts.app')

@section('title', 'Accueil - AutoManager Pro')

@section('content')
<div class="text-center">
    <!-- Hero Section -->
    <div class="hero-section mb-5" data-aos="fade-up">
        <div class="hero-content p-5 rounded-4" style="background: var(--gradient-primary); color: white;">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-car-side me-3"></i>
                        AutoManager Pro
                    </h1>
                    <p class="lead fs-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        Système de gestion moderne et intelligent pour votre garage automobile
                    </p>
                    <p class="fs-5 mb-4" data-aos="fade-up" data-aos-delay="300">
                        Gérez facilement votre inventaire de véhicules avec notre interface moderne, intuitive et performante
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="400">
                        <a class="btn btn-light btn-lg btn-modern px-4 py-3" href="{{ route('vehicules.liste') }}" role="button">
                            <i class="fas fa-list me-2"></i>
                            Voir les véhicules
                        </a>
                        <a class="btn btn-outline-light btn-lg btn-modern px-4 py-3" href="{{ route('vehicules.create') }}" role="button">
                            <i class="fas fa-plus me-2"></i>
                            Ajouter un véhicule
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-5" data-aos="fade-up" data-aos-delay="500">
        <div class="col-md-4 mb-4">
            <div class="card card-modern h-100 text-center p-4">
                <div class="card-body">
                    <div class="display-4 text-primary mb-3">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ \App\Models\Vehicule::count() }}</h3>
                    <p class="text-muted mb-0">Véhicules enregistrés</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-modern h-100 text-center p-4">
                <div class="card-body">
                    <div class="display-4 text-success mb-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="fw-bold text-success">100%</h3>
                    <p class="text-muted mb-0">Disponibilité système</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-modern h-100 text-center p-4">
                <div class="card-body">
                    <div class="display-4 text-warning mb-3">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="fw-bold text-warning">24/7</h3>
                    <p class="text-muted mb-0">Support technique</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Fonctionnalités principales -->
    <div class="row mb-5">
        <div class="col-lg-4 mb-4" data-aos="fade-right" data-aos-delay="600">
            <div class="card card-modern h-100">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px; background: var(--gradient-primary);">
                            <i class="fas fa-list text-white fs-2"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold mb-3">📋 Gestion Complète</h5>
                    <p class="card-text text-muted">
                        Consultez et gérez tous vos véhicules avec des filtres avancés par marque, énergie et immatriculation
                    </p>
                    <a href="{{ route('vehicules.liste') }}" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-arrow-right me-2"></i>Voir la liste
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="700">
            <div class="card card-modern h-100">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px; background: var(--gradient-secondary);">
                            <i class="fas fa-plus text-white fs-2"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold mb-3">➕ Ajout Rapide</h5>
                    <p class="card-text text-muted">
                        Enregistrez rapidement de nouveaux véhicules avec notre formulaire intelligent et validation automatique
                    </p>
                    <a href="{{ route('vehicules.create') }}" class="btn btn-success-modern btn-modern">
                        <i class="fas fa-plus me-2"></i>Ajouter
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4" data-aos="fade-left" data-aos-delay="800">
            <div class="card card-modern h-100">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            <i class="fas fa-cogs text-white fs-2"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold mb-3">🔧 API REST</h5>
                    <p class="card-text text-muted">
                        Intégrez facilement avec d'autres systèmes grâce à notre API REST complète et documentée
                    </p>
                    <a href="/api/vehicules" class="btn btn-info-modern btn-modern" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Voir l'API
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Technologies utilisées -->
    <div class="row" data-aos="fade-up" data-aos-delay="900">
        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header-modern text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-code me-2"></i>
                        Technologies Modernes
                    </h3>
                </div>
                <div class="card-body p-5">
                    <div class="row text-center">
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fab fa-laravel text-danger fs-1 mb-2"></i>
                                <h6 class="fw-bold">Laravel 10</h6>
                                <small class="text-muted">Framework PHP</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fab fa-vuejs text-success fs-1 mb-2"></i>
                                <h6 class="fw-bold">Vue.js 3</h6>
                                <small class="text-muted">Interface réactive</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fab fa-bootstrap text-primary fs-1 mb-2"></i>
                                <h6 class="fw-bold">Bootstrap 5</h6>
                                <small class="text-muted">Design responsive</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fas fa-database text-warning fs-1 mb-2"></i>
                                <h6 class="fw-bold">MySQL</h6>
                                <small class="text-muted">Base de données</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fas fa-mobile-alt text-info fs-1 mb-2"></i>
                                <h6 class="fw-bold">Responsive</h6>
                                <small class="text-muted">Multi-plateforme</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-4">
                            <div class="tech-item">
                                <i class="fas fa-shield-alt text-success fs-1 mb-2"></i>
                                <h6 class="fw-bold">Sécurisé</h6>
                                <small class="text-muted">Protection CSRF</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer info -->
    <div class="mt-5 text-center" data-aos="fade-up" data-aos-delay="1000">
        <p class="text-muted">
            <i class="fas fa-graduation-cap me-2"></i>
            Projet développé avec <strong>Laravel & Vue.js</strong> - ISET Sfax 2025-2026
        </p>
    </div>
</div>

<style>
    .hero-section {
        margin: -2rem -2rem 2rem -2rem;
    }
    
    .tech-item {
        transition: all 0.3s ease;
        padding: 1rem;
        border-radius: 12px;
    }
    
    .tech-item:hover {
        background: rgba(37, 99, 235, 0.1);
        transform: translateY(-5px);
    }
    
    .feature-icon {
        transition: all 0.3s ease;
    }
    
    .card-modern:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }
</style>
@endsection