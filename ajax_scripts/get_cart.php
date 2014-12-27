<?php

session_start();

if(isset($_GET['action']) && $_GET['action'] == "get_cart" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$cart_main = null;
$total_price = 0;
$sub_for_tot = 0;

// check in stock

require_once("../app/init.php");




// selecting new update

$get_cart = $db->prepare("SELECT * FROM user_cart WHERE user_id=:uid");
$get_cart->execute(array("uid" => $user));

$get_cart_row = $get_cart->rowCount();

if($get_cart_row >= 1){  



while($row = $get_cart->fetch(PDO::FETCH_ASSOC)){

$pid = $row['pid'];
$qty = $row['qty'];


// cart info

$get_cart_info = $db->prepare("SELECT name, sale_price, main_image FROM products WHERE id=:pid");
$get_cart_info->execute(array("pid" => $pid));

while($row = $get_cart_info->fetch(PDO::FETCH_ASSOC)){

$name = $row['name'];
$price = $row['sale_price'];
$image = $row['main_image'];

$subtotal = $price * $qty;

$sub_for_tot += $subtotal; 

$img_link = "site_images/products/$pid/$image";

$cart_main .= '<tr id="each_cart'.$pid.'">
                <td><img src="'.$img_link.'" style="max-width:125px; max-height:125px; height: auto !important;"></td>
                <td>'.$name.'</td>
                <td><div class="form-group">
                    <input type="text" value="'.$qty.'" id="quant_val'.$pid.'" class="form-control" placeholder="" style="width:50px;padding:none; box-shadow:none; border:none;"><a href="javascript:;" onClick="update_item('.$pid.');" style="margin-left:5px;">Save</a>
                  </div></td>
                <td>Rs. '.$price.'</td>
                <td>Rs. '.$subtotal.'</td>
                <td><a id="close" onClick="delete_item('.$pid.');">×</a></td>
            </tr>';

}






  

}

$total_price = $sub_for_tot;

echo '<table class="table" id="cart_table" style="border-bottom:2px solid grey;">
        <thead>
            <tr>
                <th></th>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            '.$cart_main.'
        </tbody>
        </table>
            <p id="cart_total" class="text-right" style="font-size:20px; font-weight:bold;">Total : Rs. '.$total_price.'</p>
            <a href="confirm_payment.php" id="place_order_btn" style="color:white; width:200px; padding:10px; background:#D47324;" class="btn btn-default pull-right" aria-expanded="true">
                      Place Order
            </a>';



}else{


   echo '<div id="cart_loader_holder" style="z-index:1; position:absolute;">
    <div class="text-center" style="margin-top:100px; margin-left:300px;"><h3>Your Cart is Empty</h3></div>
    </div>';

   


}


}


?>