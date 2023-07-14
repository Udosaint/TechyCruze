<?php 
include '../config.php';

$token = TOKEN;

$id = $_GET['id'];

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.d7networks.com/report/v1/message-log/'.$id,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token
),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response.'<br>';

if (str_contains($response, 'MESSAGE_LOG_NOT_EXISTS')) {

    echo 'The Request ID doest not exist';

}else{
    
    $status = '';

    if(str_contains($status = substr($response, -100, 15), 'sent')){
        $status = "sent";
        $set_stat = $db_conn->prepare("UPDATE sms_report SET status = ? WHERE request_id = ?");
        $stm = $set_stat->execute([$status, $id]);
        if ($stm) {
            echo 'Message '.$status;
        }


    }elseif(str_contains($status = substr($response, -100, 15), 'un_delivered')){
        $status = "un_delivered";
        $set_stat = $db_conn->prepare("UPDATE sms_report SET status = ? WHERE request_id = ?");
        $stm = $set_stat->execute([$status, $id]);
        if ($stm) {
            echo 'Message is not Delivered '.$status;
        }

    }elseif(str_contains($status = substr($response, -100, 15), 'delivered')){
        $status = "delivered";
        $set_stat = $db_conn->prepare("UPDATE sms_report SET status = ? WHERE request_id = ?");
        $stm = $set_stat->execute([$status, $id]);
        if ($stm) {
            echo 'Message '.$status;
        }

    }elseif(str_contains($status = substr($response, -100, 15), 'rejected')){
        $status = "rejected";
        $set_stat = $db_conn->prepare("UPDATE sms_report SET status = ? WHERE request_id = ?");
        $stm = $set_stat->execute([$status, $id]);
        if ($stm) {
            echo 'Message '.$status;
        }
    }else{
        echo 'ID does not exist';
    }
    
}

?>