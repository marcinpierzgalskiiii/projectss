
<?php 
ob_start();


session_start();
           

           $host = 'localhost';
            $user = '2k22_acdc000';
           $password = '387410';
            $dbname = "2k22_acdc000";
            // $prefix = "prefix nazwy tabeli";

        
        $link = mysqli_connect($host, $user, $password, $dbname); //Database connection


        
            // Check connection
    //    if (mysqli_connect_errno()) {
    //         die("Connection failed: " . mysqli_connect_error());
    //         exit();
    //     }
      
?>