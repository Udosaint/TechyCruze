<?php 

ob_start();
include("../config.php");

$username = filter_var(htmlentities($_POST['username']),FILTER_UNSAFE_RAW);
$password = filter_var(htmlentities($_POST['password']),FILTER_UNSAFE_RAW);



if($username == null && $password == null){
	echo "Enter your username or email and password to login";
}elseif ($username == null){
	echo "Enter your username or email to login";
}elseif($password == null){
	echo "Enter your password to login";
}

else{
    $chekPwd = $db_conn->prepare("SELECT * FROM admin WHERE username = :username OR email = :email");
    $chekPwd->bindParam(':username',$username,PDO::PARAM_STR);
    $chekPwd->bindParam(':email',$username,PDO::PARAM_STR);
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        echo "username or email address does not exist";
    }
    while ($row = $chekPwd->fetch(PDO::FETCH_ASSOC)) {
        $rUsername = $row['username'];
        $rPassword = $row['password'];
        $role = $row['role'];
        $rEmail = $row['email'];

        if (password_verify($password,$rPassword)) {
        	$loginsql = "SELECT * FROM admin WHERE username = :rUsername OR email = :rEmail AND password = :rPassword";
        	$query = $db_conn->prepare($loginsql);
    		$query->bindParam(':rUsername', $username, PDO::PARAM_STR);
            $query->bindParam(':rEmail', $username, PDO::PARAM_STR);
    		$query->bindParam(':rPassword', $rPassword, PDO::PARAM_STR);
   			$query->execute();
    		$num = $query->rowCount();
		    if($num == 0){
		       echo "User and password incorrect!";
		    }
		    else{

                $_SESSION['username'] = $rUsername;
                $_SESSION['email'] = $rEmail;
                $_SESSION['role'] = $role;
                echo  "success";
		    }   
        }
        else{
          echo "Incorrect password Please try again";
        }
    }
}


?>