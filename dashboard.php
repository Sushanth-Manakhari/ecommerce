<?php 
session_start();
require_once("app/init.php");

if(isset($_COOKIE['uid'])){

  $user_id = $_COOKIE['uid'];

  $_SESSION['uid'] = $user_id;

$user = $_SESSION['uid'];


}else{
	header("Location:index.php");
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

      <div class="col-sm-5 col-md-4" style="padding:10px;">
   
     
      
      </div>

  <div class="col-sm-6 col-md-4">
    
      <div class="text-center"><h3>Edit Your Info</h3></div> 
      <br />
       

        <table class="table table-striped">
				      
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

				      <tbody>
				      <tr>
				       	  <td><label style="margin-left:100px;" for="fname">Firstname:</label></td>
				          	
				          			<td><input type="text" id="fname" style="margin-left:0px; width:200px;" placeholder="Firstname" class="form-control" value="<?php echo $fname; ?>">
				          </td>
				        </tr>
				        <tr>
				       	  <td><label style="margin-left:100px;" for="lname">Lastname:</label></td>
				          
				          			<td><input type="text" id="lname" style="margin-left:0px; width:200px;" placeholder="Lastname" class="form-control" value="<?php echo $lname; ?>">
				          </td>
				        </tr>
				        <tr>
				          <td><label style="margin-left:100px;" for="addr">Address:</label></td>
				         
				          			<td><textarea class="form-control"  id="addr"  style="margin-left:0px; height:50px; width:350px;" id="comment" placeholder="Your home address"><?php echo $addr; ?></textarea></td>
				        </tr>
				        <tr>
				          <td><label style="margin-left:100px;" for="city">City:</label></td>
				          			<td><input type="text" id="city" style="margin-left:0px; width:200px;" placeholder="City" class="form-control" value="<?php echo $city; ?>">
				          </td>
				        </tr>
				        <tr>
				         <td><label style="margin-left:100px;" for="state">State:</label></td>
				          			<td><input type="text" id="state" style="margin-left:0px; width:200px;" placeholder="State" class="form-control" value="<?php echo $state; ?>">
				          </td>
				        </tr>
				        <tr>
				         <td><label style="margin-left:100px;" for="pin">PIN:</label></td>
				          			<td><input type="text" id="pin" style="margin-left:0px; width:200px;" placeholder="PIN" class="form-control" value="<?php echo $pin; ?>">
				          </td>
				        </tr>
				        <tr>
				         <td><label style="margin-left:100px;" for="phone">Phone: +91 </label></td>
				          			<td><input type="text" id="phone" style="margin-left:0px; width:200px;" placeholder="Phone" class="form-control" value="<?php echo $phone; ?>">
				          </td>
				        </tr>
				        <tr>
				         <td></td>
				          <td><button type="button" onClick="edit_info();" class="btn btn-success">Save</button>
				          </td>
				        </tr>
				        <tr id="info_alert_div" style="display:none;"><td colspan="4"><p style="display:none; margin-left;-40px;" class="text-center alert alert-danger" id="info_alert_e"></p><p style="display:none; margin-left:-40px;" class="text-center alert alert-success" id="info_alert_s"></p></td></tr>
				      </tbody>
				    </table>

        
     
    
  </div>

 


   

   </div> <!-- /row -->
	
	<br />

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>

    function edit_info(){

    	var fname = $('#fname').val();
    	var lname = $('#lname').val();
    	var addr = $('#addr').val();
    	var city = $('#city').val();
    	var state = $('#state').val();
    	var pin = $('#pin').val();
    	var phone = $('#phone').val();



    		
    		if(isNaN(pin.trim()) || isNaN(phone.trim()) ){

    			$("#info_alert_div").show();
    			$("#info_alert_e").text("PIN and Phone should be numbers only ").show();
    			$("#info_alert_s").text(" ").hide();

    		}else{

    		 if(pin.length != 6 && pin.length > 0){

    			$("#info_alert_div").show();
    			$("#info_alert_e").text("PIN must be of only 6 characters").show();
    			$("#info_alert_s").text(" ").hide();


    		}else if(phone.length != 10 && phone.length > 0){

    			$("#info_alert_div").show();
    			$("#info_alert_e").text("Phone must be of only 10 characters").show();
    			$("#info_alert_s").text(" ").hide();
    		}else{


    			var info_edit = {

    				action : "info_edit",
    				fname : fname,
    				lname : lname,
    				addr : addr,
    				city : city,
    				state : state,
    				pin  : pin,
    				phone : phone

    			};

    			$.ajax({

                type : "POST",
                url : "ajax_scripts/info_edit.php",
                data : info_edit,
                cache : false,
               
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1){
                    	$("#info_alert_div").show();
    					$("#info_alert_s").text("Updated Successfully!").show();
    					$("#info_alert_e").text(" ").hide();
                    }

                }
                    });


    		}

    	}

    		
    }

    </script>
  </body>
</html>
