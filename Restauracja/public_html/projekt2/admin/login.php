
<?php
ob_start();


session_start();

if(file_exists('../config/constants.php')) include('../config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);


?>

<html>
    <head>
        <title>Login Food order</title>
            <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                   
                    if(isset($_SESSION['login-user']))
                    {
                        echo $_SESSION['login-user'];
                        unset($_SESSION['login-user']);
                    }
                    
                ?>
                <br><br>
               
              

            <!--Login form start-->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit" name="submit" value="Login as admin" class="btn-primary">

                <input type="submit" name="login-as-user" value="Login as user" class="btn-primary">


                <input type="submit" name="home-page" value="Go to home page" class="btn-primary"></br>

                
                
            </form>
              <!--Login form end-->
        </div>
    </body>

</html>

<?php
    //check submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //get data from login form
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($link, $_POST['username']);
        //$password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($link, $raw_password);

        // sql to check whether user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

        //execute query
        $res = mysqli_query($link, $sql);

        // count rows to check whether user exists or not
        $count= mysqli_num_rows($res);

        if($count == 1)
        {
            //user avilable
            $_SESSION['login'] ="Login successful";
            $_SESSION['user'] = $username; // to check whether user is logged in or not 
            //redirect to home page/dashbord
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/index.php"); 
        }
        else {
            //user not avilable
            $_SESSION['login'] =" <center>Username or password did not match </center>";
            //redirect to home page/dashbord
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/login.php"); 
        }


        
    }
//login for user
    if(isset($_POST['login-as-user']))
    {
        //get data from login form
        //$username = $_POST['username'];
        $username2 = mysqli_real_escape_string($link, $_POST['username']);
        //$password = md5($_POST['password']);
        $raw_password2 = md5($_POST['password']);
        $password2 = mysqli_real_escape_string($link, $raw_password2);

        // sql to check whether user with username and password exists or not
        $sql2 = "SELECT * FROM tbl_user WHERE username='$username2' AND password = '$password2'";

        //execute query
        $res2 = mysqli_query($link, $sql2);

        // count rows to check whether user exists or not
        $count2= mysqli_num_rows($res2);

        if($count2 == 1)
        {
            //user avilable
            $_SESSION['login-user'] ="Login successful";
            $_SESSION['user'] = $username2; // to check whether user is logged in or not 
            //redirect to home page/dashbord
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/user/index-user.php"); 
        }
        else {
            //user not avilable
            $_SESSION['login-user'] =" <center>Username or password did not match </center>";
            //redirect to home page/dashbord
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/login.php"); 
        }


        
    }


    if(isset($_POST['home-page']))
    {
        header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"); 
    }

    
?>