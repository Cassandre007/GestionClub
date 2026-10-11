# GestionClub

Application de gestion de club de théâtre (PHP / MySQL).

## Stack front-end : Tailwind CSS v4 + DaisyUI 5

Le CSS est compilé avec l'outil en ligne de commande de Tailwind (`@tailwindcss/cli`).

### Installation (une seule fois)

Nécessite [Node.js](https://nodejs.org/) :

```bash
npm install
```

### Développement

Recompile le CSS automatiquement à chaque modification (classes scannées dans tout le projet, y compris les fichiers `.php`) :

```bash
npm run dev
```

### Production

Génère le CSS minifié :

```bash
npm run build
```

### Utilisation dans les pages PHP

1. Laisser tourner `npm run dev` pendant le développement.
2. Lier le CSS compilé dans le `<head>` :

```html
<link rel="stylesheet" href="assets/css/app.css">
```

3. Utiliser les classes Tailwind et les composants DaisyUI (`btn`, `card`, `navbar`…) directement dans le HTML.
4. Choisir le thème DaisyUI via l'attribut `data-theme` sur `<html>` (ex. `light`, `dark`).

### Fichiers

| Fichier | Rôle |
|---|---|
| `src/input.css` | Source CSS (`@import "tailwindcss"` + `@plugin "daisyui"`) |
| `public/assets/css/app.css` | CSS compilé (généré, **non versionné**) |
| `public/index.php` | Page de démonstration |

Voir la doc : [Tailwind CSS](https://tailwindcss.com/docs) · [DaisyUI](https://daisyui.com/docs/)
