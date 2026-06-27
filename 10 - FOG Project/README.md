# Déploiement d'Images — FOG + Windows 11 + Active Directory

<img width="853" height="700" alt="Capture d&#39;écran 2026-01-09 111152" src="https://github.com/user-attachments/assets/46daaa39-bceb-40ac-ad59-f7abf3724e09" />

> Automatisation du déploiement de postes clients **Windows 11** via **FOG Project** (Free Open-source Ghost), avec intégration automatique dans le domaine **Active Directory NovaTech** — suite du Projet 1 (AD).

---

## Contexte

Après avoir conçu et sécurisé l'Active Directory (Projet 1), **NovaTech Industries** souhaite standardiser et automatiser le déploiement des postes clients Windows 11 pour ses collaborateurs.

**Objectifs :**

| Objectif | Détail |
|---|---|
| **Homogénéité** | Configuration identique sur toutes les machines |
| **Intégration AD** | Jonction automatique au domaine Active Directory |
| **Rapidité** | Réduction du temps de déploiement pour accompagner la croissance (15 → 50 collaborateurs) |

---

## Prérequis

- Projet 1 (Active Directory NovaTech) déployé et fonctionnel
- Serveur **FOG** installé sur Linux (recommandé : Ubuntu Server)
- Réseau configuré avec **PXE Boot** activé sur les postes clients
- Windows 11 (version **23H2 ou 25H2**)

> ⚠️ Si vous utilisez une version récente de Windows 11, la jonction automatique au domaine nécessite l'utilisation de **Sysprep + fichier `unattend.xml`** (nouvelles restrictions Microsoft sur l'automatisation).

### Ressources d'installation FOG

- 📖 [Documentation officielle FOG Project](https://docs.fogproject.org)

---

## Étape 1 — Préparation du poste maître (Golden Image)

Le **poste maître** (ou Golden Image) est la machine de référence dont l'image sera capturée puis déployée sur tous les autres postes.

### 1.1 — Installation de Windows 11

<img width="1224" height="919" alt="Capture d&#39;écran 2026-01-25 171427" src="https://github.com/user-attachments/assets/bf0f4ca4-d0ca-473c-9b2b-eb757589939c" />

Installer **Windows 11** (version 23H2 ou 25H2) sur le poste maître.

### 1.2 — Configuration des paramètres de base

- **Nom de machine :** temporaire (sera renommé automatiquement au déploiement)
- **Langue :** Français
- **Réseau :** connecté au réseau NovaTech

### 1.3 — Installation des logiciels requis

Installer sur le poste maître tous les logiciels qui devront être présents sur chaque poste client :

<img width="1228" height="915" alt="Capture d&#39;écran 2026-02-01 181139" src="https://github.com/user-attachments/assets/71d5f2fa-56aa-4a65-b426-ce399e89e627" />

- Navigateur web
- Suite bureautique
- Outils métier NovaTech

### 1.4 — Préparation avec Sysprep *(si Windows 11 récent)*

Si vous utilisez une version récente de Windows 11, exécuter Sysprep avec un fichier `unattend.xml` pour permettre la jonction automatique au domaine lors du déploiement :

```cmd
C:\Windows\System32\Sysprep\sysprep.exe /oobe /generalize /shutdown /unattend:C:\unattend.xml
```

---

## Étape 2 — Capture de l'image avec FOG

### 2.1 — Installation et configuration du serveur FOG

<img width="853" height="700" alt="Capture d&#39;écran 2026-01-09 111152" src="https://github.com/user-attachments/assets/0e77d35e-309f-4942-828a-4b32e7f28c12" />
<img width="736" height="440" alt="Capture d&#39;écran 2026-01-09 111344" src="https://github.com/user-attachments/assets/7035fae4-4f83-4b8d-97b3-45a2997e1665" />

<img width="1533" height="750" alt="Capture d&#39;écran 2026-01-20 114412" src="https://github.com/user-attachments/assets/eabd2866-905c-4a29-abbf-5305a7cd16cb" />
<img width="1919" height="1028" alt="Capture d&#39;écran 2026-01-20 114517" src="https://github.com/user-attachments/assets/57598a9a-a34f-4767-8778-3a79890fb3cd" />

### 2.2 — Enregistrement du poste maître dans FOG

Démarrer le poste maître en **PXE Boot** pour qu'il soit détecté par le serveur FOG.


### 2.3 — Création de la tâche de capture

Dans FOG, créer une **image** puis une **tâche de capture** associée au poste maître.

<img width="1401" height="735" alt="Capture d&#39;écran 2026-01-20 115330" src="https://github.com/user-attachments/assets/8de8a320-2645-4859-86ab-3066891d1ceb" />

### 2.4 — Vérification de l'image capturée

> **Vérifier** que l'image est correctement stockée sur le serveur FOG avant de passer au déploiement.

---

## Étape 3 — Déploiement sur les postes clients

### 3.1 — Démarrage des postes via PXE

Démarrer les postes clients en **PXE Boot** pour lancer le déploiement réseau.

### 3.2 — Lancement de la tâche de déploiement

Dans l'interface FOG, créer une tâche de **déploiement** pour un ou plusieurs hôtes cibles.

### 3.3 — Jonction automatique au domaine Active Directory

Après le redémarrage du poste, vérifier la jonction automatique au domaine **NovaTech**.

---

## Étape 4 — Validation & Tests

### 4.1 — Vérification de l'intégration au domaine

Sur chaque poste déployé, vérifier que la machine est bien membre du domaine NovaTech.

```powershell
# Vérifier le domaine
systeminfo | findstr /B /C:"Domain"
```

### 4.2 — Contrôle de l'application des GPO

Forcer l'application des stratégies de groupe et vérifier qu'elles sont bien appliquées (GPO définies dans le Projet 1).

```cmd
gpupdate /force
gpresult /r
```

### Tableau de validation final

| Test | Résultat attendu |
|---|---|
| Poste joint au domaine NovaTech | ✅ Membre de NovaTech.local |
| GPO Tier2 appliquées | ✅ USB bloqué, macros désactivées, verrouillage 15 min |
| GPO Password Policy active | ✅ Longueur min 15 car., expiration 90 jours |
| Connexion avec compte AD | ✅ amartin, tlefebvre, etc. peuvent se connecter |
| Droits d'accès aux dossiers partagés | ✅ Conformes à la matrice du Projet 1 |

---

## Conclusion

Ce projet complète l'infrastructure NovaTech initiée dans le Projet 1 (Active Directory) en y ajoutant une **chaîne de déploiement automatisée et reproductible** :

1. **Golden Image** — Une seule image maître configurée une fois, déployée à l'infini
2. **FOG + PXE** — Déploiement réseau sans intervention manuelle sur chaque poste
3. **Jonction AD automatique** — Chaque nouveau poste intègre immédiatement le domaine, hérite des GPO et des droits d'accès définis dans le Projet 1

Cette solution permet à NovaTech d'accueillir de nouveaux collaborateurs rapidement et de manière homogène, en respectant la politique de sécurité déjà en place.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) et [Théo Blaise](https://github.com/theoblaise1) — BTS SIO SLAM | EPSI Lille*
