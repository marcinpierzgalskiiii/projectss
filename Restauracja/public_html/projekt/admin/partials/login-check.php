<?php 
//authorization -access control 
//check  whether the user is logged in or not
if(!isset($_SESSION['user'])) //if user session is not set
{
    //user is not logged in
    
    $_SESSION['no-login-message'] = "<center> Login to access Admin panel </center>";
    //redirect to login page
    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/login.php"); 
}
?>