<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
</br></br>

        <?php 
            if(isset( $_SESSION['add'])) //checking the session is set or not
            {
                echo  $_SESSION['add']; //display a session message if set
                unset( $_SESSION['add']); //remove session message
            }
        ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                        
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Your username">
                        </td>
                    </tr>

                    <tr>
                        <td>Password:</td>

                        <td>
                            <input type="password" name="password" placeholder="Your password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
    </div>
</div>

        <?php include('partials/footer.php'); ?>


        <?php 
        //Process the value from Form and Save it in database

        //Check whether the submit button is clicked or not

       /* if(isset($_POST['add-addmin'])){
            $host = 'localhost';
            $user = '2k22_acdc000';
            $password = '387410';
            $dbname = "2k22_acdc000";

            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);  

            $connect = mysqli_connect($host,  $user, $password,  $dbname);
            $query = "INSERT INTO `tbl_admin`( `full_name`, `username`, `password`) VALUES ('[$full_name]','[$username]','[$password]')";

            $result = mysqli_query($connect, $query);


            if($result)
            {
                echo "Data inserted";
            }
            else{
                echo "Data not inserted";
                function se($query){ 
                    if ( mysqli_errno($query) <> 0)
                    {
                      echo "<p><code>".mysqli_errno($query) .":". mysqli_error($query) ."</code></pre>\n"; 
                    }
                                    }
            }

            mysqli_free_result($result);
            mysqli_close($connect);
        }
                */
    
       

        if(isset($_POST['submit']))

        {
            if(!empty($_POST['full_name']) && !empty($_POST['username']) && !empty($_POST['password'])) 
            {
                
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];
                $password = md5($_POST['password']);  //Password encryption with MD5
    
                //Sql Query to save the data into database

              $sql = "INSERT INTO tbl_admin(full_name, username, password)  VALUES ('$full_name','$username','$password')";
              //echo $sql;
             
              /*$sql = "INSERT INTO tbl_admin SET    
              full_name= '$full_name',
              username = '$username',
              password ='$password'
              ";*/
    
              $result =  mysqli_query($link, $sql);
    echo mysqli_affected_rows($result);
                if($result)
                {
                   // echo " Form sumbimtted success ";

                    //a sesion variable to dispaly message
                    $_SESSION['add'] ="Admin added sucessfully";
                    //Redirect page to manage-admin
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");
                    
                }
                else
                {
                        //echo "Form not subminted";

                        //a sesion variable to dispaly message
                    $_SESSION['add'] ="Failed to add admin";
                    //Redirect page to Add  admin
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/add-admin.php");
                }
                echo $_SESSION['add'];
            }
            
    
            else{
                echo "all fields requierd";
            }
    
            
        }
        
        
    
    

       
       
       
        
        
    
  
?>