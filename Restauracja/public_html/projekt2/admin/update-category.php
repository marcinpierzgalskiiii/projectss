<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update category</h1>

            <br><br>

                <?php 
                
                //check whether the id is set or not 
                if(isset($_GET['id']))
                {
                    //get the id and all other details
                   $id = $_GET['id'];

                   // creat sql query
                   $sql = "SELECT * FROM tbl_category WHERE id=$id";

                   //execute the query
                   $res = mysqli_query($link, $sql);

                   $count = mysqli_num_rows($res);

                   if($count ==1)
                   {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image =$row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                   }
                   else
                    {
                        //redirect to mange category page
                        $_SESSION['no-category-found'] = "Category not found";
                        //redirect to manage category page
                         header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                    
                   }
                }
                else
                {
                 //redirect to mange category page
                 header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                }

                ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Curent image:</td>
                    <td>
                         <?php 
                         if($current_image != "")
                         {
                            //Display image
                            ?>

                            <img src="<?php echo  "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>images/category/<?php echo $current_image;  ?>" width="150px" >

                            <?php
                         }
                         else
                        {
                          echo "Image not added";    
                         }

                         ?>
                    </td>
                </tr>

                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="YES"){echo "checked";} ?> type="radio" name="featured" value="YES"> YES

                        <input <?php if($featured=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO"> NO
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="YES"){echo "checked";} ?>  type="radio" name="active" value="YES">YES
                        <input <?php if($active=="NO"){echo "checked";} ?>  type="radio" name="active" value="NO">NO
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 

                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name= "id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update category " class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
                         
                         <?php 
                         
                         if(isset($_POST['submit']))
                         {
                                //get all the value from form 
                                $id = $_POST['id'];
                                $title = $_POST['title'];
                                $current_image = $_POST['current_image'];
                                $featured = $_POST['featured'];
                                $active = $_POST['active'];

                                //updating new image if selected

                                //check whwether the image is selected or not 

                             
                                if(isset($_FILES['image']['name']))
                                {
                                    //get the image details
                                    $image_name = $_FILES['image']['name'];

                                        //check whether the image is available or not 
                                        if($image_name !="")
                                        {
                                            //image available

                                            //upload new image
                                            
                                             // auto rename image 
                                                    $image_info = explode (".", $image_name);
                                                    $ext = end($image_info);

                                                    //rename the image
                                                    $image_name = "Food_category_".rand(000,999).'.'.$ext;

                                                    $source_path =  $_FILES['image']['tmp_name'];
                                                    $destination_path = "../images/category/".$image_name;

                                                    //Upload the image
                                                    $upload = move_uploaded_file($source_path, $destination_path);
                                                
                                                    //check whether the image is uploaded or not
                                                    if($upload==false)
                                                    {
                                                    echo $_FILES;
                                                        //set massage 
                                                        $_SESSION['upload'] = "Fail to upload image";
                                                        
                                                        //redirect to manage category page
                                                        header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                                                        //stop the proces
                                                        die();

                                                    } 

                                                        //remove the current image if is available
                                                        if( $current_image!= "")
                                                        {
                                                                $remove_path = "../images/category/".$current_image; 

                                                            $remove = unlink($remove_path);

                                                            //check whether image is remove or not
                                                            if($remove == false)
                                                            {
                                                                //failed to romove image
                                                                $_SESSION['failed-remove'] = "Fail to remove current image";
                                                                //redirect to manage category page
                                                                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                                                                //stop the proces
                                                                die();

                                                            }
                                                        }
                                                       

                                        }
                                        else
                                        {
                                            $image_name =  $current_image;
                                        }
                                }
                                else
                                {
                                        $image_name =  $current_image;
                                }

                                //update the database 

                                //query to update admin
        
                                $sql2 = "UPDATE tbl_category SET 
                                title = '$title',
                                image_name = '$image_name',
                                featured= '$featured',
                                active = '$active'
                                    WHERE id=$id
                                ";
                                
                                //execute the query
                                $res2 = mysqli_query($link, $sql2);

                                
                                //check whether execute or not
                                if($res == true)
                                {
                                    //category updated
                                    $_SESSION['update'] = "Category updated successfully";
                                    //redirect to manage-category page
                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                                }
                                else 
                                {
                                    //fail to update category
                                    $_SESSION['update'] = "Fail to update category";
                                    //redirect to manage-category page
                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-category.php");
                                }


                         }
                         ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>