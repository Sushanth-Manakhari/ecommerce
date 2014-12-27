<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "transfer_quantity" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;

$product_id = $_POST['pid'];
$quantity = $_POST['qty_tr'];
$in_qty = $_POST['in_qty'];
$sh_qty = $_POST['sh_qty'];

require_once("../app/init.php");


$current_inventory = $in_qty - $quantity;

$current_store = $sh_qty + $quantity;



$sql_update_product = $db->prepare("UPDATE products SET inventory_qty=:in_qty , shown_qty=:sh_qty WHERE id=:pid LIMIT 1");
$sql_update_product->execute(array("in_qty" => $current_inventory, "sh_qty" => $current_store, "pid" => $product_id));


		//echo "Prod: $product_id, Quant: $quantity, In: $current_inventory, Sh: $current_store";

		$response = array(

			"codeval" => 1,
			"in_q" => $current_inventory,
			"sh_q" => $current_store
				);

		echo json_encode($response);



}	


?>