# Site de Gestion de Tickets — L'Atelier des Jeux

![Interface de connexion](https://github.com/user-attachments/assets/26d00138-6744-4a44-8ad5-108486dd6b88)

> Gestionnaire de tickets multi-rôles pour la société "L'Atelier des Jeux" — avec tableaux de bord dédiés, suivi de statut en temps réel et traçabilité des connexions, développé en PHP et MySQL.
>
> 🔗 **[Accéder au site](https://www.yharrache.free.nf/atelier_des_jeux)**

---

## Introduction

Ce projet est un **gestionnaire de tickets** complet développé dans le cadre du **BTS SIO** (EPSI Lille), en binôme. Il repose sur une architecture PHP/MySQL structurée autour de **trois rôles distincts** : l'utilisateur soumet des tickets, le technicien les traite et met à jour leurs statuts, l'administrateur supervise les comptes et consulte les logs de connexion. La sécurité a été au cœur du développement : requêtes préparées contre les injections SQL, protection XSS via `htmlspecialchars()`, hachage des mots de passe et isolation des interfaces par rôle via `$_SESSION['role']`.

---

## Fonctionnalités

- **Authentification multi-rôles** : Administrateur, Technicien, Utilisateur et Inactif — chaque rôle accède à une interface dédiée
- **Gestion des tickets** : création avec sujet, catégorie et description, suivi de statut (Ouvert, En cours, Fermé), modification et suppression
- **Dashboard Administrateur** : statistiques en temps réel sur les utilisateurs, gestion CRUD des comptes et historique des connexions avec horodatage
- **Dashboard Technicien** : vue globale des volumes de tickets par statut, accès et mise à jour de chaque ticket
- **Sécurité** : requêtes préparées (`prepare()` / `execute()`), protection XSS, gestion stricte des sessions, système d'audit des actions critiques
- **Désactivation automatique** : les comptes sans activité depuis plus d'un mois sont automatiquement désactivés

---

## Démonstration

### Authentification

La page de connexion vérifie les identifiants et redirige chaque utilisateur vers son interface selon son rôle.

![Interface de connexion](https://github.com/user-attachments/assets/26d00138-6744-4a44-8ad5-108486dd6b88)

La création de compte génère automatiquement un identifiant (initiale du prénom + nom) et assigne le rôle utilisateur par défaut.

![Interface de création de compte](https://github.com/user-attachments/assets/9a899c66-4976-48f1-a802-bed05155fcd9)

### Espace Administrateur

Le dashboard affiche les statistiques de répartition des utilisateurs et les dernières activités en temps réel.

![Dashboard administrateur](https://github.com/user-attachments/assets/48b22743-99e3-4ee9-a44c-bba99ed25f17)

La gestion des comptes permet de créer, modifier, supprimer ou changer le rôle de n'importe quel utilisateur, technicien ou administrateur.

![Gestion des comptes](https://github.com/user-attachments/assets/0a9526af-5d9f-43f8-8773-0c926a554ac0)

Le tableau des logs retrace chaque connexion avec l'heure précise, permettant une traçabilité complète du système.

![Historique des connexions](https://github.com/user-attachments/assets/73d10e3f-20b1-4ad5-bb8d-50f7f1f9d36a)

![Paramètres du compte administrateur](https://github.com/user-attachments/assets/a6382dbf-341e-4d9c-90d6-4b6a5de7e175)

### Espace Technicien

Le dashboard technicien affiche les volumes de tickets par statut pour prioriser le traitement.

![Dashboard technicien](https://github.com/user-attachments/assets/85400624-3baf-4624-82d7-8fcfdd26423e)

La vue détaillée d'un ticket permet de consulter la demande et de mettre à jour son statut via la structure `match` de PHP 8.

![Vue d'un ticket](https://github.com/user-attachments/assets/8909dbc4-8e06-4539-8388-9f5ab6f06c0d)

![Paramètres du compte technicien](https://github.com/user-attachments/assets/20c76e92-72f5-46ef-a61a-edfa9378c9be)

### Espace Utilisateur

Le dashboard utilisateur permet de soumettre un ticket avec un sujet, une catégorie et une description détaillée.

![Dashboard utilisateur](https://github.com/user-attachments/assets/0dcf10c9-5b17-489b-9fb2-e54a19af15ef)

L'historique liste tous les tickets soumis avec leur statut actuel pour un suivi en temps réel.

![Historique des tickets](https://github.com/user-attachments/assets/74ea4578-2d75-451f-87c5-92d08fe16663)

![Paramètres du compte utilisateur](https://github.com/user-attachments/assets/8f554a63-7bbf-430d-86a4-8dded40411b0)

### Base de données

Le schéma repose sur deux tables principales — `tickets` et `utilisateurs` — liées par une clé étrangère garantissant l'intégrité référentielle.

![Tables de la base de données](https://github.com/user-attachments/assets/39cd07f5-f0ec-4279-a990-3ce9c82ec4e2)

![Détail table tickets](https://github.com/user-attachments/assets/60044110-b874-4545-9629-735845122324)

![Détail table utilisateurs](https://github.com/user-attachments/assets/8ddf3edc-face-4654-9f78-08cf2204dfcf)

Le Modèle Conceptuel de Données formalise les relations entre entités.

![MCD](./mcd.jpeg)

![Dictionnaire de données — utilisateurs](https://github.com/user-attachments/assets/a95e8ac7-37ed-4c81-b5ec-8529064bcf8c)

![Dictionnaire de données — tickets](https://github.com/user-attachments/assets/171ff625-473b-4fc6-8851-3f5c78ea0726)

---

## Identifiants de test

| Rôle | Identifiant | Mot de passe |
|---|---|---|
| Technicien | technicien | tech123 |
| Utilisateur | mdupont | password |

Vous pouvez également créer votre propre compte via le formulaire d'inscription.

---

## Perspectives d'évolution

- **Notifications** : alertes par email ou en temps réel lors d'un changement de statut
- **Priorisation** : système de niveaux d'urgence sur les tickets
- **Chat intégré** : messagerie directe entre utilisateur et technicien sur un ticket
- **Pièces jointes** : possibilité de joindre des fichiers à une demande
- **Sécurité renforcée** : confirmation par email à l'inscription et authentification à deux facteurs

---

## Conclusion

Ce projet en binôme a permis de concevoir un système complet de la base de données jusqu'à l'interface, en maîtrisant la gestion des rôles, le CRUD PHP/MySQL, et les bonnes pratiques de sécurité web. L'implémentation des requêtes préparées, de la protection XSS et du système d'audit a constitué un apprentissage concret des enjeux de sécurité applicative en environnement de production.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) & [Oumaima Saoui](https://github.com/oumaimasaoui377) — BTS SIO SLAM | EPSI Lille*
