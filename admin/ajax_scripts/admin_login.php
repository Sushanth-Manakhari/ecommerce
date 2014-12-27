<?php

if(isset($_POST['action']) && $_POST['action'] == 'ad_login'){

	$email = $_POST['email'];
	$password = $_POST['password'];


	require_once("../app/init.php");

	// password encryption creation

		$salt_1 = '2emgAd86';
		$salt_2 = 'nnbghdgf9&';

		$pass = md5(sha1($salt_1.$password.$salt_2)); 

	
	$sql_login = $db->prepare("SELECT id FROM admin WHERE email=:email AND password=:password LIMIT 1");

	$sql_login->execute(array('email'=>$email, 'password'=>$pass));

	$numrows = $sql_login->rowCount();

	$row = $sql_login->fetch(PDO::FETCH_ASSOC);

	$admin_id = $row['id']; 

		if($numrows < 1){
		
		$result = array();
		$result['not_matched'] = "Your email and password does not match"; 
		$result['log_code'] = 0;

		echo json_encode($result);

		

	}else{

		

		$result['log_code'] = 1;

		session_start();

		$_SESSION['adid'] = $admin_id;

		$time=time();
		
		setcookie("adid", $admin_id, time()+86400, "/", false);

		echo json_encode($result);

	}


}

?>