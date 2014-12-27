<?php

session_start();
require_once("app/init.php");

if(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$user = $_SESSION['uid'];


}

function go_to_404(){


header("Location:404.php");


} 

if(!isset($_GET['cat']) && !isset($_GET['p'])){

go_to_404();

}else if(isset($_GET['cat']) && isset($_GET['p'])){

    $cat_get = $_GET['cat'];
    $name_get = $_GET['p'];

    // get cat id

    require_once("app/init.php");

    $get_cat_id = $db->prepare("SELECT id FROM category WHERE name=:cat LIMIT 1");
    $get_cat_id->execute(array("cat" => $cat_get));

    $rowcat = $get_cat_id->fetch(PDO::FETCH_ASSOC);
    $category_id = $rowcat['id'];

    $pname = str_replace("-", " ", $name_get);

  

require_once('app/init.php');

$sql_check_p_exists = $db->prepare("SELECT * FROM products WHERE name=:name AND category=:cat LIMIT 1");
$sql_check_p_exists->execute(array("name" => $pname, "cat" => $category_id));

$numrow = $sql_check_p_exists->rowCount();

if($numrow < 1){

//go_to_404();

}else{

  $row = $sql_check_p_exists->fetch(PDO::FETCH_ASSOC);

  $pid = $row['id'];
  $pname = $row['name'];
  $pdesc = $row['description'];
  $price = $row['sale_price'];
  $or_price = $row['original_price'];
  $quantity = $row['shown_qty'];
  $main_image = $row['main_image'];

  //get main image id

  $sql_get_main_image_id = $db->prepare("SELECT id FROM product_images WHERE p_id=:pid && image=:image");
  $sql_get_main_image_id->execute(array("pid" => $pid, "image" => $main_image));

  $row_main = $sql_get_main_image_id->fetch(PDO::FETCH_ASSOC);

  $m_img_id = $row_main['id'];

$small_image_connect_link = str_replace(".jpg", "", $main_image);

$main_image_link = "site_images/products/$pid/$main_image";
$main_image_frame = '<span class="ex1" id="main_image_holder'.$small_image_connect_link.'"><img src="'.$main_image_link.'" style="height:550px; width:100%; "></span>';
$small_image_frame = '<li id="small_image_holder'.$small_image_connect_link.'" style="padding:7px;"><a href="javascript:;" onClick="change_image('.$small_image_connect_link.');"><img src="'.$main_image_link.'" style="width:100px; height:120px;"></a></li>';

  if($or_price != 0){
    $or_price_display = $or_price;
  }elseif($or_price == 0){
    $or_price_display = $or_price;
  }

  if($quantity < 1){
    $cart_btn = null;
    $available = "<small>Out of Stock</small>";
  }else if($quantity >= 1){

    if(isset($_SESSION['uid'])){
    $cart_btn = '<a href="javascript:;" class="btn btn-primary btn-lg" onClick="add_to_cart('.$pid.');" role="button">Add to Cart</a>';
    }else{
     $cart_btn = '<a href="javascript:;" class="btn btn-primary btn-lg" onClick="login_glow();" role="button">Add to Cart</a>'; 
    }
    $available = "<small>In Stock</small>";
    
  }

  

  $sql_get_images = $db->prepare("SELECT * FROM product_images WHERE p_id=:pid && image!=:image");
  $sql_get_images->execute(array("pid" => $pid, "image" => $main_image));

  $numrow_img = $sql_get_images->rowCount();

if($numrow_img < 1){
    $rest_main_image_frame = null;
    $rest_small_image_frame = null;
}else{

  $rest_image = array();

  while($row = $sql_get_images->fetch(PDO::FETCH_ASSOC)){

    $img_id = $row['id'];
    $rest_image[] = $row['image'];

    
  }

  $rest_main_image_frame_array = array();
  $rest_small_image_frame_array = array();

  foreach ($rest_image as $each_image) {

$small_rest_image_connect_link = str_replace(".jpg", "", $each_image); 

  $rest_image_link = "site_images/products/$pid/$each_image";

  $rest_main_image_frame_array[] = '<span class="ex1" id="main_image_holder'.$small_rest_image_connect_link.'" style="display:none;"><img src="'.$rest_image_link.'" style="height:550px; width:100%; "></span>';

  $rest_small_image_frame_array[] = '<li id="small_image_holder'.$small_rest_image_connect_link.'" style="padding:7px;"><a href="javascript:;" onClick="change_image('.$small_rest_image_connect_link.');"><img src="'.$rest_image_link.'" style="width:100px; height:120px;"></a></li>';

}

$rest_main_image_frame = implode(" ", $rest_main_image_frame_array);
$rest_small_image_frame = implode(" ", $rest_small_image_frame_array);

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ecommerce Demo</title>

   <?php include_once("includes/header.php") ; ?>





	<div class="row" style="margin-top:80px;">

		<!-- ekhane hobe -->

         <div class="col-sm-7 col-md-5" style="padding:10px;">
   
      <?php echo $main_image_frame; ?>
      <?php echo $rest_main_image_frame; ?>

      <div class="caption">

      <ul class="nav nav-tabs"  id="show_uploaded_slider_images">
      <?php echo $small_image_frame; ?>
      <?php echo $rest_small_image_frame; ?>
      </ul>
        
      </div>
    
  </div>

  <div class="col-sm-6 col-md-4">
    
      <div class="caption">
        <h3><?php echo $pname; ?></h3>
        <span class="text-muted"><?php echo $available; ?></span>

        <h3>&#8360; <?php echo $price; ?></h3>
        <h6><s>&#8360; <?php echo $or_price_display; ?></s></h6>
         <p><?php echo $cart_btn; ?></p>
        <p><?php echo $pdesc; ?></p>
       


        
      </div>
     
    
  </div>

 


   </div> <!-- /row -->



   </div> <!-- /container -->


   <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
   <script src='js/zoom.js'></script>
   <script type="text/javascript">

   $(document).ready(function(){
            $('.ex1').zoom();
            
        });

   function change_image(imgid){

    
    if(imgid == 1){

        $("#main_image_holder"+1).show();
        $("#main_image_holder"+2).hide();
        $("#main_image_holder"+3).hide();
        $("#main_image_holder"+4).hide();

    }else if(imgid == 2){

        $("#main_image_holder"+2).show();
        $("#main_image_holder"+1).hide();
        $("#main_image_holder"+3).hide();
        $("#main_image_holder"+4).hide();

    }else if(imgid == 3){

        $("#main_image_holder"+3).show();
        $("#main_image_holder"+1).hide();
        $("#main_image_holder"+2).hide();
        $("#main_image_holder"+4).hide();

    }else if(imgid == 4){

        $("#main_image_holder"+4).show();
        $("#main_image_holder"+2).hide();
        $("#main_image_holder"+3).hide();
        $("#main_image_holder"+1).hide();

    }
    



   }

   
   </script>
  </body>
</html>
<?php

}


} 

?>
