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

if(!isset($_GET['cat'])){

go_to_404();


}else if(isset($_GET['cat'])){

$cat_get = $_GET['cat'];



require_once('app/init.php');

$sql_check_cat_exists = $db->prepare("SELECT id FROM category WHERE name=:cat LIMIT 1");
$sql_check_cat_exists->execute(array("cat" => $cat_get));

$numrow = $sql_check_cat_exists->rowCount();

if($numrow < 1){

go_to_404();

}else{

  $row = $sql_check_cat_exists->fetch(PDO::FETCH_ASSOC);

  $cat_id = $row['id'];

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

<br />
   



   

  

<div class="row">

<div class="panel panel-default pull-center col-md-6" style="background:none; border:none;" >
  <div style="background:#B7B9BD; width:35%; margin-left:66%; display:none;" id="sorting_div" class="panel-heading text-center">
   <span style="color:white;" id="sort_status"></span>
  </div>
</div>

<div class="dropdown text-right col-md-6">
 <button class="btn btn-info dropdown-toggle" style="color:black;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    Sort Products
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1" >
    <li role="presentation"><a role="menuitem" tabindex="-1" onClick="get_products(<?php echo $cat_id; ?> , 1);" href="javascript:;">Recent</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" onClick="get_products(<?php echo $cat_id; ?> , 2);" href="javascript:;">Most Sold</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" onClick="get_products(<?php echo $cat_id; ?> , 3);" href="javascript:;">Price</a></li>
    
  </ul>
</div>

</div>


<br /><br />

   
   <div class="row" id="display_product" >

 

      



   </div> <!-- /container -->

   <div  class="col-sm-18 col-md-12 text-center" style="margin-top:60px;" id="load_more">
   
   </div>

<script type="text/javascript">
    
    $(document).ready(function(){
    
  

    

    var cat = "<?php echo $cat_id; ?>";
    var c = cat;

    m = 0;

   get_products(c, m);
    
    });




   


    var nop = 6;


    function get_products(c, m){

      
      nop = 6;

      var get_products = {

            action : "get_products",
            cat : c,
            mode: m
            
      };
      

      $.ajax({

                type : "GET",
                url : "ajax_scripts/get_products.php",
                data : get_products,
                cache : false,
                beforeSend : function(){
                        $('.container #loader_holder').show();
                    },
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1 && obj.setmode != null){

                        
                      $('#display_product').html(obj.success); 
                      $('.container #loader_holder').hide();
                      $('#sorting_div').show();
                      $('#sort_status').html(obj.setmode); 
                      $('#load_more').html(obj.loadmore).show();

                    }else if(obj.codeval == 1 && obj.setmode == null){

                      $('#display_product').html(obj.success);



                      $('.container #loader_holder').hide();
                      $('#sorting_div').hide();
                      $('#sort_status').html(" "); 
                      $('#load_more').html(obj.loadmore).show();

                    }else if(obj.codeval == 0){
                      $('#display_product').html(obj.error_get); 
                      $('#sorting_div').show();
                      $('#sort_status').html(obj.setmode);
                      $('.container #loader_holder').hide(); 
                      $('#load_more').hide();
                    }

                },




            });


    } 

    

    function load_more_get_products(c, m){

      

      

     $('#load_more_btn').text("Loading...");
     $('#load_more_btn').prop("disabled", true);

     var get_products_load_more = {

            action : "get_products_load_more",
            cat : c,
            mode: m,
            nop : nop
            
      };
      

      $.ajax({

                type : "GET",
                url : "ajax_scripts/get_products_load_more.php",
                data : get_products_load_more,
                cache : false,
                beforeSend : function(){
                        $('.container #loader_holder').show();
                    },
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1 && obj.setmode != null){

                      
                      setTimeout(function(){

                      $('#display_product').append(obj.success); 
                      $('.container #loader_holder').hide();
                      $('#sorting_div').show();
                      $('#sort_status').html(obj.setmode); 

                      if(obj.load_btn_show == 0){
                        $('#load_more').hide();

                      }

                       nop = obj.nopupdate;

                       

                       $('#load_more_btn').text("Load More");
                       $('#load_more_btn').prop("disabled", false);

                      }, 1500);

                     

                    }else if(obj.codeval == 1 && obj.setmode == null){

                      setTimeout(function(){

                      $('#display_product').append(obj.success); 
                      $('.container #loader_holder').hide();
                      $('#sorting_div').hide();
                      $('#sort_status').html(" "); 
                      
                       if(obj.load_btn_show == 0){
                        $('#load_more').hide();
                      }

                      nop = obj.nopupdate;

                      
                       $('#load_more_btn').text("Load More");
                       $('#load_more_btn').prop("disabled", false);

                       }, 1500);

                    }else if(obj.codeval == 0){
                      $('#display_product').html(obj.error_get); 
                      $('#sorting_div').show();
                      $('#sort_status').html(obj.setmode);
                      $('.container #loader_holder').hide(); 
                      $('#load_more').html(" ");

                      $('#load_more_btn').text("Load More");
                      $('#load_more_btn').prop("disabled", false);
                    }

                },




            });



    } 




    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php

}

 } 

?>