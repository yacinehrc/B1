# Cybersécurité — Sécurisation du Poste Client Windows 11

> Déploiement et durcissement d'un poste client Windows 11 Professionnel N sous VMware, en appliquant les recommandations de l'**ANSSI** pour sécuriser un environnement professionnel de bout en bout.

---

## Contexte

Dans le cadre d'un renouvellement de parc informatique pour la société fictive **G5K France**, j'ai été missionné en tant que technicien informatique pour réceptionner, configurer et sécuriser les nouveaux postes clients (Lenovo ThinkPad E15 Gen 4).

L'ensemble du déploiement a été réalisé dans une machine virtuelle **VMware Workstation** (2 vCPU, 4 Go RAM, 100 Go disque, réseau NAT) sous **Windows 11 Professionnel N**, afin de produire un master reproductible avant déploiement en production.

---

## Compétences mobilisées

- Déployer les moyens appropriés de preuve électronique
- Identifier les menaces et mettre en œuvre les défenses appropriées
- Gérer les accès et les privilèges au plus juste (principe du moindre privilège)
- Vérifier l'efficacité des protections mises en place

---

## Ce que ce projet m'a apporté

Ce TP m'a permis d'appréhender concrètement la **sécurisation d'un poste client en entreprise**, au-delà de la simple installation d'un système d'exploitation. J'ai compris l'importance de chaque mesure de durcissement, leur justification vis-à-vis des menaces réelles, et comment les recommandations de l'ANSSI se traduisent en actions techniques précises.

J'ai notamment pris conscience que la sécurité d'un poste ne repose pas sur un seul mécanisme, mais sur une **approche en couches** : cloisonnement des données, chiffrement, gestion des comptes, journalisation, mise à jour automatisée et restriction des applications. Chaque couche compense les limites des autres.

---

## Étapes de déploiement et de sécurisation

### A. Création de la machine virtuelle

Configuration d'une VM VMware avec ajout d'un module **TPM (Trusted Platform Module)**, prérequis indispensable pour l'activation de BitLocker et l'installation de Windows 11.

---

### B. Partitionnement du disque

Création de trois partitions distinctes dès l'installation, conformément aux recommandations ANSSI (R21) :

| Lecteur | Nom | Taille | Usage |
|---|---|---|---|
| C:\ | SYSTEM | 60 Go | Système d'exploitation |
| D:\ | DATA | 35 Go | Données utilisateurs |
| E:\ | LOGS | 5 Go | Journaux d'événements dédiés |

> **Pourquoi ?** Séparer les journaux sur une partition dédiée garantit leur intégrité et leur disponibilité même si la partition système est compromise ou saturée.

---

### C. Convention de nommage des postes

Définition d'une politique de nommage structurée intégrant le pays, la ville, le type de machine et un numéro séquentiel.

**Exemple appliqué :** `FRLIPOR001`
→ FR (France) · LI (Lille) · POR (Portable) · 001 (numéro de séquence)

---

### D & E. Création des comptes utilisateurs

- Création d'un compte **local** (sans liaison à un compte Microsoft) via l'option *"Joindre le domaine à la place"*
- Compte utilisateur métier nommé selon la convention `prenom.nom` pour éviter les conflits avec les homonymes
- Compte du service informatique **SIT** avec privilèges élevés
- Compte **Administrateur local désactivé** (compte connu = vecteur d'attaque)
- Application du **principe du moindre privilège** : chaque utilisateur est placé dans le groupe `Utilisateurs` (non `Administrateurs`)

---

### F. Nommage et formatage des partitions

Formatage en **NTFS** des partitions brutes créées à l'installation et attribution des lettres de lecteur et étiquettes de volume (`SYSTEM`, `DATA`, `LOGS`).

---

### G. Synchronisation des horloges (NTP)

Configuration du serveur NTP français `fr.pool.ntp.org` pour garantir un **horodatage fiable et cohérent** sur l'ensemble du parc — condition indispensable pour l'exploitabilité des journaux d'événements.

> **ANSSI R5 :** Les horloges des équipements doivent être synchronisées sur des sources de temps internes cohérentes entre elles.

---

### H. Chiffrement du disque avec BitLocker

**Démonstration de la vulnérabilité :** démarrage sur un Live CD Fedora et montage de la partition Windows via `sudo mount /dev/nvme0n1p3 /tmp/win` → accès complet aux fichiers utilisateurs **sans aucun mot de passe**.

**Remédiation :** activation de **BitLocker (XTS-AES)** sur les trois partitions avec sauvegarde de la clé de récupération au format PDF.

**Vérification :** après chiffrement, la même tentative depuis Fedora retourne `unknown filesystem type 'BitLocker'` — les données sont inaccessibles.

---

### I. Désactivation de la collecte de données Windows

Désactivation de l'ensemble des télémétries Windows 11 pour réduire la surface d'exposition des données :

- Identifiant publicitaire et personnalisation
- Dictionnaire personnel d'entrée manuscrite
- Expériences personnalisées et données de diagnostic
- Historique des activités
- Suppression des tâches planifiées du dossier **Application Experience** (Planificateur de tâches)

---

### J. Journaux d'événements — Relocalisation et rotation

- Déplacement du répertoire de stockage des journaux vers `E:\Logs\` (partition dédiée)
- Configuration de l'**archivage automatique** à saturation pour chaque canal (Application, Sécurité, Système, Installation)
- Taille maximale des journaux fixée à 20 480 Ko par canal

> **ANSSI R24 :** Une politique de rotation des journaux d'événements doit être formalisée et mise en œuvre sur l'ensemble des équipements du système de journalisation.

---

### K. Gestionnaire de mots de passe

Déploiement d'un **coffre-fort de mots de passe** open-source avec extension navigateur pour intégration transparente dans le quotidien de l'utilisateur.

> **ANSSI R31 :** Il est recommandé que les responsables du SI mettent à disposition des utilisateurs un coffre-fort de mots de passe et les forment à son utilisation.

---

### L. Politique de mots de passe (Stratégie de sécurité locale)

Configuration via `secpol.msc` :

| Paramètre | Valeur appliquée |
|---|---|
| Longueur minimale | 12 caractères (niveau Moyen à fort) |
| Durée de vie maximale | 90 jours |
| Durée de vie minimale | 1 jour |
| Historique | 10 mots de passe mémorisés |
| Complexité | Activée |
| Verrouillage du compte | 5 tentatives échouées |

> **ANSSI R20/R21/R22/R23 :** politique de mots de passe adaptée au contexte, longueur minimale imposée, pas de longueur maximale, règles de complexité activées.

---

### L. Verrouillage automatique de session

Configuration du délai d'inactivité avant verrouillage à **5 minutes** via les options d'alimentation avancées.

> **ANSSI R15 :** La durée d'inactivité avant verrouillage doit être un compromis entre sécurité physique et besoins métiers. Valeur maximale recommandée : 5 minutes.

---

### M. Élévation de privilèges ciblée avec RunAsTool

Utilisation de **RunAsTool** pour permettre à un utilisateur standard d'exécuter des applications nécessitant des droits administrateurs (ex. PowerShell admin) **sans lui attribuer le rôle Administrateur**.

Le raccourci est déployé dans `C:\Users\Public\Desktop` pour être accessible à tous les profils.

---

### N. Mises à jour de sécurité automatisées

Configuration de **Windows Update** avec une plage d'heures d'activité de 08h00 à 18h00, afin que les mises à jour et redémarrages s'effectuent en dehors des heures de travail.

---

### O. Déploiement et mise à jour automatique des applications avec Chocolatey

Installation de **Chocolatey** (gestionnaire de paquets Windows) et déploiement des applications requises en une seule commande :

```powershell
choco install firefox 7zip vlc notepadplusplus -y
```

Mise à jour automatique de l'ensemble des logiciels installés :

```powershell
choco upgrade all -y
```

Cette commande est planifiée via le **Planificateur de tâches** pour s'exécuter automatiquement chaque jour à 12h.

---

### P. Green IT — Extinction automatique

Création d'une tâche planifiée déclenchant `shutdown.exe /s` chaque jour à 19h pour réduire la consommation électrique des postes en dehors des heures de bureau.

---

### Q. AppLocker — Restriction d'exécution d'applications

Activation d'**AppLocker** via l'éditeur de stratégie de groupe locale (`gpedit.msc`) et création de règles d'exécution pour restreindre l'accès à des applications spécifiques selon les utilisateurs ou groupes.

**Test réalisé :** blocage de la Calculatrice Windows pour un utilisateur du groupe `Utilisateurs` → message *"Cette application a été bloquée par votre administrateur système."*

---

## Synthèse des mesures ANSSI appliquées

| Référence | Recommandation | Statut |
|---|---|---|
| R5 | Synchronisation NTP | ✅ |
| R15 | Verrouillage automatique ≤ 5 min | ✅ |
| R20 | Politique de mots de passe adaptée | ✅ |
| R21 | Longueur minimale imposée / Partition journaux | ✅ |
| R22 | Pas de longueur maximale | ✅ |
| R23 | Complexité des mots de passe | ✅ |
| R24 | Rotation des journaux d'événements | ✅ |
| R25 | Expiration des mots de passe comptes à privilèges | ✅ |
| R31 | Coffre-fort de mots de passe | ✅ |

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*  
