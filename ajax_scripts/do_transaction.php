<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "order_product" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$name = $_POST['name'];
$addr = $_POST['addr'];
$city = $_POST['city'];
$state = $_POST['state'];
$pin = $_POST['pin'];
$phone = $_POST['phone'];
$order = $_POST['order'];


// get user cart

// selecting new update

require_once("../app/init.php");

$get_cart = $db->prepare("SELECT * FROM user_cart WHERE user_id=:uid");
$get_cart->execute(array("uid" => $user));

$get_cart_row = $get_cart->rowCount();

if($get_cart_row >= 1){

// generate transaction id
			$sql = $db->prepare("SHOW TABLE STATUS LIKE 'product_order'");
			$sql->execute();

			$row = $sql->fetch(PDO::FETCH_ASSOC);

			$auto_increment = $row['Auto_increment'];


			$transaction_id = "ECOMM".$auto_increment.time();

			

while($row = $get_cart->fetch(PDO::FETCH_ASSOC)){

$pid = $row['pid'];
$qty = $row['qty'];



//check product exist or not

$in_stock = $db->prepare("SELECT shown_qty, sale_price FROM products WHERE id=:pid LIMIT 1");
$in_stock->execute(array("pid" => $pid));

$numrow = $in_stock->rowCount();

// product exist or not

if($numrow != 1){

//  product doesnt exist


	$array = array("codeval" => 0);
	echo json_encode($array);

	//exit;

}else{ 

$row = $in_stock->fetch(PDO::FETCH_ASSOC);
$shown_qty = $row['shown_qty'];
$price = $row['sale_price'];

// out of stock

if($qty > $shown_qty){

 

	$array = array("codeval" => 2);
	echo json_encode($array);

	//exit;

}else{


$subtotal = $price * $qty;

// insert into order table

}

}


$sql_insert_order = $db->prepare("INSERT INTO product_order VALUES(null, :uid, :trns_id, :pid, :qty, :subttl)");
$sql_insert_order->execute(array(

		"uid" => $user,
		"trns_id" => $transaction_id,
		"pid" => $pid,
		"qty" => $qty,
		"subttl" => $subtotal

	));


// update quantity

$sql_update_product = $db->prepare("UPDATE products SET shown_qty=(shown_qty-:s_qty) WHERE id=:pid  LIMIT 1");
$sql_update_product->execute(array("s_qty" => $qty, "pid" => $pid));




}




// insertion into customers table


			


	date_default_timezone_set('Asia/Kolkata');
	$date = date('Y-m-d H:i:s');

	// customer insert
	
	$sql_insert_customer = $db->prepare("INSERT INTO transaction VALUES(null, :user, :name, :addr, :city, :state, :pin, :phone, :time, :tr_id, :or_type)");		
	$sql_insert_customer->execute(array(

		"user" => $user,
		"name" => $name,
		"addr" => $addr,
		"city" => $city,
		"state" => $state,
		"pin" => $pin,
		"phone" => $phone,
		"time" => $date,
		"tr_id" => $transaction_id,
		"or_type" => $order

		));


	// empty cart

	$del_cart = $db->prepare("DELETE FROM user_cart WHERE user_id=:uid");
	$del_cart->execute(array("uid" => $user));


$result = array(
	"codeval" => 1,
	"trans" => $transaction_id
	);

echo json_encode($result);



}	


} 

?>