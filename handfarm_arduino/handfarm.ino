#include <MQ7.h>

#include "DHT.h"    // dht 라이브러리(온습도)
#include <Phpoc.h>  // 네트워크 관련 라이브러리

// DHT11(온습도) 센서
#define DHTPIN 3
#define DHTTYPE DHT11
#define RelayPin 4      // 릴레이 모듈
#define CodPin A0       // 일산화탄소 센서
#define RainDropPin A1  // 빗물감지 센서

// pH 센서
#define PHSensorPin A2
#define VREF 5.0    // 기본 전압
#define OFFSET 0.00 // 오차
#define SCOUNT 30

// 토양 pH 센서 변수 선언
int analogBuffer[SCOUNT];
int analogBufferTemp[SCOUNT];
int analogBufferIndex = 0,copyIndex = 0;
float averageVoltage;
float phValue;

int timeCount = 1;    // 전체 시간 제어 변수
int insertTime = 1;   // 시간 제어 변수(센서 데이터 Insert)

char server_name[] = "serverIP";   // 서버 IP 또는 도메인
int server_port = 8080;                 // 포트

DHT dht(DHTPIN, DHTTYPE);   // 온습도 센서 객체
MQ7 mq7(CodPin, 5.0);
PhpocClient client;         // 클라이언트 객체

void setup() {
  pinMode(RelayPin,OUTPUT);
  pinMode(PHSensorPin,INPUT);
  Phpoc.begin();              // 네트워크 초기화
  dht.begin();                // DHT 11 센서 초기화
  Serial.begin(9600);
}

void loop() {
  unsigned long startTime = millis()/1000;  // 작동 시간

  int relay = 0;                      // 릴레이 제어 변수(워터펌프 제어)

  float hum = dht.readHumidity();     // 습도
  float temp = dht.readTemperature(); // 온도(섭씨)
  float cod = mq7.getPPM();       // 일산화탄소
  int rain = analogRead(RainDropPin); // 빗물감지

  if(rain >= 1000) {
    rain = 990;
  }
  rain = (1000 - rain)/10;

  // pH 센서 측정 알고리즘
  unsigned long analogSampleTimepoint = millis();
  while(millis()-analogSampleTimepoint < 1000U){
    analogBuffer[analogBufferIndex] = analogRead(PHSensorPin);
    analogBufferIndex++;
    if(analogBufferIndex == SCOUNT){
      analogBufferIndex = 0;
      break;
    }
    delay(30);
  }
  for(copyIndex=0;copyIndex<SCOUNT;copyIndex++){
    analogBufferTemp[copyIndex]= analogBuffer[copyIndex];
  }
  averageVoltage = getMedianNum(analogBufferTemp,SCOUNT) * (float)VREF / 1024.0;
  phValue = 3.5 * averageVoltage + OFFSET;

  if(startTime > 10*timeCount) {
    // 서버 연결
    serverConnect();

    // HTTP 요청
    if(startTime > 30*insertTime){
      makeRequestInsert(phValue, hum, temp, cod, rain);   // 30초마다 웹 서버에 HTTP 요청(DB Insert)

      // HTTP 응답(응답 데이터 사용 X)
      while(true){
        char insertResponse = client.read();

        if(client.available() == 0 && insertResponse=='\n'){
          break;
        }
      }

      insertTime++;
      Serial.println("insert : success");
    }
    else{
      makeRequestSelect();    // 10초마다 웹 서버에 HTTP 요청(DB Select)

      // HTTP 응답(응답 데이터 사용 O)
      String waterCheck = "";

      while(true){
        char selectResponse = client.read();

        if(selectResponse > 33 && selectResponse < 122){
          waterCheck += selectResponse;

          if(client.available() == 0 && selectResponse=='>'){
            break;
          }
        }
      }

      // 응답 데이터 추출
      int startStr = waterCheck.indexOf("<waterCheck>");
      int endStr = waterCheck.indexOf("</waterCheck>");

      // 릴레이 제어 변수
      relay = waterCheck.substring(startStr+String("<waterCheck>").length(),endStr).toInt();
      Serial.println("select : success");
    }

    Serial.println("서버 연결 해제");
    client.stop();
    Serial.println("---------------");
    timeCount++;
  }

  // 릴레이 제어
  if(relay != 0){
    serverConnect();

    // 릴레이 작동
    digitalWrite(RelayPin,HIGH);
    delay(1000*relay);
    digitalWrite(RelayPin,LOW);

    // HTTP 요청(릴레이 작동 후 DB에 0으로 초기화)
    makeRequestUpdate();

    // HTTP 응답(응답 데이터 사용 X)
    while(true){
      char updateResponse = client.read();

      if(client.available() == 0 && updateResponse=='\n'){
        break;
      }
    }
    Serial.println("서버 연결 해제");
    client.stop();
  }
  delay(500);
}

void serverConnect() {
  if(client.connect(server_name, server_port)){
    Serial.print("웹 서버 연결 : ");
    Serial.print(server_name);
    Serial.print(":");
    Serial.println(server_port);
  }
  else{
    Serial.println("웹 서버 연결 실패!");
  }
}

void makeRequestSelect(){
  client.println("GET /control_select.php HTTP/1.1");
  client.println("Host: handfarm.kro.kr");
  client.println("Connection: close");
  client.println();
}

void makeRequestUpdate(){
  client.println("GET /water_off.php HTTP/1.1");
  client.print("Host: ");
  client.println(server_name);
  client.println();
}

// 웹 서버에 GET 요청(DB Insert)
void makeRequestInsert(float phValue, float hum, float temp, float cod, int rain){
  String strget = "GET /insert_data.php/?ph_val=";
  strget += String(phValue,2);
  strget += "&hum_val=";
  strget += String(hum);
  strget += "&temp_val=";
  strget += String(temp);
  strget += "&cod_val=";
  strget += String(cod);
  strget += "&rain_val=";
  strget += String(rain);
  strget += " HTTP/1.1";
  client.println(strget);
  client.println("Host: handfarm.kro.kr");
  client.println("Connection: close");
  client.println();

  // 센서 데이터 시리얼 모니터 출력
  Serial.print("ph : ");
  Serial.print(phValue);
  Serial.print("\t");
  Serial.print("hum : ");
  Serial.print(hum);
  Serial.print("\t");
  Serial.print("temp : ");
  Serial.print(temp);
  Serial.print("\t");
  Serial.print("cod : ");
  Serial.println(cod);
  Serial.print("\t");
  Serial.print("rain : ");
  Serial.println(rain);
}

// pH 센서 전압 평균 구하기
int getMedianNum(int bArray[], int iFilterLen){
  int bTab[iFilterLen];

  for (byte i = 0; i<iFilterLen; i++){
    bTab[i] = bArray[i];
  }

  int i, j, bTemp;
  for (j = 0; j < iFilterLen - 1; j++){
    for (i = 0; i < iFilterLen - j - 1; i++){
      if (bTab[i] > bTab[i + 1]){
        bTemp = bTab[i];
        bTab[i] = bTab[i + 1];
        bTab[i + 1] = bTemp;
      }
    }
  }

  if ((iFilterLen & 1) > 0){
    bTemp = bTab[(iFilterLen - 1) / 2];
  }
  else{
    bTemp = (bTab[iFilterLen / 2] + bTab[iFilterLen / 2 - 1]) / 2;
  }
  return bTemp;
}
