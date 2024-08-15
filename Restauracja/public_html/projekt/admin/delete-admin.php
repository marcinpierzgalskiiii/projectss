<?php 
if(file_exists('../config/constants.php')) include('../config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

//get the id admin to be delated
 $id = $_GET['id'];

//sql query to delete admin
$sql = "DELETE FROM  tbl_admin WHERE id=$id";

//echo $sql;

//execute the query
$res = mysqli_query($link, $sql);

//check the query executed successfully or not
if($res==TRUE)
{
    //query executed successfully and admin deledted
    //echo"Admin deleted";
    $_SESSION['delete'] ="Admin deleted successfully";
    //redirect to manage admin page
    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");
}
        else
        {
        //Failed to deleted admin
        //echo "Fail to deleted admin";
        $_SESSION['delete'] ="Fail delete admin";
         //redirect to delate admin page
        header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-admin.php");
        }
//echo $_SESSION['delete'];

//redirect to manage admin page 
?>