


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant web</title>

    <!--Link css-->
    <link rel="stylesheet" href="css/style.css">

</head>

<?php
if(file_exists('config/constants.php')) include('config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

//include('login-check.php');
?>

<body>
    <!--Navabar starts -->
    <section class="navbar">
        <div class="container"> 
            <div class="logo">
               <img src="images/Logo.jpg" alt="Restaurant logo" class="img-responsive-for-logo" >
            </div>

             <div class="menu text-right">
               <ul>
                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>">Home</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>categories.php">Categories</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>food.php">Foods</a>
                    
                        
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>admin/login.php">Login</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>registration.php">Registration</a>
                      </li>
                    
               </ul>
             </div> 
                  <div class="clearfix">

                  </div> 
        </div>
    </section> 
     <!--Navabar ends -->