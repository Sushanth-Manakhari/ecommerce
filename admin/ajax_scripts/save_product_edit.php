<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "save_product_edit" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;	

$pid = $_POST['pid'];
$name = $_POST['pname'];
$desc = $_POST['pdesc'];
$cat = $_POST['pcat'];
$i_qty = $_POST['p_in_qty'];
$s_qty = $_POST['p_av_qty'];
$s_price = $_POST['p_s_pr'];
$o_price = $_POST['p_or_pr'];

require_once("../app/init.php");

$name = str_replace(array("&", "-"), array("and", " "), $name);

$sql_check_name = $db->prepare("SELECT name FROM products WHERE id!=:pid AND name=:prdct LIMIT 1");
$sql_check_name->execute(array("pid" => $pid, "prdct" => $name));
	
$num_rows = $sql_check_name->rowCount();

	if($num_rows < 1){



$sql_update_product = $db->prepare("UPDATE products SET name=:n, description=:descr, category=:cat, inventory_qty=:in_qty, shown_qty=:sh_qty, original_price=:or_pr, sale_price=:s_pr WHERE id=:pid LIMIT 1");
$sql_update_product->execute(array("n" => $name, "descr" => $desc, "cat" => $cat, "in_qty" => $i_qty, "sh_qty" => $s_qty, "or_pr" => $o_price, "s_pr" => $s_price, "pid" => $pid));


		//echo "Prod: $product_id, Quant: $quantity, In: $current_inventory, Sh: $current_store";

		$response = array(

			"codeval" => 1
			
				);

		echo json_encode($response);

}else{

	$response = array(

			"codeval" => 0
			
				);

		echo json_encode($response);


}


}	


?>