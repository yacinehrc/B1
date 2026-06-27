# Gestionnaire de Tâches (To-Do List)

![Interface principale](https://github.com/user-attachments/assets/73c553e0-db31-4f84-9add-d65497a1267f)

> Application web CRUD de gestion de tâches — développée avec PHP, MySQL et XAMPP dans le cadre du BTS SIO.
>
> 🔗 **[Voir la démo en ligne](https://www.yharrache.free.nf/ProjetPHP/)**

---

## Introduction

Dans le cadre de la découverte du développement web back-end, ce projet consistait à concevoir une application de gestion de tâches en **PHP** connectée à une base de données **MySQL**. L'objectif principal était de mettre en œuvre le cycle complet du **CRUD** (Create, Read, Update, Delete) à travers un environnement de développement local piloté par **XAMPP**.

---

## Fonctionnalités

L'interface principale se compose de trois sections majeures : la liste des tâches en cours, la liste des tâches terminées, et un accès au formulaire de création.

- **Création de tâche** : formulaire dédié avec titre et description optionnelle, enregistrement immédiat en base de données
- **Modification de tâche** : mise à jour du titre ou du contenu via une icône d'édition
- **Gestion du statut** : cocher une tâche la bascule en "terminée" et la transfère dans la section archivée (texte barré)
- **Suppression sécurisée** : boîte de dialogue de confirmation avant toute suppression définitive en base de données
- **Thème clair / sombre** : sélecteur de thème intégré pour le confort visuel

---

## Démonstration

### Création d'une tâche

Le formulaire de création permet de saisir le titre de la tâche ainsi qu'une description optionnelle.

![Formulaire de création](https://github.com/user-attachments/assets/0c1855e7-4d5e-4717-b004-1e8ce8002825)

![Saisie d'une tâche](https://github.com/user-attachments/assets/38071fa0-837b-4a26-a6cb-3a5d4b5e0e32)

Après validation, la tâche s'affiche dynamiquement dans la liste des éléments à réaliser.

![Affichage après création](https://github.com/user-attachments/assets/011eae4f-dfbd-4420-a30f-5944cfa085d4)

### Modification d'une tâche

L'icône d'édition ouvre un formulaire de mise à jour permettant de modifier le titre ou les détails d'une tâche existante.

![Formulaire de modification](https://github.com/user-attachments/assets/56052b4d-e7fc-49bf-a621-157702179a7e)

![Tâche modifiée](https://github.com/user-attachments/assets/677cb1ef-3323-43c9-9e23-9eb6b459774d)

### Gestion du statut

En cochant la case d'une tâche, son statut bascule vers "terminée" : elle est transférée dans la section des éléments conclus et son texte est barré.

![Tâche validée](https://github.com/user-attachments/assets/912171e0-023f-4ffe-84f4-65d69ce1e521)

### Suppression d'une tâche

Une boîte de dialogue de confirmation s'affiche avant toute suppression définitive, évitant les suppressions accidentelles.

![Confirmation de suppression](https://github.com/user-attachments/assets/4c375079-6779-499c-bc1a-1469f4cd2dfe)

### Thème clair / sombre

Un sélecteur de thème permet de basculer entre mode clair et mode sombre pour améliorer le confort visuel.

![Mode sombre activé](https://github.com/user-attachments/assets/e9094705-a282-46ef-ab1d-959dc46090d5)

---

## Conclusion

Ce projet a permis d'acquérir les bases solides du développement web back-end : structuration d'une base de données relationnelle en **MySQL**, programmation dynamique côté serveur en **PHP**, et intégration front-end en **HTML5 / CSS3**. La mise en pratique du CRUD a notamment ouvert la voie à une compréhension plus profonde des interactions client-serveur et de la persistance des données.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
