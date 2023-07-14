<?php

$curl = curl_init();

include '../config.php';


// //$xreceiver = explode(',', $receiver);


$curl = curl_init();

$sender = strtoupper(filter_var(htmlentities($_POST['sender']),FILTER_UNSAFE_RAW));
$receiver = filter_var(htmlentities($_POST['receiver']),FILTER_UNSAFE_RAW);
$message = filter_var(htmlentities($_POST['message']),FILTER_UNSAFE_RAW);

$token = TOKEN;

// $sender = "registered_sender_id";
// $receiver = "destination mobile number";
// $message = "Hello how was your day?";
// $token = "YOUR_API_TOKEN";

$message_obj =  array( 
    "channel"=> "sms",
    "msg_type"=> "text",
    "recipients"=> array($receiver),
    "content"=> $message,
    "data_coding" => "auto"
);

$globals_obj = array( 
    "originator"=> $sender,
    "report_url"=> "https://the_url_to_recieve_delivery_report.com", 
);

$payload = json_encode( 
    array( 
        "messages"=> array($message_obj),
        "message_globals"=> $globals_obj 
    ) 
);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.d7networks.com/messages/v1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$payload,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer '.$token
  ),
));
$response = curl_exec($curl);
curl_close($curl);
//echo $response;






// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api.d7networks.com/messages/v1/send',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//   "messages": [
//     {
//         "channel": "sms",
//         "recipients": ["'.$receiver.'"],
//         "content": "'.$message.'",
//         "msg_type": "text",
//         "data_coding": "auto"
//     }
//   ],
//   "message_globals": {
//     "originator": "'.$sender.'",
//     "report_url": "https://the_url_to_recieve_delivery_report.com"
//   }
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Accept: application/json',
//     'Authorization: Bearer '.$token
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// //$tt =  explode(":",$response);
// //echo $tt[2];

// //echo $response;

// // $response = "dsjdskjskjcskajcskjlkcslakcslc";

// // $at = '{"request_id":"00195778-ec65-484d-a1c6-70a3a4eb923a","status":"accepted","created_at":"2023-07-06T18:13:14.838850"}';

$at = $response;

// $el = str_contains($at, '"status":"accepted"');
//echo $el;

$request_id = '';
$status = '';

if (str_contains($at, 'status":"accepted')) {

    $request_id  = substr($at, 15,36);
    $status  = substr($at, 63,8);

    $sql1 = "INSERT INTO sms_report (request_id, date, sender, receiver, message, status) VALUES (?,?,?,?,?,?)";
    $query = $db_conn->prepare($sql1);
    $stm = $query->execute([$request_id, date('Y-m-d'), $sender, $receiver, $message, $status]);

    if ($stm) {
      echo "success";
    }else{
      echo "An error Occured";
    }

}else{

  $sql1 = "INSERT INTO error_log (date, receiver, message, error) VALUES (?,?,?,?)";
  $query = $db_conn->prepare($sql1);
  $stm = $query->execute([date('Y-m-d'), $receiver, $message, $response]);

  if ($stm) {
      echo "An error Occured, Contact Admin";
  }
}



