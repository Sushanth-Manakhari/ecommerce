
<?php
session_start();

if(isset($_COOKIE['adid'])){

$adid = $_COOKIE['adid'];
$_SESSION['adid'] = $adid;

$admin = $adid;


require_once("../app/init.php");

			$sql = $db->prepare("SHOW TABLE STATUS LIKE 'products'");
			$sql->execute();

			$row = $sql->fetch(PDO::FETCH_ASSOC);

			$auto_increment = $row['Auto_increment'];

			$addr = "../../site_Images/products/$auto_increment";

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

		$sql_delete_dump = $db->prepare("DELETE FROM product_images_dump WHERE pid=:pid");
		$sql_delete_dump->execute(array("pid" => $auto_increment));	

			mkdir("../../site_images/products/$auto_increment", 0777);


$flag = NULL;

 
 	$count = 1;


	foreach($_FILES['image']['tmp_name'] as $key => $tmp_name ){
	
	if((($_FILES['image']['type'][$key] == 'image/jpeg') ||
	($_FILES['image']['type'][$key] == 'image/jpg') ||	
	($_FILES['image']['type'][$key] == 'image/png') ||
	($_FILES['image']['type'][$key] == 'image/png')) 
	&& ($_FILES['image']['size'][$key] < 1073741824))		//10 mb in bytes
	{
		
		    

			
			
			$picture = $count.'.jpg';

			$store_img = "../../site_images/products/$auto_increment/".$picture;


			$sql_insert_img_db = $db->prepare("INSERT INTO product_images_dump VALUES (null, :pid, :image)");
			$sql_insert_img_db->execute(array("pid" => $auto_increment, "image" => $picture));

			
			
			if($sql_insert_img_db){
				
				move_uploaded_file($_FILES['image']['tmp_name'][$key], $store_img);

			

			}else{

			$flag = 2; 

			
			echo "problem with db";	
			
			

			}

			

			
			$time = time();
				
			echo '<li style="padding:13px;"><img src="../site_images/products/'.$auto_increment.'/'.$picture.'?t='.$time.'" style="height:80px; width:80px;" alt="..."></li>
			      <li style="padding:4px; margin-top: 80px;"><label class="radio"><input value="'.$count.'" id="image_radio" name="radio" type="radio"></label></li>';
			
 
			
			
			
		
			
			 
			
			
			
			
	
}else{


	
echo "This file is not supported";
}

$count++;
		
}

//}

}

?>