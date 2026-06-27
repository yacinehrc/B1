# Active Directory — Infrastructure NovaTech Industries

<img width="1376" height="716" alt="active_directory" src="https://github.com/user-attachments/assets/7ba2c729-6eb9-48e4-a12b-121e33303c8c" />

> Conception, déploiement et sécurisation d'un annuaire **Active Directory** pour NovaTech Industries — structure organisationnelle en OUs, comptes utilisateurs, groupes de sécurité, GPO par niveau de tiering — réalisé sur **Windows Server 2025**.

---

## Contexte du projet

**NovaTech Industries** est une jeune entreprise lilloise spécialisée dans la robotique industrielle. En pleine croissance (15 → 50 collaborateurs), elle présente de graves lacunes de sécurité :

| Problème identifié | Risque |
|---|---|
| Comptes partagés sans traçabilité | Impossibilité d'auditer les actions |
| Mots de passe faibles / visibles à l'écran | Compromission facile |
| Prestataires ayant accès à l'ensemble du réseau | Surface d'attaque maximale |
| Admins utilisant leurs comptes personnels | Pas de séparation des privilèges |
| Tentative d'intrusion récente sur l'ancien site | Menace active confirmée |

**Mission :** Concevoir et sécuriser l'annuaire Active Directory de NovaTech — structure des OUs, comptes utilisateurs, droits d'accès et stratégies de sécurité.

---

## Prérequis & Installation

### Environnement requis

- **Windows Server 2025** (VM ou machine dédiée) pour le contrôleur de domaine
- **Windows 11** (VM avec snapshot) pour tester les postes clients Tier 1 et Tier 2

### Ressources d'installation

- 📖 Installer le rôle AD DS et configurer un domaine : [rdr-it.com — Windows Server 2025 AD DS](https://rdr-it.com/windows-serveur-2025-installer-le-role-adds-et-configurer-un-domaine-active-directory/)
- 📖 Installer Windows 11 sur PC non compatible : [lecrabeinfo.net](https://lecrabeinfo.net/tutoriels/windows-11-25h2-comment-installer-la-mise-a-jour-sur-un-pc-non-compatible/)

---

## Structure de l'Active Directory

### Arborescence des Unités d'Organisation (OU)

L'arborescence respecte une double logique : **séparation par service** ET **séparation par niveau de tiering**.

```
NovaTech.local
├── Direction
├── IT
│   ├── Tier0          ← Admins domaine (accès total)
│   ├── Tier1          ← Techniciens IT (administration des postes)
│   └── Tier2          ← Utilisateurs standards
├── R&D
├── Production
├── RH
├── Prestataires
├── Admins             ← OU dédiée aux comptes administrateurs (séparée des users)
└── GroupesSecurite    ← OU dédiée aux groupes de sécurité
```

---

## Création des comptes utilisateurs

### Convention de nommage

| Type de compte | Format | Exemple |
|---|---|---|
| Compte standard | 1ère lettre prénom + nom | `amartin` (Alice Martin) |
| Compte admin | `adm_` + identifiant standard | `adm_mhonvault` (Mickael Honvault) |

Voici une session de compte standard :

<img width="1054" height="839" alt="Capture d&#39;écran 2025-12-12 145923" src="https://github.com/user-attachments/assets/bbb9d840-ba4b-4c64-96e0-c6dacf780e77" />

### Règles de création

- **Attributs obligatoires :** Nom complet, service, description du poste
- **Placement :** OU correspondant au service ET au niveau de tier
- **Comptes multiples pour les admins :** un compte standard (usage quotidien) + un compte `adm_` (tâches d'administration uniquement)

### Liste des utilisateurs

| Nom complet | Identifiant | Identifiant admin | Service | Poste | Tier | Groupe(s) AD |
|---|---|---|---|---|---|---|
| Alice Martin | amartin | — | R&D | Ingénieure IA | 2 | G_R&D_Users |
| Thomas Lefebvre | tlefebvre | — | R&D | Développeur embarqué | 2 | G_R&D_Users |
| Julie Moreau | jmoreau | — | Production | Superviseur ligne 1 | 2 | G_Prod_Users |
| Karim Bouchard | kbouchard | — | Production | Opérateur machine | 2 | G_Prod_Users |
| Sophie Dubois | sdubois | — | RH | Responsable RH | 2 | G_RH_Users |
| Hugo Lambert | hlambert | — | RH | Assistant RH | 2 | G_RH_Users |
| Claire Fontaine | cfontaine | adm_cfontaine | Direction | PDG | 0 | G_Dir_Users, G_Tier0_Admins |
| Marc Petit | mpetit | — | Direction | DAF | 2 | G_Dir_Users |
| Mickael Honvault | mhonvault | adm_mhonvault | IT | Admin Système & Réseau | 0 | G_Tier0_Admins |
| Lucas Bernard | lbernard | adm_lbernard | IT | Technicien Réseau | 1 | G_Tier1_IT |
| Prestataire 1 | guest01 | — | Prestataire | Consultant ERP | 2 | G_Guests |
| Prestataire 2 | guest02 | — | Prestataire | — | 2 | G_Guests |

---

## Groupes de sécurité

### Groupes par service

| Groupe | Membres |
|---|---|
| `G_R&D_Users` | amartin, tlefebvre |
| `G_Prod_Users` | jmoreau, kbouchard |
| `G_RH_Users` | sdubois, hlambert |
| `G_Dir_Users` | cfontaine, mpetit |
| `G_Guests` | guest01, guest02 |

### Groupes par niveau de tiering

| Groupe | Membres | Niveau |
|---|---|---|
| `G_Tier0_Admins` | adm_cfontaine, adm_mhonvault | Tier 0 — Admins domaine |
| `G_Tier1_IT` | adm_lbernard | Tier 1 — Techniciens IT |
| `G_Tier2_Users` | Tous les utilisateurs standards | Tier 2 — Utilisateurs |

### Groupes pour les ressources

| Groupe | Ressource associée |
|---|---|
| `G_Partage_RH` | Dossier partagé `\serveur\RH` |
| `G_Imprimante_Prod` | Imprimante production |

> **Modèle AGDLP respecté :** Les utilisateurs sont dans des groupes **Globaux** (G_), qui sont eux-mêmes membres de groupes **Locaux de domaine** pour les permissions sur les ressources.

---

## Stratégies de groupe (GPO)

### GPO_Tier0_Security — Tier 0 (Admins domaine)

```
✔ Activer BitLocker avec TPM
✔ Désactiver les services inutiles + forcer l'authentification Kerberos
✔ Bloquer la navigation Internet
```

### GPO_Tier1_Security — Tier 1 (Techniciens IT)

```
✔ Désactiver SMBv1
```

### GPO_Tier2_Security — Tier 2 (Utilisateurs standards)

```
✔ Bloquer les périphériques USB de stockage
✔ Désactiver les macros Office non signées
✔ Activer le verrouillage automatique (15 min d'inactivité)
✔ Forcer les mises à jour automatiques Windows Update
```

### GPO_Password_Policy — Tous les tiers

```
✔ Longueur minimale : 15 caractères
✔ Complexité obligatoire
✔ Expiration : 90 jours
✔ Historique : 24 derniers mots de passe
```

<img width="790" height="576" alt="Server AD1" src="https://github.com/user-attachments/assets/f9d034cd-69ce-4aab-bc5e-dff3c3d86f47" />

---

## Matrice des droits d'accès

> **Principe du moindre privilège :** chaque groupe reçoit uniquement les droits nécessaires à son activité. Aucun droit individuel — tout passe par les groupes de sécurité.

| Groupe | `\serveur\RH` | `\serveur\Finance` | `\serveur\R&D` | `\serveur\Production` | `\serveur\Direction` |
|---|---|---|---|---|---|
| `G_RH_Users` | Modification | — | — | — | Lecture |
| `G_Dir_Users` | Lecture | Contrôle total | — | — | Contrôle total |
| `G_R&D_Users` | — | — | Modification | — | — |
| `G_Prod_Users` | — | — | — | Modification | — |
| `G_Tier0_Admins` | Contrôle total | Contrôle total | Contrôle total | Contrôle total | Contrôle total |
| `G_Guests` | — | — | — | — | — |

---

## Conclusion

Ce projet illustre la mise en place d'un annuaire Active Directory complet et sécurisé pour une PME en croissance :

1. **Structure OU** — Séparation claire par service et par niveau de tiering, facilitant la gestion et l'application des GPO
2. **Comptes utilisateurs** — Convention de nommage professionnelle, comptes multiples pour les admins (tiering), attributs métier renseignés
3. **Groupes de sécurité** — Modèle AGDLP respecté, aucun droit individuel, séparation des accès par rôle
4. **GPO** — Durcissement adapté à chaque tier, politique de mots de passe forte appliquée à l'ensemble du domaine
5. **Droits d'accès** — Principe du moindre privilège appliqué sur toutes les ressources partagées

Cette infrastructure répond aux exigences de sécurité du **Guide d'hygiène informatique ANSSI** et constitue une base solide pour l'intégration future du déploiement automatisé de Windows 11.

### Outils utilisés

| Outil | Usage |
|---|---|
| **Active Directory Users and Computers** | Gestion des utilisateurs, OUs, groupes |
| **Group Policy Management Console (GPMC)** | Création et liaison des GPO |
| **PowerShell ISE** | Scripts de création en masse des comptes |
| **PingCastle** | Audit de sécurité de l'environnement AD |

---

### Ressources

- 📖 [Guide d'hygiène informatique — ANSSI](https://www.ssi.gouv.fr/guide/guide-dhygiene-informatique/)
- 📖 [Best practices Active Directory — Microsoft](https://learn.microsoft.com/fr-fr/windows-server/identity/ad-ds/plan/security-best-practices/best-practices-for-securing-active-directory)

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) et [Théo Blaise](https://github.com/theoblaise1) — BTS SIO SLAM | EPSI Lille*
