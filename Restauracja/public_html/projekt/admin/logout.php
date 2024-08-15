<?php 

 include('../config/constants.php'); 

//destroy the sesion 
session_destroy(); //unsets $_SESSION['user']

//redirect to login page
header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/login.php"); 
?>