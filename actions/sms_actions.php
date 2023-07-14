<?php 

include '../config.php';
$action = $_GET['action'];


if ($action == "countSMS") {

	$chekPwd = $db_conn->prepare("SELECT * FROM sms_report ");
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo 'Total SMS : '.$chekPwd->rowCount();
    }else {
    	echo 'Total SMS : '.$chekPwd->rowCount();
    }
}


if($action == "countdeliver"){
	$chekPwd = $db_conn->prepare("SELECT * FROM sms_report WHERE status = 'delivered' ");
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo 'No of Delivered SMS : '.$chekPwd->rowCount();
    }else {
    	echo 'No of Delivered SMS : '.$chekPwd->rowCount();
    }
}


if($action == "countfail"){

	$chekPwd = $db_conn->prepare("SELECT * FROM sms_report WHERE status = 'un_delivered' ");
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo 'Total Failed SMS : '.$chekPwd->rowCount();
    }else {
    	echo 'Total Failed SMS : '.$chekPwd->rowCount();
    }
}


if($action == "countrejected"){
	$chekPwd = $db_conn->prepare("SELECT * FROM sms_report WHERE status = 'rejected' ");
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo 'No of Rejected SMS : '.$chekPwd->rowCount();
    }else {
    	echo 'No of Rejected SMS : '.$chekPwd->rowCount();
    }
}

?>