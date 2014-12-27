<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "info_edit" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$fname = ucfirst($_POST['fname']);
$lname = ucfirst($_POST['lname']);
$addr = $_POST['addr'];
$city = ucfirst($_POST['city']);
$state = ucfirst($_POST['state']);
$pin = $_POST['pin'];
$phone = $_POST['phone'];

require_once("../app/init.php");

$sql_check = $db->prepare("SELECT id FROM user_info WHERE user_id=:user LIMIT 1");
$sql_check->execute(array("user" => $user));

$numrow = $sql_check->rowCount();

if($numrow == 1){

$sql_update = $db->prepare("UPDATE user_info SET fname=:fname, lname=:lname, address=:address, city=:city, state=:state, pin=:pin, phone=:phone WHERE user_id=:user LIMIT 1");
$sql_update->execute(array(

	"fname" => $fname,
	"lname" => $lname,
	"address" => $addr,
	"city" => $city,
	"state" => $state,
	"pin" => $pin,
	"phone" => $phone,
	"user" => $user

	));

}elseif($numrow < 1){

$sql_insert = $db->prepare("INSERT INTO user_info VALUES(null, :user, :fname, :lname, :address, :city, :state,  :pin, :phone, :av)");
$sql_insert->execute(array(

	"user" => $user,
	"fname" => $fname,
	"lname" => $lname,
	"address" => $addr,
	"city" => $city,
	"state" => $state,
	"pin" => $pin,
	"phone" => $phone,
	"av" => " "
	

	));
}

$result = array("codeval" => 1);
echo json_encode($result);

}

?>	