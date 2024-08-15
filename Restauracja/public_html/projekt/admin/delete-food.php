<?php 

            include('../config/constants.php');

   

        if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete 
            $id= $_GET['id'];
            $image_name = $_GET['image_name'];

            //remove the physical file if available
            if( $image_name != "") 
            {
                //image is available
                $path = "../images/food/".$image_name;
                //remove the image
                $remove = unlink($path);

                if($remove== false)
                {
                    //set the session
                    $_SESSION['remove'] = "Failed to remove  image";
                    //reirect to manage food page
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
                    //stop proces
                    die();
                }
            }


        //delede food from database
            $sql = "DELETE FROM tbl_food WHERE id=$id";
            //exectue the query
            $res = mysqli_query($link, $sql);
           

            //check whether the query executed or not 
            if($res ==true)
            {
                //food deleted

                $_SESSION['delete'] ="Food deleted successfully";
                //redirect to delate admin page
               header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
            }
            else
            {
                //Failed to delete food

                $_SESSION['delete'] ="Fail to delete food?";
                //redirect to delate admin page
                header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
            }
       
    }
    else
    {
       
        $_SESSION['unauthorized'] ="unauthorized access";
        //redirect to delate admin page
       header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
    }
?>