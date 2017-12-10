  
  #include <Arduino.h>
  
  #include <ESP8266WiFi.h>
  #include <ESP8266WiFiMulti.h>
  
  #include <ESP8266HTTPClient.h>
  
  #define USE_SERIAL Serial
  
  
  ESP8266WiFiMulti WiFiMulti;
  //
  //int person = 0 ;
  //int rele = 2;
  void setup() {
    /// pinMode(rele,OUTPUT);
    USE_SERIAL.begin(9600);
    // USE_SERIAL.setDebugOutput(true);
  
    //////  USE_SERIAL.println();
    //////  USE_SERIAL.println();
    //////  USE_SERIAL.println();
  
    for (uint8_t t = 4; t > 0; t--) {
      /////    USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
      USE_SERIAL.flush();
      delay(1000);
  
      //    digitalWrite(rele, 1);
      //    delay(1000);
      //    digitalWrite(rele, 0);
    }
  
    WiFiMulti.addAP("rodrigo", "12345678");
  
  }
  
  void loop() {
    // wait for WiFi connection
    if ((WiFiMulti.run() == WL_CONNECTED)) {
  
      HTTPClient http;
  
      //////// USE_SERIAL.print("[HTTP] begin...\n");
      // configure traged server and url
      //script php
      http.begin("http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/ad.php"); //HTTP
  
      /////// USE_SERIAL.print("[HTTP] GET...\n");
      // start connection and send HTTP header
      int httpCode = http.GET();
  
      // httpCode will be negative on error
      if (httpCode > 0) {
        // HTTP header has been send and Server response header has been handled
        ///////      USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);
  
        // file found at server
        if (httpCode == HTTP_CODE_OK) {
          String payload = http.getString();
          USE_SERIAL.println(payload);
          /////      int L = payload.length();
          //////     USE_SERIAL.print("Número de cadeiras: ");
          //////     USE_SERIAL.println(L);
          //////      for(int p = L; p>0; p-- ){
          /////
          /////         if(payload[p-1] == '1'){person++;}
          /////        }
          /////        if(person>0){
          //////       USE_SERIAL.print("Ativando três cadeiras que encontrei nível lógico 1: ");
          //////       USE_SERIAL.println(person);
          /////        digitalWrite(rele,1);
          /////        delay(person*3000);
          /////        digitalWrite(rele,0);
          //////        person = 0;
          ////        }
        }
      } else {
        //////      USE_SERIAL.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }
  
      http.end();
    }
  
    delay(5000);
  }

