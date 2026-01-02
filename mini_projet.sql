-- Base de données pour le mini projet Laravel - Gestion des véhicules
-- ISET Sfax 2025-2026 - BOUFAYED Morthadha

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS `mini_projet_boufayed_morthadha` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mini_projet_boufayed_morthadha`;

-- Structure de la table `vehicules`
CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `carrosserie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `energie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Données d'exemple pour la table `vehicules`
INSERT INTO `vehicules` (`id`, `immatriculation`, `marque`, `modele`, `couleur`, `annee`, `kilometrage`, `carrosserie`, `energie`, `boite`, `created_at`, `updated_at`) VALUES
(1, '123TUN456', 'Peugeot', '208', 'Blanc', 2020, 45000, 'Berline', 'Essence', 'Manuelle', '2024-01-01 10:00:00', '2024-01-01 10:00:00'),
(2, '789TUN012', 'Renault', 'Clio', 'Rouge', 2019, 62000, 'Citadine', 'Diesel', 'Automatique', '2024-01-01 10:00:00', '2024-01-01 10:00:00'),
(3, '345TUN678', 'Toyota', 'Corolla', 'Gris', 2021, 28000, 'Berline', 'Hybride', 'Automatique', '2024-01-01 10:00:00', '2024-01-01 10:00:00'),
(4, '901TUN234', 'Volkswagen', 'Golf', 'Noir', 2018, 78000, 'Compacte', 'Essence', 'Manuelle', '2024-01-01 10:00:00', '2024-01-01 10:00:00'),
(5, '567TUN890', 'BMW', 'Serie 3', 'Bleu', 2022, 15000, 'Berline', 'Diesel', 'Automatique', '2024-01-01 10:00:00', '2024-01-01 10:00:00');

-- Structure de la table `migrations` (Laravel)
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Données pour la table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000000_create_vehicules_table', 1);

-- Index pour les tables déchargées

-- Index pour la table `vehicules`
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicules_immatriculation_unique` (`immatriculation`);

-- Index pour la table `migrations`
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT pour les tables déchargées

-- AUTO_INCREMENT pour la table `vehicules`
ALTER TABLE `vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- AUTO_INCREMENT pour la table `migrations`
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;