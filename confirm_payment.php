<?php 
session_start();
require_once("app/init.php");

if(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$user = $_SESSION['uid'];


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ecommerce Demo</title>

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
		get_cart_count_payment();


		
		$('#section_a_anchor').addClass('active');

	});



	function get_cart_count_payment(){

	 var get_cart_count = {
        action : "get_count"
      };


      $.ajax({

          type : "GET",
          url : "ajax_scripts/get_cart_count_payment.php",
           data : get_cart_count,
          cache : false,
          success : function(r){

            
             var obj = JSON.parse(r);

             if(obj.codeval == 0){

             	$('.container #cart_status').show();
             	$('.overlay').show();

             }
             
            }




        });
	}

	function click_a(){

		get_cart_count_payment();

		$('#section_a_anchor').addClass('active');
		$('#sectionA').fadeIn();
		$('#sectionB, #sectionC').fadeOut();
		$('#section_b_anchor, #section_c_anchor').removeClass("active");


		 $("#first_alert").text(" ").hide();

		 

	}



	function click_b(){

		get_cart_count_payment();

		$('#section_b_anchor').addClass('active');
		$('#sectionB').fadeIn();
		$('#sectionA, #sectionC').fadeOut();
		$('#section_a_anchor, #section_c_anchor').removeClass("active");

		
	}


	function click_c(){

		get_cart_count_payment();

		$('#section_c_anchor').addClass('active');
		$('#sectionC').fadeIn();
		$('#sectionA, #sectionB').fadeOut();
		$('#section_a_anchor, #section_b_anchor').removeClass("active");

		
	}


	function first_btn(){

		get_cart_count_payment();


		var name = $('#name').val();
		var addr = $('#addr').val();
		var city = $('#city').val();
		var state = $('#state').val();
		var pin = $('#pin').val();
		var phone = $('#phone').val();


		if(name.trim() == '' || addr.trim() == '' || city.trim() == '' || state.trim() == '' || pin.trim() == '' || phone.trim() == ''){

		$("#first_alert").text("Fill in all infos").show();
		
		
		}else if(isNaN(pin.trim()) || isNaN(phone.trim()) ) {

		$("#first_alert").text("PIN and Phone should be numbers only ").show();	
		
		}else{

			if(pin.length != 6 && pin.length > 0){

    			
    			$("#first_alert").text("PIN must be of only 6 characters").show();
    			


    		}else if(phone.length != 10 && phone.length > 0){

    			
    			$("#first_alert").text("Phone must be of only 10 characters").show();
    			
    		}else{


    	$('#section_b_anchor').addClass('active');
    	$('#sectionA, #sectionC').hide();
		$('#sectionB').show();
		
		$('#section_a_anchor, #section_c_anchor').removeClass("active");

	   get_cart_info();

	   $("#first_alert").text(" ").hide();
	   $('#section_a_anchor').addClass('disabled');
	   $('#section_b_anchor').removeClass('disabled');

	   $('#section_a_anchor').removeClass('btn-primary').addClass('btn-success');

    		}	



		}

	}




	function second_btn(){

		get_cart_count_payment();
		
		$('#section_c_anchor').addClass('active');
		$('#sectionA, #sectionB').hide();
		$('#sectionC').show();
		$('#section_b_anchor').addClass('disabled');
		 $('#section_c_anchor').removeClass('disabled');
		 $('#section_b_anchor').removeClass('btn-info').addClass('btn-success');

		
	}



	function order_btn(){

		get_cart_count_payment();

		var name = $('#name').val();
		var addr = $('#addr').text();
		var city = $('#city').val();
		var state = $('#state').val();
		var pin = $('#pin').val();
		var phone = $('#phone').val();	
		var order_pref = $('input[name=radio]:checked').val();

		if(!$('input[name=radio]').is(':checked')){

			$('#order_alert_e').text("Choose a mode").show();

		}else{

			

			var order = {

				action : "order_product",
				name : name,
				addr : addr,
				city : city,
				state : state,
				pin : pin,
				phone : phone,
				order : order_pref

			}; 



		$.ajax({

          type : "POST",
          url : "ajax_scripts/do_transaction.php",
           data : order,
          cache : false,
          success : function(r){

            
             var obj = JSON.parse(r);

             if(obj.codeval == 0){

             	alert("product doesn't exist");

             }else if(obj.codeval == 2){

             	alert("productis out of stock");
             
             }else if(obj.codeval == 1){

             	alert("Your order is successful and your Transaction ID is " +obj.trans + ". Note it down. You will be redirected automatically...");

             	

             	 $('#section_c_anchor').removeClass('btn-warning').addClass('btn-success');
             	 $('#pr_order_btn').hide();

             	 setTimeout(function(){

             	 	window.location.href = "index.php";

             	 }, 2000)
             	 

             }
             
            }




        });



		}	

	}



	function get_cart_info(){

		var get_cart = {
        action : "get_cart"
      };


      $.ajax({

          type : "GET",
          url : "ajax_scripts/get_cart_payment.php",
          beforeSend : function(){
                        $('.container #loader_holder').show();
                    },
          data : get_cart,
          cache : false,
          success : function(r){

            
          	 setTimeout(function(){
          	  $('.container #loader_holder').hide();	
              $('#sectionB').html(r);
          }, 1000)

          },




        });
	}



	</script>

	</head>

	<div class="overlay" style="opacity:0.5; display:none;  background:#000; width:100%; height:100%; z-index:1; top: 0; left:0; position:fixed; "></div>
  

    <div class="container">

    <div id="loader_holder">
    <div class="text-center" style="margin-top:100px;"><img src="site_images/loader.gif" style="height:70px; width:70px;" /></div>
    </div>

    <div id="cart_status">

    <p class="text-center alert alert-warning">All products in your cart have gone <b>Out of Stock/Unavailable</b> right now..</p>

    <div class="input-group input-group-lg ">
	     <a href="index.php" style="margin-left:150px;" class="btn btn-primary btn-md ">Shop More</a>
	</div>

    </div>


    		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          
          <div class="container">
              
              <div class="navbar-header">
                  <a class="navbar-brand" href="index.php">Ecommerce</a>
              </div>
        

         <p class="navbar-text navbar-right">| <span class="glyphicon glyphicon-lock"></span> Secure Payment | <span class="glyphicon glyphicon-refresh"></span> Easy Returns | <span class="glyphicon glyphicon-ok-sign"></span> 100% Protection |</p>
         
            
          
          </div>

    </nav>




    		

    		<div class="row" >

    			<div class="col-sm-5 col-md-3">

    			</div>

    			<div class="col-sm-8 col-md-6" style="margin-top:100px; border:1px solid black; background:white;">


    		<ul class="nav nav-tabs" >
			    
			    <li><button type="button"  id="section_a_anchor" onClick="click_a();" class="btn btn-primary btn-lg " role="button" >Address</button></li>
			    <li><button type="button"  id="section_b_anchor" onClick="click_b();" class="btn btn-info btn-lg disabled" role="button" >Summary</button></li>
			    <li><button type="button"  id="section_c_anchor" onClick="click_c();" class="btn btn-warning btn-lg disabled" role="button">Payment</button></li>
			</ul>
			

			<div class="tab-content" >
			    <div id="sectionA">

			    <?php



			    	// getting user info

			    $get_info = $db->prepare("SELECT * FROM user_info WHERE user_id=:user LIMIT 1");
			    $get_info->execute(array("user" => $user));

			    $numrow = $get_info->rowCount();

			    if($numrow < 1){

			    $fname = null;
			    $lname = null;
			    $addr = null;
			    $city = null;
			    $state = null;
			    $pin = null;
			    $phone = null;

			    
			    }elseif($numrow >= 1){

			    	$row = $get_info->fetch(PDO::FETCH_ASSOC);

			    	$fname = $row['fname'];
			    	$lname = $row['lname'];
			    	$addr = $row['address'];
			    	$city = $row['city'];
			    	$state = $row['state'];
			    	$pin = $row['pin'];
			    	$phone = $row['phone'];

			    	

			    }

			  
			    ?>
			        
			    
       		<div class="text-center"><h4>Your Shipping address</h4></div> 

			        <br />
			    	
			        <div class="table-responsive">          
					      <table class="table table-striped text-center">
					        
					        <tbody>
					          <tr>
					            <td><div style="margin-top:5px;">Name</div></td>
					            <td><input type="text" id="name" value="<?php echo $fname; ?> <?php echo $lname; ?>" style="margin-left:-60px;" class="form-control" placeholder="Name"></td>
					          </tr>
					          
					          <tr>
					            <td><div style="margin-top:40px;">Address</div></td>
					            <td><div class="form-group">
							        
							        <textarea class="form-control" id="addr" rows="3"  style="margin-left:-60px;"><?php echo $addr; ?></textarea>
							      </div>
							    
							    </td>
					          </tr>

					          <tr>
					            <td><div style="margin-top:2px;">City</div></td>
					            <td><input type="text" id="city" value="<?php echo $city; ?>" style="margin-left:-60px;" class="form-control pull-center" placeholder="City"></td>
					          </tr>

					          <tr>
					            <td><div style="margin-top:2px;">State</div></td>
					            <td><input type="text" id="state" value="<?php echo $state; ?>" style="margin-left:-60px;" class="form-control pull-center" placeholder="State"></td>
					          </tr>

					          <tr>
					            <td><div style="margin-top:2px;">Pin Code</div></td>
					            <td><input type="text" id="pin" value="<?php echo $pin; ?>" style="margin-left:-60px;" class="form-control pull-center" placeholder="PIN Code"></td>
					          </tr>

					           <tr>
					            <td><div style="margin-top:2px;">India</div></td>
					            <td><input type="text" style="margin-left:-60px;" class="form-control pull-center" value="India" placeholder="Country" disabled></td>
					          </tr>

					           <tr>
					            <td><div style="margin-top:2px;">Phone&nbsp;&nbsp;&nbsp;&nbsp;+91</div></td>
					            
				                <td><input type="text" id="phone" value="<?php echo $phone; ?>" style="margin-left:-60px;" class="form-control pull-center" placeholder="Phone">
				                  </td>
					          </tr>
					        </tbody>
					      </table>
					  </div>

					<br />
					<br />
					<div class="input-group input-group-lg ">
						<button type="button" style="margin-left:250px;" onClick="first_btn();" class="btn btn-primary btn-lg">Continue</button>
					</div>
					<br />
					<p class="text-center alert alert-danger" style="width:250px; margin-left:160px; display:none;" id="first_alert" ></p>
			    </div>
			    <div id="sectionB" style="display:none;">
			       
			   	
				      
				      
				        

				        
			    </div>
			    <div id="sectionC" style="display:none;">
			       
			    	 <div class="text-center"><h4>Select Payment Mode</h4></div>
			    <br /><br />
			    <div class="alert alert-info">
            		<div class="form-inline text-center">
		               
		                <label class="radio">
		                    <input value="1" name="radio" type="radio"> Online
		                </label>&nbsp;&nbsp;&nbsp;&nbsp;
		                <label class="radio">
		                    <input value="2" name="radio" type="radio"> Cash on Delivery
		                </label>
		                
            		</div>

			    </div>

			    <br />
					<div class="input-group input-group-lg ">
						<button type="button" id="pr_order_btn" onClick="order_btn();" style="margin-left:230px;" class="btn btn-primary btn-lg">Order</button>
					</div>
					<br />
					<p class="text-center alert alert-danger" style="width:250px; margin-left:130px; display:none;" id="order_alert_e" ></p>
					<p class="text-center alert alert-success" style="width:250px; margin-left:130px; display:none;" id="order_alert_s" ></p>
			    </div>
			    

    			</div>

    			<div class="col-sm-5 col-md-3">

    			</div>


    		</div>
			                	


			



           

           	




			  	

			  

			




   </div> <!-- /container -->
</div>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php

}else{
	header("Location: index.php");
}

?>