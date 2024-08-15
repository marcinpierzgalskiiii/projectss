<?php include('partials/menu.php'); ?>


<?php 
    //chceck whether id is set or not
    if(isset($_GET['id']))
    {
        //get all the detail 
        $id = $_GET['id'];

        //sql query to get the selected food
        $sql2 = "SELECT  * FROM tbl_food WHERE id =$id";
        //execute the queery
        $res2 = mysqli_query($link, $sql2);
        
        //get the value based on query executed 
        $row2 = mysqli_fetch_assoc($res2);

        //get the individual value of selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else 
    {
        //redirect to manage food page
        header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php"); 
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <br><br>

            <form action="" method ="POST" enctype="multipart/form-data">

                    <table class="tbl-30">
                                <tr>
                                    <td>Title:</td>
                                    <td>
                                        <input type="text" name ="title" value= "<?php echo $title; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Description:</td>
                                    <td>
                                        <textarea name="description"  cols="22" rows="5"><?php echo $description; ?></textarea>
                                    </td>
                                </tr>

                            <tr>
                                <td>Price:</td>
                                <td>
                                    <input type="number" name="price" value="<?php echo $price; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>Current image</td>
                                <td>
                                    <?php
                                    if($current_image == "")
                                    {
                                        //image not available
                                        echo "image not available";
                                    }
                                    else
                                    {
                                    //image available  
                                        ?>
                                            <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/"; ?>images/food/<?php echo $current_image; ?>" width="150px">

                                        <?php
                                    }

                                   
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Select new image:</td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>

                            <tr>
                                <td>Category:</td>
                                <td>
                                    <select name="category" >
                                    <?php 
                                        
                                        //create sql to get all active categories  from database
                                        $sql = "SELECT * FROM tbl_category WHERE active = 'YES'";
                                        
                                        //executing query
                                        $res = mysqli_query($link, $sql);

                                        //count rows to check whether have category or not
                                        $count = mysqli_num_rows($res);

                                        if($count>0)
                                        {
                                            //have categories
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                
                                                $category_title = $row['title']; 
                                                $category_id = $row['id'];
                                            

                                                ?>
                                                    <option <?php if($current_category == $category_id) {echo "Selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>

                                                <?php
                                            }
                                        }
                                        else 
                                        {
                                        //don't have category
                                        ?>
                                            <option value="0">Category not available</option>
                                        <?php

                                        }
                                        
                                        //display on dropdown 
                                        ?>
                                    </select>
                                </td>
                            </tr>   
                            
                            <tr>
                                <td>Featured:</td>
                                <td>
                                    <input <?php if($featured =="YES") {echo "checked";}?> type="radio" name="featured" value="YES">YES
                                    <input <?php if($featured =="NO") {echo "checked";}?> type="radio" name="featured" value="NO">NO
                                </td>
                            </tr>

                            <tr>
                                <td>Active:</td>
                                <td>
                                    <input <?php if($active =="YES") {echo "checked";}?> type="radio" name="active" value="YES">YES
                                    <input <?php if($active =="No") {echo "checked";}?> type="radio" name="active" value="NO">NO
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                                    <input type="submit" name="submit" value="Update food" class="btn-secondary">
                                </td>
                            </tr>

                    </table>
            </form>

                                    <?php
                                    
                                        if(isset($_POST['submit']))
                                        {
                                            //get all the detail from the form
                                                $id = $_POST['id'];
                                                $title = $_POST['title'];
                                                $description = $_POST['description'];
                                                $price = $_POST['price'];
                                                $current_image = $_POST['current_image'];
                                                $category = $_POST['category'];

                                                $featured = $_POST['featured'];
                                                $active = $_POST['active'];

                                            


                                            //upload image if selected 

                                            //check whether upload button is clicked or not
                                          
                                            if(isset($_FILES['image']['name']))
                                            {
                                                    $image_name = $_FILES['image']['name'];

                                                    if($image_name !="")
                                                    { 
                                                        //image is available
                                                        //reame the image 
                                                        $image_info = explode (".", $image_name);
                                                         $ext = end($image_info);

                                                        //rename the image
                                                        $image_name = "Food_category_".rand(000,999).'.'.$ext;

                                                        $source_path =  $_FILES['image']['tmp_name'];
                                                        $destination_path = "../images/food/".$image_name;

                                                        //Upload the image
                                                        $upload = move_uploaded_file($source_path, $destination_path);
                                                    
                                                        //check whether the image is uploaded or not
                                                        if($upload==false)
                                                        {
                                                            echo $_FILES;
                                                            //set massage 
                                                            $_SESSION['upload'] = "Fail to upload image";
                                                            
                                                            //redirect to manage category page
                                                            header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
                                                            //stop the proces
                                                            die();
                                                        }
                                                            //remove the current image if is available
                                                            if( $current_image!= "")
                                                            {
                                                                    $remove_path = "../images/food/".$current_image; 

                                                                $remove = unlink($remove_path);

                                                                //check whether image is remove or not
                                                                if($remove == false)
                                                                {
                                                                    //failed to romove image
                                                                    $_SESSION['failed-remove'] = "Fail to remove current image";
                                                                    //redirect to manage category page
                                                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
                                                                    //stop the proces
                                                                    die();

                                                                }
                                                            }
                                                    }
                                                else
                                                {
                                                    $image_name = $current_image;    
                                                }
                                            } 
                                            else
                                            {
                                                    $image_name =  $current_image;
                                            }
                                               


                                            //update food in database
                                            $sql3 = "UPDATE  tbl_food SET
                                             title = '$title',
                                             description ='$description',
                                             price = '$price',
                                             image_name = '$image_name',
                                             category_id = '$category',
                                             featured = '$featured',
                                             active = '$active'
                                             WHERE id =$id
                                            ";

                                            //execute the query
                                            $res3 = mysqli_query($link, $sql3);

                                            //checke whether the query is executed or not
                                            if($res3 == true)
                                            {
                                                //query executed and food updated
                                                $_SESSION['update'] = "Food updated successfully";
                                                //redirect to manage-category page
                                                header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
                                            }
                                            else 
                                            {
                                              //Failed to update food 
                                              $_SESSION['update'] = "Fail to updated food";
                                              //redirect to manage-category page
                                              header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-food.php");
                                            }
                                        }
                                    ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>