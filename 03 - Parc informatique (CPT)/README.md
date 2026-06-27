# Parc Informatique — Infrastructure Réseau sous Cisco Packet Tracer

<img width="1917" height="1008" alt="Capture d&#39;écran 2026-06-27 153336" src="https://github.com/user-attachments/assets/72cbb444-e47e-445c-83df-f8f0d44ce63d" />

> Conception et déploiement d'une infrastructure réseau segmentée avec **VLANs**, **routage inter-VLAN** et **filtrage par ACL**, simulée dans **Cisco Packet Tracer** — EPSI Lille, BTS SIO SLAM.

---

## Table des matières

- [Introduction](#introduction)
- [TP 2.2 — Le Switch](#tp-22--le-switch)
- [TP 2.5 — Le Routeur](#tp-25--le-routeur)
- [TP 2.7 — Sécurité & ACL](#tp-27--sécurité--acl)
- [Conclusion](#conclusion)

---

## Introduction

Ce projet simule un réseau d'entreprise complet dans **Cisco Packet Tracer**, en partant d'un simple switch jusqu'à une infrastructure segmentée par VLANs avec filtrage de sécurité.

### Architecture finale

| Équipement | Modèle | Rôle |
|---|---|---|
| **Switch** | Cisco 2960-24TT | Commutation & segmentation VLAN |
| **Routeur** | Cisco 1841 | Routage inter-VLAN (Router-on-a-stick) |
| **Serveur** | Server-PT | Hébergement web HTTP/HTTPS |
| **Postes** | PC-PT (x7) | Clients répartis sur les VLANs |

### Plan d'adressage

| VLAN | Nom | Réseau | Passerelle |
|---|---|---|---|
| VLAN 10 | reseauInformatique | 192.168.10.0/24 | 192.168.10.254 |
| VLAN 20 | reseauUtilisateur | 192.168.20.0/24 | 192.168.20.254 |
| VLAN 30 | reseauServeur | 192.168.30.0/24 | 192.168.30.254 |

---

## TP 2.2 — Le Switch

### Objectif

Comprendre le fonctionnement d'un switch Cisco, observer le comportement de la table MAC, maîtriser la segmentation par VLAN.

---

### Étape 1 — Configuration initiale & table MAC

**Adressage :**
- PC0 : `192.168.0.1 / 255.255.255.0`
- PC1 : `192.168.0.2 / 255.255.255.0`

**Commandes CLI switch :**
```
enable
conf t
wr mem
show running-config
show mac-address-table
```

**Commande ping depuis PC0 :**
```
ping 192.168.0.2
```

> **Observation :** Avant le ping, la table MAC est vide. Après le ping, le switch a appris les adresses MAC des deux PC et les associe à leurs ports respectifs — c'est le mécanisme d'apprentissage dynamique.

---

### Étape 2 — Ajout de PC2 & effet du masque de sous-réseau

**Adressage PC2 :** `192.168.0.3 / 255.255.255.0`

**Tests effectués :**
1. PC2 → ping PC1 et PC0 → ✅ Fonctionne (même réseau)
2. Changer l'IP de PC2 en `192.168.10.3` (masque inchangé `/24`) → ping échoue ❌
3. Passer tous les masques en `255.255.0.0` → ping réussit à nouveau ✅

> **Conclusion :** Le masque de sous-réseau délimite les plages d'adresses capables de communiquer directement. Des hôtes sur des sous-réseaux différents ne peuvent pas se joindre sans routeur.

---

### Étape 3 — Création des VLANs (VLAN 10 & VLAN 20)

**Créer le VLAN 10 sur le switch :**
```
enable
conf t
vlan 10
name reseauInformatique
```

**Affecter PC0 au port fa0/1 (VLAN 10) :**
```
int fa0/1
switchport access vlan 10
```

**Créer le VLAN 20 et affecter PC3, PC4 :**
```
vlan 20
name reseauUtilisateur
int fa0/4
switchport access vlan 20
```

**Adressage VLAN 10 :**
- PC0 : `192.168.10.1` — PC1 : `192.168.10.2` — PC2 : `192.168.10.3`

**Adressage VLAN 20 :**
- PC3 : `192.168.20.1 / 255.255.255.0` — PC4 : `192.168.20.2 / 255.255.255.0`

> **Observation :** PC0 (VLAN 10) ne peut plus communiquer avec PC3/PC4 (VLAN 20) — les VLANs isolent le trafic comme des réseaux physiquement séparés.

---

## TP 2.5 — Le Routeur

### Objectif

Faire communiquer les PC de VLANs différents via un routeur Cisco 1841 en configuration **Router-on-a-Stick** (sous-interfaces 802.1Q).

---

Le lien entre le switch et le routeur doit transporter les deux VLANs simultanément → **mode trunk**.

**Sur le switch (port connecté au routeur) :**
```
switchport mode trunk
switchport trunk allowed vlan 10,20
```

---

### Étape 2 — Sous-interfaces sur le routeur (Router-on-a-Stick)

Sur un routeur Cisco, le mode trunk n'existe pas directement. On crée une sous-interface par VLAN :

**VLAN 10 :**
```
int fa0/0.10
encapsulation dot1Q 10
ip address 192.168.10.254 255.255.255.0
```

**VLAN 20 :**
```
int fa0/0.20
encapsulation dot1Q 20
ip address 192.168.20.254 255.255.255.0
```

---

### Étape 3 — Passerelle par défaut sur les PC

Sur chaque PC, renseigner la passerelle correspondant à son VLAN dans Desktop > IP Configuration :
- PC du **VLAN 10** → passerelle `192.168.10.254`
- PC du **VLAN 20** → passerelle `192.168.20.254`

---

### Vérification

**Afficher la table de routage du routeur :**
```
show ip route
```

**Ping depuis PC0 (VLAN 10) vers PC4 (VLAN 20) :**
```
ping 192.168.20.2
```

**Tracer le chemin réseau :**
```
tracert 192.168.20.2
```

> **Résultat :** Le flux passe obligatoirement par le routeur avant d'atteindre PC4 — le routeur est le point de transit inter-VLAN.

---

## TP 2.7 — Sécurité & ACL

### Objectif

Ajouter un serveur web dans un VLAN dédié (VLAN 30) et restreindre l'accès HTTP aux seuls PC du VLAN informatique, via des **Access Control Lists (ACL)** sur le routeur.

---

### Étape 1 — Ajout du VLAN 30 & du serveur web

**Sur le switch :**
```
vlan 30
name reseauServeur
```

**Sous-interface routeur pour VLAN 30 :**
```
int fa0/0.30
encapsulation dot1Q 30
ip address 192.168.30.254 255.255.255.0
```

**Adressage du serveur :**
- IP : `192.168.30.200 / 255.255.255.0`
- Passerelle : `192.168.30.254`

---

### Étape 2 — Vérification de connectivité


Depuis PC0, tester l'accès web via le navigateur intégré (Desktop > Web Browser) :

---

### Étape 3 — Filtrage par ACL

Les ACL Cisco filtrent le trafic paquet par paquet sur une interface du routeur, en entrée (`in`) ou en sortie (`out`). La bonne pratique est de **bloquer au plus tôt**, donc en entrée sur l'interface source.

**Syntaxe :**
```
access-list 100 permit/deny tcp <source> <wildcard> eq <port> <dest> <wildcard> eq <port>
```

> En notation wildcard, `192.168.20.0/24` s'écrit `192.168.20.0 0.0.0.255`

**ACL 100 — Bloquer HTTP depuis VLAN 20 vers le serveur :**
```
access-list 100 deny tcp 192.168.20.0 0.0.0.255 host 192.168.30.200 eq 80
access-list 100 permit ip any any
```

**Appliquer l'ACL sur fa0/0.20 en entrée :**
```
int fa0/0.20
ip access-group 100 in
```

---

### Étape 4 — Vérification finale

| Source | Destination | HTTP (80) | HTTPS (443) |
|---|---|---|---|
| PC VLAN 10 | Serveur | ✅ Autorisé | ✅ Autorisé |
| PC VLAN 20 | Serveur | ❌ Bloqué | ✅ Autorisé |

---

### Routeur vs Firewall

| Critère | Routeur (ACL) | Firewall |
|---|---|---|
| **Filtrage** | Stateless (paquet par paquet) | Stateful (suivi de session) |
| **Niveau OSI** | Couche 3 (réseau) | Couches 3 à 7 |
| **Inspection** | IP / Port source-destination | Contenu, état de connexion, applications |
| **Usage** | Filtrage basique inter-VLAN | Protection périmétrique avancée |

> Un routeur **n'est pas** un firewall. Il applique des règles statiques sur les en-têtes IP/TCP sans analyser l'état des connexions ni le contenu applicatif.

---

## Conclusion

Ce projet illustre la construction progressive d'une infrastructure réseau d'entreprise, depuis la commutation de base jusqu'à la sécurité périmétrique :

1. **Switch & VLANs** — Segmentation logique du réseau, isolation du trafic, apprentissage de la table MAC
2. **Routeur inter-VLAN** — Activation du dialogue entre segments via Router-on-a-Stick et encapsulation 802.1Q
3. **ACL & Sécurité** — Contrôle granulaire des flux réseau, distinction routeur/firewall

Cette infrastructure constitue la base d'un réseau d'entreprise sécurisé et segmenté, conforme aux bonnes pratiques de cloisonnement des rôles (utilisateurs / informatique / serveurs).

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
