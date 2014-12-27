<?php

if(isset($_POST['action']) && $_POST['action'] == 'ad_register'){

	
	$email = $_POST['email'];
	$password = $_POST['password'];
	


	require_once("../app/init.php");

	//checking if email exists

	$sql_check_email = null;
	$sql_register = null;
	$flag = NULL;

	$sql_check_email = $db->prepare("SELECT id FROM admin WHERE email=:email LIMIT 1");
	$sql_check_email->bindParam(':email', $email);
	$sql_check_email->execute();
	
	$num_rows = $sql_check_email->rowCount();

	if($num_rows > 0){
		$flag = 0;
		$response = array();
		$response['email_exists'] = "This email address already exists!";
		$response['res_code'] = $flag;
		echo json_encode($response);

		
	}else{

		

		


		// password encryption creation

		$salt_1 = '2emgAd86';
		$salt_2 = 'nnbghdgf9&';

		$pass = md5(sha1($salt_1.$password.$salt_2)); 

		

		$sql_register = $db->prepare("INSERT INTO admin VALUES(null,:em,:pass)");
		$sql_register->execute(array('em'=>$email, 'pass'=>$pass));

		$admin_id = $db->lastInsertId();

		
		

		$flag = 1;

		

		session_start();
		$_SESSION['adid'] = $admin_id;

		$time=time();
		setcookie("adid", $admin_id, time()+86400, "/", false);
		
		
		$response['res_code'] = $flag;
		
		echo json_encode($response);

		

		
	}





}

?>