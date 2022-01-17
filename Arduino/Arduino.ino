#include <SPI.h>
#include <Ethernet.h>
#include <OneWire.h>
#include <DallasTemperature.h>
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = {192, 168, 137, 20 }; //Enter the IP of ethernet shield
byte serv[] = {192, 168, 137, 100} ; //Enter the IPv4 address
EthernetClient client;

#define ONE_WIRE_BUS 43 //กำหนดขาที่จะเชื่อมต่อ SensorTemp
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
int led1 =13;   // ledpin13 and ledtemp
int led2 =12;   // ledpin12 and ledLswitch
int led3 =11;   // ledpin11 and Current
float Temp;     // ตัวแปรเก็บอุณหภูมิ
//char Current;   
int Lswitch =4;   //Lswitch pin 4
int flag ;         
char Door[6];    
int t=1;        
int d=1;        
int c=1;        
double val;     // เก็บค่าเฉลี่ยของค่าอนาล็อคที่ได้จากเซนเซอร์วัดกระแส
int count = 500;  // จำนวนรอบที่จะนำมาคิดค่าเฉลี่ยของเซนเซอร์วัดกระแส
double sum1=0;   // ตัวแปรเก็บผลรวมของค่าอนาล็อคที่ได้จากเซนเซอร์วัดกระแส
float vs1;
float vs2;
void setup() {
   Serial.begin(9600); //setting the baud rate at 9600
   Ethernet.begin(mac, ip);
   pinMode(led1,OUTPUT);
   pinMode(Lswitch,INPUT);
   pinMode(led2,OUTPUT);
   pinMode(led3,OUTPUT);
   float vstart = analogRead(A0);
   vs1 = vstart+10;
   vs2 = vstart-10;
}

void loop() {
  sensors.requestTemperatures();    //สั่งอ่านค่าอุณหภูมิ
  Temp = sensors.getTempCByIndex(0);  // เก็บค่าอุณหภูมในตัวแปร Temp
  sento_adata();                   // ส่งเข้าdatabase getdataA.php
  Serial.println(Temp);
  if(Temp > 40){                 //ถ้าอุณหภูมิมากกว่า 40 องศาเซลเซียล
     digitalWrite(led1, HIGH);    //led1 ไฟติด
     if(t==1){                    //ถ้าอ่านค่าครั้งแรก
     sento_error();               //ส่งเข้าdatabase getdataerror.php
     sento_linetemp();            // ส่งเข้าline line.php
     t++;             
     }
     else{
     sento_error1();           //ส่งเข้าdatabase getdataerror1.php
     }
  }
  if(Temp < 40){                 //ถ้าอุณหภูมิน้อยกว่า 40 องศาเซลเซียล
     digitalWrite(led1, LOW);     //led1 ไฟดับ
     t=1;
  }
  //////////////////////////////////////////////////////////////////
  if((digitalRead(Lswitch)==LOW)&&(flag==0))     // ถ้าลิมิตสวิตโดนกด
  {
     digitalWrite(led2,LOW); 
     Serial.println("door is closed");          
     char Door[] = "closed";                  // Door[] เก็บค่า "closed"
     flag = 1;
     d=1;
     delay(20);
  }
  if((digitalRead(Lswitch)==HIGH)&&(flag==1))    // ถ้าลิมิตสวิตไม่โดนกด
  {
     digitalWrite(led2,HIGH);
     Serial.println("door is opened");
     char Door[] = "opened";                  // Door[] เก็บค่า "opened"
     flag = 0;
     if(d==1){
     sento_error();                          //ส่งเข้าdatabase getdataerror.php
     sento_linedoor();                        // ส่งเข้าline linedoor.php
      d++;
     }
     delay(20);
  }
  digitalWrite(Lswitch,HIGH);
  ////////////////////////////////////////////////////////////////////
    for (int i = 0; i < count; i++) {    //เก็บค่าอนาล็อคที่ได้จากเซนเซอร์วัดกระแส500ครั้ง
  float v_raw = analogRead(A0);             //รับค่าอนาล็อคที่ได้จากเซนเซอร์วัดกระแสเก็บไว้ใน v_raw
   //Serial.println(v_raw);
  sum1 =sum1 +v_raw;                   //ผลรวมของ v_raw
  }
  val = sum1 / count;         //หาค่าเฉลี่ยเก็บใน val
  Serial.println(val);
  if((val>vs1)||(val<vs2)){   // ถ้า val มีค่ามากกว่า vs1 หรือ น้อยกว่า vs1 เท่ากระมีกระแสไฟฟ้า
    Serial.println("Active");
    digitalWrite(led3,HIGH);
    c=1;
  }
  else{
    if(c==1){
     sento_error();      //ส่งเข้าdatabase getdataerror.php
     sento_linecurrent();  // ส่งเข้า line sento_linecurrent()
      c++;
     }
     Serial.println("No Active");
     digitalWrite(led3,LOW);
  }
  sum1 = 0;
  delay(100);

  Sending_To_phpmyadmindatabase();   //ส่งเข้าdatabase databasep2.php
}
///////////////////////////////////////////////////////////////////////////////////////////
 void Sending_To_phpmyadmindatabase(){   //ส่งเข้าdatabase databasep2.php ส่งค่า Temp,Door,Current ไว้ใช้แสดงค่าหน้าเว็บ
 if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/databasep2.php?Temp=");
    client.print("GET http://localhost/web/datadase/databasep2.php?Temp=");     //YOUR URL
    client.print(Temp);
    Serial.print(Temp);
    client.print("&Door=");
    Serial.print("&Door=");
    if(flag==0)
    {
    char Door[] = "opened";
    flag = 1;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    else if(flag==1)
    {
    char Door[] = "closed";
    flag = 0;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    client.print("&Current=");
    Serial.print("&Current=");
    if((val>vs1)||(val<vs2)){
    char Current[]= "Active";
    client.print(Current);
    Serial.println(Current);
    }
  else{
    char Current[]= "No%20Active";
    client.print(Current);
    Serial.println(Current);
  }   
    
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
 }
else {
      Serial.println("connection failed");
 }
}
///////////////////////////////////////////////////////////////////
   void sento_adata(){ //ส่งเข้าdatabase getdataA.php ส่งค่า Temp ไว้ใช้แสดงค่าในกราฟหน้าเว็บ
 if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/getdataA.php?Temp=");
    client.print("GET http://localhost/web/datadase/getdataA.php?Temp=");     //YOUR URL
    client.print(Temp);
    Serial.println(Temp);
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
 }
else {
      Serial.println("connection failed");
 }
}
///////////////////////////////////////////////////////////////////////////
void sento_error(){ //ส่งเข้าdatabase getdataerror.php ส่งค่า Temp,Door,Current <insert>
  if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/getdataerror.php?Temp=");  //http://localhost/source/datadase/getdataerror.php?Temp=26.19&Door=opened&Current=No%20Active
    client.print("GET http://localhost/web/datadase/getdataerror.php?Temp=");  //http://localhost/source/datadase/getdataerror.php?Temp=26.19&Door=opened&Current=No%20Active
  client.print(Temp);
    Serial.print(Temp);
    client.print("&Door=");
    Serial.print("&Door=");
    if(flag==0)
    {
    char Door[] = "opened";
    flag = 1;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    else if(flag==1)
    {
    char Door[] = "closed";
    flag = 0;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    client.print("&Current=");
    Serial.print("&Current=");
   if((val>vs1)||(val<vs2)){
    char Current[]= "Active";
    client.print(Current);
    Serial.println(Current);
    }
  else{
    char Current[]= "No%20Active";
    client.print(Current);                      //unread
    Serial.println(Current);
    } 
    client.print("&status=unread");
    Serial.print("&status=unread");
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection  
  }
else {
      Serial.println("connection failed");
 }
}
////////////////////////////////////////////////////////////////////////////////////////////
void sento_error1(){  //ส่งเข้าdatabase getdataerror1.php ส่งค่า Temp,Door,Current <UPDATE>
  if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/getdataerror1.php?Temp=");
    client.print("GET http://localhost/web/datadase/getdataerror1.php?Temp=");     //YOUR URL
  client.print(Temp);
    Serial.print(Temp);
    client.print("&Door=");
    Serial.print("&Door=");
    if(flag==0)
    {
    char Door[] = "opened";
    flag = 1;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    else if(flag==1)
    {
    char Door[] = "closed";
    flag = 0;
    delay(20);
    client.print(Door);
    Serial.print(Door);
    }
    client.print("&Current=");
    Serial.print("&Current=");
    if((val>vs1)||(val<vs2)){
    char Current[]= "Active";
    client.print(Current);
    Serial.println(Current);
    }
  else{
    char Current[]= "No%20Active";
    client.print(Current);
    Serial.println(Current);
    }   
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
  }
else {
      Serial.println("connection failed");
     }
 }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 void sento_linetemp(){  //ส่งเข้า line.php ส่งค่า Temp
 if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/line.php?Temp=");
    client.print("GET http://localhost/web/datadase/line.php?Temp=");     //YOUR URL
    client.print(Temp);
    Serial.println(Temp);
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
 }
else {
      Serial.println("connection failed");
 }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
void sento_linedoor(){ //ส่งเข้า linedoor.php ส่งค่า Door=opened
 if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/linedoor.php?Door=opened");
    client.print("GET http://localhost/web/datadase/linedoor.php?Door=opened");     //YOUR URL
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
 }
else {
      Serial.println("connection failed");
 }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
void sento_linecurrent(){ //ส่งเข้า linecur.php ส่งค่า Current=No%20Active
 if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("connected");
    Serial.print("GET http://localhost/web/datadase/linecur.php?Current=No%20Active");
    client.print("GET http://localhost/web/datadase/linecur.php?Current=No%20Active");     //YOUR URL
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.100");
    client.println("Connection: close");
    client.println();
    client.stop(); //Closing the connection
 }
else {
      Serial.println("connection failed");
 }
}
