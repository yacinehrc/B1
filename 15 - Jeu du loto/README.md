# Jeu de Loto Python

![Aperçu du jeu de loto](https://github.com/user-attachments/assets/96fd10ed-d3f5-479e-ae5a-c311b30cf631)

> Mini-jeu de loto en console développé en Python — tirage aléatoire, saisie utilisateur, validation des entrées, comparaison des résultats et attribution de lots selon les numéros gagnants.

---

## Introduction

Ce projet **transversal** avait pour objectif de créer un jeu de loto fonctionnel en **Python**, en alliant les cours de programmation et les cours d'algorithmie. Le jeu se déroule entièrement en console : l'utilisateur saisit 10 numéros compris entre 1 et 49, un tirage aléatoire est généré via le module `random`, les résultats sont comparés et un lot est attribué selon le nombre de numéros identiques. Le projet a permis de consolider la logique de validation des entrées, la manipulation de listes et la structuration d'un programme en fonctions indépendantes coordonnées par un `main`.

---

## Fonctionnalités

- **Tirage aléatoire** : génération de 10 numéros uniques entre 1 et 49 via `import random`
- **Saisie sécurisée** : validation de chaque entrée — entier, compris entre 1 et 49, non déjà saisi
- **Comparaison des résultats** : identification des numéros gagnants et calcul d'un bonus d'ordre selon la position de saisie
- **Attribution de lots** : trois paliers de récompense selon le nombre de bons numéros (petit prix, prix intermédiaire, grand prix)
- **Exécution sécurisée** : garde `if __name__ == '__main__'` pour empêcher le lancement automatique en cas d'import dans un autre script

---

## Démonstration

### Import et génération du tirage

Le module `random` est importé pour générer les 10 numéros officiels du tirage.

![Import random](https://github.com/user-attachments/assets/502325f4-64c5-43ff-9050-62d541398353)

La fonction de tirage appelle `random` et affiche les 10 valeurs générées.

![Fonction tirage](https://github.com/user-attachments/assets/f3554ad9-76f5-4077-9a98-127b9eaf6175)

### Saisie et validation utilisateur

Les 10 numéros sont saisis successivement. Une structure conditionnelle vérifie à chaque entrée que la valeur est un entier, qu'elle est comprise entre 1 et 49, et qu'elle n'a pas déjà été saisie. Si toutes les conditions sont respectées, le numéro est ajouté à la liste `user_nums`.

![Saisie et validation](https://github.com/user-attachments/assets/53fd868c-d990-4e5c-9ba3-012382b7d750)

### Comparaison des résultats

La fonction de comparaison identifie les numéros gagnants en deux temps : correspondance des valeurs entre la liste utilisateur et le tirage, puis calcul d'un bonus d'ordre en comparant les index de position.

![Comparaison](https://github.com/user-attachments/assets/8ed46af7-563f-4602-90d6-7306c6be0ca0)

### Attribution des lots

L'affichage final compte les bons numéros et détermine le gain selon trois paliers de récompense.

![Attribution des lots](https://github.com/user-attachments/assets/36ea82ff-3966-4025-9985-390f3bed1922)

### Fonction main et garde d'exécution

La fonction `main` coordonne l'ensemble du programme en appelant les fonctions dans l'ordre. La garde `if __name__ == '__main__'` sécurise l'exécution en évitant tout lancement non voulu en cas d'import.

![Fonction main](https://github.com/user-attachments/assets/be23c530-87a2-4c92-8cf9-0aed369d5ec6)

![Garde d'exécution](https://github.com/user-attachments/assets/84c38655-d7e6-40a1-b6a0-3b139d825552)

---

## Installation

> **Prérequis :** Python 3.x — aucune dépendance externe, `random` est un module natif.

```bash
# Cloner le dépôt
git clone https://github.com/yacinehrc/jeu-du-loto-python.git
cd jeu-du-loto-python

# Lancer le jeu
python loto.py
```

---

## Perspectives d'évolution

- **Interface graphique** : intégration de `Tkinter` pour afficher une vraie grille de loto avec animations sur les numéros gagnants
- **Rejouer** : proposition de relancer une partie ou de quitter proprement en fin de jeu
- **Porte-monnaie dynamique** : cumul des gains sur plusieurs parties avec sauvegarde entre les sessions
- **Système de comptes** : création d'un profil joueur avec nom d'utilisateur et mot de passe pour persister les données

---

## Conclusion

Ce projet a permis de mettre en pratique les bases de la **programmation Python** dans un contexte ludique : validation d'entrées, manipulation de listes, structuration en fonctions et gestion du flux d'exécution via un `main`. La logique de comparaison avec bonus d'ordre a constitué le défi algorithmique central du projet, en mobilisant la notion d'index de position sur des listes.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
