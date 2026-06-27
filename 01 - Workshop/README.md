# Machine de Rube Goldberg — PC Windows 7 Revisité 🏆

<img width="945" height="2048" alt="380d1848-8b6e-403f-bcc6-20fd1112f3bd" src="https://github.com/user-attachments/assets/79e7e325-edcc-4f7f-8ba8-be2ec75f3ff8" />
<img width="1200" height="1600" alt="f1e9ce65-d7f9-4070-b4a7-019806644018" src="https://github.com/user-attachments/assets/3e0c2c7e-e0d2-4799-b429-ff7bd0a183b3" />

> Machine de Rube Goldberg conçue dans une caisse de 40×20×40 cm reprenant l'esthétique d'une **tour PC Windows 7 modernisée** — pilotée par **Arduino**, avec capteurs LDR, relais, servomoteur, écran LCD et ruban LED. Réalisée en **4 jours** au workshop EPSI myDiL Lille.

@@ -81,16 +81,9 @@

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

@@ -154,10 +147,6 @@

---

## Code Arduino

Le code complet est disponible dans le fichier [`src/rube_goldberg.ino`](src/rube_goldberg.ino).

### Logique générale

```
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
```

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
