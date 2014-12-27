<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "add_category" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;

$category = $_POST['category'];

require_once("../app/init.php");

$flag = NULL;

// check existance

$sql_check_cat = $db->prepare("SELECT id FROM category WHERE category=:cat LIMIT 1");
$sql_check_cat->execute(array("cat" => $category));
	
$num_rows = $sql_check_cat->rowCount();

	if($num_rows > 0){
		$flag = 0;
		$response = array();
		$response['errormsg'] = "This category already exists!";
		$response['codeval'] = $flag;
		echo json_encode($response);

		
	}else{

	$category = str_replace(" ", "-", $category);	

	$sql_cat = $db->prepare("INSERT INTO category VALUES(null,:cat)");
	$sql_cat->execute(array('cat'=>$category));


	$flag = 1;
	
	$response['codeval'] = $flag;
	$response['success'] = "Category has been created successfully!";
	
	echo json_encode($response);

	$db = NULL;

		}


}


?>

