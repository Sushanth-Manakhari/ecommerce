<?php
session_start();

if(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$user = $_SESSION['uid'];


}

if(isset($_GET['action']) && $_GET['action'] == "get_products"){

	$product_display = NULL;

	require_once("../app/init.php");


$category = $_GET['cat'];
$mode = $_GET['mode'];

$get_cat_name = $db->prepare("SELECT name FROM category WHERE id=:cat LIMIT 1");
$get_cat_name->execute(array("cat" => $category));

$rowcat = $get_cat_name->fetch(PDO::FETCH_ASSOC);
$category_name = $rowcat['name'];

// if load more button will be displayed or not. if product > 6 then cool

$get_products_sql_loadmore = $db->prepare("SELECT * FROM products WHERE category=:cat");
$get_products_sql_loadmore->execute(array("cat" => $category));

$numrow_load = $get_products_sql_loadmore->rowCount();



switch($mode){

	case 0 : $get_products_sql = $db->prepare("SELECT * FROM products WHERE category=:cat ORDER BY id DESC LIMIT 0, 6");
			 $set_mode = null;	
			 break;

	case 1 : $get_products_sql = $db->prepare("SELECT * FROM products WHERE category=:cat ORDER BY id DESC LIMIT 0, 6");
			 $set_mode = "Most Recent";	
			 break;	


	case 2 : $get_products_sql = $db->prepare("SELECT * FROM products WHERE category=:cat ORDER BY sold DESC LIMIT 0, 6");
			 $set_mode = "Most Sold";
			 break;		 



	case 3 : $get_products_sql = $db->prepare("SELECT * FROM products WHERE category=:cat ORDER BY sale_price ASC LIMIT 0, 6");
			 $set_mode = "From minimum Price";
			 break;			 

			 }


$get_products_sql->execute(array("cat" => $category));

$numrow = $get_products_sql->rowCount();

if($numrow < 1){

	$result = array(

		"codeval" => 0,
		"error_get" => "There isn't any products yet under this category..",
		"setmode" => $set_mode
		
		);

	echo json_encode($result);

}else{


// determine which load more button to display depending on the mode....

if($numrow_load <= 6){

	// if products <= 6 then no display

	$loadmore = null;

	
}else{

	//$start_after = 6;

	$loadmore = '<button type="button" id="load_more_btn" class="btn btn-primary" onClick="load_more_get_products('.$category.',  '.$mode.');" >Load More</button>';
	
}





while($row = $get_products_sql->fetch(PDO::FETCH_ASSOC)){

  $pid = $row['id'];
  $name = $row['name'];
  $desc = $row['description'];
  $main_image = $row['main_image'];
  $sold = $row['sold'];
  $original_price = $row['original_price'];
  $sale_price = $row['sale_price'];

  $fullname = $row['name'];


  if($original_price != 0){
   
    $or_pr_div = '<li class="list-inline-item" style="padding:5px;"><s>&#8360; '.$original_price.'</s></li>';
  
  }else{
    $or_pr_div = null;
  }



  $desc = substr($desc, 0, 90);
  $desc = $desc.'....';

  $main_image = 'site_images/products/'.$pid.'/'.$main_image.''; 


  if(strlen($name) > 25 ){

 $name = substr($name, 0, 25);
 $name = $name."...";

	}

	
 $name_url_link = str_replace(" ", "-", $fullname);

 if(isset($_SESSION['uid'])){

   $cart_btn = '<a href="javascript:;" style="color:black;" class="btn btn-info" onClick="add_to_cart('.$pid.');"  role="button">Add to Cart</a>';

  }else{

     $cart_btn = '<a href="javascript:;" style="color:black;" onClick="login_glow();" class="btn btn-info"  role="button">Add to Cart</a>';

  }
	

    $product_display .= '<div class="col-sm-6 col-md-4">
    <a href="product.php?cat='.$category_name.'&p='.$name_url_link.'"  style="text-decoration:none; color:#000;">
       	<div class="thumbnail">	
          <img src="'.$main_image.'" style="height:300px;" title="'.$fullname.'">
          <div class="caption">
            <h3><span title="'.$fullname.'">'.$name.'</span></h3>
             
            <p>'.$desc.'</p>
            <p><ul class="list-inline"><li class="list-inline-item" style="padding:5px; font-size:19px;"><b>&#8360; '.$sale_price.'</b></li>'.$or_pr_div.'</ul>'.$cart_btn.'</p>
          </div>
        </div>
        </a>
      </div>';

    

    
    

}

$result = array(

		"codeval" => 1,
		"success" => $product_display,
		"loadmore" => $loadmore,
		"setmode" => $set_mode
		);

echo json_encode($result);

}




}
?>	