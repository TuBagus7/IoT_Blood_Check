#include <WiFi.h> // library koneksi
#include <Adafruit_SSD1306.h> // Memanggil Library OLED SSD1306
#include <Adafruit_GFX.h>


// variabel sensor LDR
#define LDR_A_PIN 35
#define LDR_B_PIN 32
#define LDR_D_PIN 33

// variabel push button
#define BUTTON_PIN 14

// variabel LED
#define LED_A_PIN 25
#define LED_B_PIN 26
#define LED_D_PIN 27
#define LED_RED_PIN 16
#define LED_GREEN_PIN 17


#define SCREEN_WIDTH 128 // Lebar Oled dalam Pixel
#define SCREEN_HEIGHT 64 // Tinggi Oled dalam Pixel
#define OLED_RESET     4 
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

              //Mendeklarasi varibel dataInt

/*
 * Wiring Cable On OlED
 * SCL --> D22
 * SDA --> D21
 */

// nilai kalibrasi nilai sensor LDR
int kalibrasi_a = 220;
int kalibrasi_b = 235;
int kalibrasi_d = 400;

// Konfigurasi WiFi
const char *ssid = "Redmi Note 10 Pro";
const char *password = "1sampai8";

// IP Address server
const char *host = "172.20.10.3";

void setup() {
  Serial.begin(9600);
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);  // alamat I2C 0x3C untuk 128x64
  display.clearDisplay();
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  Serial.print("Menunggu koneksi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("Koneksi berhasil");

  pinMode(LDR_A_PIN, INPUT);
  pinMode(LDR_B_PIN, INPUT);
  pinMode(LDR_D_PIN, INPUT);

  pinMode(LED_A_PIN, OUTPUT);
  pinMode(LED_B_PIN, OUTPUT);
  pinMode(LED_D_PIN, OUTPUT);

  pinMode(BUTTON_PIN, INPUT_PULLUP);

  digitalWrite(LED_A_PIN, HIGH);
  digitalWrite(LED_B_PIN, HIGH);
  digitalWrite(LED_D_PIN, HIGH);
}

void loop() {
  delay(10);
  int button = digitalRead(BUTTON_PIN);
  if (button == LOW) {
    int ldr_a = 0;
    int ldr_b = 0;
    int ldr_d = 0;
    
    for(int i=0; i<3; i++){
      delay(10);
      ldr_a += analogRead(LDR_A_PIN);
      delay(10);
      ldr_b += analogRead(LDR_B_PIN);
      delay(10);
      ldr_d += analogRead(LDR_D_PIN);
      display.clearDisplay();
      display.setTextSize(2);
      display.setTextColor(WHITE);
      display.setCursor(40,25);
      display.println("AMAN");
      display.display();
      delay(2000);  
    }

    ldr_a = ldr_a/3;
    ldr_b = ldr_b/3;
    ldr_d = ldr_d/3;
    
    Serial.println("LDR A : " + String(ldr_a));
    Serial.println("LDR B : " + String(ldr_b));
    Serial.println("LDR D : " + String(ldr_d));
    Serial.println();

    String gol_darah;
    String rhesus;

    if (ldr_a <= kalibrasi_a) {
      if (ldr_b <= kalibrasi_b) {
        gol_darah = "AB";
      } else {
        gol_darah = "A";
      }
    } else {
      if (ldr_b <= kalibrasi_b) {
        gol_darah = "B";
      } else {
        gol_darah = "O";
      }
    }

    if (ldr_d <= kalibrasi_d) {
      rhesus = "+";
    } else {
      rhesus = "-";
    }

    Serial.println("Golongan Darah : " + gol_darah);
    Serial.println("Rhesus : " + rhesus);
    Serial.println();
    
    kirim(gol_darah, rhesus);
    delay(1000);
  }
}

void kirim(String gol_darah, String rhesus){
  // mengirimkan ke alamat host dengan port 80
  WiFiClient client;
  const int httpPort = 80;

  // mencoba terkoneksi dengan host
  if (!client.connect(host, httpPort)) {
    Serial.println("Koneksi Gagal");
    digitalWrite(LED_RED_PIN, HIGH);
    delay(2000);
    digitalWrite(LED_RED_PIN, LOW);
    return;
  }

  if(rhesus == "+"){
    rhesus = "%2B";
  }else{
    rhesus = "%2D";
  }
  
  // alamat tujuan  
  String url = "/golongan_darah/simpan_data.php?gol="+gol_darah+"&rhesus="+rhesus;

  // mengirimkan request ke server
  client.print("GET " + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  
  
  digitalWrite(LED_GREEN_PIN, HIGH);
  delay(2000);
  digitalWrite(LED_GREEN_PIN, LOW);
  
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 1000) {
      Serial.println("client timeout !");
      client.stop();
      return;
    }
  }

  // membaca balasan dari server dan tampilkan di serial monitor
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println("Selesai");
}
