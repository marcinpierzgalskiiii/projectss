<?php 

include('../config/constants.php');

    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete 
            $id= $_GET['id'];
            $image_name = $_GET['image_name'];

            //remove the physical file if available
            if( $image_name != "") 
            {
                //image is available
                $path = "../images/category/".$image_name;
                //remove the image
                $remove = unlink($path);

                if($remove== false)
                {
                    //set the session
                    $_SESSION['remove'] = "Failed to remove category image";
                    //reirect to manage category page
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                    //stop proces
                    die();
                }
            }
            //Delate data from database

            //get the id  category to be delated
            $id = $_GET['id'];
             //sql query to delete data from database
            $sql = "DELETE FROM tbl_category WHERE id=$id";
           
               
            //execute the query
            $res = mysqli_query($link, $sql);

            //chcek whether the data is delate from database or not
            if($res==true)
            {
                $_SESSION['delete'] = "Category delate successfully";
                //redirect to manage category page
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");

            }
            else 
            {
                $_SESSION['delete'] = "Failed to delete category";
                //redirect to manage category page
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");    
            }

            //redirect to manage category page 
    }
    else {
        //redirect to manage category page
        header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
    }
?>