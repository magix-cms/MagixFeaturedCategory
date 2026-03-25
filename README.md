# MagixFeaturedCategory

[![Release](https://img.shields.io/github/release/magix-cms/MagixFeaturedCategory.svg)](https://github.com/magix-cms/MagixFeaturedCategory/releases/latest)
[![License](https://img.shields.io/github/license/magix-cms/MagixFeaturedCategory.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.2-blue.svg)](https://php.net/)
[![Magix CMS](https://img.shields.io/badge/Magix%20CMS-4.x-success.svg)](https://www.magix-cms.com/)

**MagixFeaturedCategory** est un plugin officiel pour Magix CMS 4.x permettant de mettre en avant une sélection de catégories spécifiques directement sur la page d'accueil de votre boutique ou site web.

## 🌟 Fonctionnalités principales

* **Recherche AJAX ultra-rapide** : Ajoutez des catégories à votre sélection en les cherchant par leur nom.
* **Filtre intelligent** : Les catégories déjà ajoutées n'apparaissent plus dans les résultats de recherche pour éviter les doublons.
* **Drag & Drop fluide** : Modifiez l'ordre d'affichage de vos catégories phares d'un simple glisser-déposer (propulsé par `Sortable.js`).
* **Sauvegarde 100% automatique** : Chaque modification (ajout, suppression, tri) est sauvegardée instantanément en arrière-plan via AJAX.
* **Intégration native au thème** : Le widget public réutilise la boucle native (`category-grid.tpl`) de votre thème, garantissant une cohérence visuelle parfaite avec votre catalogue.
* **SEO Orienté** : Délégation complète au moteur central du CMS. Le plugin hérite de la génération automatique d'images responsives et du balisage structuré `JSON-LD` généré par le `CategoryPresenter`.

## ⚙️ Installation

1. Téléchargez la dernière version du plugin.
2. Décompressez l'archive et placez le dossier `MagixFeaturedCategory` dans le répertoire `plugins/` de votre installation Magix CMS.
3. Connectez-vous à l'administration de Magix CMS.
4. Rendez-vous dans **Extensions > Plugins**.
5. Repérez **MagixFeaturedCategory** dans la liste et cliquez sur **Installer**.

*Note : Lors de l'installation, le système créera la table `mc_plug_featured_category` dans votre base de données et greffera le widget sur le hook `displayHomeBottom`.*

## 🚀 Utilisation

### Côté Administration
1. Accédez à la configuration du plugin depuis votre panneau de contrôle.
2. Utilisez la barre de recherche à gauche pour trouver une catégorie.
3. Cliquez sur la catégorie dans les résultats pour l'ajouter à votre sélection.
4. Dans la colonne de droite, utilisez l'icône de poignée (⋮⋮) pour réorganiser vos catégories.
5. Une notification verte `MagixToast` vous confirmera la sauvegarde automatique à chaque action.

### Côté Public (Frontend)
Le plugin s'affiche automatiquement sur votre page d'accueil via le hook défini dans le `manifest.json`. Si aucune catégorie n'est sélectionnée, le widget reste invisible.

## 🛠️ Architecture Technique (Pour les développeurs)

Conçu selon l'architecture modulaire de **Magix CMS V4** :

* **Frontend** : Délègue la récupération des données complexes au cœur du CMS via `CategoryDb::getCategoriesByIds()`, évitant ainsi la duplication de requêtes SQL lourdes.
* **Backend UI** : L'interface d'administration utilise la classe Javascript centralisée `MagixItemSelector.js` (Fetch API, Sortable.js, MagixToast).
* **Sécurité (Sandboxing)** : Le `FrontendController` est encapsulé dans un `try/catch`. Toute exception liée au plugin sera interceptée silencieusement (sous forme de commentaire HTML) sans bloquer le rendu du reste de la page d'accueil.

## 📄 Licence



Ce projet est sous licence **GPLv3**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

Copyright (C) 2008 - 2026 Gerits Aurelien (Magix CMS)

Ce programme est un logiciel libre ; vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique Générale GNU telle que publiée par la Free Software Foundation ; soit la version 3 de la Licence, ou (à votre discrétion) toute version ultérieure.