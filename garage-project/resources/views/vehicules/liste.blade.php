@extends('layouts.app')

@section('title', 'Liste des Véhicules - AutoManager Pro')

@section('content')
<div id="vehicules-app">
    <!-- Header avec titre et bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="h2 fw-bold text-primary mb-2">
                <i class="fas fa-car me-3"></i>Liste des Véhicules
            </h1>
            <p class="text-muted mb-0">Gérez votre inventaire de véhicules en temps réel</p>
        </div>
        <a href="{{ route('vehicules.create') }}" class="btn btn-success-modern btn-modern">
            <i class="fas fa-plus me-2"></i>Nouveau véhicule
        </a>
    </div>

    <!-- Statistiques rapides -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="col-md-3 col-6 mb-3">
            <div class="card card-modern text-center p-3">
                <div class="text-primary fs-2 mb-2">
                    <i class="fas fa-car"></i>
                </div>
                <h4 class="fw-bold text-primary mb-1">@{{ vehicules.length }}</h4>
                <small class="text-muted">Total véhicules</small>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card card-modern text-center p-3">
                <div class="text-success fs-2 mb-2">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4 class="fw-bold text-success mb-1">@{{ getCountByEnergie('Hybride') + getCountByEnergie('Électrique') }}</h4>
                <small class="text-muted">Éco-friendly</small>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card card-modern text-center p-3">
                <div class="text-warning fs-2 mb-2">
                    <i class="fas fa-cogs"></i>
                </div>
                <h4 class="fw-bold text-warning mb-1">@{{ getCountByBoite('Automatique') }}</h4>
                <small class="text-muted">Automatiques</small>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card card-modern text-center p-3">
                <div class="text-info fs-2 mb-2">
                    <i class="fas fa-calendar"></i>
                </div>
                <h4 class="fw-bold text-info mb-1">@{{ getAverageYear() }}</h4>
                <small class="text-muted">Année moyenne</small>
            </div>
        </div>
    </div>

    <!-- Filtres de recherche avancés -->
    <div class="card card-modern mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header-modern">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2"></i>Filtres de recherche
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-id-card me-2"></i>Immatriculation
                    </label>
                    <input 
                        type="text" 
                        class="form-control form-control-modern" 
                        placeholder="Rechercher par immatriculation..."
                        v-model="searchImmatriculation"
                        @input="filterVehicules"
                    >
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-industry me-2"></i>Marque
                    </label>
                    <select class="form-select form-select-modern" v-model="searchMarque" @change="filterVehicules">
                        <option value="">Toutes les marques</option>
                        <option v-for="marque in uniqueMarques" :key="marque" :value="marque">
                            @{{ marque }}
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-gas-pump me-2"></i>Énergie
                    </label>
                    <select class="form-select form-select-modern" v-model="searchEnergie" @change="filterVehicules">
                        <option value="">Tous les types d'énergie</option>
                        <option v-for="energie in uniqueEnergies" :key="energie" :value="energie">
                            @{{ energie }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-calendar me-2"></i>Année minimum
                    </label>
                    <input 
                        type="number" 
                        class="form-control form-control-modern" 
                        placeholder="Ex: 2020"
                        v-model.number="searchAnneeMin"
                        @input="filterVehicules"
                    >
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-tachometer-alt me-2"></i>Kilométrage maximum
                    </label>
                    <input 
                        type="number" 
                        class="form-control form-control-modern" 
                        placeholder="Ex: 50000"
                        v-model.number="searchKmMax"
                        @input="filterVehicules"
                    >
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-primary-modern btn-modern" @click="resetFilters">
                    <i class="fas fa-undo me-2"></i>Réinitialiser
                </button>
                <span class="badge badge-modern bg-primary fs-6 align-self-center">
                    @{{ filteredVehicules.length }} résultat(s)
                </span>
            </div>
        </div>
    </div>

    <!-- Messages d'alerte -->
    <div v-if="message" :class="'alert alert-' + messageType + '-modern'" class="alert-modern alert-dismissible fade show" data-aos="fade-in">
        <i :class="getAlertIcon(messageType)" class="me-2"></i>
        @{{ message }}
        <button type="button" class="btn-close" @click="message = ''"></button>
    </div>

    <!-- Tableau des véhicules -->
    <div class="card card-modern" data-aos="fade-up" data-aos-delay="300">
        <div class="card-header-modern d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>Inventaire des véhicules
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-light btn-sm" @click="toggleView" :title="viewMode === 'table' ? 'Vue grille' : 'Vue tableau'">
                    <i :class="viewMode === 'table' ? 'fas fa-th' : 'fas fa-table'"></i>
                </button>
                <button class="btn btn-outline-light btn-sm" @click="exportData" title="Exporter en CSV">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <!-- Loading -->
            <div v-if="loading" class="text-center p-5">
                <div class="spinner-modern mx-auto mb-3"></div>
                <p class="text-muted">Chargement des véhicules...</p>
            </div>
            
            <!-- Aucun résultat -->
            <div v-else-if="filteredVehicules.length === 0" class="text-center p-5">
                <div class="text-muted fs-1 mb-3">
                    <i class="fas fa-search"></i>
                </div>
                <h5 class="text-muted">Aucun véhicule trouvé</h5>
                <p class="text-muted">Essayez de modifier vos critères de recherche</p>
            </div>
            
            <!-- Vue tableau -->
            <div v-else-if="viewMode === 'table'" class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Immatriculation</th>
                            <th>Véhicule</th>
                            <th>Détails</th>
                            <th>Énergie</th>
                            <th>Année</th>
                            <th>Kilométrage</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(vehicule, index) in paginatedVehicules" :key="vehicule.id" class="align-middle">
                            <td class="text-center fw-bold">@{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; font-size: 0.8rem;">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <strong class="text-primary">@{{ vehicule.immatriculation }}</strong>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold">@{{ vehicule.marque }} @{{ vehicule.modele }}</div>
                                    <small class="text-muted">@{{ vehicule.carrosserie }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-modern" :style="'background-color: ' + getColorBadge(vehicule.couleur) + '; color: ' + getTextColor(vehicule.couleur)">
                                    @{{ vehicule.couleur }}
                                </span>
                                <div class="mt-1">
                                    <small class="text-muted">@{{ vehicule.boite }}</small>
                                </div>
                            </td>
                            <td>
                                <span :class="'badge badge-modern bg-' + getEnergieBadge(vehicule.energie)">
                                    <i :class="getEnergieIcon(vehicule.energie)" class="me-1"></i>
                                    @{{ vehicule.energie }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold">@{{ vehicule.annee }}</span>
                                <div class="progress mt-1" style="height: 4px;">
                                    <div class="progress-bar bg-info" :style="'width: ' + getAgeProgress(vehicule.annee) + '%'"></div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">@{{ formatKilometrage(vehicule.kilometrage) }}</div>
                                <div class="progress mt-1" style="height: 4px;">
                                    <div class="progress-bar" :class="getKmProgressClass(vehicule.kilometrage)" 
                                         :style="'width: ' + getKmProgress(vehicule.kilometrage) + '%'"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a 
                                        :href="'/vehicules/' + vehicule.id + '/details'"
                                        class="btn btn-info-modern btn-modern" 
                                        title="Voir détails"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a 
                                        :href="'/vehicules/' + vehicule.id + '/edit'" 
                                        class="btn btn-warning-modern btn-modern"
                                        title="Modifier"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button 
                                        class="btn btn-danger-modern btn-modern" 
                                        @click="vehiculeToDelete = vehicule"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal"
                                        title="Supprimer"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Vue grille -->
            <div v-else class="p-4">
                <div class="row g-4">
                    <div v-for="vehicule in paginatedVehicules" :key="vehicule.id" class="col-lg-4 col-md-6">
                        <div class="card card-modern h-100 vehicle-card">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="vehicle-icon">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-car fs-4"></i>
                                        </div>
                                    </div>
                                    <span :class="'badge badge-modern bg-' + getEnergieBadge(vehicule.energie)">
                                        @{{ vehicule.energie }}
                                    </span>
                                </div>
                                
                                <h5 class="fw-bold text-primary mb-2">@{{ vehicule.immatriculation }}</h5>
                                <h6 class="text-dark mb-3">@{{ vehicule.marque }} @{{ vehicule.modele }}</h6>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Année</small>
                                        <span class="fw-bold">@{{ vehicule.annee }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Kilométrage</small>
                                        <span class="fw-bold">@{{ formatKilometrage(vehicule.kilometrage) }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Couleur</small>
                                        <span class="badge badge-modern" :style="'background-color: ' + getColorBadge(vehicule.couleur)">
                                            @{{ vehicule.couleur }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Boîte</small>
                                        <span class="fw-bold">@{{ vehicule.boite }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a :href="'/vehicules/' + vehicule.id + '/details'" 
                                       class="btn btn-info-modern btn-modern btn-sm flex-fill">
                                        <i class="fas fa-eye me-1"></i>Voir
                                    </a>
                                    <a :href="'/vehicules/' + vehicule.id + '/edit'" class="btn btn-warning-modern btn-modern btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger-modern btn-modern btn-sm" 
                                            @click="vehiculeToDelete = vehicule"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="totalPages > 1" class="d-flex justify-content-center p-4">
                <nav>
                    <ul class="pagination pagination-modern">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <button class="page-link" @click="currentPage = 1" :disabled="currentPage === 1">
                                <i class="fas fa-angle-double-left"></i>
                            </button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <button class="page-link" @click="currentPage--" :disabled="currentPage === 1">
                                <i class="fas fa-angle-left"></i>
                            </button>
                        </li>
                        <li v-for="page in visiblePages" :key="page" class="page-item" :class="{ active: page === currentPage }">
                            <button class="page-link" @click="currentPage = page">@{{ page }}</button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <button class="page-link" @click="currentPage++" :disabled="currentPage === totalPages">
                                <i class="fas fa-angle-right"></i>
                            </button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <button class="page-link" @click="currentPage = totalPages" :disabled="currentPage === totalPages">
                                <i class="fas fa-angle-double-right"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal de suppression SIMPLE -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Confirmer la suppression
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="vehiculeToDelete">
                    <p>Êtes-vous sûr de vouloir supprimer le véhicule <strong>@{{ vehiculeToDelete.immatriculation }}</strong> ?</p>
                    <p class="text-muted">Cette action est irréversible.</p>
                </div>
                <div class="modal-body" v-else>
                    <p>Chargement...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button v-if="vehiculeToDelete" type="button" class="btn btn-danger" @click="deleteVehicule">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .vehicle-card {
        transition: all 0.3s ease;
    }
    
    .vehicle-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }
    
    .pagination-modern .page-link {
        border: none;
        border-radius: 8px;
        margin: 0 2px;
        color: var(--primary-color);
        font-weight: 500;
    }
    
    .pagination-modern .page-item.active .page-link {
        background: var(--gradient-primary);
        border: none;
    }
    
    .info-group label {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        display: block;
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

@section('scripts')
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            vehicules: @json($vehicules),
            filteredVehicules: @json($vehicules),
            loading: false,
            message: '',
            messageType: 'success',
            vehiculeToDelete: null,
            searchImmatriculation: '',
            searchMarque: '',
            searchEnergie: '',
            searchAnneeMin: null,
            searchKmMax: null,
            viewMode: 'table', // 'table' ou 'grid'
            currentPage: 1,
            itemsPerPage: 10
        }
    },
    computed: {
        uniqueMarques() {
            return [...new Set(this.vehicules.map(v => v.marque))].sort();
        },
        uniqueEnergies() {
            return [...new Set(this.vehicules.map(v => v.energie))].sort();
        },
        totalPages() {
            return Math.ceil(this.filteredVehicules.length / this.itemsPerPage);
        },
        paginatedVehicules() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredVehicules.slice(start, end);
        },
        visiblePages() {
            const pages = [];
            const total = this.totalPages;
            const current = this.currentPage;
            
            if (total <= 7) {
                for (let i = 1; i <= total; i++) {
                    pages.push(i);
                }
            } else {
                if (current <= 4) {
                    for (let i = 1; i <= 5; i++) pages.push(i);
                    pages.push('...');
                    pages.push(total);
                } else if (current >= total - 3) {
                    pages.push(1);
                    pages.push('...');
                    for (let i = total - 4; i <= total; i++) pages.push(i);
                } else {
                    pages.push(1);
                    pages.push('...');
                    for (let i = current - 1; i <= current + 1; i++) pages.push(i);
                    pages.push('...');
                    pages.push(total);
                }
            }
            
            return pages;
        }
    },
    methods: {
        filterVehicules() {
            this.filteredVehicules = this.vehicules.filter(vehicule => {
                const matchImmat = vehicule.immatriculation.toLowerCase().includes(this.searchImmatriculation.toLowerCase());
                const matchMarque = !this.searchMarque || vehicule.marque === this.searchMarque;
                const matchEnergie = !this.searchEnergie || vehicule.energie === this.searchEnergie;
                const matchAnnee = !this.searchAnneeMin || vehicule.annee >= this.searchAnneeMin;
                const matchKm = !this.searchKmMax || vehicule.kilometrage <= this.searchKmMax;
                
                return matchImmat && matchMarque && matchEnergie && matchAnnee && matchKm;
            });
            this.currentPage = 1;
        },
        resetFilters() {
            this.searchImmatriculation = '';
            this.searchMarque = '';
            this.searchEnergie = '';
            this.searchAnneeMin = null;
            this.searchKmMax = null;
            this.filterVehicules();
        },
        toggleView() {
            this.viewMode = this.viewMode === 'table' ? 'grid' : 'table';
        },
        async deleteVehicule() {
            if (!this.vehiculeToDelete) return;
            
            try {
                await axios.delete(`/api/vehicules/${this.vehiculeToDelete.id}`);
                
                // Supprimer de la liste locale
                this.vehicules = this.vehicules.filter(v => v.id !== this.vehiculeToDelete.id);
                this.filterVehicules();
                
                this.showMessage('Véhicule supprimé avec succès', 'success');
                
                // Fermer la modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                if (modal) modal.hide();
                
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                this.showMessage('Erreur lors de la suppression', 'danger');
            }
        },
        showMessage(text, type) {
            this.message = text;
            this.messageType = type;
            setTimeout(() => {
                this.message = '';
            }, 5000);
        },
        formatKilometrage(km) {
            return new Intl.NumberFormat('fr-FR').format(km) + ' km';
        },
        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('fr-FR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },
        getColorBadge(couleur) {
            const colors = {
                'Blanc': '#f8f9fa',
                'Noir': '#212529',
                'Rouge': '#dc3545',
                'Bleu': '#0d6efd',
                'Gris': '#6c757d',
                'Vert': '#198754',
                'Jaune': '#ffc107',
                'Orange': '#fd7e14',
                'Violet': '#6f42c1',
                'Marron': '#8b4513',
                'Beige': '#f5f5dc'
            };
            return colors[couleur] || '#6c757d';
        },
        getTextColor(couleur) {
            const darkColors = ['Noir', 'Bleu', 'Vert', 'Violet', 'Marron'];
            return darkColors.includes(couleur) ? 'white' : 'black';
        },
        getEnergieBadge(energie) {
            const badges = {
                'Essence': 'primary',
                'Diesel': 'warning',
                'Électrique': 'success',
                'Hybride': 'info',
                'Hybride rechargeable': 'info',
                'GPL': 'secondary',
                'GNV': 'secondary'
            };
            return badges[energie] || 'secondary';
        },
        getEnergieIcon(energie) {
            const icons = {
                'Essence': 'fas fa-gas-pump',
                'Diesel': 'fas fa-oil-can',
                'Électrique': 'fas fa-bolt',
                'Hybride': 'fas fa-leaf',
                'Hybride rechargeable': 'fas fa-plug',
                'GPL': 'fas fa-fire',
                'GNV': 'fas fa-wind'
            };
            return icons[energie] || 'fas fa-gas-pump';
        },
        getAlertIcon(type) {
            const icons = {
                'success': 'fas fa-check-circle',
                'danger': 'fas fa-exclamation-circle',
                'warning': 'fas fa-exclamation-triangle',
                'info': 'fas fa-info-circle'
            };
            return icons[type] || 'fas fa-info-circle';
        },
        getCountByEnergie(energie) {
            return this.vehicules.filter(v => v.energie === energie).length;
        },
        getCountByBoite(boite) {
            return this.vehicules.filter(v => v.boite === boite).length;
        },
        getAverageYear() {
            if (this.vehicules.length === 0) return 0;
            const sum = this.vehicules.reduce((acc, v) => acc + v.annee, 0);
            return Math.round(sum / this.vehicules.length);
        },
        getAgeProgress(annee) {
            const currentYear = new Date().getFullYear();
            const age = currentYear - annee;
            const maxAge = 20; // Considérer 20 ans comme âge maximum
            return Math.min((age / maxAge) * 100, 100);
        },
        getKmProgress(km) {
            const maxKm = 200000; // 200,000 km comme maximum
            return Math.min((km / maxKm) * 100, 100);
        },
        getKmProgressClass(km) {
            if (km < 50000) return 'bg-success';
            if (km < 100000) return 'bg-warning';
            return 'bg-danger';
        },
        exportData() {
            const csvContent = "data:text/csv;charset=utf-8," 
                + "Immatriculation,Marque,Modèle,Couleur,Année,Kilométrage,Carrosserie,Énergie,Boîte\n"
                + this.filteredVehicules.map(v => 
                    `${v.immatriculation},${v.marque},${v.modele},${v.couleur},${v.annee},${v.kilometrage},${v.carrosserie},${v.energie},${v.boite}`
                ).join("\n");
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "vehicules_export.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    },
    mounted() {
        this.filterVehicules();
        console.log('Application Vue.js initialisée avec', this.vehicules.length, 'véhicules');
    }
}).mount('#vehicules-app');
</script>
@endsection