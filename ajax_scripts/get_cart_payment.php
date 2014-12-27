<?php

session_start();

if(isset($_GET['action']) && $_GET['action'] == "get_cart" &&  isset($_COOKIE['uid'])){

$uid = $_COOKIE['uid'];
$_SESSION['uid'] = $uid;

$user = $uid;

$cart_main = null;
$total_price = 0;
$sub_for_tot = 0;
$qty_total = 0;

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

$qty_total += $qty; 

$img_link = "site_images/products/$pid/$image";

$cart_main .=            '<tr>
                          <td><img src="'.$img_link.'" style="height:60px;" alt="..."></td>
                          <td>'.$name.'</td>
                          <td colspan="2">'.$qty.'</td>
                          <td colspan="2">Rs. '.$subtotal.'</td>
                        </tr>';

}






  

}

$total_price = $sub_for_tot;


              echo   '<table class="table table-striped" id="cart_table">
                     <thead>
                        <tr>
                          <th></th>
                          <th>Product</th>
                          <th colspan="2">Qty</th>
                          <th colspan="2">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                      '.$cart_main.'
                       <tr>
                          <td></td>
                          <td></td>
                          <td colspan="2">'.$qty_total.'</td>
                          <td colspan="2">Rs. '.$total_price.'</td>
                        </tr>
                      </tbody>
                    </table>

                    <br />
                    <div class="input-group input-group-lg ">
                        <button type="button" onClick="second_btn();" style="margin-left:230px;" class="btn btn-primary btn-lg">Continue</button>
                    </div>
                    <br />';



}


}


?>