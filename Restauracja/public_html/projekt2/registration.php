
   
<?php
ob_start();


session_start();

if(file_exists('config/constants.php')) include('config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
?>




<html>
    <head>
        <title>Registration</title>
            <link rel="stylesheet" href="css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Registration</h1>
            <br><br>

            <?php 
            if(isset( $_SESSION['regist'])) //checking the session is set or not
            {
                echo  $_SESSION['regist']; //display a session message if set
                unset( $_SESSION['regist']); //remove session message
            }
        ?>
               
                <br><br>
               
              

            <!--Registration form start-->
            <form action="" method="POST" class="text-center">
           
                        Email: &nbsp; &nbsp;&nbsp;&nbsp;
                        <input type="email" name="email" placeholder=" foodgmail.com"  ><br><br>


                        Username: 
                        <input type="text" name="username" placeholder="Enter username"> <br><br>

                        Password: 
                        <input type="password" name="password" placeholder="Enter password"> <br><br>

                        <input type="submit" name="submit" value="Sign up" class="btn-primary">

                        <input type="submit" name="home-page" value="Go to home page" class="btn-primary">
                
            </form>
              <!--Registration form end-->
        </div>
    </body>

</html>

<?php


if(isset($_POST['submit']))

        {
            if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) 
            {
                
                
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = md5($_POST['password']); 
              
               
    
                //Sql Query to save the data into database

              

              $sql = "INSERT INTO  tbl_user SET
                                            email = '$email',
                                            username =  '$username',
                                            password = '$password'
                                            ";

              //echo $sql; die();
             
            
    
                $result =  mysqli_query($link, $sql);
                echo mysqli_affected_rows($result);
                if($result ==true)
                {
                   // echo " Form sumbimtted success ";

                    //a sesion variable to dispaly message
                    $_SESSION['regist'] ="User added sucessfully";
                    //Redirect page to manage-admin
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/user/index-user.php");
                    
                }
                else
                {
                        //echo "Form not subminted";

                        //a sesion variable to dispaly message
                    $_SESSION['regist'] ="Failed to add user";
                    //Redirect page to Add  admin
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/registration.php");
                }
                echo $_SESSION['regist'];
            }
            
    
            else{
                echo "all fields requierd";
            }
    
            
        }
        
        


if(isset($_POST['home-page']))
    {
        header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"); 
    }
?>




