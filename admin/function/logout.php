<?php
session_start();

if(isset($_SESSION['adid'])){

session_destroy();
header("Location: ../index.php");

}

?>