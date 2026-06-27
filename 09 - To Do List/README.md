# Gestionnaire de Tâches (To-Do List)

# GESTIONNAIRE DE TÂCHES
![Interface principale](https://github.com/user-attachments/assets/73c553e0-db31-4f84-9add-d65497a1267f)

<img width="1918" height="905" alt="Interface principale" src="https://github.com/user-attachments/assets/73c553e0-db31-4f84-9add-d65497a1267f" />
> Application web CRUD de gestion de tâches — développée avec PHP, MySQL et XAMPP dans le cadre du BTS SIO.
>
> 🔗 **[Voir la démo en ligne](https://www.yharrache.free.nf/ProjetPHP/)**

---

## INTRODUCTION

Ce projet est une application web de gestion de tâches développée dans le cadre du **BTS SIO** (EPSI Lille). L'objectif principal était d'appréhender l'architecture d'un serveur local avec XAMPP, de comprendre les interactions entre PHP et MySQL, et de mettre en œuvre le cycle complet du **CRUD** (Create, Read, Update, Delete) sur une base de données relationnelle.

L'interface principale se compose de trois sections majeures : la liste des tâches en cours, la liste des tâches terminées, et un accès au formulaire de création.

**Avantages :**

- Open-Source & Gratuit : Aucun coût de licence, basé sur des technologies standards du web.
- Léger & Rapide : Architecture simple PHP/MySQL, sans framework superflu.
- CRUD complet : Toutes les opérations de base de données sont couvertes (Create, Read, Update, Delete).
- Ergonomie : Thème clair/sombre intégré et confirmation avant suppression pour éviter les erreurs.
## Introduction

**Inconvénients :**

- Monoposte : L'application est conçue pour un usage local, sans gestion d'utilisateurs ni accès distant natif.
- Stockage SQL uniquement : Les données sont liées à la base de données locale, sans export ni synchronisation.
Dans le cadre de la découverte du développement web back-end, ce projet consistait à concevoir une application de gestion de tâches en **PHP** connectée à une base de données **MySQL**. L'objectif principal était de mettre en œuvre le cycle complet du **CRUD** (Create, Read, Update, Delete) à travers un environnement de développement local piloté par **XAMPP**.

---

## CRÉATION D'UNE TÂCHE

L'action sur le bouton de création ouvre un formulaire dédié. L'utilisateur peut y saisir le titre de la tâche ainsi qu'une description optionnelle.

<img width="1920" height="909" alt="Formulaire de création" src="https://github.com/user-attachments/assets/0c1855e7-4d5e-4717-b004-1e8ce8002825" />
## Fonctionnalités

Il suffit de remplir le champ titre, la description est optionnelle.

<img width="1913" height="912" alt="Saisie d'une tâche" src="https://github.com/user-attachments/assets/38071fa0-837b-4a26-a6cb-3a5d4b5e0e32" />

Après validation, la tâche est enregistrée en base de données et s'affiche dynamiquement dans la liste des éléments à réaliser.
L'interface principale se compose de trois sections majeures : la liste des tâches en cours, la liste des tâches terminées, et un accès au formulaire de création.

<img width="1909" height="905" alt="Affichage après création" src="https://github.com/user-attachments/assets/011eae4f-dfbd-4420-a30f-5944cfa085d4" />
- **Création de tâche** : formulaire dédié avec titre et description optionnelle, enregistrement immédiat en base de données
- **Modification de tâche** : mise à jour du titre ou du contenu via une icône d'édition
- **Gestion du statut** : cocher une tâche la bascule en "terminée" et la transfère dans la section archivée (texte barré)
- **Suppression sécurisée** : boîte de dialogue de confirmation avant toute suppression définitive en base de données
- **Thème clair / sombre** : sélecteur de thème intégré pour le confort visuel

---

## MODIFICATION D'UNE TÂCHE
## Démonstration

L'interface intègre une option de modification accessible via l'icône d'édition. Elle permet de mettre à jour le titre ou les détails d'une tâche existante.
### Création d'une tâche

<img width="1909" height="911" alt="Formulaire de modification" src="https://github.com/user-attachments/assets/56052b4d-e7fc-49bf-a621-157702179a7e" />
Le formulaire de création permet de saisir le titre de la tâche ainsi qu'une description optionnelle.

Une fois les modifications enregistrées, l'affichage est immédiatement actualisé avec les nouvelles informations.
![Formulaire de création](https://github.com/user-attachments/assets/0c1855e7-4d5e-4717-b004-1e8ce8002825)

<img width="1911" height="919" alt="Tâche modifiée" src="https://github.com/user-attachments/assets/677cb1ef-3323-43c9-9e23-9eb6b459774d" />
![Saisie d'une tâche](https://github.com/user-attachments/assets/38071fa0-837b-4a26-a6cb-3a5d4b5e0e32)

---

## GESTION DU STATUT

En cochant la case située à gauche d'une tâche, son statut bascule vers **"terminée"**. Elle est alors transférée dans la section des éléments conclus et son texte est barré pour symboliser sa complétion.
Après validation, la tâche s'affiche dynamiquement dans la liste des éléments à réaliser.

<img width="1915" height="908" alt="Tâche validée" src="https://github.com/user-attachments/assets/912171e0-023f-4ffe-84f4-65d69ce1e521" />
![Affichage après création](https://github.com/user-attachments/assets/011eae4f-dfbd-4420-a30f-5944cfa085d4)

---

## SUPPRESSION D'UNE TÂCHE
### Modification d'une tâche

L'utilisateur peut supprimer définitivement une tâche via l'icône de suppression. Par mesure de sécurité, une boîte de dialogue de confirmation s'affiche avant la suppression effective en base de données, évitant ainsi toute suppression accidentelle.
L'icône d'édition ouvre un formulaire de mise à jour permettant de modifier le titre ou les détails d'une tâche existante.

<img width="1909" height="912" alt="Fenêtre de confirmation de suppression" src="https://github.com/user-attachments/assets/4c375079-6779-499c-bc1a-1469f4cd2dfe" />
![Formulaire de modification](https://github.com/user-attachments/assets/56052b4d-e7fc-49bf-a621-157702179a7e)

---
![Tâche modifiée](https://github.com/user-attachments/assets/677cb1ef-3323-43c9-9e23-9eb6b459774d)

## MODE SOMBRE / CLAIR
### Gestion du statut

L'application intègre un sélecteur de thème permettant de basculer entre un mode clair et un mode sombre pour améliorer le confort visuel de l'utilisateur.
En cochant la case d'une tâche, son statut bascule vers "terminée" : elle est transférée dans la section des éléments conclus et son texte est barré.

<img width="1906" height="907" alt="Mode sombre activé" src="https://github.com/user-attachments/assets/e9094705-a282-46ef-ab1d-959dc46090d5" />
![Tâche validée](https://github.com/user-attachments/assets/912171e0-023f-4ffe-84f4-65d69ce1e521)

---
### Suppression d'une tâche

## TECHNOLOGIES UTILISÉES
Une boîte de dialogue de confirmation s'affiche avant toute suppression définitive, évitant les suppressions accidentelles.

| Couche | Technologie |
|---|---|
| **Backend** | PHP |
| **Base de données** | MySQL (MariaDB) |
| **Frontend** | HTML5 / CSS3 |
| **Environnement** | XAMPP (Apache) |
![Confirmation de suppression](https://github.com/user-attachments/assets/4c375079-6779-499c-bc1a-1469f4cd2dfe)

---
### Thème clair / sombre

## PERSPECTIVES D'ÉVOLUTION
Un sélecteur de thème permet de basculer entre mode clair et mode sombre pour améliorer le confort visuel.

- **Système de corbeille :** Mettre en place une suppression logique (*soft delete*) afin de permettre la récupération d'une tâche supprimée par erreur.
- **Catégorisation et priorisation :** Ajouter un système d'étiquettes de couleur pour classifier les tâches par matière ou par niveau d'importance.
- **Fonctionnalités collaboratives :** Développer une gestion d'utilisateurs permettant le partage et la gestion de tâches à plusieurs.
![Mode sombre activé](https://github.com/user-attachments/assets/e9094705-a282-46ef-ab1d-959dc46090d5)

---

## COMPÉTENCES ACQUISES

Le développement de cette application a permis de consolider des compétences techniques essentielles du parcours **BTS SIO** :
## Conclusion

- Administration et utilisation d'un environnement de développement local (XAMPP / Apache).
- Programmation logique et dynamique avec le langage PHP.
- Conception, modélisation et manipulation d'une base de données relationnelle SQL.
- Intégration front-end (HTML5 / CSS3, dark mode, UX).
Ce projet a permis d'acquérir les bases solides du développement web back-end : structuration d'une base de données relationnelle en **MySQL**, programmation dynamique côté serveur en **PHP**, et intégration front-end en **HTML5 / CSS3**. La mise en pratique du CRUD a notamment ouvert la voie à une compréhension plus profonde des interactions client-serveur et de la persistance des données.

---

<div align="center">

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO · EPSI Lille*
