#include <Servo.h>
#include <LiquidCrystal_I2C.h>

Servo monServo;
LiquidCrystal_I2C LCD(0x27,20,4);

// Déf des pins 
const int pinFinCourse = 5;        // capteur de fin de course 
const int buzzerPin = 2;           // buzzer crash / démarrage 
const int pinLDR = A0;             // photorésistance
const int servoPin = 10;           // servo moteur
const int relais12V = 13;          // relais avec alim externe
const int relais12VBille = 9;      // relais avec alim externe
const int ledFinCourse = 6;        // LED rouge fin de course
const int ledLDR = 7;              // LED rouge LDR
const int ledFinale = 3;           // LED verte de fin
const int ledBille12V = 4;         // LED orange de bille du 12V
const int relais5V = 8;                 // Relais 5V bruit


void crashSound() {
  // Petit bip d'erreur
  tone(buzzerPin, 1000, 200);
  delay(250);

  // Descente aigu -> grave
  for (int f = 2000; f > 100; f -= 30) {
    tone(buzzerPin, f, 20);
    delay(25);
  }

  noTone(buzzerPin);
  delay(300);
}

void rebootSound() {
  delay(500);

  // Montée grave -> aigu
  for (int f = 200; f < 1200; f += 20) {
    tone(buzzerPin, f, 15);
    delay(20);
  }

  // Note finale longue
  tone(buzzerPin, 1000, 1200);
  delay(1300);
  noTone(buzzerPin);
}

void crashAndReboot() {
  crashSound();
  rebootSound();
  for (int i = 0; i < 5; i++) {
      LCD.clear();
      LCD.backlight();
      LCD.setCursor(random(0, 8), random(0, 2));
      LCD.print("ERR#@!");
      delay(random(50, 200));

      LCD.clear();
      LCD.setCursor(random(0, 5), random(0, 2));
      LCD.print("###BUG###");
      delay(random(50, 200));

      LCD.clear();
      LCD.setCursor(random(0, 3), random(0, 2));
      LCD.print("LILLE WIN !!");
      delay(random(50, 200));
    }
    LCD.init();
    LCD.setCursor(2,0);
    LCD.print("ReDemarrage");
    LCD.setCursor(1,1);
    LCD.print("LILLE_WIN.init");
}
Transféré
void setup() {
  pinMode(pinFinCourse, INPUT_PULLUP);
  pinMode(pinLDR, INPUT);
  pinMode(relais12V, OUTPUT);
  pinMode(relais5V, OUTPUT);
  pinMode(relais12VBille, OUTPUT);
  pinMode(ledFinCourse, OUTPUT);
  pinMode(ledLDR, OUTPUT);
  pinMode(ledFinale, OUTPUT);

  LCD.init();

  monServo.attach(servoPin);
  monServo.write(90); // position initiale
}

void loop() {
  // Début / Allumage
  if (digitalRead(pinFinCourse) == LOW) {
    LCD.init();
    LCD.backlight();
    LCD.setCursor(3,0);
    LCD.print("Demarrage");
    LCD.setCursor(3,1);
    LCD.print("WINDOWS7");
    digitalWrite(relais12V, HIGH);
    digitalWrite(ledFinCourse, HIGH);
    digitalWrite(relais5V, HIGH);
  }

  if (digitalRead(pinLDR) == HIGH) {
    digitalWrite(ledLDR, HIGH);
    delay(3000);
    digitalWrite(relais12V, LOW);
    digitalWrite(relais5V, LOW);
    monServo.write(0);
    delay(500);
    crashAndReboot();
    delay(900);
    digitalWrite(ledBille12V, HIGH);
    digitalWrite(relais12V, HIGH);
    digitalWrite(relais12VBille, HIGH);
    digitalWrite(relais5V, HIGH);
    delay(3000);
    digitalWrite(relais12V, LOW);
    digitalWrite(relais12VBille, LOW);
    digitalWrite(ledFinale, HIGH);
  }
}