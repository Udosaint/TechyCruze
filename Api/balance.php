<?php

include '../config.php';


/* FROM D7*/

$curl = curl_init();

$token = TOKEN;

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.d7networks.com/messages/v1/balance',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer '.$token
),
));

$response = curl_exec($curl);

curl_close($curl);

$res = explode(",",$response);
//$res = $response[11]. $response[12]. $response[13];
echo 'Balance is : $'. substr($response, -5, -1) ;;
//echo $response;

//var_dump($res[0]);




/* FROM ONBUKA*/

// $bal = 0;
// $gift = 0;

// $apiKey = "JPhsiTmw";
// $apiSecret = "ZDule2fC";

// $url = "https://api.onbuka.com/v3/getBalance";

// $timeStamp = time();
// $sign = md5($apiKey.$apiSecret.$timeStamp);

// $headers = array('Content-Type:application/json;charset=UTF-8',"Sign:$sign","Timestamp:$timeStamp","Api-Key:$apiKey");

// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);
// curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// $output = curl_exec($ch);
// curl_close($ch);

// $t =  explode(",",$output);

// $bal= 'Balance is : €'. substr($t[1], -2, -1) ;
// $gift = 'Gift is : €'.substr($t[2], -8, -3);

//echo $bal . '<br>'.$gift;
//echo $output;