// ライブラリの読み込み
#include <ESP8266WiFi.h>
#include <Milkcocoa.h>

// 転送スピード
#define SERIAL_SPEED          115200

/************************* WiFi Access Point *********************************/

// Wi-Fi SSID
#define WLAN_SSID             "pr500m-963ac5-1"
// Wi-Fi PASSWORD
#define WLAN_PASS             "2f058d9e02b68"

/************************* Your Milkcocoa Setup *********************************/

// MilkcocoaのアプリID
#define MILKCOCOA_APP_ID      "zooiv4gg5gp"
// Data Store名
#define MILKCOCOA_DATASTORE   "esp8266/tout"

/************* Milkcocoa Setup (you don't need to change this!) ******************/

#define MILKCOCOA_SERVERPORT  1883

/************ Global State (you don't need to change this!) ******************/

// Create an ESP8266Client class to connect to the MQTT server.
WiFiClient client;

const char MQTT_SERVER[] PROGMEM    = MILKCOCOA_APP_ID ".mlkcca.com";
const char MQTT_CLIENTID[] PROGMEM  = __TIME__ MILKCOCOA_APP_ID;

Milkcocoa milkcocoa = Milkcocoa(&client, MQTT_SERVER, MILKCOCOA_SERVERPORT, MILKCOCOA_APP_ID, MQTT_CLIENTID);

// センサーを接続するピン
const int sensorPin = A0;

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

void loop() {
  // Milkcocoaのループ処理を実行
  milkcocoa.loop();

  // センサーの値
  int sensorValue = analogRead(sensorPin);

  Serial.print("Sensor Value : ");
  Serial.println(sensorValue);

  // Milkcocoaへ送信するデータを作成
  DataElement elem = DataElement();
  // sensorValueというデータ名で値を追加
  elem.setValue("sensorValue", sensorValue);
  // Milkcocoaへデータを送信
  milkcocoa.send(MILKCOCOA_DATASTORE, &elem);
}
