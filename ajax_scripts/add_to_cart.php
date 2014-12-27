<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "add_to_cart" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$pid = $_POST['pid'];

// check in stock

require_once("../app/init.php");

$in_stock = $db->prepare("SELECT shown_qty FROM products WHERE id=:pid LIMIT 1");
$in_stock->execute(array("pid" => $pid));

$numrow = $in_stock->rowCount();

// product exist or not

if($numrow != 1){

	$array = array("codeval" => 0);
	echo json_encode($array);

}else{


$row = $in_stock->fetch(PDO::FETCH_ASSOC);


$qty = $row['shown_qty'];
// quantity less than 1 or not

if($qty < 1){

$array = array("codeval" => 2);
echo json_encode($array);

}elseif($qty >= 1){


// check if the product is already there in cart then update or insert

$pr_exist = $db->prepare("SELECT pid FROM user_cart WHERE pid=:pid AND user_id=:uid LIMIT 1");
$pr_exist->execute(array("pid" => $pid, "uid" => $user));	

$numrow_e = $pr_exist->rowCount();

if($numrow_e == 1){

$update_cart = $db->prepare("UPDATE user_cart SET qty=qty+1 WHERE pid=:pid AND user_id=:uid LIMIT 1 ");
$update_cart->execute(array("pid" => $pid, "uid" => $user));


}else{

$insert_cart = $db->prepare("INSERT INTO user_cart VALUES(null, :pid, :uid, :qty)");
$insert_cart->execute(array("pid" => $pid, "uid" => $user, "qty" => 1));


}

// selecting new update



$result = array(

	"codeval" => 1
	
	);

echo json_encode($result);

}


}

} 


?>