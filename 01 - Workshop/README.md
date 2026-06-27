# Machine de Rube Goldberg — PC Windows 7 Revisité 🏆

<img width="945" height="2048" alt="380d1848-8b6e-403f-bcc6-20fd1112f3bd" src="https://github.com/user-attachments/assets/79e7e325-edcc-4f7f-8ba8-be2ec75f3ff8" />
<img width="1200" height="1600" alt="f1e9ce65-d7f9-4070-b4a7-019806644018" src="https://github.com/user-attachments/assets/3e0c2c7e-e0d2-4799-b429-ff7bd0a183b3" />

> Machine de Rube Goldberg conçue dans une caisse de 40×20×40 cm reprenant l'esthétique d'une **tour PC Windows 7 modernisée** — pilotée par **Arduino**, avec capteurs LDR, relais, servomoteur, écran LCD et ruban LED. Réalisée en **4 jours** au workshop EPSI myDiL Lille.

---

## 🏆 Résultats du Workshop National — 1er octobre 2025

| Classement | Campus |
|---|---|
| 🥇 **1ère place** | **EPSI Lille** |
| 🥈 2ème place | EPSI Montpellier |
| 🥉 3ème place | EPSI Toulouse |

---

## Contexte & Défi

**Workshop — myDiL Lille, septembre 2025**

Nous sommes en 2068. La technologie, autrefois destinée à simplifier nos vies, est désormais utilisée pour créer des machines inutiles et complexes. La mission : concevoir une **machine de Rube Goldberg** à l'intérieur d'une caisse de **40×40×20 cm**.

### Contraintes techniques obligatoires

| Contrainte | Détail |
|---|---|
| **Caisse** | 40 cm (H) × 20 cm (L) × 40 cm (P) — 5 faces dont 2 avec trous ⌀18mm |
| **Départ** | Trou en haut à gauche (position 100×100 depuis le haut) |
| **Arrivée** | Trou en bas à droite (position 100×100 depuis le bas) |
| **Condition de sortie** | La bille ne peut pas ressortir par l'endroit où elle est entrée |
| **Parcours** | La bille doit parcourir toutes les faces de la caisse |
| **Électronique** | 1 carte de développement + min. 2 capteurs différents + min. 2 actionneurs |
| **Fabrication** | Imprimante 3D et/ou découpe laser autorisées |

### Notre concept

> **"Et si la machine de Rube Goldberg… était introduite dans un PC Windows 7 ?"**

Inspirés par la forme de tour PC de la caisse, nous avons recréé tous les composants d'un ordinateur (carte graphique RTX 10, barrette RAM, ventilateurs, cartes électroniques) et intégré dedans le parcours de la bille — avec un scénario complet : **démarrage → crash → redémarrage**.

---

## L'équipe & les rôles

| Membre | Rôle |
|---|---|
| **Théo** | Codage Arduino (relais, ruban LED, 4 LED), câblage Dupont et cable management |
| **Gauthier** | Mise en place des éléments dans la boîte, découpe laser et gravure |
| **Yacine** | Design de la boîte et des couleurs, modélisation 3D de toutes les pièces, impression |

---

## Conception & Matériel

### Matériaux

| Catégorie | Éléments |
|---|---|
| **Structure** | Carton, baguettes de sushis, colle, scotch, cutter |
| **Impression 3D (PLA)** | 1 hélice, 2 tuyaux, 1 demi-tuyau, 2 cubes, 3 quarts de cercles, 1 cadre écran, 1 spirale (non retenue), organisateurs de câbles Dupont |
| **Découpe laser** | Logo Windows gravé sur bois, "RTX 10" carte graphique, logo myDiL Lille |
| **Récupération** | Ventilateurs d'anciens PC, 2 cartes électroniques, 1 barrette RAM |
| **Peinture** | Noir (bombe), blanc, vert, jaune — pièces 3D en bleu PLA |
| **Électronique** | 1 carte Arduino, 1 breadboard, câbles Dupont, 3 relais, 1 alimentation 12V, 1 LDR, 1 afficheur LCD I2C 16×2, 1 buzzer, 1 servomoteur, 1 interrupteur, LEDs, 2 billes + 1 bille métallique, 1 aimant, ruban LED |

### Pièces 3D — à quoi servent-elles ?

| Pièce 3D | Rôle |
|---|---|
| **Hélice** | Représentation du ventilateur de carte graphique moderne |
| **Tuyau vert** | Guide la bille vers le cube LDR |
| **Demi-tuyau noir** | Remplace le tuyau bleu (meilleure visibilité sur la bille) |
| **2 cubes blancs** | L'un entouré de LDR (détecte la bille), l'autre retient la bille métallique |
| **3 quarts de cercles** | Guidage de la bille depuis le ventilateur 12V jusqu'à la sortie |
| **Cadre écran LCD** | Intégration propre de l'écran dans la boîte |
| **Organisateurs Dupont** | Cable management pour les fils Arduino |

### Objets gravés à la découpe laser

<img width="3060" height="4080" alt="windows de dos 1" src="https://github.com/user-attachments/assets/5b32c723-5bc1-4c3f-9dd8-6e554562c0a1" />

<img width="1080" height="1920" alt="f376e0d1-c247-442f-b9e0-d01ff978e6d0" src="https://github.com/user-attachments/assets/55f357f4-f0f0-404a-b964-30ecbe8c8fc5" />

<!-- 📸 PHOTO À METTRE : Photo de la gravure "RTX 10" sur la carte graphique en carton
     (tirée du dossier page 10)
     → Nommer le fichier : screenshots/rtx10-grave.jpg -->
![RTX 10 gravé — fausse carte graphique](screenshots/rtx10-grave.jpg)

<!-- 📸 PHOTO À METTRE : Photo de la gravure "myDiL Lille" sur bois
     (tirée du dossier page 10)
     → Nommer le fichier : screenshots/mydil-grave.jpg -->
![Gravure myDiL Lille](screenshots/mydil-grave.jpg)
<img width="1200" height="1600" alt="3857d536-3103-4950-b744-b969046b0674" src="https://github.com/user-attachments/assets/67626846-02f3-4498-8343-b0aa2568ee15" />

### Outils logiciels utilisés

| Outil | Usage |
|---|---|
| **Onshape / Tinkercad** | Modélisation 3D des pièces |
| **Creality Slicer / Falcon Design Space** | Préparation des impressions 3D |
| **Arduino IDE** | Programmation de la carte Arduino |
| **Thingiverse** | Inspiration et modèles 3D |

---

## Architecture & Design

### Pourquoi un PC Windows 7 ?

La caisse fournie avait exactement la forme d'une tour PC. En tant que futurs ingénieurs informatiques, le lien était évident. Nous avons donc recréé les composants internes d'un ordinateur pour habiller le parcours de la bille.

### Choix des couleurs

| Couleur | Justification |
|---|---|
| **Noir** | Rappelle les anciens PC quasi-universellement noirs |
| **Bleu (PLA & LED)** | Couleur emblématique de Windows + modernité (RGB) |
| **Vert** | Se fond avec la couleur de la barrette RAM |
| **Blanc (cubes)** | Rend les cubes visibles, symbolise la "téléportation" entre les deux billes |

### Pourquoi les LED ?

Les vrais PC de 2025 sont illuminés RGB. Windows 7 n'avait pas d'éclairage interne — nous l'avons modernisé avec un ruban LED bleu pour créer un "Windows 7 revisité 2025".

<img width="3060" height="4080" alt="fin 1" src="https://github.com/user-attachments/assets/73f02282-fd5a-47c6-b579-956d8dd759d5" />
<img width="3060" height="4080" alt="windows de dos" src="https://github.com/user-attachments/assets/3db665bd-05e8-418b-a2bd-077d516c3db7" />

---

## Électronique & Capteurs

### Schéma de câblage

<img width="1280" height="764" alt="schema elec" src="https://github.com/user-attachments/assets/69adb52e-3ead-44cc-b7be-f36cbe9cf498" />
<img width="2560" height="1528" alt="se" src="https://github.com/user-attachments/assets/eb1f43a2-bf09-453c-b301-a0983ecfe118" />

### Rôle de chaque composant

| Composant | Broche Arduino | Rôle |
|---|---|---|
| **Interrupteur** | `pin 5` (INPUT_PULLUP) | Déclenchement au passage de la bille — active relais 1 & 3 |
| **LDR (photorésistance)** | `A0` (analogique) | Détecte l'obscurité quand la bille entre dans le cube — déclenche le crash |
| **Relais 1** | `pin 13` | Allume les ventilateurs 5V (démarrage) |
| **Relais 2** | `pin 9` | Allume le ventilateur 12V de l'étape 3 (propulsion bille) |
| **Relais 3** | `pin 8` | Allume le ventilateur bruit 5V |
| **Servomoteur** | `pin 10` | Libère la bille métallique (position 0° au crash) |
| **Buzzer** | `pin 2` | Sons crash + redémarrage Windows 8 bits |
| **Écran LCD I2C 16×2** | `I2C (0x27)` | Affiche "Démarrage Windows 7" → "ERR#@!" → "ReDemarrage" |
| **LED rouge fin de course** | `pin 6` | Indicateur interrupteur activé |
| **LED rouge LDR** | `pin 7` | Indicateur LDR activé |
| **LED verte finale** | `pin 3` | Indicateur fin de parcours |
| **LED orange bille 12V** | `pin 4` | Indicateur ventilateur 12V activé |
| **Alimentation 12V** | Externe | Convertit 230V AC → 12V DC pour les ventilateurs haute puissance |

---

## Code Arduino

Le code complet est disponible dans le fichier [`src/rube_goldberg.ino`](src/rube_goldberg.ino).

### Logique générale

```
1. Bille entre → interrupteur activé
   → Relais 1 & 3 ON (ventilateurs 5V)
   → LCD : "Démarrage WINDOWS7"

2. Bille entre dans le cube LDR → obscurité détectée
   → Tous les relais OFF (ventilateurs s'éteignent)
   → Servomoteur : 0° (libère la bille métallique)
   → Buzzer : son de crash Windows
   → LCD : glitch "ERR#@!" / "###BUG###" / "LILLE WIN !!"
   → LCD : "ReDemarrage / LILLE_WIN.init"

3. Après redémarrage
   → Relais 1, 2 & 3 ON (tous ventilateurs + propulsion bille)
   → LED verte finale : allumée à la sortie
```

### Extrait — Sons 8 bits

```cpp
void crashSound() {
  tone(buzzerPin, 1000, 200);
  delay(250);
  // Descente aigu → grave
  for (int f = 2000; f > 100; f -= 30) {
    tone(buzzerPin, f, 20);
    delay(25);
  }
  noTone(buzzerPin);
}

void rebootSound() {
  // Montée grave → aigu
  for (int f = 200; f < 1200; f += 20) {
    tone(buzzerPin, f, 15);
    delay(20);
  }
  tone(buzzerPin, 1000, 1200);
  delay(1300);
  noTone(buzzerPin);
}
```

### Extrait — Effet glitch LCD au crash

```cpp
for (int i = 0; i < 5; i++) {
  LCD.clear();
  LCD.setCursor(random(0, 8), random(0, 2));
  LCD.print("ERR#@!");
  delay(random(50, 200));
  LCD.setCursor(random(0, 5), random(0, 2));
  LCD.print("###BUG###");
  delay(random(50, 200));
  LCD.setCursor(random(0, 3), random(0, 2));
  LCD.print("LILLE WIN !!");
  delay(random(50, 200));
}
```

---

## Les 3 étapes de la bille

### Étape 1 — Démarrage du PC

<img width="1414" height="2000" alt="1" src="https://github.com/user-attachments/assets/b4169d27-8c2e-4f95-872a-5a91d65a26b8" />

La bille entre par le **trou en haut à gauche** et appuie sur l'interrupteur collé devant l'entrée.

- **Déclenchement :** relais 1 & 3 → ventilateurs 5V s'allument
- **LCD :** affiche `"Démarrage WINDOWS7"`
- **Parcours :** la bille descend le long de la **barrette RAM** ralentie par des petits supports

*Journée consacrée : lundi et mardi*

---

### Étape 3 — Redémarrage & sortie *(conçue avant l'étape 2)*

<img width="1414" height="2000" alt="2" src="https://github.com/user-attachments/assets/b0c80864-ffff-4e06-b234-ed887df3d50f" />

Après le redémarrage, le **ventilateur 12V** (relais 2) souffle sur la **bille métallique** qui avance sur la planche, passe sur les **3 quarts de cercles** imprimés en 3D et sort par le **trou en bas à droite**.

- **Déclenchement :** relais 1, 2 & 3 → tous les ventilateurs se rallument
- **LCD :** affiche `"ReDemarrage / LILLE_WIN.init"`
- **LED verte :** s'allume à la fin du parcours

*Journée consacrée : mercredi*

---

### Étape 2 — Crash du système *(raccordement)*

<img width="1414" height="2000" alt="3" src="https://github.com/user-attachments/assets/7d3951a8-be3f-48aa-8569-096e2f11a190" />

La bille quitte la RAM, entre dans le **tuyau vert**, glisse sur le **demi-tuyau noir** jusqu'au **cube LDR**.

- **LDR :** détecte l'obscurité → tous les ventilateurs s'éteignent
- **Servomoteur :** libère la **bille métallique** depuis le cube du haut
- **Buzzer :** joue le son de crash Windows 8 bits
- **LCD :** effet glitch `ERR#@!` puis `"ReDemarrage"`
- La première bille disparaît, la bille métallique prend le relais → effet "téléportation"

*Journées consacrées : jeudi et vendredi matin*

---

## Échecs & Améliorations

### Ce qui a été changé en cours de route

| ❌ Idée initiale | ✅ Solution retenue | Raison |
|---|---|---|
| Tuyau bleu fermé | **Demi-tuyau noir ouvert** | Pas de visibilité sur la bille dans le tuyau fermé |
| Spirale 3D pour descendre la bille | **3 quarts de cercles** | Spirale trop fragile, bille manquait de place |
| Carte électronique collée au fond comme décor | **Posée sur étagère au-dessus de la carte graphique** | Un ventilateur d'imprimante 3D récupéré a changé le plan |

<img width="3060" height="4080" alt="Tuyau bleu" src="https://github.com/user-attachments/assets/9f77f39b-4de0-4bf0-bc39-38b546f596be" /><img width="1080" height="2340" alt="Screenshot_20250929_123037_Gallery" src="https://github.com/user-attachments/assets/858acc0a-efaa-40c3-982b-b974734ee6cc" />

<img width="482" height="492" alt="Screenshot_20250929_090649_Gallery" src="https://github.com/user-attachments/assets/0aaff55a-7f20-4deb-a991-5be58eb0d4b5" /><img width="848" height="622" alt="Screenshot_20250929_090833_Gallery" src="https://github.com/user-attachments/assets/90c9fc45-31d0-4afe-b1bf-56729ce7925a" />

---

## Évolution du projet

| Étape | Description |
|---|---|
| **Jour 1 (lundi)** | Brainstorming, premiers câblages Arduino, boîte vierge posée |
| **Jour 2 (mardi)** | Construction étape 1 (RAM + interrupteur), premiers tests ventilateurs |
| **Jour 3 (mercredi)** | Construction étape 3 (GPU + quarts de cercles), peinture à la bombe |
| **Jour 4 (jeudi matin)** | Construction étape 2 (tuyaux + cubes LDR), codage du crash/reboot, LEDs |
| **Vendredi matin** | Finalisation, câble management, tests complets, dépôt des livrables |

<img width="1200" height="1600" alt="6db57bb4-e648-4702-8331-1d0fa7ccc003" src="https://github.com/user-attachments/assets/c85db98c-fbcd-4994-8f04-6148e17f04a5" />
<img width="1200" height="1600" alt="163d6c24-f599-4a42-bde6-095a6b8f1ec8" src="https://github.com/user-attachments/assets/96a4f68e-98d4-4379-ab7d-4dcc0a386bca" />
<img width="1200" height="1600" alt="f91119e6-5801-4958-b8ab-9ff48b11504e" src="https://github.com/user-attachments/assets/51b00008-cec8-4258-a9cd-90bc7ee4dd06" />
<img width="1600" height="1200" alt="ffd0fc9e-f39a-4c68-962a-880d305131dc" src="https://github.com/user-attachments/assets/13ba59bf-e8c5-4101-aa1c-d6d12a19f8dd" />
<img width="3060" height="4080" alt="boite noire" src="https://github.com/user-attachments/assets/a304301c-5e1c-4224-b5bd-dd894a416e77" />
<img width="1418" height="1200" alt="87f27901-b410-4110-8d4c-b7fad0f2e9cf" src="https://github.com/user-attachments/assets/98d7c9df-688f-4706-93d6-7aa9e4937e2d" />
<img width="577" height="769" alt="boite" src="https://github.com/user-attachments/assets/7ecb4688-95be-45c2-b83f-ca7e4ad21e9b" />
<img width="3060" height="4080" alt="fin 2" src="https://github.com/user-attachments/assets/21ee29f5-085d-4345-bac0-651193c89293" />
<img width="1200" height="1600" alt="f1e9ce65-d7f9-4070-b4a7-019806644018" src="https://github.com/user-attachments/assets/11d85cf4-1afa-460c-a12a-006f1708466a" />

## Démonstration






<video>https://github.com/user-attachments/assets/f40e11f2-85bf-4124-a992-fdaa0131a893</video>

---

## Perspectives

Ce qui aurait pu être fait avec plus de temps et de ressources :

| Idée | Raison de l'abandon |
|---|---|
| **6 ventilateurs** (prévu) → 4 retenus | Trop de consommation pour la carte Arduino |
| **Vitre plexiglass** sur la 6ème face | Introuvable au myDiL, remplacée par les tuyaux |
| **Caméra + retransmission live** sur écran | Trop complexe à câbler en 4 jours |
| **Fumée** via résistance de cigarette électronique | Non retenu par sécurité |
| **Circuit plus lent** avec plus d'obstacles | Contrainte de rapidité du parcours |

---

## Conclusion

Ce projet démontre qu'il est possible de créer une machine inutile mais spectaculaire à partir d'une simple caisse en carton. Nous avons réussi à :

- Toucher les **6 faces** de la caisse avec la bille
- Créer un **scénario narratif complet** : démarrage → crash → redémarrage
- Intégrer une **véritable électronique** (Arduino, LDR, relais, servomoteur, LCD, buzzer)
- Modéliser et imprimer **toutes les pièces 3D** sur mesure
- Rendre Windows 7 **moderne** grâce au ruban LED RGB

> *"Windows 7 plante… notre machine, elle, transforme le bug en spectacle !"*

---

**Workshop — myDiL EPSI Lille, septembre 2025**
🏆 *Vainqueurs du concours national EPSI — 1er octobre 2025*

*Réalisé par [Yacine Harrache](https://github.com/yacinehrc), Gauthier Bernard et [Théo Blaise](https://github.com/theoblaise1)— BTS SIO SLAM | EPSI Lille*
