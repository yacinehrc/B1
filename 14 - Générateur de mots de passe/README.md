# Générateur de Mot de Passe

<img width="451" height="382" alt="Capture d&#39;écran 2026-06-27 123845" src="https://github.com/user-attachments/assets/e693e88c-3986-412b-b9eb-9f03242a936b" />

> Application de bureau Python permettant de générer des mots de passe cryptographiquement sécurisés, avec interface graphique moderne en mode sombre.

---

## Introduction

Ce projet est une application desktop développée en **Python** avec la bibliothèque **CustomTkinter**. L'objectif était de concevoir un outil simple et efficace pour générer des mots de passe robustes, en s'appuyant sur le module **`secrets`** — conçu spécifiquement pour la génération de données cryptographiquement sûres, contrairement au module `random` classique. L'interface graphique en mode sombre offre une expérience utilisateur moderne et fluide.

---

## Fonctionnalités

- **Génération sécurisée** : utilisation du module `secrets` pour garantir une entropie maximale, avec un jeu de caractères complet (lettres, chiffres, caractères spéciaux)
- **Longueur personnalisable** : un slider permet de choisir la longueur du mot de passe entre 8 et 32 caractères
- **Affichage dynamique** : la longueur sélectionnée se met à jour en temps réel sous le slider
- **Interface moderne** : thème sombre via CustomTkinter avec mise en page épurée

---

## Démonstration

### Interface principale

L'application s'ouvre en mode sombre avec un champ de résultat centré, le slider de longueur et le bouton de génération.

<img width="332" height="237" alt="Capture d&#39;écran 2026-06-27 124059" src="https://github.com/user-attachments/assets/2599b150-250b-44dd-9cc0-1ea4f6e75665" />


### Génération d'un mot de passe

Un clic sur le bouton **Générer** produit instantanément un mot de passe aléatoire dans le champ de saisie, en respectant la longueur choisie via le slider.

<img width="154" height="43" alt="Capture d&#39;écran 2026-06-27 124103" src="https://github.com/user-attachments/assets/6031008c-8979-4d75-b657-9b15a0d80bf6" />


### Ajustement de la longueur

Le slider permet de faire varier la longueur en temps réel entre 8 et 32 caractères. L'affichage sous le slider se met à jour dynamiquement à chaque déplacement.

<img width="318" height="113" alt="Capture d&#39;écran 2026-06-27 124116" src="https://github.com/user-attachments/assets/8be5426d-f1aa-44c9-9b68-4be27ff3088e" />
<img width="313" height="108" alt="Capture d&#39;écran 2026-06-27 124124" src="https://github.com/user-attachments/assets/f3cb9f26-0436-4004-a289-45451a6d1852" />
<img width="314" height="126" alt="Capture d&#39;écran 2026-06-27 124130" src="https://github.com/user-attachments/assets/9733db5a-6090-40a5-a98c-53fb98f75adb" />


---

## Installation

> **Prérequis :** Python 3.8 ou supérieur.

```bash
# Cloner le dépôt
git clone https://github.com/yacinehrc/mdp-generator.git
cd mdp-generator

# Installer la dépendance
pip install customtkinter

# Lancer l'application
python MDP.py
```

---

## Conclusion

Ce projet a permis de découvrir la création d'interfaces graphiques desktop en Python grâce à **CustomTkinter**, tout en approfondissant la notion de sécurité cryptographique via le module **`secrets`**. La distinction entre `random` (non sécurisé) et `secrets` (cryptographiquement sûr) constitue un apprentissage clé pour toute application manipulant des données sensibles.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
