#include <ESP8266WiFi.h>
#include <Milkcocoa.h>

/************************* WiFi Access Point *********************************/

#define WLAN_SSID       ""
#define WLAN_PASS       ""


/************************* Your Milkcocoa Setup *********************************/

#define MILKCOCOA_APP_ID      ""
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

void setup() {
  Serial.begin(115200);
  delay(10);
  Serial.println(F("Milkcocoa SDK demo"));

  setupWiFi();

  Serial.println( milkcocoa.on(MILKCOCOA_DATASTORE, "push", onpush) );
};

void loop() {
  milkcocoa.loop();

  int val = analogRead(A0);
  Serial.println(String(val));

  DataElement elem = DataElement();
  elem.setValue("v", val);

  milkcocoa.push(MILKCOCOA_DATASTORE, &elem);
  delay(7000);

    Serial.println("---");
    delay(5000);
  
};
