
<?php
session_start();

if(isset($_COOKIE['adid'])){


$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;



require_once("../app/init.php");

$addr = "../../site_images/slider";

			/* delete folder and contents */

			function Delete($path)
				{
				    if (is_dir($path) === true)
				    {
				        $files = array_diff(scandir($path), array('.', '..'));

				        foreach ($files as $file)
				        {
				            Delete(realpath($path) . '/' . $file);
				        }

				        return rmdir($path);
				    }

				    else if (is_file($path) === true)
				    {
				        return unlink($path);
				    }

				    return false;
				}

				Delete($addr);

		$sql_delete_dump = $db->prepare("DELETE FROM slider_images");
		$sql_delete_dump->execute();

		mkdir("../../site_images/slider", 0777);				


$flag = NULL;

 
 	$count = 1;


	foreach($_FILES['image_slider']['tmp_name'] as $key => $tmp_name ){
	
	if((($_FILES['image_slider']['type'][$key] == 'image/jpeg') ||
	($_FILES['image_slider']['type'][$key] == 'image/jpg') ||	
	($_FILES['image_slider']['type'][$key] == 'image/png') ||
	($_FILES['image_slider']['type'][$key] == 'image/png')) 
	&& ($_FILES['image_slider']['size'][$key] < 1073741824))		//10 mb in bytes
	{
		
		    
			
			
			
			$picture = $count.'.jpg';

			$store_img = "../../site_images/slider/".$picture;

			$sql_check_db = $db->prepare("SELECT * FROM slider_images WHERE image=:slider");
			$sql_check_db->execute(array("slider" => $picture));

			$numrow = $sql_check_db->rowCount();

			

				$sql_insert = $db->prepare("INSERT INTO slider_images VALUES(null, :slider)");
				$sql_insert->execute(array("slider" => $picture));

			


			if($sql_insert){
			
				
				move_uploaded_file($_FILES['image_slider']['tmp_name'][$key], $store_img);

			}else{
				echo "probleem with db";
			}

			

			

			
			$time = time();
				
			echo '<li style="padding:5px;"><img src="../site_images/slider/'.$picture.'?t='.$time.'" style="width:350px; height:200px;"></li>';
			
         
 
			
			
			
		
			
			 
			
			
			
			
	
}else{


	
echo "This file is not supported";
}

$count++;
		
}





}

?>