<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
</br></br>

            <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
            ?>

<form action="" method="POST">

    <table class="tbl-30">

        <tr>
            <td>Old password:</td>
            <td>
                <input type="password" name="old_password" placeholder="Old password">
            </td>
        </tr>

        <tr>
            <td>New password:</td>
            <td>
                <input type="password" name="new_password" placeholder="New password">
            </td>
        </tr>

        <tr>
            <td>Confirm password</td>
            <td>
                <input type="password" name="confirm_password" placeholder="Confirm passwoed">
            </td>
        </tr>

        <tr>    
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Change password" class="btn-secondary">
            </td>
        </tr>

    </table>
</form>
    </div>
</div>

<?php 

//check submit button is clicked or not
if(isset($_POST['submit']))
{
    //get data from form 
    $id= $_POST['id'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']); 


    //check user with old password id and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$old_password'";

    //execute query
    $res_pass= mysqli_query($link, $sql);
    if($res_pass== true)
    {
        //check data is available or not
        $count = mysqli_num_rows($res_pass);

        if($count==1)
        {
            //user exists and passwors can be change
            echo "User found";

            //check new password and confirm match or not
            if($new_password==$confirm_password)
            {
                //Update password
               $sql2 = "UPDATE tbl_admin SET
               password = '$new_password '
               WHERE id=$id
               ";

               //execute query
               $res2 = mysqli_query($link, $sql2);

               //check query executed or not 
               if($res2 =true)
               {
                //redirect to manage admin
                $_SESSION['change-password'] = "Password change successfully";
                //redirect the user
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-admin.php");
               }
               else
                {
                $_SESSION['change-password'] = "Fail to change password";
                //redirect the user
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-admin.php");
               }
            }
            else 
            {
               //redirect to manage admin withe error message
                $_SESSION['password-not-match'] = "Password did not match";
                //redirect the user
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-admin.php");

            }
        }
        else
        {
                //user does not exist 
                $_SESSION['user-not-found'] = "User not found";
                //redirect the user
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-admin.php");
        }
    }

    //check new password and confirm match or not
    
    //change password if all above is true
}
?>

<?php include('partials/footer.php'); ?>