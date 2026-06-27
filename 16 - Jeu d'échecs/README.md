# Y-Chess 

<img width="1917" height="907" alt="Capture d&#39;écran 2026-06-27 130500" src="https://github.com/user-attachments/assets/4c9a6012-66a2-4bf8-ae5f-b00b9eeec65f" />

> Jeu d'échecs web jouable contre une IA, avec moteur Minimax, thèmes de plateau personnalisables et console de notation — développé en HTML5, CSS3 et JavaScript vanilla.

---

## Introduction

**Y-Chess** est un jeu d'échecs entièrement jouable dans le navigateur, développé dans le cadre du **BTS SIO** (EPSI Lille). L'objectif était de concevoir un jeu fonctionnel de A à Z en JavaScript, sans framework côté logique, en s'appuyant sur la bibliothèque **chess.js** pour la gestion des règles et en implémentant un moteur IA maison basé sur l'algorithme **Minimax avec élagage alpha-bêta**. L'interface s'inspire de l'univers visuel de chess.com, avec un thème sombre et une mise en page en trois colonnes.

---

## Fonctionnalités

- **Moteur IA Minimax** : algorithme avec élagage alpha-bêta pour éviter les calculs inutiles, profondeur limitée à 3 pour garantir la fluidité dans le navigateur
- **4 niveaux de difficulté** : Facile, Moyen, Difficile et GOAT (Magnus) — chaque niveau augmente la profondeur d'analyse de l'IA
- **Drag & drop** : déplacement des pièces par glisser-déposer, avec promotion automatique en dame
- **Alertes visuelles** : case orange en cas d'échec, case rouge animée en cas d'échec et mat
- **4 thèmes de plateau** : Classique, Océan, Forêt, Sombre — commutables en temps réel
- **2 sets de pièces** : Wikipedia (standard) et Neo (moderne)
- **Console de notation** : historique des coups en notation algébrique, affiché en temps réel
- **Bouton Reset** : réinitialise la partie et vide l'historique

---

## Démonstration

### Plateau et interface

L'interface se compose de trois colonnes : panneau de thématisation à gauche, plateau central, et console de notation + sélecteur de niveau à droite.

<img width="1917" height="907" alt="Capture d&#39;écran 2026-06-27 130500" src="https://github.com/user-attachments/assets/1cecdca2-33ed-4726-9492-3075695f57d4" />

### Thèmes de plateau

Quatre thèmes sont disponibles et s'appliquent instantanément via les boutons colorés du panneau latéral gauche.

<img width="1917" height="907" alt="Capture d&#39;écran 2026-06-27 130500" src="https://github.com/user-attachments/assets/175e66a7-eeaf-4d9c-87a5-007ae2770f55" />
<img width="1905" height="907" alt="Capture d&#39;écran 2026-06-27 130510" src="https://github.com/user-attachments/assets/ac460eda-c1d6-4411-9a3b-8a72d7e0b6c4" />
<img width="1910" height="909" alt="Capture d&#39;écran 2026-06-27 130517" src="https://github.com/user-attachments/assets/5ff841e3-e76c-4b76-850b-e581423d3351" />
<img width="1909" height="910" alt="Capture d&#39;écran 2026-06-27 130526" src="https://github.com/user-attachments/assets/cef1d2bb-52ae-406f-bb78-beabb2ec5632" />

### Alertes échec et mat

La case du roi passe en **orange** lorsqu'il est en échec, et en **rouge animé** en cas d'échec et mat.

<img width="1900" height="898" alt="Capture d&#39;écran 2026-06-27 130619" src="https://github.com/user-attachments/assets/771fea63-4b90-4d4e-994e-49acec9f9108" />

<img width="1911" height="911" alt="Capture d&#39;écran 2026-06-27 130734" src="https://github.com/user-attachments/assets/3872c9fe-8173-487e-b7ab-080be47aad45" />

### Console de notation

Chaque coup joué est enregistré en notation algébrique dans la console et s'affiche en temps réel.

<img width="283" height="377" alt="Capture d&#39;écran 2026-06-27 130745" src="https://github.com/user-attachments/assets/6e8e5cce-6460-4fcd-b1d6-862338781d55" />

---

## Installation

> **Prérequis :** aucun — le projet fonctionne directement dans le navigateur.

```bash
# Cloner le dépôt
git clone https://github.com/yacinehrc/y-chess.git
cd y-chess

# Ouvrir dans le navigateur
# → Double-cliquer sur chess.html
# ou lancer un serveur local :
npx serve .
```

Les dépendances externes sont chargées via CDN — aucune installation npm requise.

| Dépendance | Source |
|---|---|
| TailwindCSS | `cdn.tailwindcss.com` |
| chess.js 0.10.3 | `cdnjs.cloudflare.com` |
| Pièces (images) | `chessboardjs.com` |

---

## Conclusion

Ce projet a permis d'appréhender des concepts algorithmiques avancés, notamment l'implémentation du **Minimax avec élagage alpha-bêta** pour simuler un adversaire artificiel. La gestion du thread principal via `setTimeout` pour éviter le freeze du navigateur pendant le calcul IA, ainsi que la manipulation dynamique du DOM pour le rendu du plateau, ont constitué des défis techniques significatifs. L'ensemble a renforcé la maîtrise du **JavaScript vanilla** appliqué à un cas concret et interactif.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
