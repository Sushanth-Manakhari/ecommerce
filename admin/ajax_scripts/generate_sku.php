<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "send_sku" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;




require_once("../app/init.php");



// get autoincrement id

$sql = $db->prepare("SHOW TABLE STATUS LIKE 'products'");
$sql->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);

$auto_increment = $row['Auto_increment'];


if(strlen($auto_increment) == 2){
	$new = "0".$auto_increment;
}elseif(strlen($auto_increment) == 1){
	$new = "00".$auto_increment;
}else{
	$new = $auto_increment;
}

$new_sku =  "#ecomm_".$new;


	
		$response = array(

			"codeval" => 1,
			"success" => $new_sku

			);

	
	echo json_encode($response);

	$db = NULL;

		


}


?>