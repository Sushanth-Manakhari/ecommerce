 <!-- Bootstrap core CSS -->

   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">

   
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
 <!--<script type="text/javascript" src="js/jquery-1.9.1.min"></script>-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
   
   <script type="text/javascript">
   
   $(document).ready(function(){

      $('#rg_email, #rg_password, #rg_password_again').on("keypress", function(e) {
        if (e.keyCode == 13) {
           register();
            return false; // prevent the button click from happening
        }
    });

    $('#lg_email, #lg_password').on("keypress", function(e) {
        if (e.keyCode == 13) {
           login();
            return false; // prevent the button click from happening
        }
    }); 

    get_cart_count();
   
    })

     

     function ValidateEmail(email) { 
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
      };

      function login(){

      var  em = $('#lg_email').val();
      var ps = $('#lg_password').val();

      if(em.trim() == '' || ps.trim() == ''){
        alert("Please provide all infos!");
      }else if(!(ValidateEmail(em))){
        alert("Please provide a valid email!");
      }else{  

        var user_login = {
          action : "user_login",
          email : em,
          password : ps
        };

        $.ajax({

          type : "POST",
          url : "ajax_scripts/user_login.php",
          data : user_login,
          cache : false,
          success : function(r){

            var obj = JSON.parse(r);

            if(obj.log_code == 0){
              alert("Your email and password don't match");
            }else if(obj.log_code == 1){
              window.location.reload(true);
            }

          },




        });


      }

    }

     function register(){

      var  em = $('#rg_email').val();
      var ps = $('#rg_password').val();
      var ps_ag = $('#rg_password_again').val();

      if(em.trim() == '' || ps.trim() == '' || ps_ag.trim() == ''){
        $('#register_alert').text("Please provide all infos!").show();
      }else if(ps !== ps_ag){
        $('#register_alert').text("Your passwords don't match!").show();
      }else if(!(ValidateEmail(em))){
        $('#register_alert').text("Please provide a valid email!").show();
      }else{

        var register = {
          action : "register",
          email : em,
          password : ps

        };

        $.ajax({

          type : "POST",
          url : "ajax_scripts/user_register.php",
          data : register,
          cache : false,
          success : function(r){

            var obj = JSON.parse(r);

            if(obj.res_code == 0){
              $('#register_alert').text(obj.email_exists).show();
            }else if(obj.res_code == 1){
               $("#register_modal").fadeOut();
               $(".overlay").fadeOut();
              window.location.reload(true); 
            }

          },




        });


      }

    }

    function open_register_modal(){

      $("#register_modal").fadeIn();
      $(".overlay").fadeIn();
    }

    function close_register_modal(){
      $("#register_modal").fadeOut();
      $(".overlay").fadeOut();
    }

    function close_cart_modal(){
      $("#cart_modal").fadeOut();
      $(".overlay").fadeOut();
    }

    function login_glow(){

      $('#lg_email').focus();

      $('#lg_email, #lg_password').css({"box-shadow": "0 0 5px #A6ED3B",
      "padding": "3px 0px 3px 3px",
      
      "border" : "3px solid #A6ED3B" });



    }

    function logout(){

      var logout = {
        action : "logout"
      };

      $.ajax({

          type : "POST",
          url : "ajax_scripts/user_logout.php",
          data : logout,
          cache : false,
          success : function(r){

            var obj = JSON.parse(r);

             if(obj.codeval == 1){
               
              window.location.reload(true); 
            }

          },




        });


    }

    function add_to_cart(pid){



      var add_cart = {
          action : "add_to_cart",
          pid : pid
        };

        $.ajax({

          type : "POST",
          url : "ajax_scripts/add_to_cart.php",

          data : add_cart,
          cache : false,
          success : function(r){

            var obj = JSON.parse(r);

            if(obj.codeval == 0){
              alert("This product does not exist");
            }else if(obj.codeval == 2){
               alert("This product is out of stock currently.");
            }else if(obj.codeval == 1){
               
               get_cart();
            }

          },




        });

    }

    function get_cart(){

      

      var get_cart = {
        action : "get_cart"
      };


      $.ajax({

          type : "GET",
          url : "ajax_scripts/get_cart.php",
            beforeSend : function(){
                        $('.container #loader_holder').show();
                    },
          data : get_cart,
          cache : false,
          success : function(r){

            get_cart_count();

              setTimeout(function(){
                $('#cart_modal').fadeIn();
               $('.overlay').fadeIn();
              $('#loader_holder').hide();
               $("#get_cart_div").html(r);
                }, 1500);
           

             

          },




        });

    }

    function get_cart_inside(){

      

      var get_cart = {
        action : "get_cart"
      };


      $.ajax({

          type : "GET",
          url : "ajax_scripts/get_cart.php",
            beforeSend : function(){
                        $('.container #cart_loader_holder').show();
                    },
          data : get_cart,
          cache : false,
          success : function(r){

            get_cart_count();

              setTimeout(function(){
               $('.container #cart_loader_holder').hide();
               $("#get_cart_div").html(r);
                }, 1000);
           

             

          },




        });

    }

    function get_cart_count(){

         var get_cart_count = {
        action : "get_cart_count"
      };


      $.ajax({

          type : "GET",
          url : "ajax_scripts/get_cart_count.php",
           data : get_cart_count,
          cache : false,
          success : function(r){

            
             var obj = JSON.parse(r);

             $('#cart_count').text(obj.count);
           

             

          },




        });

    }

    function delete_item(pid){

     var delete_item = {
        action : "delete_item",
        pid : pid
      };


      $.ajax({

          type : "POST",
          url : "ajax_scripts/delete_item.php",
           data : delete_item,
          cache : false,
          success : function(r){


            
             var obj = JSON.parse(r);

             if(obj.codeval == 1){

              get_cart_count();
              get_cart_inside();
              $('#each_cart'+pid).fadeOut('slow');

             }

             
           

             

          },




        });


    }

    function update_item(pid){

     var quant = $.trim($("#quant_val"+pid).val());

     if(!isNaN(quant)){

      if(parseInt(quant) == 0 || quant.length == 0 || parseInt(quant) < 0){

        $('#cart_alert').text("Quantity must be starting from 1").show();


      }else{

       var update_item = {
        action : "update_item",
        quant : quant,
        pid : pid

      };


      $.ajax({

          type : "POST",
          url : "ajax_scripts/update_item.php",
           data : update_item,
          cache : false,
          success : function(r){


            
             var obj = JSON.parse(r);

             if(obj.codeval == 1){

             
              get_cart_inside();

              $('#cart_alert').hide();
              

             }else if(obj.codeval == 0){

                $('#cart_alert').text("We do not have this item that much!").show();

             }

             
           

             

          },




        });

    }

  }else{

     $('#cart_alert').text("A number is accepted").show();

  }
      
    } 

  </script>


  </head>

  <body>

   <div class="overlay" style="opacity:0.5; display:none;  background:#000; width:100%; height:100%; z-index:1; top: 0; left:0; position:fixed; "></div>

    <div class="container">

    <div id="loader_holder">
    <div class="text-center" style="margin-top:100px;"><img src="site_images/loader.gif" style="height:70px; width:70px;" /></div>
    </div>

    <div id="register_modal">
        <a id="close" onClick="close_register_modal();" class="pull-right">×</a>
        
        <div class="text-center"><h3>Register Now!</h3></div> 
        
        <div class="input-group input-group-lg ">
            <input type="text" style="margin-left:50px;" id="rg_email" class="form-control" placeholder="Email">
        </div>

        <div class="input-group input-group-lg ">
            <input type="password" style="margin-left:50px;" id="rg_password" class="form-control" placeholder="Password">
        </div>


        <div class="input-group input-group-lg ">
            <input type="password" style="margin-left:50px;" id="rg_password_again" class="form-control" placeholder="Retype Password">
        </div>
    
        <br />
    
        <div class="input-group input-group-lg ">
            <button type="button" style="margin-left:150px;" onClick="register();" class="btn btn-primary btn-lg">Register</button>
        </div>

      <br />
    
  <p class="text-center alert alert-danger" id="register_alert" style="width:300px; margin-left:50px; display:none;">not submitted</p>
</div>



<div id="cart_modal">
        <a id="close" onClick="close_cart_modal();" style="font-size:25px; font-weight:bold;" class="pull-right">×</a>
        <p class="text-center alert alert-danger" id="cart_alert" style="display:none;"></p>
    <div id="cart_loader_holder" style="z-index:1; position:absolute; display:none;">
    <div class="text-center" style="margin-top:150px; margin-left:370px;"><img src="site_images/loader.gif" style="height:70px; width:70px;" /></div>
    </div>  

    <div class="bs-example">

   <div id="get_cart_div">

   </div>


<br />
<br />

</div>

</div>


<?php

function visitor_header(){

 return '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
     <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="index.php">Ecommerce</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <div class="navbar-form" role="search">
        <div class="form-group navbar-left">

          <input type="text" class="form-control" placeholder="Search" style="margin-left:50px; width:300px;">
          <input type="text" class="form-control" style="margin-left:200px;" placeholder="Email" id="lg_email" />
          <input type="password" class="form-control" style="margin-left:0px;" placeholder="Password" id="lg_password" />
          
        </div>
        
      </div>

      <p class="navbar-text"><a href="#" class="navbar-link"></a></p>

      
      <ul class="nav navbar-nav navbar-right">
        <li style="margin-right:50px;"><button class="btn btn-info" style="color:black;" onClick="open_register_modal();" aria-expanded="true">
          Sign Up
        </button></li>
       
        
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>';

}

if(!isset($_COOKIE['uid']))
{


echo visitor_header();


}elseif(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$sql_get_user_info = $db->prepare("SELECT email FROM user_login WHERE id=:id LIMIT 1");
$sql_get_user_info->execute(array("id" => $_SESSION['uid']));

$numrow = $sql_get_user_info->rowCount();

if($numrow < 1){

  echo visitor_header();

}else if($numrow == 1){

  $row = $sql_get_user_info->fetch(PDO::FETCH_ASSOC);

  $email = $row['email'];



echo '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="index.php">Ecommerce</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <div class="navbar-form" role="search">
        <div class="form-group navbar-left">

          <input type="text" class="form-control" placeholder="Search" style="margin-left:50px; width:400px;">
          
        </div>
        
      </div>

      <p class="navbar-text"><a href="#" class="navbar-link"></a></p>

      
      <ul class="nav navbar-nav navbar-right">
        
        
         <li class="dropdown" style="margin-top:-13px;">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img style="min-height:35px; height:35px;"  src="site_images/thumbnail.gif" alt="..."><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" style="width:200px;">
            <li class="text-left" style="padding:10px;"><strong>'.$email.'</strong></li>
            <li class="text-left" style="padding:10px;"><a href="dashboard.php">Dashboard</a></li>
            
            <li class="divider"></li>
            <li class="text-left" style="padding:10px;"><a onClick="logout();" href="javascript:;">Logout</a></li>
          </ul>
        </li>


        
        <li style="margin-right:30px; "><button onClick="get_cart();" style="color:black;" class="btn btn-warning" aria-expanded="true">
          <span class="glyphicon glyphicon-shopping-cart"></span> Cart (<span id="cart_count"></span>)
        </button></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>';



}

}

?>

<br /><br />




<nav class="navbar navbar-inverse" style="background:none; border:none; background:#C9C8BF; position:fixed; z-index:2; margin-top:-10px;" role="navigation"> 
  
  
 <ul class="nav navbar-nav">
  <?php

  require_once("app/init.php");

  $sql_get_cat = $db->prepare("SELECT * FROM category");
  $sql_get_cat->execute();

  while($row = $sql_get_cat->fetch(PDO::FETCH_ASSOC)){

    $id = $row['id'];
    $cat = $row['name'];

    $category = str_replace("-", " ", $cat);

    echo ' <li role="presentation"><a style="color:black;" href="category.php?cat='.str_replace(' ','-',$cat).'">'.$category.'</a></li>';

  }

  ?>
</ul>

 
  
</nav>



