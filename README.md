# Jettingen.fr - Kirby CMS Project

Site web de la commune de Jettingen, Haut-Rhin, Alsace.
Kirby CMS 5 avec design chaleureux et villageois.

## Aperçu

Ce projet est un starter Kirby complet prêt pour le développement du nouveau site de Jettingen. Il inclut :

- Structure de site pré-configurée avec blueprints pour toutes les pages
- Design responsif avec palette de couleurs personnalisée
- Navigation mobile et navigation principale
- Sections pour actualités, événements, document, école, salle des fêtes
- Galeries d'images intégrées
- Formulaire de contact
- Breadcrumbs et pagination
- Optimisé pour le SEO
- Intégration des plugins Kirby recommandés

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Serveur web avec support des URL clean (Apache avec mod_rewrite ou Nginx)
- SQLite ou MySQL (optionnel, Kirby utilise SQLite par défaut)

## Installation

### 1. Cloner/copier le projet

```bash
cp -r kirby-jettingen /chemin/vers/votre/installation
cd kirby-jettingen
```

### 2. Installer les dépendances

```bash
composer install
```

Cette commande va télécharger Kirby CMS et les dépendances PHP nécessaires.

### 3. Créer les fichiers d'accès

Créer un fichier `.htaccess` à la racine pour Apache :

```apache
<IfModule mod_rewrite.c>
  RewriteEngine On

  # Bloquer les accès directs
  RewriteRule "^\.git" - [F]
  RewriteRule "^composer\.(json|lock)" - [F]
  RewriteRule "^\.env$" - [F]

  # Rediriger vers le routeur Kirby
  RewriteCond %{REQUEST_FILENAME} -f [OR]
  RewriteCond %{REQUEST_FILENAME} -d
  RewriteRule ^.*$ - [L]

  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^.*$ index.php [L]
</IfModule>
```

Pour Nginx, ajouter à votre configuration :

```nginx
location / {
  try_files $uri $uri/ /index.php?$query_string;
}

location ~ "^(?!.*\.(?:css|js|jpg|jpeg|png|gif|ico|svg|woff2|woff))" {
  rewrite ^/(.*)$ /index.php?$query_string last;
}
```

### 4. Permissions

Assurer que les dossiers suivants sont accessibles en écriture :

```bash
chmod -R 755 site/content
chmod -R 755 storage
```

### 5. Configuration

Éditer `site/config/config.php` pour personnaliser :
- Mode debug (development/production)
- Paramètres de cache
- Configuration des images
- Paramètres des plugins

## Structure du projet

```
kirby-jettingen/
├── kirby/                 # Cœur de Kirby (géré par Composer)
├── site/
│   ├── blueprints/       # Définition des pages et champs
│   │   ├── site.yml      # Paramètres globaux du site
│   │   └── pages/        # Templates des pages
│   ├── templates/        # Templates PHP
│   ├── snippets/         # Composants réutilisables
│   ├── config/           # Configuration
│   └── content/          # Contenu du site (créé automatiquement)
├── assets/
│   ├── css/              # Feuilles de style
│   ├── js/               # Scripts JavaScript
│   └── img/              # Images statiques
├── storage/              # Fichiers générés, cache, etc.
├── vendor/               # Dépendances Composer
├── index.php             # Point d'entrée
├── composer.json         # Dépendances PHP
└── README.md            # Ce fichier
```

## Pages disponibles

### Début (home)
Page d'accueil avec :
- Section héro avec image de fond
- Accès rapide (4 raccourcis)
- Dernières actualités (3 articles)
- Section informations générales

### La Commune (commune)
- Description générale
- Chiffres clés dans sidebar
- Galerie de photos

### Actualités (articles)
- Liste des articles de news
- Triage par date

### Article (article)
- Date, auteur, catégorie
- Image de couverture
- Contenu avec blocs
- Documents à télécharger
- Navigation entre articles

### Événements (events)
- Liste des événements à venir
- Événements passés séparés

### Événement (event)
- Date, heure, lieu
- Image
- Contenu
- Lien d'inscription

### Contact (contact)
- Formulaire de contact
- Informations de contact
- Carte intégrée
- Horaires

### Bibliothèque de documents (documents)
- Documents téléchargeables
- Catégorisation
- Descriptions

### Salle des fêtes (salle-des-fetes)
- Description générale
- Capacité et équipements
- Tarifs
- Galerie
- Informations de réservation

### École (ecole)
- Description
- Équipe pédagogique
- Horaires
- Projets pédagogiques
- Activités

## Couleurs

Palette personnalisée pour Jettingen :

```css
--color-primary: #5B7F3B;      /* Vert olive */
--color-secondary: #8B6F47;    /* Marron chaud */
--color-accent: #D4A853;       /* Doré blé */
--color-background: #FAF8F5;   /* Fond crème */
--color-text: #2C2C2C;         /* Texte foncé */
```

## Plugins recommandés

### SEO (tobimori/kirby-seo)
```bash
composer require tobimori/kirby-seo
```
Ajoute :
- Meta descriptions
- Sitemap XML
- Robots.txt
- OpenGraph

### Formulaires (bnomei/kirby-uniform)
```bash
composer require bnomei/kirby-uniform
```
Gère les formulaires avec :
- Protection honeypot
- Email logging
- Validation

### Images (timnarr/kirby-imagex)
```bash
composer require timnarr/kirby-imagex
```
Traitement avancé d'images.

## Configuration du Panel (Admin)

L'admin Kirby est accessible à `/panel`.

Créer le premier utilisateur :
```bash
php -r "
require 'kirby/bootstrap.php';
kirby()->users()->create([
  'email'    => 'admin@jettingen.fr',
  'password' => 'changez-moi',
  'role'     => 'admin'
]);
"
```

## Déploiement

### 1. Préparation

- Définir `'debug' => false` dans `site/config/config.php`
- Activer le cache des pages
- Vérifier les permissions des dossiers

### 2. Mise à jour Kirby

```bash
composer update
```

### 3. Scripts disponibles

```bash
# Démarrer un serveur local
composer start

# Vérifier le style de code
composer lint

# Formater le code
composer format
```

## Personnalisation

### Couleurs

Éditer les variables CSS dans `assets/css/style.css` :

```css
:root {
  --color-primary: #5B7F3B;
  --color-secondary: #8B6F47;
  --color-accent: #D4A853;
  /* ... */
}
```

### Typographie

La police par défaut est Lato (Google Fonts). Pour changer :

1. Éditer l'import dans `site/snippets/header.php`
2. Mettre à jour `--font-primary` dans `assets/css/style.css`

### Logo

1. Ajouter le logo au Panel (Paramètres du site)
2. Éditer `site/snippets/header.php` pour ajuster la taille

### Contenu par défaut

Les pages par défaut sont vides. Vous devez les créer dans le Panel :

1. Accéder à `/panel`
2. Créer les pages principales
3. Publier le contenu

## Développement local

### Démarrer un serveur

```bash
cd kirby-jettingen
php -S localhost:8000 kirby/router.php
```

Puis accéder à `http://localhost:8000`

### Activer le mode debug

```php
// site/config/config.php
return [
    'debug' => true,
    // ...
];
```

## Maintenance

### Sauvegardes

Le contenu est stocké en YAML dans `site/content/`. Créer des sauvegardes régulières :

```bash
tar -czf backup-$(date +%Y%m%d).tar.gz site/content/
```

### Mise à jour

```bash
composer update
```

### Cache

Vider le cache manuellement :

```bash
rm -rf storage/cache/*
```

## Fonctionnalités JavaScript

- **Navigation mobile** : Toggle du menu sur petits écrans
- **Smooth scroll** : Défilement doux vers les ancres
- **Intersection Observer** : Animations au scroll
- **Form validation** : Validation basique avec honeypot
- **Table of contents** : Sommaire automatique pour articles longs
- **Back to top** : Bouton retour en haut
- **Lazy loading** : Chargement images avec `data-src`

## SEO

Le projet inclut :
- Meta descriptions configurables
- OpenGraph pour réseaux sociaux
- Canonical URLs
- Sitemap automatique
- Breadcrumbs structurés
- Heading hierarchy appropriée
- Images optimisées avec srcsets

## Accessibilité

- Navigation au clavier
- Labels associés aux formulaires
- ARIA attributes appropriés
- Contraste de couleurs conforme WCAG AA
- Focus visible sur tous les éléments interactifs
- Contenu pour lecteurs d'écran

## Support & Documentation

- Kirby Docs : https://getkirby.com/docs
- Forum Kirby : https://forum.getkirby.com
- GitHub Issues : Pour les bugs spécifiques au projet

## Licence

Propriétaire - Tous droits réservés à la Commune de Jettingen.

## Auteurs

- Structure initiale : Kirby Starter Template
- Design et intégration : Pour Jettingen.fr
- Développement : [Votre nom/équipe]

---

**Dernière mise à jour** : 2026-04-01
**Version Kirby** : ^5.0
**PHP minimum** : 8.2
