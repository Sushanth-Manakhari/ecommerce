<?php

session_start();

if(isset($_GET['action']) && $_GET['action'] == "get_cart_count" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;



require_once("../app/init.php");




// selecting new update

$get_cart = $db->prepare("SELECT id FROM user_cart WHERE user_id=:uid");
$get_cart->execute(array("uid" => $user));

$count = $get_cart->rowCount();



$result = array("count" => $count);


echo json_encode($result);


}


?>