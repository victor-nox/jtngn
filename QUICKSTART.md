# Démarrage rapide - Jettingen.fr

Guide de démarrage en 5 minutes pour mettre en place le site.

## Étape 1 : Installation basique (2 min)

```bash
# Naviguer vers le répertoire du projet
cd kirby-jettingen

# Installer les dépendances Kirby
composer install

# Attendre que tout se télécharge (~30-60 secondes)
```

## Étape 2 : Démarrer le serveur local (1 min)

```bash
# Ouvrir un terminal dans le dossier kirby-jettingen
php -S localhost:8000 kirby/router.php
```

Puis ouvrir dans le navigateur : **http://localhost:8000**

## Étape 3 : Accéder au Panel d'administration (1 min)

Aller à : **http://localhost:8000/panel**

Vous verrez une page pour créer le premier utilisateur.

```
Email : admin@jettingen.fr
Mot de passe : (votre choix)
```

Cliquer sur "Create" et c'est prêt !

## Étape 4 : Créer les pages principales (1 min)

Dans le Panel (vous êtes maintenant connecté) :

1. Cliquer sur "+" en haut à gauche
2. Créer une page "home" (avec le type "Accueil")
3. Publier

Répéter pour les autres pages :
- articles (type "Actualités")
- commune (type "La Commune")
- contact (type "Contact")
- events (type "Événements")
- documents (type "Bibliothèque de documents")
- salle-des-fetes (type "Salle des fêtes")
- ecole (type "École")

## Étape 5 : Remplir le contenu (optionnel)

Pour chaque page, vous pouvez :

1. Remplir les champs
2. Ajouter des images
3. Ajouter du contenu avec les blocs
4. Publier quand c'est prêt

## Structure des pages

```
Accueil (/)
├── La Commune (/commune)
├── Actualités (/articles)
│   ├── Article 1 (/articles/article-1)
│   ├── Article 2
│   └── ...
├── Événements (/events)
│   ├── Événement 1 (/events/event-1)
│   └── ...
├── Contact (/contact)
├── Documents (/documents)
├── Salle des fêtes (/salle-des-fetes)
└── École (/ecole)
```

## Fichiers importants

| Fichier | Rôle |
|---------|------|
| `site/blueprints/site.yml` | Configuration du site (logo, coordonnées, etc.) |
| `site/blueprints/pages/*.yml` | Définition de chaque type de page |
| `site/templates/*.php` | Affichage HTML des pages |
| `site/snippets/*.php` | Composants réutilisables (header, footer, cards) |
| `site/config/config.php` | Configuration générale Kirby |
| `assets/css/style.css` | Tout le CSS du site |
| `assets/js/main.js` | JavaScript (navigation mobile, etc.) |

## Personnalisations rapides

### Changer le logo

1. Panel → Paramètres du site → Logo
2. Télécharger une image
3. Sauvegarder

### Changer les couleurs

Éditer `assets/css/style.css`, variables au début :

```css
:root {
  --color-primary: #5B7F3B;      /* Vert principal */
  --color-secondary: #8B6F47;    /* Marron */
  --color-accent: #D4A853;       /* Doré */
}
```

### Changer les coordonnées du site

Panel → Paramètres du site :
- Adresse
- Téléphone
- Email
- Horaires d'ouverture

### Ajouter les réseaux sociaux

Panel → Paramètres du site → Réseaux sociaux

Ajouter chaque plateforme (Facebook, Instagram, etc.) avec le lien.

## Plugins utiles

Pour installer un plugin :

```bash
composer require tobimori/kirby-seo
```

Plugins recommandés :
- `tobimori/kirby-seo` : Gestion SEO automatique
- `bnomei/kirby-uniform` : Meilleur traitement des formulaires

## Mode production

Quand le site est prêt :

1. Éditer `site/config/config.php` :
   ```php
   'debug' => false,  // Désactiver le debug
   ```

2. Vérifier les permissions des dossiers :
   ```bash
   chmod -R 755 site/content
   chmod -R 755 storage
   ```

3. Sauvegarder la base de données (site/content/)

4. Déployer sur le serveur

## Support

- **Documentation Kirby** : https://getkirby.com/docs
- **Forum Kirby** : https://forum.getkirby.com
- **Fichier README** : `README.md` pour plus de détails

---

Vous êtes maintenant prêt à commencer ! 🎉
