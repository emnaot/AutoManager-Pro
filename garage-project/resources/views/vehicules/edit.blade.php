@extends('layouts.app')

@section('title', 'Modifier un Véhicule')

@section('content')
<div id="edit-vehicule-app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">✏️ Modifier le véhicule - {{ $vehicule->immatriculation }}</h4>
                </div>
                <div class="card-body">
                    <!-- Messages d'alerte -->
                    <div v-if="message" :class="'alert alert-' + messageType" class="alert-dismissible fade show">
                        @{{ message }}
                        <button type="button" class="btn-close" @click="message = ''"></button>
                    </div>

                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="immatriculation" class="form-label">Immatriculation *</label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        :class="{ 'is-invalid': errors.immatriculation }"
                                        id="immatriculation"
                                        v-model="form.immatriculation"
                                        placeholder="Ex: 123TUN456"
                                        required
                                    >
                                    <div v-if="errors.immatriculation" class="invalid-feedback">
                                        @{{ errors.immatriculation[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="marque" class="form-label">Marque *</label>
                                    <select 
                                        class="form-select"
                                        :class="{ 'is-invalid': errors.marque }"
                                        id="marque"
                                        v-model="form.marque"
                                        required
                                    >
                                        <option value="">Sélectionner une marque</option>
                                        <option v-for="marque in marques" :key="marque" :value="marque">
                                            @{{ marque }}
                                        </option>
                                    </select>
                                    <div v-if="errors.marque" class="invalid-feedback">
                                        @{{ errors.marque[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="modele" class="form-label">Modèle *</label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        :class="{ 'is-invalid': errors.modele }"
                                        id="modele"
                                        v-model="form.modele"
                                        placeholder="Ex: 208, Clio, Corolla"
                                        required
                                    >
                                    <div v-if="errors.modele" class="invalid-feedback">
                                        @{{ errors.modele[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="couleur" class="form-label">Couleur *</label>
                                    <select 
                                        class="form-select"
                                        :class="{ 'is-invalid': errors.couleur }"
                                        id="couleur"
                                        v-model="form.couleur"
                                        required
                                    >
                                        <option value="">Sélectionner une couleur</option>
                                        <option v-for="couleur in couleurs" :key="couleur" :value="couleur">
                                            @{{ couleur }}
                                        </option>
                                    </select>
                                    <div v-if="errors.couleur" class="invalid-feedback">
                                        @{{ errors.couleur[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="annee" class="form-label">Année *</label>
                                    <input 
                                        type="number" 
                                        class="form-control"
                                        :class="{ 'is-invalid': errors.annee }"
                                        id="annee"
                                        v-model.number="form.annee"
                                        :min="1900"
                                        :max="new Date().getFullYear() + 1"
                                        required
                                    >
                                    <div v-if="errors.annee" class="invalid-feedback">
                                        @{{ errors.annee[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kilometrage" class="form-label">Kilométrage *</label>
                                    <input 
                                        type="number" 
                                        class="form-control"
                                        :class="{ 'is-invalid': errors.kilometrage }"
                                        id="kilometrage"
                                        v-model.number="form.kilometrage"
                                        min="0"
                                        placeholder="Ex: 50000"
                                        required
                                    >
                                    <div v-if="errors.kilometrage" class="invalid-feedback">
                                        @{{ errors.kilometrage[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="carrosserie" class="form-label">Carrosserie *</label>
                                    <select 
                                        class="form-select"
                                        :class="{ 'is-invalid': errors.carrosserie }"
                                        id="carrosserie"
                                        v-model="form.carrosserie"
                                        required
                                    >
                                        <option value="">Sélectionner une carrosserie</option>
                                        <option v-for="carrosserie in carrosseries" :key="carrosserie" :value="carrosserie">
                                            @{{ carrosserie }}
                                        </option>
                                    </select>
                                    <div v-if="errors.carrosserie" class="invalid-feedback">
                                        @{{ errors.carrosserie[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="energie" class="form-label">Énergie *</label>
                                    <select 
                                        class="form-select"
                                        :class="{ 'is-invalid': errors.energie }"
                                        id="energie"
                                        v-model="form.energie"
                                        required
                                    >
                                        <option value="">Sélectionner un type d'énergie</option>
                                        <option v-for="energie in energies" :key="energie" :value="energie">
                                            @{{ energie }}
                                        </option>
                                    </select>
                                    <div v-if="errors.energie" class="invalid-feedback">
                                        @{{ errors.energie[0] }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="boite" class="form-label">Boîte de vitesses *</label>
                                    <select 
                                        class="form-select"
                                        :class="{ 'is-invalid': errors.boite }"
                                        id="boite"
                                        v-model="form.boite"
                                        required
                                    >
                                        <option value="">Sélectionner un type de boîte</option>
                                        <option v-for="boite in boites" :key="boite" :value="boite">
                                            @{{ boite }}
                                        </option>
                                    </select>
                                    <div v-if="errors.boite" class="invalid-feedback">
                                        @{{ errors.boite[0] }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vehicules.liste') }}" class="btn btn-secondary">
                                ← Retour à la liste
                            </a>
                            <button type="submit" class="btn btn-warning" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                                💾 Mettre à jour
                            </button>
                        </div>
                    </form>
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
            vehiculeId: {{ $vehicule->id }},
            form: {
                immatriculation: '{{ $vehicule->immatriculation }}',
                marque: '{{ $vehicule->marque }}',
                modele: '{{ $vehicule->modele }}',
                couleur: '{{ $vehicule->couleur }}',
                annee: {{ $vehicule->annee }},
                kilometrage: {{ $vehicule->kilometrage }},
                carrosserie: '{{ $vehicule->carrosserie }}',
                energie: '{{ $vehicule->energie }}',
                boite: '{{ $vehicule->boite }}'
            },
            errors: {},
            loading: false,
            message: '',
            messageType: 'success',
            marques: [
                'Peugeot', 'Renault', 'Citroën', 'Toyota', 'Volkswagen', 
                'BMW', 'Mercedes', 'Audi', 'Ford', 'Opel', 'Nissan', 
                'Hyundai', 'Kia', 'Mazda', 'Honda', 'Fiat'
            ],
            couleurs: [
                'Blanc', 'Noir', 'Gris', 'Rouge', 'Bleu', 'Vert', 
                'Jaune', 'Orange', 'Violet', 'Marron', 'Beige'
            ],
            carrosseries: [
                'Berline', 'Break', 'Coupé', 'Cabriolet', 'SUV', 
                'Monospace', 'Citadine', 'Compacte', '4x4', 'Pick-up'
            ],
            energies: [
                'Essence', 'Diesel', 'Électrique', 'Hybride', 
                'Hybride rechargeable', 'GPL', 'GNV'
            ],
            boites: [
                'Manuelle', 'Automatique', 'Semi-automatique', 'CVT'
            ]
        }
    },
    methods: {
        async submitForm() {
            this.loading = true;
            this.errors = {};
            
            try {
                const response = await axios.put(`/api/vehicules/${this.vehiculeId}`, this.form);
                
                if (response.data.success) {
                    this.showMessage('Véhicule mis à jour avec succès !', 'success');
                    
                    // Rediriger vers la liste après 2 secondes
                    setTimeout(() => {
                        window.location.href = '{{ route("vehicules.liste") }}';
                    }, 2000);
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                    this.showMessage('Veuillez corriger les erreurs dans le formulaire', 'danger');
                } else {
                    this.showMessage('Erreur lors de la mise à jour du véhicule', 'danger');
                }
            } finally {
                this.loading = false;
            }
        },
        showMessage(text, type) {
            this.message = text;
            this.messageType = type;
            setTimeout(() => {
                this.message = '';
            }, 5000);
        }
    }
}).mount('#edit-vehicule-app');
</script>
@endsection