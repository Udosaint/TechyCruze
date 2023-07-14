<?php 

ob_start();
include ("../config.php");
session_destroy();
session_unset();
header("Location: ../");
exit();
 ?>