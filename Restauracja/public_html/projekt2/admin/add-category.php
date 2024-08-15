<?php include('partials/menu.php'); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Add category</h1>

        <br><br>

            <?php 
            if(isset($_SESSION['add']))
            {
                echo  $_SESSION['add']; //display a session message if set
                unset( $_SESSION['add']); //remove session message
            }

            if(isset($_SESSION['upload']))
            {
                echo  $_SESSION['upload']; //display a session message if set
                unset( $_SESSION['upload']); //remove session message
            }

            ?>

           <br><br>

        <!--Add category start-->
        <form action="" method="POST" enctype= "multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Category title">
                </td>
            </tr>

            <tr>
                <td>Select image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="YES"> YES
                    <input type="radio" name="featured" value="NO"> NO
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="YES">YES
                    <input type="radio" name="active" value="NO">NO
                </td>
            </tr>

            <tr>
                <td colspan="2"> 

                <input type="submit" name="submit" value="Add category " class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <!--Add category end-->
            <?php 
            
            //check whether  the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";

                //get the value from  category form
                $title= $_POST['title'];

                //check for radio input whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        //get the value from form 
                        $featured = $_POST['featured'];

                    }
                    else {
                       //set the default value

                       $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                     {
                        $active= "No";    
                    }

                    //check whether the image is selected or not and set the value for image name accoridingly
                    //print_r($_FILES['image']);

                   // die(); // Brake the code 
                      
                  
                   if(isset($_FILES['image']['name']))
                                    {
                                        //get the detail of the selected image
                                        $image_name = $_FILES['image']['name'];

                                        //check whether the image is selcted or not
                                        if( $image_name !="")
                                        {
                                                    //image is selected

                                                    //rename the image
                                                   $image_info = explode (".", $image_name);
                                                    $ext = end($image_info);

                                                    //create a new name for image
                                                    $image_name = "Food-name-".rand(0000,9999).".".$ext;

                                                    //upload the image

                                                    //get the source path and destination path


                                                    $source_path =  $_FILES['image']['tmp_name'];
                                                    $destination_path = "../images/category/".$image_name;
                                                //upload  food image
                                                $upload =  move_uploaded_file($source_path, $destination_path);

                            
                        
                                                //check whether the image is uploaded or not
                                                if($upload == false)
                                                {
                                                
                                                    //set massage 
                                                    $_SESSION['upload'] = "Fail to upload image";
                                                    
                                                    //redirect to Add category page
                                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/add-category.php");
                                                    //stop the proces
                                                    die();

                                                } 
                                        }
                                    }
                                    else
                                    {
                                        //don't upload image and set the image_name value as blank
                                        $image_name ="";
                                    }

                                    //create sql query ti insert category into database
                        
                                    $sql = "INSERT INTO  tbl_category SET
                                                            title = '$title',
                                                            image_name = '$image_name',
                                                            featured = '$featured',
                                                            active = '$active'
                                                            ";
                    

                    //execute the query and save in database
                    $res = mysqli_query($link, $sql);
                    echo $sql;

                    //check whether query executed or not and data add or not
                    if($res ==true)
                    {
                        //query executed and category added
                        $_SESSION['add'] = "Category added successfully";
                        //redirect to manage-category page
                       header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                    }
                    else 
                    {
                       //Fail to add category 
                         $_SESSION['add'] = " Fail to add Category";
                        //redirect to manage-category page
                        header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                    }
            }

            ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>