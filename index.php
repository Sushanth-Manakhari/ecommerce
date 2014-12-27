<?php 
session_start();
require_once("app/init.php");

if(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$user = $_SESSION['uid'];


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

   <div class="bs-example" style="margin-top:50px;">
    <div id="myCarousel" class="carousel slide" data-interval="5000" data-ride="carousel">
      <!-- Carousel indicators -->
         
       <!-- Carousel items -->
        <div class="carousel-inner">

           
                
                <?php

              require_once("app/init.php"); 

              $img_1 = "1.jpg";
                
              $sql_get_slider_image = $db->prepare("SELECT * FROM slider_images WHERE image=:img1 LIMIT 1");
              $sql_get_slider_image->execute(array("img1" => $img_1));

              $numrows = $sql_get_slider_image->rowCount();

              if($numrows < 1){
                
              }else{

                $row_one = $sql_get_slider_image->fetch(PDO::FETCH_ASSOC);
                $slider_picture_one = $row_one['image'];

                echo '<div class="item active"><img src="site_images/slider/'.$slider_picture_one.'" style="width:100%; height:100%;"></div>';

              $sql_get_slider_image_rest = $db->prepare("SELECT * FROM slider_images WHERE image!=:img1");
              $sql_get_slider_image_rest->execute(array("img1" => $img_1));

              $numrows_rest = $sql_get_slider_image_rest->rowCount();

              if($numrows < 1){
               
               }else{

                while($row = $sql_get_slider_image_rest->fetch(PDO::FETCH_ASSOC)){

                    $slider_pictures = $row['image'];

                echo '<div class="item"><img src="site_images/slider/'.$slider_pictures.'" style="width:100%; height:100%;"></div>';
             
                }
              }
             
              }


                ?>


                <!--
                <dv class="item">
                <img src>
                <h2>Slide 1</h2>
                <div class="carousel-caption">
                  <h3>First slide label</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                </div>
                </div>-->

          
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>


    

    

  
  

  

  <div class="panel panel-default">
  <div style="background:#B7B9BD;" class="panel-heading text-center">
   <span style="color:white;">Most Recent Products</span>
  </div>
</div>



<div class="row">

<?php 

$sql_get_products_recent = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 6");
$sql_get_products_recent->execute();

$numrow = $sql_get_products_recent->rowCount();

if($numrow == 0){

  echo '<p>No products are available</p>';

}else{

while($row = $sql_get_products_recent->fetch(PDO::FETCH_ASSOC)){

  $pid = $row['id'];
  $cat = $row['category'];
  $name = $row['name'];
  $desc = $row['description'];
  $main_image = $row['main_image'];
  $original_price = $row['original_price'];
  $sale_price = $row['sale_price'];
  $fullname = $row['name'];

  if($original_price != 0){
   
    $or_pr_div = '<li class="list-inline-item" style="padding:5px;"><s>&#8360; '.$original_price.'</s></li>';
  
  }else{
    $or_pr_div = null;
  }

  $get_cat_name = $db->prepare("SELECT name FROM category WHERE id=:cat");
  $get_cat_name->execute(array("cat" => $cat));

  while($catrow = $get_cat_name->fetch(PDO::FETCH_ASSOC)){
    $category_name = $catrow['name'];
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

  echo '<div class="col-sm-6 col-md-4">
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

}

?>

</div>

<div class="panel panel-default">
  <div  style="background:#B7B9BD;"class="panel-heading text-center">
   <span style="color:white;">Best Selling Products</span>
  </div>
</div>

<div class="row" >

<?php

$sql_get_products_recent = $db->prepare("SELECT * FROM products ORDER BY sold DESC LIMIT 6");
$sql_get_products_recent->execute();

$numrow = $sql_get_products_recent->rowCount();

if($numrow == 0){

  echo '<p>No products are available</p>';
}else{

while($row = $sql_get_products_recent->fetch(PDO::FETCH_ASSOC)){

  $pid = $row['id'];
  $cat = $row['category'];
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



  $get_cat_name = $db->prepare("SELECT name FROM category WHERE id=:cat");
  $get_cat_name->execute(array("cat" => $cat));

  while($catrow = $get_cat_name->fetch(PDO::FETCH_ASSOC)){
    $category_name = $catrow['name'];
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

    $cart_btn = '<a href="javascript:;" style="color:black;" class="btn btn-info"  onClick="add_to_cart('.$pid.');" role="button">Add to Cart</a>';

  }else{

     $cart_btn = '<a href="javascript:;" style="color:black;" onClick="login_glow();" class="btn btn-info"  role="button">Add to Cart</a>';

  }

  echo '<div class="col-sm-6 col-md-4">
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

}

?>

</div> <!-- /row -->
<br />

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
