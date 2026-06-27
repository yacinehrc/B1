# Répertoire de Contacts

<img width="1875" height="917" alt="Capture d&#39;écran 2025-12-30 163846" src="https://github.com/user-attachments/assets/213c80fa-b784-4f44-93a9-90eee896d655" />

> Application web de gestion de contacts professionnels et personnels — avec import CSV, thème clair/sombre, favoris et suppression logique, développée en HTML5, CSS3, JavaScript vanilla et PHP/MySQL.

---

## Introduction

Ce projet est une application de **répertoire de contacts** développée dans le cadre du **BTS SIO** (EPSI Lille). Elle se compose de deux couches complémentaires : une interface front-end en **JavaScript vanilla** avec persistance `localStorage`, et un back-end en **PHP/MySQL** gérant le CRUD complet côté serveur. L'objectif était de concevoir une interface moderne inspirée des applications mobiles natives (Material Design), tout en maîtrisant la gestion de données côté serveur avec une **suppression logique** (corbeille) plutôt que physique.

---

## Fonctionnalités

- **Double onglet** : séparation des contacts Professionnels et Personnels avec champs adaptés à chaque type
- **Ajout de contact** : formulaire modal avec champs dynamiques selon le type sélectionné (entreprise, poste, téléphone, email, adresse)
- **Recherche en temps réel** : filtre instantané par nom ou entreprise sans rechargement de page
- **Favoris** : marquage d'un contact avec une étoile, persisté en `localStorage`
- **Import CSV** : chargement d'un fichier `.csv` pour importer des contacts en masse
- **Suppression logique** : les contacts supprimés passent en corbeille (flag `Supprime = 1`) et peuvent être restaurés ou définitivement effacés
- **Thème clair / sombre** : bascule avec persistance de la préférence via `localStorage`
- **Avatar initiales** : génération automatique des initiales du contact en guise d'avatar
- **Bouton FAB** : bouton d'ajout flottant fixe en bas à droite, inspiré des UI mobiles

---

## Démonstration

### Interface de connexion

Le site permet une connexion sécurisée avec un nom d'utilisateur et un mot de passe (hashé en MD5 dans la base de données).

<img width="641" height="586" alt="Capture d&#39;écran 2025-12-16 224324" src="https://github.com/user-attachments/assets/3a4b91e2-5765-4a5a-be1b-d4847e38522e" />

### Interface principale

La grille de contacts s'adapte automatiquement à la largeur d'écran. Chaque carte affiche les initiales, le poste, l'entreprise et les coordonnées du contact.

<img width="1871" height="912" alt="Capture d&#39;écran 2025-12-30 192821" src="https://github.com/user-attachments/assets/3dedf037-5b0e-47c3-afef-eec2e888586e" />

### Ajout d'un contact

Le bouton FAB ouvre une modal avec un sélecteur de type. Les champs s'adaptent dynamiquement : mode professionnel (entreprise, poste, téléphone pro, email pro) ou personnel (téléphone, email, adresse).

Nous pouvons donc ajouter des contacts, ici un contact professionnel.

<img width="1875" height="909" alt="Capture d&#39;écran 2025-12-30 193830" src="https://github.com/user-attachments/assets/7e645f93-113e-4f41-b81d-222952865a4a" />

### Recherche et filtres

La barre de recherche filtre les contacts en temps réel par nom ou entreprise. Un message vide s'affiche si aucun résultat ne correspond.

### Import CSV

Le bouton d'import en haut à droite permet de charger un fichier `.csv` pour importer des contacts en masse. Le parseur détecte automatiquement l'en-tête et mappe les colonnes Nom, Entreprise, Téléphone et Email.

### Corbeille et suppression logique (PHP)

Côté back-end, la suppression d'un contact lève un flag `Supprime = 1` en base de données. L'onglet corbeille liste les contacts supprimés avec les options "Restaurer" ou "Supprimer définitivement".


---

## Conclusion

Ce projet a permis de consolider mes compétences en PHP, HTML et CSS, et en SQL pour la création de la base de données. Cela m'a aussi permis de comprendre le fonctionnement de comment nous pouvons gérer la partie "professionnelle" et "personnelle" d'un gestionnaire.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc), [Louis Agthe](https://github.com/LGame127) [Oumaima Saoui](https://github.com/oumaimasaoui377)et [Théo Blaise](https://github.com/theoblaise1) — BTS SIO SLAM | EPSI Lille*
