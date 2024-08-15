


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
     // if(file_exists('../config/constants.php')) include('../config/constants.php');
    //  else echo "error";
     // ini_set( 'display_errors', 'On' );
     // error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

     ob_start();


session_start();

            $host = 'localhost';
            $user = '2k22_acdc000';
           $password = '387410';
            $dbname = "2k22_acdc000";
            // $prefix = "prefix nazwy tabeli";

        
        $link = mysqli_connect($host, $user, $password, $dbname); //Database connection
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
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/";?>">Home</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/"; ?>categories.php">Categories</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/"; ?>food.php">Foods</a>
                      </li>

                      <li>
                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/";?>admin/login.php">Login</a>
                      </li>
                    
               </ul>
             </div> 
                  <div class="clearfix">

                  </div> 
        </div>
    </section> 
     <!--Navabar ends -->