 <!-- Bootstrap core CSS -->

   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">

   
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
 <!--<script type="text/javascript" src="js/jquery-1.9.1.min"></script>-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="http://gregpike.net/demos/bootstrap-file-input/bootstrap.file-input.js"></script>
   
   <script type="text/javascript">
   
   $(document).ready(function(){

      $('input[type=file]').bootstrapFileInput();
      $('.file-inputs').bootstrapFileInput();
   
    })

    function register_func(){

    
    var email_reg = $('#email_reg').val();
    var pas_reg = $('#password_reg').val();
    var re_pas = $('#re_password').val();
   

  if(email_reg != '' || pas_reg != '' || re_pas != '' || username != ''){    // if email and password is empty

    if (!ValidateEmail(email_reg)) {      // Email Validation
            alert("Invalid email address.");
        }
        else 
        {

        if(name_reg ==''){
            alert("Fill in the Name field!");
        }else{    

        if(pas_reg == '' || re_pas == ''){
            alert("Fill in the password fields");
        } 
        else
        {   

        if(pas_reg != re_pas){
          alert("Your passwords did not match.");

        }else if(username.length < 4){
            alert("Your username must be atleast of 4 characters long!");
        }else{  
            
            var register = {
              action : "Register_pressed",
                name : name_reg,
              email : email_reg,
              password : pas_reg,
                username : username
            };

            $.ajax({
              type : "POST",
              url : "ajax_scripts/function_register.php",
              //beforeSend : function(){

                //}
              data : register,
              cache : false,
              success:function(r){
        
        var response = JSON.parse(r);

        if(response['res_code'] == 1){
          alert(response['email_exists']);
                }else if(response['res_code'] == 2){
                    alert(response['username_exists']);
                }else if(response['res_code'] == 3){
          window.location.href = "home.php";
        }
        
              //alert(r);
              },

              error : function(e){
                alert(e);
              }

            })
        }

    }
}

    }

  }else{
    alert("Fill in all fields!");
  }

 }


 

  </script>


  </head>

  <body>

   <div class="overlay" style="opacity:0.5; display:none;  background:#000; width:100%; height:100%; z-index:1; top: 0; left:0; position:fixed; "></div>

    <div class="container">

    <?php



    ?>


    <div id="edit_product_modal">

    <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="height:30px; width:30px; margin-top:130px; margin-left:340px; display:none;" id="image_loader_edit_info"></span>

      <div id="inner_cover_edit_product_modal" style="display:none;">
        
        <a id="close" onClick="close_edit_modal();" class="pull-right">×</a>
        
        <div class="text-center"><h3>Edit Product</h3></div> 

        <div class="form-group">
          <label style="margin-left:100px;" for="ed_p_name">Product Name:</label>
          
          <input type="text" id="ed_p_name" style="margin-left:100px; width:400px;" placeholder="Product Name..." class="form-control">
          
        </div>
        
        
          <div class="form-group">
          <label style="margin-left:100px;" for="ed_p_desc">Product Description:</label>
                <textarea class="form-control" rows="3" id="ed_p_desc"  style="margin-left:100px; width:400px;" placeholder="Write product Description...."></textarea>
          </div>
          <br />

          

          <div class="form-group">
                <label style="margin-left:100px;" for="ed_p_cat">Product Category:</label>
                <select class="form-control" id="ed_p_cat" style="width:150px; margin-left:100px;">
                   
                   
                    
                </select>
          </div>
          <br />
          <div class="form-group">
               <label style="margin-left:100px;" for="ed_p_in_qty">Inventory Quantity:</label>
                <select class="form-control" id="ed_p_in_qty" style="width:100px; margin-left:100px;">
                   
                   <?php

                   $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
                   foreach ($array as $value) {
                       echo '<option value="'.$value.'">'.$value.'</option>';
                   }

                    ?>

                    
                </select>
          </div>
          <br />
          <div class="form-group">
                 <label style="margin-left:100px;" for="ed_p_av_qty">Store Quantity:</label>
                <select class="form-control" id="ed_p_av_qty" style="width:100px; margin-left:100px;">
                   
                   <?php

                   $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
                   foreach ($array as $value) {
                       echo '<option value="'.$value.'">'.$value.'</option>';
                   }

                    ?>

                    
                </select>
          </div>
          <br />
          <div class="form-group">
          <label style="margin-left:100px;" for="ed_p_s_price">Sale Price: Rs. 500</label>
          
                <input type="text" id="ed_p_s_price" style="margin-left:100px; width:200px;"  class="form-control" placeholder="Sale Price..">
                
          
          </div>
          <br />

          <div class="form-group">
                <label style="margin-left:100px;" for="ed_p_or_price">Original Price Without Discount: <s>Rs. 1000</s></label>
                <input type="text" id="ed_p_or_price" style="margin-left:100px; width:200px;"  class="form-control" placeholder="Original Price..">
                
          </div>
          <br />

          <p class="text-center alert alert-danger" style="width:250px; margin-left:220px; display:none;" id="product_e_edit_alert" ></p>
          <p class="text-center alert alert-success" style="width:250px; margin-left:220px; display:none;" id="product_s_edit_alert" ></p>
          
          <div class="form-group" id="edit_product_button_holder">
            
          </div>

          
    
          </div>

    </div>

    

    
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          
          <div class="container">
              
              <div class="navbar-header">
                  <a class="navbar-brand" href="#">Ecommerce Admin Panel</a>
              </div>

              <?php
              if(isset($_SESSION['adid'])){
                echo '<p class="navbar-text navbar-right"><a style="color:white;" href="function/logout.php">Logout</a></p>';
              }else{
                echo null;
              }

              ?>
               

              
        

         
          </div>

    </nav>





