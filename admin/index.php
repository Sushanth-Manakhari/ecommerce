<?php

session_start();


if(isset($_SESSION['adid']) || isset($_COOKIE['adid'])){
	header("Location:dashboard.php");	
}else{

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

    <title>Ecommerce Admin Login</title>

   <?php include_once("includes/header.php") ; ?>

   <br /><br /><br />
   
   <div class="row">



                    <div class="col-sm-9 col-md-6">
                      
                    		<div class="text-center"><h3>Login Here</h3></div> 
        
						        <div class="input-group input-group-lg">
						            <input type="text" style="margin-left:100px;" id="lg_email" class="form-control pull-center" placeholder="Email">
						        </div>

						        <div class="input-group input-group-lg ">
						            <input type="password" style="margin-left:100px;" id="lg_password" class="form-control" placeholder="Password">
						        </div>


						        <br />
						    
						        <div class="input-group input-group-lg ">
						            <button type="button" style="margin-left:250px;" onClick="admin_login();" class="btn btn-primary btn-lg">Login</button>
						        </div>
						        <br />
						         <p class="text-center alert alert-danger" id="login_alert" style="display:none;"></p>


                  	</div>

                  	<div class="col-sm-9 col-md-6">
                      
                  				<div class="text-center"><h3>Register Here</h3></div> 
        
						        <div class="input-group input-group-lg">
						            <input type="text" style="margin-left:100px;" id="rg_email" class="form-control pull-center" placeholder="Email">
						        </div>

						        <div class="input-group input-group-lg ">
						            <input type="password" style="margin-left:100px;" id="rg_password" class="form-control" placeholder="Password">
						        </div>

						        <div class="input-group input-group-lg ">
						            <input type="password" style="margin-left:100px;" id="rg_password_again" class="form-control" placeholder="Repeat Password">
						        </div>


						        <br />
						    
						        <div class="input-group input-group-lg ">
						            <button type="button" style="margin-left:250px;" onClick="admin_register();" class="btn btn-primary btn-lg">Register</button>
						        </div>
						        <br />
						         <p class="text-center alert alert-danger" id="register_alert" style="display:none;"></p>

                  	</div>

    </div>

    </div>
    <script type="text/javascript">

   // $(document).ready(function() {
    
    	$('#lg_email, #lg_password').on("keypress", function(e) {
        if (e.keyCode == 13) {
           admin_login();
            return false; // prevent the button click from happening
        }
		});

		$('#rg_email, #rg_password, #rg_password_again').on("keypress", function(e) {
        if (e.keyCode == 13) {
           admin_register();
            return false; // prevent the button click from happening
        }
		});


	//s});

    function ValidateEmail(email) { 
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    	};

    function admin_login(){

    	var  em = $('#lg_email').val();
    	var ps = $('#lg_password').val();

    	if(em.trim() == '' || ps.trim() == ''){
    		$('#login_alert').text("Please provide all infos!").show();
    	}else if(!(ValidateEmail(em))){
    		$('#login_alert').text("Please provide a valid email!").show();
    	}else{	

    		var ad_login = {
    			action : "ad_login",
    			email : em,
    			password : ps
    		};

    		$.ajax({

    			type : "POST",
    			url : "ajax_scripts/admin_login.php",
    			data : ad_login,
    			cache : false,
    			success : function(r){

    				var obj = JSON.parse(r);

    				if(obj.log_code == 0){
    					$('#login_alert').text(obj.not_matched).show();
    				}else if(obj.log_code == 1){
    					window.location.href = "dashboard.php";
    				}

    			},




    		});


    	}

    }

    function admin_register(){

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

    		var ad_register = {
    			action : "ad_register",
    			email : em,
    			password : ps

    		};

    		$.ajax({

    			type : "POST",
    			url : "ajax_scripts/admin_register.php",
    			data : ad_register,
    			cache : false,
    			success : function(r){

    				var obj = JSON.parse(r);

    				if(obj.res_code == 0){
    					$('#register_alert').text(obj.email_exists).show();
    				}else if(obj.res_code == 1){
    					window.location.href = "dashboard.php";
    				}

    			},




    		});


    	}

    }

    </script>
   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php

}

?>

