@extends('layouts.app')

@section('title', 'Liste des Véhicules')

@section('content')
<div id="vehicules-app">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">📋 Liste des Véhicules</h1>
        <a href="{{ route('vehicules.create') }}" class="btn btn-success">
            ➕ Ajouter un véhicule
        </a>
    </div>

    <!-- Filtres de recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Rechercher par immatriculation..."
                        v-model="searchImmatriculation"
                        @input="filterVehicules"
                    >
                </div>
                <div class="col-md-4">
                    <select class="form-select" v-model="searchMarque" @change="filterVehicules">
                        <option value="">Toutes les marques</option>
                        <option v-for="marque in uniqueMarques" :key="marque" :value="marque">
                            @{{ marque }}
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" v-model="searchEnergie" @change="filterVehicules">
                        <option value="">Tous les types d'énergie</option>
                        <option v-for="energie in uniqueEnergies" :key="energie" :value="energie">
                            @{{ energie }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages d'alerte -->
    <div v-if="message" :class="'alert alert-' + messageType" class="alert-dismissible fade show">
        @{{ message }}
        <button type="button" class="btn-close" @click="message = ''"></button>
    </div>

    <!-- Tableau des véhicules -->
    <div class="card">
        <div class="card-body">
            <div v-if="loading" class="text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </div>
            
            <div v-else-if="filteredVehicules.length === 0" class="text-center text-muted">
                <p>Aucun véhicule trouvé.</p>
            </div>
            
            <div v-else class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Immatriculation</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Couleur</th>
                            <th>Année</th>
                            <th>Kilométrage</th>
                            <th>Carrosserie</th>
                            <th>Énergie</th>
                            <th>Boîte</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="vehicule in filteredVehicules" :key="vehicule.id">
                            <td>@{{ vehicule.id }}</td>
                            <td><strong>@{{ vehicule.immatriculation }}</strong></td>
                            <td>@{{ vehicule.marque }}</td>
                            <td>@{{ vehicule.modele }}</td>
                            <td>
                                <span class="badge" :style="'background-color: ' + getColorBadge(vehicule.couleur)">
                                    @{{ vehicule.couleur }}
                                </span>
                            </td>
                            <td>@{{ vehicule.annee }}</td>
                            <td>@{{ formatKilometrage(vehicule.kilometrage) }}</td>
                            <td>@{{ vehicule.carrosserie }}</td>
                            <td>
                                <span :class="'badge bg-' + getEnergieBadge(vehicule.energie)">
                                    @{{ vehicule.energie }}
                                </span>
                            </td>
                            <td>@{{ vehicule.boite }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button 
                                        class="btn btn-outline-info btn-custom" 
                                        @click="showVehicule(vehicule)"
                                        title="Voir détails"
                                    >
                                        👁️
                                    </button>
                                    <a 
                                        :href="'/vehicules/' + vehicule.id + '/edit'" 
                                        class="btn btn-outline-warning btn-custom"
                                        title="Modifier"
                                    >
                                        ✏️
                                    </a>
                                    <button 
                                        class="btn btn-outline-danger btn-custom" 
                                        @click="confirmDelete(vehicule)"
                                        title="Supprimer"
                                    >
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de détails -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" v-if="selectedVehicule">
                <div class="modal-header">
                    <h5 class="modal-title">Détails du véhicule - @{{ selectedVehicule.immatriculation }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Marque:</strong> @{{ selectedVehicule.marque }}</p>
                            <p><strong>Modèle:</strong> @{{ selectedVehicule.modele }}</p>
                            <p><strong>Couleur:</strong> @{{ selectedVehicule.couleur }}</p>
                            <p><strong>Année:</strong> @{{ selectedVehicule.annee }}</p>
                            <p><strong>Kilométrage:</strong> @{{ formatKilometrage(selectedVehicule.kilometrage) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Carrosserie:</strong> @{{ selectedVehicule.carrosserie }}</p>
                            <p><strong>Énergie:</strong> @{{ selectedVehicule.energie }}</p>
                            <p><strong>Boîte:</strong> @{{ selectedVehicule.boite }}</p>
                            <p><strong>Créé le:</strong> @{{ formatDate(selectedVehicule.created_at) }}</p>
                            <p><strong>Modifié le:</strong> @{{ formatDate(selectedVehicule.updated_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" v-if="vehiculeToDelete">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer le véhicule <strong>@{{ vehiculeToDelete.immatriculation }}</strong> ?</p>
                    <p class="text-muted">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" @click="deleteVehicule">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
            selectedVehicule: null,
            vehiculeToDelete: null,
            searchImmatriculation: '',
            searchMarque: '',
            searchEnergie: ''
        }
    },
    computed: {
        uniqueMarques() {
            return [...new Set(this.vehicules.map(v => v.marque))].sort();
        },
        uniqueEnergies() {
            return [...new Set(this.vehicules.map(v => v.energie))].sort();
        }
    },
    methods: {
        filterVehicules() {
            this.filteredVehicules = this.vehicules.filter(vehicule => {
                const matchImmat = vehicule.immatriculation.toLowerCase().includes(this.searchImmatriculation.toLowerCase());
                const matchMarque = !this.searchMarque || vehicule.marque === this.searchMarque;
                const matchEnergie = !this.searchEnergie || vehicule.energie === this.searchEnergie;
                
                return matchImmat && matchMarque && matchEnergie;
            });
        },
        showVehicule(vehicule) {
            this.selectedVehicule = vehicule;
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        },
        confirmDelete(vehicule) {
            this.vehiculeToDelete = vehicule;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        },
        async deleteVehicule() {
            try {
                await axios.delete(`/api/vehicules/${this.vehiculeToDelete.id}`);
                
                // Supprimer de la liste locale
                this.vehicules = this.vehicules.filter(v => v.id !== this.vehiculeToDelete.id);
                this.filterVehicules();
                
                this.showMessage('Véhicule supprimé avec succès', 'success');
                bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
            } catch (error) {
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
            return new Date(dateString).toLocaleDateString('fr-FR');
        },
        getColorBadge(couleur) {
            const colors = {
                'Blanc': '#f8f9fa',
                'Noir': '#212529',
                'Rouge': '#dc3545',
                'Bleu': '#0d6efd',
                'Gris': '#6c757d',
                'Vert': '#198754',
                'Jaune': '#ffc107'
            };
            return colors[couleur] || '#6c757d';
        },
        getEnergieBadge(energie) {
            const badges = {
                'Essence': 'primary',
                'Diesel': 'warning',
                'Électrique': 'success',
                'Hybride': 'info'
            };
            return badges[energie] || 'secondary';
        }
    },
    mounted() {
        this.filterVehicules();
    }
}).mount('#vehicules-app');
</script>
@endsection