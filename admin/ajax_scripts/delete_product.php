<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "delete_product" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;
	

$product_id = $_POST['pid'];

require_once("../app/init.php");

$sql_delete_product = $db->prepare("DELETE FROM products WHERE id=:pid LIMIT 1");
$sql_delete_product->execute(array("pid" => $product_id));

// delete images

$delete_img = $db->prepare("DELETE FROM product_images WHERE p_id=:pid");
$delete_img->execute(array("pid" => $product_id));

// delete folder

$addr = "../../site_images/products/$product_id";

			/* delete folder and contents */

			function Delete($path)
				{
				    if (is_dir($path) === true)
				    {
				        $files = array_diff(scandir($path), array('.', '..'));

				        foreach ($files as $file)
				        {
				            Delete(realpath($path) . '/' . $file);
				        }

				        return rmdir($path);
				    }

				    else if (is_file($path) === true)
				    {
				        return unlink($path);
				    }

				    return false;
				}

				Delete($addr);


			$response = array(

			"codeval" => 1,
				);

		echo json_encode($response);



}	


?>