<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "delete_item" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$pid = $_POST['pid'];


require_once("../app/init.php");




// selecting new update

$del_cart = $db->prepare("DELETE FROM user_cart WHERE pid=:pid AND user_id=:uid LIMIT 1");
$del_cart->execute(array("pid" => $pid, "uid" => $user));




$result = array("codeval" => 1);


echo json_encode($result);


}


?>