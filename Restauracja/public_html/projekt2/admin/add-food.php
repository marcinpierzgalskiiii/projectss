<?php include('partials/menu.php'); ?>

<div class="main-conatin">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>

                                 <?php 
                                    if(isset($_SESSION['upload-food']))
                                    {
                                        echo  $_SESSION['upload-food']; //display a session message if set
                                        unset( $_SESSION['upload-food']); //remove session message
                                    }

                                    if(isset($_SESSION['add']))
                                    {
                                        echo  $_SESSION['add']; 
                                        unset( $_SESSION['add']);
                                    }

                                ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the food">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description"  cols="22" rows="5" placeholder="Description of the food"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select image:</td>
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
                                        //get the detail of category
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                            <option value="<?php echo $id;?>"><?php echo $title;?></option>

                                        <?php
                                    }
                                }
                                else 
                                {
                                 //don't have category
                                 ?>
                                    <option value="0">No category found</option>
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
                            <input type="radio" name="featured" value="YES">YES
                            <input type="radio" name="featured" value="NO">NO
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
                            <input type="submit" name="submit" value="Add food" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>


                        <?php
                            
                            //check whether the button is clicked or not
                            if(isset($_POST['submit']))
                            {
                                //add the food in database

                                    //get the data from form 
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];
                                    $price = $_POST['price'];
                                    $category = $_POST['category'];

                                    //check whether radio button for featured and active are checked or not
                                    if(isset($_POST['featured']))
                                    {
                                        $featured = $_POST['featured'];
                                    }
                                    else
                                    {
                                        //setting default value
                                     $featured = "NO";    
                                    }

                                    if(isset($_POST['active']))
                                    {
                                        $active = $_POST['active'];
                                    }
                                    else
                                    {
                                        //setting default value
                                     $active = "NO";    
                                    }

                                    //upload  the image if selected

                                    
                                    //checke ehether selected image is clicked or not
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
                                                    $destination_path = "../images/food/".$image_name;
                                                //upload  food image
                                                $upload = move_uploaded_file($source_path, $destination_path);

                                                //check whether image upload or not
                                                if($upload==false)
                                                {
                                                    //Failed to upload the image

                                                    
                                                    $_SESSION['upload-food'] = "Fail to upload image";
                                                    //redirect to add food page
                                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/add-food.php");

                                                    //stop proces
                                                    die();
                                    
                                                }
                                        }


                                    }
                                            else 
                                            {
                                                //settinf default value as blank
                                            $image_name = "";   
                                            }

                                            //insert into database
                                            $sql2 = "INSERT INTO  tbl_food SET
                                            title = '$title',
                                            description =  '$description',
                                            price = '$price',
                                            image_name = '$image_name',
                                            category_id = '$category',
                                            featured = '$featured',
                                            active = '$active'

                                            ";

                                            //execute the query
                                            $res2 = mysqli_query($link, $sql2);
                                           // echo $sql2; die();

                                            //check whether data inserted or not
                                            if($res2 == true)
                                            {
                                                //data inserted successfully
                                                $_SESSION['add'] = "Food added successfully";
                                                //redirect to manage food page
                                                header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-food.php");
                                            }
                                            else
                                            {
                                            //failed to inserd data 

                                                 $_SESSION['add'] = "Fail to add food";
                                                
                                                 header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/admin/manage-food.php");   
                                            }

                                            
                               
                            }

                            

                        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>