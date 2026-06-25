# Gestionnaire de Tâches (To-Do List)

Ce projet consiste en une application web de gestion de tâches permettant de concevoir et de manipuler une base de données relationnelle à travers un environnement de développement local.

L'objectif principal était d'appréhender l'architecture d'un serveur local (XAMPP), de comprendre les interactions entre le langage PHP et MySQL, et de mettre en œuvre le concept fondamental du **CRUD** (Create, Read, Update, Delete).

---

## Démo en ligne
L'application est hébergée et accessible à l'adresse suivante : [https://www.yharrache.free.nf/ProjetPHP/](https://www.yharrache.free.nf/ProjetPHP/)

---

## Fonctionnalités et Parcours Utilisateur

L'interface principale se compose de trois sections majeures : la liste des tâches en cours, la liste des tâches terminées, et un accès au formulaire de création.

<img width="1918" height="905" alt="Interface principale" src="https://github.com/user-attachments/assets/73c553e0-db31-4f84-9add-d65497a1267f" />

### 1. Création d'une tâche (Create)
L'action sur le bouton de création ouvre un formulaire dédié. L'utilisateur peut y saisir le titre de la tâche ainsi qu'une description optionnelle.

<img width="1920" height="909" alt="Formulaire de création" src="https://github.com/user-attachments/assets/0c1855e7-4d5e-4717-b004-1e8ce8002825" />
<img width="1913" height="912" alt="Saisie d'une tâche" src="https://github.com/user-attachments/assets/38071fa0-837b-4a26-a6cb-3a5d4b5e0e32" />

Après validation, la tâche est enregistrée en base de données et s'affiche dynamiquement dans la liste des éléments à réaliser.

<img width="1909" height="905" alt="Affichage après création" src="https://github.com/user-attachments/assets/011eae4f-dfbd-4420-a30f-5944cfa085d4" />

### 2. Modification d'une tâche (Update)
L'interface intègre une option de modification accessible via l'icône d'édition. Elle permet de mettre à jour le titre ou les détails d'une tâche existante.

<img width="1909" height="911" alt="Formulaire de modification" src="https://github.com/user-attachments/assets/56052b4d-e7fc-49bf-a621-157702179a7e" />

Une fois les modifications enregistrées, l'affichage est actualisé avec les nouvelles informations.

<img width="1911" height="919" alt="Tâche modifiée" src="https://github.com/user-attachments/assets/677cb1ef-3323-43c9-9e23-9eb6b459774d" />

### 3. Gestion du statut et archivage
En cochant la case située à gauche d'une tâche, son statut évolue vers "terminée". La tâche est alors transférée visuellement dans la section des éléments conclus et son texte est barré pour symboliser sa complétion.

<img width="1915" height="908" alt="Tâche validée" src="https://github.com/user-attachments/assets/912171e0-023f-4ffe-84f4-65d69ce1e521" />

### 4. Suppression d'une tâche (Delete)
L'utilisateur peut supprimer définitivement une tâche à l'aide de l'icône de suppression. Par mesure de sécurité, une boîte de dialogue de confirmation s'affiche avant la suppression effective en base de données.

<img width="1909" height="912" alt="Fenêtre de confirmation de suppression" src="https://github.com/user-attachments/assets/4c375079-6779-499c-bc1a-1469f4cd2dfe" />

### 5. Ergonomie (Mode Sombre / Clair)
L'application intègre également un sélecteur de thème permettant de basculer entre un mode clair et un mode sombre pour améliorer le confort visuel de l'utilisateur.

<img width="1906" height="907" alt="Mode sombre activé" src="https://github.com/user-attachments/assets/e9094705-a282-46ef-ab1d-959dc46090d5" />

---

## Technologies utilisées
- **Backend :** PHP
- **Base de données :** MySQL (MariaDB)
- **Environnement de développement :** XAMPP
- **Frontend :** HTML5 / CSS3

---

## Perspectives d'évolution
- **Système de corbeille :** Mettre en place une suppression logique (*soft delete*) afin de permettre la récupération d'une tâche supprimée par erreur.
- **Catégorisation et priorisation :** Ajouter un système d'étiquettes de couleur pour classifier les tâches par matière ou par niveau d'importance.
- **Fonctionnalités collaboratives :** Développer une gestion d'utilisateurs permettant le partage et la gestion de tâches à plusieurs.

---

## Compétences acquises
Le développement de cette application a permis de consolider des compétences techniques essentielles du parcours informatique (BTS SIO) :
- Administration et utilisation d'un environnement de développement local.
- Programmation logique et dynamique avec le langage PHP.
- Conception, modélisation et manipulation d'une base de données relationnelle SQL.
