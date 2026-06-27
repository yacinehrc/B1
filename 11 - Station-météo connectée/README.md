# Station Météo Connectée

![Station météo connectée](https://github.com/user-attachments/assets/fdabf3a3-16a2-4432-ac82-4df089517d6d)

> Projet MSPR — Station météo physique pilotée par une Arduino Uno et un capteur DHT11, avec affichage LCD et boîtier modélisé en 3D.

---

## Introduction

Ce projet **MSPR** (Mise en Situation Professionnelle Reconstituée) avait pour objectif de nous plonger dans deux univers complémentaires : le développement embarqué avec le **langage Arduino** et la conception physique avec la **modélisation 3D**. À partir d'une Arduino Uno, d'un capteur DHT11, d'une breadboard, de câbles Dupont et d'un écran LCD, nous avons conçu une station météo connectée capable de mesurer et d'afficher en temps réel la température ressentie et le taux d'humidité.

---

## Fonctionnalités

- **Lecture de température et d'humidité** : le capteur DHT11 relève les données environnementales en continu
- **Calcul de la chaleur ressentie** : les données brutes sont converties en température ressentie par l'Homme (indice de chaleur en °C)
- **Affichage LCD alterné** : l'écran affiche successivement la température puis l'humidité, avec une seconde de pause entre chaque
- **Gestion des erreurs capteur** : une procédure d'erreur est prévue en cas de lecture défaillante du DHT11
- **Boîtier imprimé en 3D** : la station est logée dans un boîtier conçu sur mesure, avec ouvertures pour l'écran LCD, le capteur DHT11 et le câble USB-C

---

## Démonstration

### Code Arduino

Les bibliothèques `DHT` et `LiquidCrystal_I2C` sont importées pour piloter respectivement le capteur et l'écran LCD.

![Bibliothèques](https://github.com/user-attachments/assets/a0e81641-1fe0-4702-b412-4f402fb84813)

La configuration du LCD précise l'adresse I2C, le nombre de colonnes et de lignes de l'écran.

![Configuration du LCD](https://github.com/user-attachments/assets/fa64e46c-38ff-4265-8182-a15aa736d46f)

La boucle `void setup` initialise les composants : démarrage du DHT11 et activation du rétroéclairage de l'écran LCD.

![Boucle void setup](https://github.com/user-attachments/assets/6bc4f165-b5b4-4eec-aa01-ecf600a9465b)

La température et l'humidité sont lues en `float` pour plus de précision. Une procédure d'erreur est déclenchée si le capteur ne répond pas.

![Lecture DHT et gestion d'erreur](https://github.com/user-attachments/assets/413be867-d854-4260-a973-89d810ad1db7)

Le calcul de la chaleur ressentie est effectué via la fonction `computeHeatIndex` (paramètre `false` pour un résultat en Celsius).

![Température ressentie](https://github.com/user-attachments/assets/a275e593-32ff-4330-85e3-fc0b44d21a1c)

Les données sont ensuite envoyées à l'écran LCD pour affichage.

![Affichage LCD](https://github.com/user-attachments/assets/4965cd89-1004-4fe1-a4b9-bee153b6f154)

La température s'affiche sur la deuxième ligne (`Temp.: ... C`), précédée de `Météo actuelle` sur la première. L'écran reste affiché 1 seconde avant de passer à l'humidité.

![Affichage température](https://github.com/user-attachments/assets/5525ccd8-b06a-4dd6-ad5b-26afd340a9a5)

L'humidité s'affiche à son tour (`Humidite: ... %`) pendant 1 seconde, avant de revenir à la température.

![Affichage humidité](https://github.com/user-attachments/assets/da64357c-691f-47c3-8572-d8a2bee364e9)

### Modélisation 3D

Le boîtier est entièrement conçu sur mesure. L'esquisse de base définit les dimensions extérieures de la boîte (150 × 90 mm).

![Esquisse de la boîte](https://github.com/user-attachments/assets/a0f4458b-0655-4140-af6a-2f37b3f72a03)

L'extrusion fait passer l'esquisse de la 2D à la 3D, donnant un volume de 150 × 90 × 80 mm.

![Extrusion de la boîte](https://github.com/user-attachments/assets/acbe285d-82a3-4305-be48-7dc24f73f3a5)

Un perçage intérieur vide la boîte pour y accueillir les composants électroniques.

![Perçage intérieur](https://github.com/user-attachments/assets/7fe1de87-e00c-4097-be45-8d14302c83e3)

Une ouverture est usinée sur la face avant pour le passage et la fixation de l'écran LCD.

![Esquisse trou LCD](https://github.com/user-attachments/assets/6a0f9a6e-87fa-4e49-94b3-22898563a3f2)
![Trou LCD](https://github.com/user-attachments/assets/b4a8fef7-83bf-4877-8c09-601014d521c9)

Un trou latéral permet le passage du câble USB-C pour l'alimentation de l'Arduino Uno.

![Esquisse câble USB](https://github.com/user-attachments/assets/714f160a-6d4a-4112-a6cc-b50018025de8)
![Trou câble USB](https://github.com/user-attachments/assets/8c3fec7d-9fa2-4cd4-b877-97ff4a1f9c15)

Le couvercle est conçu avec un décalage de 1,2 mm pour s'emboîter précisément sur la boîte.

![Esquisse couvercle](https://github.com/user-attachments/assets/6ecf0b18-8212-437f-b8d0-9e7981ce1c3c)
![Décalage esquisse](https://github.com/user-attachments/assets/8d19795f-1ef0-458d-8ac4-6832a3eee7ed)
![Rendu intermédiaire](https://github.com/user-attachments/assets/3fe4d5d9-be94-4ab0-a58f-a47eb75e837c)

Une dernière ouverture est percée pour laisser dépasser le capteur DHT11 à l'extérieur du boîtier.

![Esquisse trou DHT11](https://github.com/user-attachments/assets/a81fee6d-36f5-4b87-af89-7db8045de372)
![Trou DHT11](https://github.com/user-attachments/assets/b939774c-3303-47ad-b9cb-5c8a9ab7fbbc)

Rendu final de la modélisation :

![Rendu final](https://github.com/user-attachments/assets/c5f74511-feaf-45f9-b84f-e1fb909027e2)

Évolution complète de la modélisation :

https://github.com/user-attachments/assets/44796cd1-79cd-42eb-9423-b337a701ca62

---

## Perspectives d'évolution

- **Design amélioré** : arrondir les coins du boîtier pour un rendu plus moderne et concevoir un couvercle clipsable plus sécurisé
- **Éco-conception** : optimiser les volumes pour réduire la quantité de matière utilisée à l'impression
- **Indicateur LED** : ajouter une LED variant du bleu (froid) au rouge (chaud) selon la température mesurée
- **Capteur LDR** : intégrer un capteur de luminosité pour afficher le taux de lumière en pourcentage — fonctionnalité initialement prévue mais écartée faute de temps et de résultats cohérents lors des tests

---

## Conclusion

Ce projet a permis de découvrir deux domaines complémentaires rarement abordés ensemble : la **programmation embarquée** avec le langage Arduino et la **modélisation 3D** orientée éco-conception. La prise en main du capteur DHT11, de l'écran LCD I2C et de la logique de la boucle `loop` a ouvert la voie à une meilleure compréhension de l'électronique physique et de l'interaction entre code et matériel.

---

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc) — BTS SIO SLAM | EPSI Lille*
