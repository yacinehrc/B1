# station_meteo_connectee
![IMG20260402093954](https://github.com/user-attachments/assets/fdabf3a3-16a2-4432-ac82-4df089517d6d)


---
~ PRÉSENTATION ~

Ce projet MSPR (Mise en Situation Profesionnelle Reconstituée) a pour objectif de nous mettre en situation afin de créer une station-météo connectée à l'aide d'une Arduino Uno et d'un capteur DHT 11 (qui seront finalement accompagnés d'une breadboard, de câbles Dupont et d'un écran LCD (Liquid Crystal Display)), et aussi de découvrir le monde du 3D (modélisation, éco-conception, géométrie dans l'espace, ...) et le langage Arduino.

---
~ FONCTIONNEMENT ~

Le capteur DHT11 (qui récupère la température et l'humidité) va le "traduire" en ressenti (car le capteur au soleil peut par exemple afficher 30°C, pourtant il ne fait que 15°C dans la pièce où il se trouve). Puis, ces données vont être récupéré dans le code pour afficher sur l'écran LCD la météo actuelle avec donc la température en °C et le taux d'humidité en %.

---
~ EXPLICATIONS DU CODE ~

- Bibliothèques nécessaires au code :
<img width="680" height="63" alt="bibliotheques" src="https://github.com/user-attachments/assets/a0e81641-1fe0-4702-b412-4f402fb84813" />


- Configuration du LCD :
<img width="545" height="45" alt="config_du_lcd" src="https://github.com/user-attachments/assets/fa64e46c-38ff-4265-8182-a15aa736d46f" />


- Boucle "void_setup" qui initialise les composants (DHT et LCD) :
<img width="644" height="176" alt="boucle_void_setup" src="https://github.com/user-attachments/assets/6bc4f165-b5b4-4eec-aa01-ecf600a9465b" />


- Lecture de la température et de l'humidité (transformé en nombre décimal (float) pour plus de précision) et procédure d'erreur du DHT :
<img width="522" height="155" alt="condition_DHT" src="https://github.com/user-attachments/assets/413be867-d854-4260-a973-89d810ad1db7" />


- Calcule la chaleur ressentie par l'Homme (false → Celsius (°C)) :
<img width="523" height="42" alt="temperature_ressentie" src="https://github.com/user-attachments/assets/a275e593-32ff-4330-85e3-fc0b44d21a1c" />


- Affichage des données sur le LCD :
<img width="473" height="154" alt="affichage_lcd" src="https://github.com/user-attachments/assets/4965cd89-1004-4fe1-a4b9-bee153b6f154" />


- Affichage de la température sur le LCD en degré Celsius avec un emplacement précis ("Météo actuelle" sur la première ligne collée à gauche et "Temp.: ... C" sur la ligne du dessous toujours collée à gauche) et un temps de 1 seconde avant de passer à l'humidité :
<img width="469" height="171" alt="affichage_temperature" src="https://github.com/user-attachments/assets/5525ccd8-b06a-4dd6-ad5b-26afd340a9a5" />


- Affichage de l'humidité sur le LCD en % avec un emplacement précis ("Météo actuelle" sur la première ligne collée à gauche et "Humidite: ... %" sur la ligne du dessous toujours collée à gauche) et un temps de 1 seconde avant de revenir à afficher la température :
<img width="456" height="191" alt="affichage_humidite" src="https://github.com/user-attachments/assets/da64357c-691f-47c3-8572-d8a2bee364e9" />


---
~ MODÉLISATION 3D ~

- Esquisse de la boîte (150.000mm x 90.000mm) :

<img width="1618" height="846" alt="esquisse_boite" src="https://github.com/user-attachments/assets/a0f4458b-0655-4140-af6a-2f37b3f72a03" />


- Extrusion de l'esquisse de la boîte, permettant de faire passer l'esquisse (2D) en volume (3D) (150.000mm x 90.000mm x 80.000mm) :

<img width="1613" height="844" alt="extrusion_esquisse_boite" src="https://github.com/user-attachments/assets/acbe285d-82a3-4305-be48-7dc24f73f3a5" />


- Perçage de l'extrusion pour permettre de rendre vide la boîte :

<img width="1616" height="846" alt="percage_boite" src="https://github.com/user-attachments/assets/7fe1de87-e00c-4097-be45-8d14302c83e3" />

- Esquisse du trou permettant de mettre l'écran LCD et son perçage :

<img width="1612" height="844" alt="esquisse_trou_LCD" src="https://github.com/user-attachments/assets/6a0f9a6e-87fa-4e49-94b3-22898563a3f2" />
<img width="1609" height="838" alt="trou_LCD" src="https://github.com/user-attachments/assets/b4a8fef7-83bf-4877-8c09-601014d521c9" />


- Esquisse et trou pour le passage du câble USB-C qui connecte l'Arduino Uno au PC :

<img width="1616" height="839" alt="esquisse_cable_usb" src="https://github.com/user-attachments/assets/714f160a-6d4a-4112-a6cc-b50018025de8" />
<img width="1615" height="842" alt="trou_cable_usb" src="https://github.com/user-attachments/assets/8c3fec7d-9fa2-4cd4-b877-97ff4a1f9c15" />


- Esquisse du couvercle qui s'emboîtera pour refermer la boîte au-dessus :

<img width="1613" height="849" alt="esquisse_couvercle" src="https://github.com/user-attachments/assets/6ecf0b18-8212-437f-b8d0-9e7981ce1c3c" />


- Décalage (1.200mm) pour permettre de créer un espace pour emboîter le couvercle sur la boîte :

<img width="1618" height="851" alt="decalage_esquisse" src="https://github.com/user-attachments/assets/8d19795f-1ef0-458d-8ac4-6832a3eee7ed" />
<img width="1617" height="845" alt="rendu_final_1" src="https://github.com/user-attachments/assets/3fe4d5d9-be94-4ab0-a58f-a47eb75e837c" />


- Esquisse et trou pour faire passer le capteur DHT 11 :

<img width="1619" height="846" alt="esquisse_trou_DHT_11" src="https://github.com/user-attachments/assets/a81fee6d-36f5-4b87-af89-7db8045de372" />
<img width="1611" height="849" alt="trou_DHT_11" src="https://github.com/user-attachments/assets/b939774c-3303-47ad-b9cb-5c8a9ab7fbbc" />


- Modélisation finale (image) :

<img width="1619" height="849" alt="rendu_final_2" src="https://github.com/user-attachments/assets/c5f74511-feaf-45f9-b84f-e1fb909027e2" />


- Évolution de la modélisation :

https://github.com/user-attachments/assets/44796cd1-79cd-42eb-9423-b337a701ca62


---
~ PERSPECTIVES ENVISAGEABLES ~

1. Avoir un plus beau design : Arrondir les coins de boîtes afin d'avoir un design plus moderne, créer un couvercle "clipsable" pour être sûr que le couvercle reste bien attaché à la boîte, ...

2. Penser encore plus éco-responsablement : Penser encore plus à l'éco-conception et utiliser encore moins de matière car actuellement, le volume de la boîte est bien plus supérieur à ce qui est nécessaire.

3. Rajouter une LED : Cette LED pourrait varier entre le bleu et le rouge, bleu lorsqu'il fait froid, rouge lorsqu'il fait chaud.

4. Rajouter un capteur LDR (Light Dependent Resistor) pour mesurer le taux de lumière : L'idée était déjà dans notre projet, malheureusement, vu que nous découvrons le langage Arduino et que nous avons eu qu'une dizaine d'heures pour le projet, il a été compliqué de maîtriser le code pour avoir un taux en % correcte. Lors de nos essaies, à pleine lumière, le taux était de 100% tandis qu'en pleine obscurité, le taux était de 79%, ce qui n'était pas cohérent. Nous avons essayé un autre code mais à pleine lumière, cela affichait 520, 780, 650, et dans l'obscurité -40, -70, ... Code pour le LDR :
<img width="739" height="126" alt="Capture d&#39;écran 2026-04-02 141501" src="https://github.com/user-attachments/assets/bd6c5f5c-c69f-4e8c-ae95-8418b404cdc8" />
<img width="739" height="51" alt="pin_et_variable_DHT11" src="https://github.com/user-attachments/assets/b56cbb97-a3ed-4edb-878a-c486ea8e7412" />
