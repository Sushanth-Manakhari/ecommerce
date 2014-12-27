<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == "logout" && (isset($_SESSION['uid']) || isset($_COOKIE['uid']))){


setcookie("uid", "", false, "/", false);
session_destroy();

$array = array("codeval" => 1);

echo json_encode($array);

}


?>