    char letra;
  char numero;
  char lig_des;
  
  #include <SoftwareSerial.h>
  
  SoftwareSerial mySerial(10, 11); // RX flutuante, TX + resistor
  void setup() {
    pinMode(12, OUTPUT);
    pinMode(8, OUTPUT);
    pinMode(9, OUTPUT);
    digitalWrite(12, 0);
    digitalWrite(8, 1);
    digitalWrite(9, 0);
    mySerial.begin(9600);
  
    Serial.begin(9600);
  }
  
  void loop() {
  
   if (mySerial.available() > 20) {
     while (mySerial.available() > 0) {
        letra = mySerial.read();
   
         if (letra == 'v') {
          letra = mySerial.read();
          Serial.print(letra);
          if (letra == 'v') {
            letra = mySerial.read();
            Serial.print(letra);
            if (letra == 'v') {
            letra = mySerial.read();
            Serial.print(letra);
          
           for(int h = 0 ; h < 1; h++){
                   if (letra == 'a') {
          Serial.print("Poltrona A1");
          numero = mySerial.read(); 
          lig_des = mySerial.read();
         
          if (numero == '1') {
            if (lig_des == 'x') {
              digitalWrite(12, 0);
              digitalWrite(9, LOW );
               digitalWrite(8, HIGH);
            }
            else {
              digitalWrite(12, 1);
              digitalWrite(9,HIGH);
              digitalWrite(8, LOW);
            }
          }        
        else {}
  
           }
           }
         }
  
  
            }
          }
        }
  
  
  
      }
    }
  
  
  
  
   
          
  
  
  
  
  
        

