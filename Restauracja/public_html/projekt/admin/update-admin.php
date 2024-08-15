<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>
</br></br>

        <?php 
         //get the id selected admin
            $id =$_GET['id'];

         //to get the details
         $sql = "SELECT * FROM tbl_admin WHERE id=$id";

         //execute the query
         $res = mysqli_query($link, $sql);

         //check the query is executed or not
         if($res==true)
         {
            //check data is available or not
            $count = mysqli_num_rows($res);
            //check we have admin data or not
            if($count==1)
            {
                //get the details 
                //echo "Admin available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else
            {
                //redirect to manage admin page
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");
            }
         }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>

                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "Button clicked";
   //get all the value from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];

    //query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id = '$id'
    ";


    //execute query
    $res = mysqli_query($link, $sql);
      //  echo $sql; die();
    //check query executed successfull or not
        if($res==true)
        {
            //query executed admin updated
            $_SESSION['update'] = "Admin updated successfully";
            //redirect to manage admin page
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");


        }
        else
        {
            //Fail to updated admin
            //query executed admin updated
            $_SESSION['update'] = "Fail to  updated admin";
            //redirect to manage admin page
            header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");
        }
}
?>

<?php include('partials/footer.php'); ?>