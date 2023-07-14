<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wemessage";

// $servername = "localhost";
// $username = "hbonslbz_Techycruze";
// $password = "Techy@2023";
// $dbname = "hbonslbz_techycruze";


define("SITE_URL", "www.techycruze.live");

define("SITE_ADDRESS", "techycruze.live");

define("SITE_NAME", "TechyCruze");

define("SITE_PHONE", "+1 (706) 514‑8852");

define("SITE", "Techycruze");

define("SITE_EMAIL", "info@".SITE_ADDRESS);

define('TOKEN', '');







try 
    {
    $db_conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
// ========================= config the languages ================================
   session_start();
   ob_start();
    date_default_timezone_set("America/New_York");
    error_reporting(E_NOTICE ^ E_ALL);

    //====================================================================================================================================================

    define("ACTIVE_LINK","dashboard");
