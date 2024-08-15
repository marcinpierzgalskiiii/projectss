
<?php
 ob_start();


 session_start();
if(file_exists('../config/constants.php')) include('../config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

//include('../login-check.php');
?>




<html>
    
    <head>

        <title>Food Order Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>
        <!--Menu Start-->
            <div class="menu">
                <div class="wrapper">
                   <ul>
                      
                        <li> <a href="index.php">Home</a>  </li>
                        <li> <a href="manage-admin.php">Admin Manager</a>  </li>
                        <li> <a href="manage-category.php">Category</a>  </li>
                        <li> <a href="manage-food.php">Food</a>  </li>
                        <li> <a href="manage-order.php">Order</a>  </li>
                        <li> <a href="logout.php">Logout</a>  </li>
                      
                   </ul>
                </div>
                 
            </div>
         <!--Menu End-->
