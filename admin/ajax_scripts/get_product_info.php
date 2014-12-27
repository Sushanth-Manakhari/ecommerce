<?php

session_start();

if(isset($_GET['action']) && $_GET['action'] == "get_info_product" && isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;


$pid = $_GET['pid'];


require_once("../app/init.php");

$show_rest_cat = NULL;


$sql_get_product = $db->prepare("SELECT * FROM products WHERE id=:pid");
$sql_get_product->execute(array("pid" => $pid));

$row = $sql_get_product->fetch(PDO::FETCH_ASSOC);

$name = $row['name'];
$desc = $row['description'];

$category = $row['category'];
$in_qty = $row['inventory_qty'];
$s_qty = $row['shown_qty'];
$or_price = $row['original_price'];
$sale_price = $row['sale_price'];

                                    // get cat name

 $sql_get_cat = $db->prepare("SELECT * FROM category WHERE id=:cat");
 $sql_get_cat->execute(array("cat" => $category));

 $numrows_cat = $sql_get_cat->rowCount();

   if($numrows_cat == 0){

     }else{

   $row_cat = $sql_get_cat->fetch(PDO::FETCH_ASSOC);

   	   $cat_id = $row_cat['id'];	
       $cat_name = $row_cat['name'];

       
       $sql_get_rest_cat = $db->prepare("SELECT * FROM category WHERE id!=:restcat");
       $sql_get_rest_cat->execute(array("restcat" => $category));

       $numrows_rest_cat = $sql_get_rest_cat->rowCount();

       if($numrows_rest_cat == 0){

     	}else{
     		while($r_row = $sql_get_rest_cat->fetch(PDO::FETCH_ASSOC)){
     			$cat_r_id = $r_row['id'];
     			$cat_r_name = $r_row['name'];

     			$show_rest_cat .= '<option value="'.$cat_r_id.'">'.$cat_r_name.'</option>';
     		}

     	}

     	$category_display = '<option value="'.$cat_id.'">'.$cat_name.'</option>'.$show_rest_cat;
  }


 $edit_pro_btn = '<button type="button" style="margin-left:250px;" onClick="save_product('.$pid.');" class="btn btn-warning">Save</button>
            <button type="button" style="margin-left:20px;" onClick="close_edit_modal('.$pid.');" class="btn btn-danger">Cancel</button>';

	
		$response = array(

			"codeval" => 1,
			"p_name" => $name,
			"desc" => $desc,
			"cat_display" => $category_display,
			
			"in_qty" => $in_qty,
			"s_qty" => $s_qty,
			"or_price" => $or_price,
			"s_price" => $sale_price,
			"btns" => $edit_pro_btn

			);

	
	echo json_encode($response);

	$db = NULL;

		


}


?>