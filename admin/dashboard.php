<?php

session_start();
include_once("app/init.php");
//session_destroy();

if(isset($_SESSION['adid']) || isset($_COOKIE['adid'])){
    

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

   



   <div class="row clearfix">

        <div class="col-sm-9 col-md-4" style="border-right:5px solid #DEDEDE; z-index:0;">

          <div>  
          <p class="text-center"><h4>Insert Category</h4></p>
          <div class="input-group input-group-lg " >
                <input type="text" id="category_text" style="margin-left:0px; " class="form-control" placeholder="Category Name..">
          </div>
          <br />
          <div class="input-group input-group-lg ">
                <button type="button" onClick="insert_category();" style="margin-left:100px;" class="btn btn-success btn-md">Insert</button>
          </div>
          <br />
          <p class="text-center alert alert-danger" style="width:250px; display:none;" id="category_e_alert" ></p>
          <p class="text-center alert alert-success" style="width:250px; display:none;" id="category_s_alert" ></p>

          </div>
          <br /><br />
          <div style="border-bottom:2px solid #DEDEDE;"></div>
          <br /><br />

          <div>
          <p class="text-center"><h4>Insert Product</h4></p>
          <div class="input-group input-group-lg " >
                <input type="text" style="margin-left:0px;" id="p_name" class="form-control" placeholder="Product Name..">
          </div>
          <br />
          <div class="input-group input-group-lg">
                <textarea class="form-control"  id="p_desc"  style="margin-left:0px; height:200px; width:350px;" id="comment" placeholder="Write product Description...."></textarea>
          </div>
          <br />

          <div class="input-group input-group-lg ">
               <p class="text-center"><h4>Select Category</h4></p>
                <select class="form-control" id="p_cat" style="width:150px; margin-left:50px;">
                   
                   <?php

                  require_once("app/init.php");

                  $sql_get_cat = $db->prepare("SELECT * FROM category");
                  $sql_get_cat->execute();

                    $num_rows = $sql_get_cat->rowCount();

                    if($num_rows > 0){

                       while($row = $sql_get_cat->fetch(PDO::FETCH_ASSOC)){

                        $id = $row['id'];
                        $name = $row['name'];

                        echo '<option value="'.$id.'">'.$name.'</option>';
                       
                       } 



                     }else{

                        echo '<option value="none">Not Available</option>';

                     }   

                   

                    ?>

                    
                </select>
          </div>
          <br />
          <div class="input-group input-group-lg ">
               <p class="text-center"><h4>Inventory Quantity</h4></p>
                <select class="form-control" id="p_in_qty" style="width:100px; margin-left:50px;">
                   
                   <?php

                   $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
                   foreach ($array as $value) {
                       echo '<option value="'.$value.'">'.$value.'</option>';
                   }

                    ?>

                    
                </select>
          </div>
          <br />
          <div class="input-group input-group-lg ">
                <p class="text-center"><h4> Quantity to be made available</h4></p>
                <select class="form-control" id="p_av_qty" style="width:100px; margin-left:50px;">
                   
                   <?php

                   $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
                   foreach ($array as $value) {
                       echo '<option value="'.$value.'">'.$value.'</option>';
                   }

                    ?>

                    
                </select>
          </div>
          <br />
          <div class="input-group input-group-lg ">
          <span class="input-group-addon">&#8360;</span>
                <input type="text" id="p_s_price" style="margin-left:0px; width:150px;"  class="form-control" placeholder="Sale Price..">
                <div style="margin-top:15px;">Rs. 500</div>
          </div>
          <br />

          <div class="input-group input-group-lg ">
                <span class="input-group-addon">&#8360;</span>
                <input type="text" id="p_or_price" style="margin-left:0px; width:150px;"  class="form-control" placeholder="Original Price..">
                <div style="margin-top:15px;"><s>Rs. 1000</s></div>
          </div>
          <br />

          <div class="input-group input-group-lg ">
               
                <input type="text" id="p_sku" style="margin-left:0px; width:150px;"  class="form-control" placeholder="SKU...">

                <button type="button" style="margin-left:10px; margin-top:5px;" onClick="generate_sku();" class="btn btn-warning btn-sm">Generate</button>
          
              <span id="sku_loader" style="display:none;"><img src="../site_images/loader.gif" style="width:20px; height:20px;" /></span>
          </div>
          <br />

          <div class="input-group input-group-lg" id="image_form">
          <form enctype="multipart/form-data" id="myform">
          <input type="file" accept="image/*" multiple name="image[]" id="image" class="btn btn-warning btn-sm" title="Upload Images Max. 4">
          </form>
           <span id="image_loader" style="display:none; margin-left:100px;"><img src="../site_images/loader.gif" style="width:20px; height:20px; margin-top:50px;" /></span>

          </div>
          <br />


          <ul class="nav nav-tabs" id="show_uploaded_images">
          

         </ul>
         
         <br />


         <br />
          
            <div class="input-group input-group-lg ">
                <button type="button" style="margin-left:100px;" onClick="insert_product();" class="btn btn-success btn-md">Insert Product</button>

          </div>
          <br />
          <p class="text-center alert alert-danger" style="width:250px; display:none;" id="product_e_alert" ></p>
          <p class="text-center alert alert-success" style="width:250px; display:none;" id="product_s_alert" ></p>


          </div>


          <br /><br />
          <div style="border-bottom:2px solid #DEDEDE;"></div>
          <br /><br />

          

          <p class="text-center"><h4>Upload Slider Images Together</h4></p>

          <div class="input-group input-group-lg" id="image_slider_form_container">
          <form enctype="multipart/form-data" id="slider_image_form">
          <input type="file" accept="image/*" multiple name="image_slider[]" id="image_slider_image" class="btn btn-warning btn-sm" title="Upload Images">
          </form>
           <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style=" margin-top:20px; margin-left:100px; display:none;" id="slider_image_loader"></span>

          

          <ul class="nav nav-tabs" id="show_uploaded_slider_images">
          
          <?php

          $sql_get_slider_image = $db->prepare("SELECT * FROM slider_images");
          $sql_get_slider_image->execute();

          $numrows = $sql_get_slider_image->rowCount();

          if($numrows < 1){
            echo null;
          }else{

            while($row = $sql_get_slider_image->fetch(PDO::FETCH_ASSOC)){

                $slider_picture = $row['image'];

            echo '<li style="padding:5px;"><img src="../site_images/slider/'.$slider_picture.'" style="width:350px; height:200px;"></li>';
         
            }
          }

          ?>

         </ul>

         <br />

          <p class="text-center alert alert-danger" style="width:250px; display:none;" id="slider_e_alert" ></p>
          <p class="text-center alert alert-success" style="width:250px; display:none;" id="slider_s_alert" ></p>
          

          </div>

          <br /><br />
          <div style="border-bottom:2px solid #DEDEDE;"></div>
          <br /><br />

        </div>



        <div class="col-sm-9 col-md-8">
            

                <div class="table-responsive">          
                          <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                  <th>ID<th>
                                  <th>Name</th>
                                  <th>Category</th>
                                  <th>Description</th>
                                  <th>Stock Qty</th>
                                  <th>Shown Qty</th>
                                  <th>Sale Price</th>
                                  <th>Original Price</th>
                                  <th>SKU</th>
                                  <th>Action</th>
                                  </tr>
                            </thead>
                            <tbody>

                            <?php

                            require_once("app/init.php");

                            $show_table = NULL;

                            $get_products = $db->prepare("SELECT * FROM products ORDER BY id ASC");
                            $get_products->execute();

                            $numrows = $get_products->rowCount();

                            if($numrows == 0){

                                echo '<tr><td colspan="6">There are no producs in your inventory.</tr>';
                            }else{

                                while($row = $get_products->fetch(PDO::FETCH_ASSOC)){

                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $desc = $row['description'];
                                    $sku = $row['sku'];
                                    $category = $row['category'];
                                    $in_qty = $row['inventory_qty'];
                                    $s_qty = $row['shown_qty'];
                                    $or_price = $row['original_price'];
                                    $sale_price = $row['sale_price'];

                                    // get cat name

                                    $sql_get_cat = $db->prepare("SELECT name FROM category WHERE id=:cat");
                                    $sql_get_cat->execute(array("cat" => $category));

                                    $numrows_cat = $sql_get_cat->rowCount();

                                    if($numrows_cat == 0){

                                    }else{



                                        while($row_cat = $sql_get_cat->fetch(PDO::FETCH_ASSOC)){

                                            $cat_name = $row_cat['name'];
                                        }

                                }

                                    // getting images
                                   
                                    $image = array();

                                    $sql_get_image = $db->prepare("SELECT image FROM product_images WHERE p_id=:pid");
                                    $sql_get_image->execute(array("pid" => $id));
                                    while($row_img = $sql_get_image->fetch(PDO::FETCH_ASSOC)){

                                        $image[] = $row_img['image'];

                                        
                                      }
                                        
                                    $img_show = array();

                                    foreach ($image as $each_image) {
                                        
                                        $path = '../site_images/products/'.$id.'/'.$each_image.'';
                                        $img_show[] = '<li style="padding:10px;" style="display:inline-block;"><img src='.$path.' style="height:80px; width:80px;" alt="..."></li>';
                                    }
                                    
                                
                                $show_img = implode(" ", $img_show);
                                

                                $show_table .= '<tr id="product_info'.$id.'">
                                              <td>'.$id.'</td>   
                                              <td>'.$name.'</td>
                                              <td>'.$cat_name.'</td>
                                              <td>'.$desc.'</td>
                                              <td><span id="inventory_qty_tr'.$id.'">'.$in_qty.'</span></td>
                                              <td><span id="shown_qty_tr'.$id.'">'.$s_qty.'</span></td>
                                              <td>Rs. '.$sale_price.'</td>
                                              <td>Rs. '.$or_price.'</td>
                                              <td>'.$sku.'</td>
                                              <td>
                                              <ul class="nav nav-tabs">
                                                <li style="padding:4px;"><button type="button" onClick="get_info('.$id.');" class="btn btn-warning btn-sm">Edit</button></li>
                                                <li style="padding:4px;"><button type="button" onClick="delete_product('.$id.');" class="btn btn-danger btn-sm">Delete</button></li>
                                                <li style="padding:4px;"><button type="button" onClick="qty_transfer('.$id.');" class="btn btn-info btn-sm">Qty transfer</button></li>
                                                </ul>
                                            </td>
                                            </tr>
                                            <tr id="product_img_info'.$id.'">
                                            
                                            <td colspan="10">
                                            <ul class="nav nav-tabs">
                                                '.$show_img.'
                                                
                                             </ul></td>

                                              
                                            </tr>'; 
                                
                                
                            
                                

                                 
                                    

                                    }

                               
                                    echo $show_table;
                            } 


                            ?>
                              
                              
                            </tbody>
                          </table>
                      </div>


        </div>



    </div>                
   


    </div>
   
   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">

    /* image upload prooduct*/

        $(function () {
        
        
        $('#image').change(function(){

             
        
        var form = new FormData($('#myform')[0]);

        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>4){
         alert("You can only upload a maximum of 4 files");
        }else{

        $("#image").val("");
           

            var imageupload = {
            action : "image_upload",
            form : form
            };

        
        $.ajax({
                url: 'ajax_scripts/image_upload.php',
                type: 'POST',
                data:form,
                beforeSend : function(){
                        $('#image_form #image_loader').show();
                    },
                cache: false,
                contentType: false,
                processData: false,
                success: function(r){
                    
                    $('#image_form #image_loader').hide();
                    $('ul#show_uploaded_images').html(r);  
                   
                   
                        
                    
                },
            });

    }
            });
            });



/* image upload slider*/

        $(function () {
        
        
        $('#image_slider_image').change(function(){

             
        
        var form = new FormData($('#slider_image_form')[0]);

        var $fileUpload = $("input[type='file']");
        

        $("#image_slider_image").val("");
          

            var imageupload = {
            action : "image_upload",
            form : form
            };

        
        $.ajax({
                url: 'ajax_scripts/slider_image_upload.php',
                type: 'POST',
                data:form,
                beforeSend : function(){
                        $('#image_slider_form_container #slider_image_loader').show();
                    },
                cache: false,
                contentType: false,
                processData: false,
                success: function(r){
                    
                    $('#image_slider_form_container #slider_image_loader').hide();
                    $('ul#show_uploaded_slider_images').html(r);  
                    $('#slider_s_alert').text("Images have been uploaded successfully!").show();
                   
                        
                    
                },
            });

    
            });
            });

function close_edit_modal(){

$('#edit_product_modal').hide();
$('#edit_product_modal #inner_cover_edit_product_modal').hide();
$('.overlay').hide();

}


function get_info(pid){

$('.overlay').fadeIn('slow');
$('#edit_product_modal').show();

$('#product_s_edit_alert').hide();
$('#product_e_edit_alert').hide();    

var get_info_product = {

    action : "get_info_product",
    pid : pid
};


        $.ajax({

                type : "GET",
                url : "ajax_scripts/get_product_info.php",
                data : get_info_product,
                cache : false,
                beforeSend : function(){
                        $('#edit_product_modal #image_loader_edit_info').show();
                    },
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1){

                        setTimeout(function(){

                        $('#edit_product_modal #image_loader_edit_info').hide();
                        
                        //$('').val(obj.success)
                        $('#edit_product_modal #ed_p_name').val(obj.p_name);
                         $('#edit_product_modal #ed_p_desc').html(obj.desc);
                        $('#edit_product_modal #ed_p_cat').html(obj.cat_display);
                       
                         $('#edit_product_modal #ed_p_in_qty').val(obj.in_qty);
                         $('#edit_product_modal #ed_p_av_qty').val(obj.s_qty);
                         $('#edit_product_modal #ed_p_s_price').val(obj.s_price);
                         $('#edit_product_modal #ed_p_or_price').val(obj.or_price);

                         
                         $('#edit_product_modal #edit_product_button_holder').html(obj.btns);

                        $('#edit_product_modal #inner_cover_edit_product_modal').fadeIn('slow');

                         $('#edit_product_modal #image_loader_edit_info').hide();

                     }, 1500);
                        

                    }

                },




            });




}

// save product 

function save_product(pid){

            var pname  =  $('#edit_product_modal #ed_p_name').val();
            var pdesc  =  $('#edit_product_modal #ed_p_desc').val();
            var pcat   =  $('#edit_product_modal #ed_p_cat').val();
                       
            var p_in_qty = $('#edit_product_modal #ed_p_in_qty').val();
            var p_av_qty = $('#edit_product_modal #ed_p_av_qty').val();
            var p_s_pr =  $('#edit_product_modal #ed_p_s_price').val();
            var p_or_pr =  $('#edit_product_modal #ed_p_or_price').val();   

            if(pname.trim() == '' || pdesc.trim() == '' || p_in_qty.trim() == '' || p_av_qty.trim() == '' || p_s_pr.trim() == '' || p_or_pr.trim() == ''){

            $('#product_s_edit_alert').hide();
            $('#product_e_edit_alert').text("Please provide all infos!").show();

        }else{

        var save_product_edit = {

            action : "save_product_edit",
            pid : pid,
            pname : pname,
            pdesc : pdesc,
            pcat : pcat,
            p_in_qty : p_in_qty,
            p_av_qty : p_av_qty,
            p_s_pr : p_s_pr,
            p_or_pr : p_or_pr
        };


        $.ajax({

                type : "POST",
                url : "ajax_scripts/save_product_edit.php",
                data : save_product_edit,
                cache : false,
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1){
                        
                        //$('').val(obj.success)
                        
                        $('#product_s_edit_alert').text("Your updates have been saved!").show();
                        $('#product_e_edit_alert').hide();
                        
                        setTimeout(function(){
                        $('#edit_product_modal').fadeOut('fast');

                        $('.overlay').fadeOut('fast');
                    }, 2500)
                    }else if(obj.codeval == 0){

                      $('#product_e_edit_alert').text("Product name already exists!").show();
                      $('#product_s_edit_alert').hide();

                    }

                },




            });

    }

}

// random generate sku 

    function generate_sku(){

      

        var sku_send = {

            action : "send_sku"
            
        };

         $.ajax({

                type : "POST",
                url : "ajax_scripts/generate_sku.php",
                data : sku_send,
                beforeSend : function(){
                        $('#sku_loader').show();
                    },
                cache : false,
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1){
                        $('#sku_loader').hide();
                        $('#p_sku').val(obj.success)

                    }

                },




            });


    }

    function insert_category(){


        var  cat = $('#category_text').val();
        

        if(cat.trim() == ''){
            $('#category_s_alert').hide();
            $('#category_e_alert').text("Please provide a name!").show();

        }else{

            var add_category = {
                action : "add_category",
                category : cat
               
            };

            $.ajax({

                type : "POST",
                url : "ajax_scripts/insert_category.php",
                data : add_category,
                cache : false,
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 0){
                        $('#category_s_alert').hide();
                        $('#category_e_alert').text(obj.errormsg).show();
                    }else if(obj.codeval == 1){
                         $('#category_e_alert').hide();
                         $('#category_s_alert').text(obj.success).show();
                         $('#category_text').val(" ");

                    }

                },




            });


        }
    }

  

    function check_image_exists() {
       return $('ul#show_uploaded_images').has('img').length == 0;
    }

  

    function insert_product(){

        var  name = $('#p_name').val();
        var desc = $('#p_desc').val();
        var cat = $('#p_cat').val();
        var i_qty = $('#p_in_qty').val();


        
        var s_qty = $('#p_av_qty').val();
        var s_price = $('#p_s_price').val();
        var o_price = $('#p_or_price').val();
        var sku = $('#p_sku').val();
        var img_pref = $('input[name=radio]:checked').val();

      
       



if(name.trim() == '' || desc.trim() == '' || i_qty.trim() == '' || s_qty.trim() == '' || s_price.trim() == '' || sku.trim() == ''){

            $('#product_s_alert').hide();
            $('#product_e_alert').text("Please provide all infos!").show();

        }else if (check_image_exists()) {


            $('#product_s_alert').hide();
            $('#product_e_alert').text("Upload Image(s) first then submit!").show();


        }else if(!$('input[name=radio]').is(':checked')){
            $('#product_s_alert').hide();
            $('#product_e_alert').text("Please select the image to be displayed as main image!").show();
        }else{

            var add_product = {
                action : "add_product",
                name : name,
                desc : desc,
                cat : cat,
                i_qty : i_qty,
                s_qty : s_qty,
                s_price : s_price,
                o_price : o_price,
                sku : sku,
                img_pref : img_pref
               
            };

            $.ajax({

                type : "POST",
                url : "ajax_scripts/insert_product.php",
                data : add_product,
                cache : false,
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 0){
                        $('#product_s_alert').hide();
                        $('#product_e_alert').text(obj.error0).show();
                    }else if(obj.codeval == 2){
                         $('#product_s_alert').hide();
                        $('#product_e_alert').text(obj.error2).show();
                    }else if(obj.codeval == 1){
                        $('#product_e_alert').hide();
                         $('#product_s_alert').text(obj.success).show();

                         $('ul#show_uploaded_images').html(" ");
                         $('#p_name').val("");
                         $('#p_desc').val("");
                         $('#p_s_price').val("");
                         $('#p_or_price').val("");
                         $("#p_sku").val("");

                      


                    }

                },




            });


        }

    }

    function delete_product(pid){

        var deletepr = {
            action : "delete_product",
            pid : pid
        };


        $.ajax({

                type : "POST",
                url : "ajax_scripts/delete_product.php",
                data : deletepr,
                cache : false,
                success : function(r){

                    var obj = JSON.parse(r);

                    if(obj.codeval == 1){
                        $('#product_info'+pid).fadeOut('slow');
                        $('#product_img_info'+pid).fadeOut('slow');
                    }

                      


                    }

                




            });


    }

    function qty_transfer(pid){


       
        var in_qty = $('#inventory_qty_tr'+pid).text();
        var sh_qty = $('#shown_qty_tr'+pid).text();


        var qty_tr = prompt("How many do you want to transfer from inventory?", "");

        if (qty_tr != '' && qty_tr != null) {

        if(isNaN(qty_tr)){
        
            alert("Enter only numbers!");
        
        }else if((parseInt(qty_tr)) > (parseInt($('#inventory_qty_tr'+pid).text()))){
        
            alert("The quantity you have entered is greater than your inventory stock!");
            

        }else{

        
        var tr_qty = {
            action : "transfer_quantity",
            pid : pid,
            qty_tr : qty_tr,
            in_qty : in_qty,
            sh_qty : sh_qty
        };


        $.ajax({

                type : "POST",
                url : "ajax_scripts/quantity_transfer.php",
                data : tr_qty,
                cache : false,
                success : function(r){

                   var obj = JSON.parse(r);

                    if(obj.codeval == 1){
                        
                        alert("Quantity hasa been transferred!");

                        $('#inventory_qty_tr'+pid).text(obj.in_q);
                        $('#shown_qty_tr'+pid).text(obj.sh_q);

                        
                    }


             
                      


                    }

                




            });


}

}
    }

    </script>

  </body>
</html>
<?php
  
}else{

header("Location:index.php"); 
}

?>


