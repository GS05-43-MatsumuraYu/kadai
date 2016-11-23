#include <ESP8266WiFi.h>
#include <Milkcocoa.h>

/************************* WiFi Access Point *********************************/

#define WLAN_SSID       "pr500m-963ac5-1"
#define WLAN_PASS       "2f058d9e02b68"


/************************* Your Milkcocoa Setup *********************************/

#define MILKCOCOA_APP_ID      "zooiv4gg5gp"
#define MILKCOCOA_DATASTORE   "esp8266/tout"

/************* Milkcocoa Setup (you don't need to change this!) ******************/

#define MILKCOCOA_SERVERPORT  1883

/************ Global State (you don't need to change this!) ******************/

// Create an ESP8266 WiFiClient class to connect to the MQTT server.
WiFiClient client;

const char MQTT_SERVER[] PROGMEM    = MILKCOCOA_APP_ID ".mlkcca.com";
const char MQTT_CLIENTID[] PROGMEM  = __TIME__ MILKCOCOA_APP_ID;

Milkcocoa milkcocoa = Milkcocoa(&client, MQTT_SERVER, MILKCOCOA_SERVERPORT, MILKCOCOA_APP_ID, MQTT_CLIENTID);

void onpush(DataElement *elem) {
  Serial.println("onpush");
  Serial.println(elem->getInt("v"));
};

void setupWiFi() {
  Serial.println(); Serial.println();
  Serial.print("Connecting to ");
  Serial.println(WLAN_SSID);

  WiFi.begin(WLAN_SSID, WLAN_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println();

  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

// ポート番号を指定
int s0 = 2;
int s1 = 3;
int s2 = 4;

int led = 5;

// 変数宣言
int cal0 = 0;
int cal1 = 0;
int cal2 = 0;

int count = 0;

void setup() {
  Serial.begin(115200);
  delay(10);
  Serial.println(F("Milkcocoa SDK demo"));

  setupWiFi();

  Serial.println( milkcocoa.on(MILKCOCOA_DATASTORE, "push", onpush) );

  pinMode(s0, OUTPUT);
  pinMode(s1, OUTPUT);
  pinMode(s2, OUTPUT);
  pinMode(led, OUTPUT);
  
  Serial.begin(9600);

};

void loop() {
  milkcocoa.loop();

  int val = analogRead(A0);
  Serial.println(String(val));

  for (count = 0; count <= 7; count++) {
    cal0 = bitRead(count, 0);
    cal1 = bitRead(count, 1);
    cal2 = bitRead(count, 2);
    
    digitalWrite(s0, cal0);
    digitalWrite(s1, cal1);
    digitalWrite(s2, cal2);

  DataElement elem = DataElement();
  elem.setValue("v", val);

  milkcocoa.push(MILKCOCOA_DATASTORE, &elem);
  delay(7000);

};
