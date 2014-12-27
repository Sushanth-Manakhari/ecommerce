<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "update_item" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$pid = $_POST['pid'];

$qty_update = $_POST['quant'];


require_once("../app/init.php");



// check how many qants are present

$in_stock = $db->prepare("SELECT shown_qty FROM products WHERE id=:pid LIMIT 1");
$in_stock->execute(array("pid" => $pid));

$row = $in_stock->fetch(PDO::FETCH_ASSOC);


$qty = $row['shown_qty'];
// quantity less than 1 or not

if($qty < $qty_update){

$array = array("codeval" => 0);
echo json_encode($array);

}elseif($qty >= $qty_update){

// selecting new update



$up_cart = $db->prepare("UPDATE user_cart SET qty=:qty WHERE pid=:pid AND user_id=:uid LIMIT 1");
$up_cart->execute(array("qty" => $qty_update, "pid" => $pid, "uid" => $user));




$result = array("codeval" => 1);


echo json_encode($result);


}
  
} 


?>