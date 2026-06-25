#include "Wire.h"    // Bibliothèque pour la communication I2C
#include "LiquidCrystal_I2C.h"    // Bibliothèque pour l'écran LCD I2C
#include "DHT.h"    // Bibliothèque pour le capteur DHT

LiquidCrystal_I2C lcd(0x27, 20, 4);    // Configuration du LCD : Adresse 0x27, 20 colonnes, 4 lignes

#define DHTPIN 2    // Pin numérique où est connecté le DHT11
#define DHTTYPE DHT11    // Type de capteur utilisé
DHT dht(DHTPIN, DHTTYPE);    // Initialisation du capteur DHT

#define LDR A1    // Pin analogique pour la photorésistance (LDR)
unsigned int value;    // Variable pour stocker la valeur brute de lumière

void setup() {
  Serial.begin(9600);    // Initialisation du moniteur série
  Serial.println(F("DHTxx test!"));
  lcd.init();    // Initialisation de l'écran LCD
  lcd.backlight();    // Allumage du rétroéclairage du LCD
  dht.begin();    // Démarrage du capteur DHT
  pinMode(LDR, INPUT);    // Configuration du pin LDR en entrée
}

void loop() {
  // Lecture de la valeur analogique de la LDR (0 à 1023)
  value = analogRead(LDR);

  // Lecture de l'humidité et de la température
  float h = dht.readHumidity();
  float t = dht.readTemperature();

  // Vérification si la lecture du DHT a échoué
  if (isnan(h) || isnan(t)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    lcd.setCursor(0, 0);
    lcd.print("Capteur DHT erreur");
    delay(2000);
    return;    // Sort de la boucle pour recommencer
  }

  // Calcul de l'indice de chaleur (température ressentie)
  float hic = dht.computeHeatIndex(t, h, false);

  // Affichage des données sur le moniteur série
  Serial.print(F("Humidite : "));
  Serial.print(h);
  Serial.print(F("% Temperature: "));
  Serial.print(t);
  Serial.print(F("°C "));
  Serial.print(F("Lumiere: "));
  Serial.println(value);

  // Affichage de la température sur le LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Meteo actuelle");
  lcd.setCursor(0, 1);
  lcd.print("Temp.: ");
  lcd.print(t);
  lcd.print(" C");
  delay(1000);

  // Affichage de l'humidité sur le LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Meteo actuelle");
  lcd.setCursor(0, 1);
  lcd.print("Humidite: ");
  lcd.print(h);
  lcd.print("%");
  delay(1000);
}
