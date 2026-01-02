# Instructions d'Installation - Mini Projet Laravel

## Prérequis

1. **XAMPP** installé avec :
   - Apache
   - MySQL
   - PHP 8.0 ou supérieur

2. **Composer** - Télécharger depuis https://getcomposer.org/download/

## Étapes d'installation

### 1. Installation de Composer
```bash
# Télécharger et installer Composer depuis le site officiel
# Ajouter Composer au PATH système
```

### 2. Installation de Laravel
```bash
# Dans le terminal, naviguer vers le dossier du projet
cd chemin/vers/le/projet

# Installer les dépendances Laravel
composer install

# Générer la clé d'application
php artisan key:generate
```

### 3. Configuration de la base de données

1. Démarrer XAMPP (Apache + MySQL)
2. Ouvrir phpMyAdmin (http://localhost/phpmyadmin)
3. Importer le fichier `mini_projet_nom_prenom.sql`
4. Ou créer manuellement la base de données :
   ```sql
   CREATE DATABASE mini_projet_nom_prenom;
   ```

### 4. Configuration de l'environnement

Modifier le fichier `.env` avec vos paramètres :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_projet_nom_prenom
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migration et seeding

```bash
# Exécuter les migrations
php artisan migrate

# Peupler la base de données avec des données d'exemple
php artisan db:seed
```

### 6. Installation de Vue.js (optionnel)

```bash
# Installer Node.js et npm
npm install

# Compiler les assets
npm run dev
```

### 7. Lancement du serveur

```bash
# Démarrer le serveur de développement Laravel
php artisan serve
```

L'application sera accessible à : http://127.0.0.1:8000

## URLs importantes

- **Accueil** : http://127.0.0.1:8000/
- **Liste des véhicules** : http://127.0.0.1:8000/vehicules/liste
- **Ajouter un véhicule** : http://127.0.0.1:8000/vehicules/create
- **API véhicules** : http://127.0.0.1:8000/api/vehicules

## Tests de l'API

### Avec Thunder Client (VS Code) ou Postman

1. **GET** - Lister tous les véhicules
   ```
   GET http://127.0.0.1:8000/api/vehicules
   ```

2. **POST** - Créer un véhicule
   ```
   POST http://127.0.0.1:8000/api/vehicules
   Content-Type: application/json
   
   {
     "immatriculation": "999TUN888",
     "marque": "Ford",
     "modele": "Focus",
     "couleur": "Blanc",
     "annee": 2023,
     "kilometrage": 5000,
     "carrosserie": "Berline",
     "energie": "Essence",
     "boite": "Manuelle"
   }
   ```

3. **GET** - Récupérer un véhicule spécifique
   ```
   GET http://127.0.0.1:8000/api/vehicules/1
   ```

4. **PUT** - Modifier un véhicule
   ```
   PUT http://127.0.0.1:8000/api/vehicules/1
   Content-Type: application/json
   
   {
     "immatriculation": "123TUN456",
     "marque": "Peugeot",
     "modele": "208",
     "couleur": "Rouge",
     "annee": 2020,
     "kilometrage": 50000,
     "carrosserie": "Berline",
     "energie": "Essence",
     "boite": "Manuelle"
   }
   ```

5. **DELETE** - Supprimer un véhicule
   ```
   DELETE http://127.0.0.1:8000/api/vehicules/1
   ```

## Dépannage

### Erreur "Class not found"
```bash
composer dump-autoload
```

### Erreur de base de données
- Vérifier que MySQL est démarré dans XAMPP
- Vérifier les paramètres de connexion dans `.env`

### Erreur de permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Structure du projet

```
mini_projet_garage/
├── app/
│   ├── Http/Controllers/
│   │   └── VehiculeController.php
│   └── Models/
│       └── Vehicule.php
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000000_create_vehicules_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── VehiculeSeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── vehicules/
│   │   ├── liste.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── welcome.blade.php
├── routes/
│   ├── api.php
│   └── web.php
├── .env
└── mini_projet_nom_prenom.sql
```