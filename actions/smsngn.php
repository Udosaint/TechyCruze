<?php 

include '../config.php';

$sender1 = strtoupper(filter_var(htmlentities($_POST['sender']),FILTER_UNSAFE_RAW));
$receiver = filter_var(htmlentities($_POST['receiver']),FILTER_UNSAFE_RAW);
$message1 = filter_var(htmlentities($_POST['message']),FILTER_UNSAFE_RAW);


// Initialize variables ( set your variables here )

$username = 'udosaintdanielokoye@gmail.com';

$password = 'Udosaint@2021';

$sender   = $sender1;

$message  = $message1;

// Separate multiple numbers by comma

$mobiles  = $receiver;

// Set your domain's API URL

$api_url  = 'https://portal.nigeriabulksms.com/api/';


//Create the message data

$data = array('username'=>$username, 'password'=>$password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$mobiles);

//URL encode the message data

$data = http_build_query($data);

//Send the message

$ch = curl_init(); // Initialize a cURL connection

curl_setopt($ch,CURLOPT_URL, $api_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

$result = curl_exec($ch);

$result = json_decode($result);


if(isset($result->status) && strtoupper($result->status) == 'OK')
{
    // Message sent successfully, do anything here

    echo 'success';

}
else if(isset($result->error))
{
     // Message failed, check reason.

   echo 'Message failed - error: '.$result->error;
}
else
{
    // Could not determine the message response.

    echo 'Unable to process request';
}


 ?>