<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "add_product" && isset($_COOKIE['adid'])){


$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;


$name = $_POST['name'];
$desc = $_POST['desc'];
$cat = $_POST['cat'];
$i_qty = $_POST['i_qty'];
$s_qty = $_POST['s_qty'];
$s_price = $_POST['s_price'];
$o_price = $_POST['o_price'];
$sku = $_POST['sku'];
$img_pref = $_POST['img_pref'];


require_once("../app/init.php");



// check image uploaded or not

$sql = $db->prepare("SHOW TABLE STATUS LIKE 'products'");
$sql->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);

$auto_increment = $row['Auto_increment'];


// check existance of name
$name = str_replace(array("&", "-"), array("and", " "), $name);



$sql_check_name = $db->prepare("SELECT name FROM products WHERE name=:prdct LIMIT 1");
$sql_check_name->execute(array("prdct" => $name));
	
$num_rows = $sql_check_name->rowCount();

	if($num_rows > 0){
		
		$response = array(

			"codeval" => 0,
			"error0" => "This product already exist. Change the name."

			);

		echo json_encode($response);

		
	}else{

	// check sku
	
	$sql_check_sku = $db->prepare("SELECT sku FROM products WHERE sku=:sku LIMIT 1");
	$sql_check_sku->execute(array("sku" => $sku));
	
	$num_rows_sku = $sql_check_sku->rowCount();	

	if($num_rows_sku == 1){

		$response = array(

			"codeval" => 2,
			"error2" => "The sku number already exists. Change it"

			);

		echo json_encode($response);


	}else{


	$sql_insert_product = $db->prepare("INSERT INTO products VALUES(null,:name, :descr, :sku, :cat, :i_qty, :s_qty, :o_pr, :s_pr, :main_image, :sold)");
	
	$sql_insert_product->execute(array(

		"name" => $name,
		"descr" => $desc,
		"sku" => $sku,
		"cat" => $cat,
		"i_qty" => $i_qty,
		"s_qty" => $s_qty,
		"o_pr" => $o_price,
		"s_pr" => $s_price,
		"main_image" => $img_pref.'.jpg',
		"sold" => 0

		));


	$sql_image_get = $db->prepare("SELECT image FROM product_images_dump WHERE pid=:pid");
	$sql_image_get->execute(array("pid" => $auto_increment));

	while($row = $sql_image_get->fetch(PDO::FETCH_ASSOC)){

		$image = $row['image'];

		$sql_insert_image = $db->prepare("INSERT INTO product_images VALUES(null, :pid, :image)");
		$sql_insert_image->execute(array("pid" => $auto_increment, "image" => $image));

	}


	$sql_delete_dump = $db->prepare("DELETE FROM product_images_dump WHERE pid=:pid");
		$sql_delete_dump->execute(array("pid" => $auto_increment));

	
	
		$response = array(

			"codeval" => 1,
			"success" => "Your product has been inserted"

			);

	
	echo json_encode($response);

	$db = NULL;

		}

	}


}


?>