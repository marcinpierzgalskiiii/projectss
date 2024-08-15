<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1>

                    </br> </br>

                                <?php 
                                    if(isset($_SESSION['add']))
                                    {
                                        echo  $_SESSION['add']; //display a session message if set
                                        unset( $_SESSION['add']); //remove session message
                                    }

                                    if(isset($_SESSION['remove']))
                                    {
                                        echo  $_SESSION['remove']; //display a session message if set
                                        unset( $_SESSION['remove']); //remove session message
                                    }
                                    
                                    
                                    if(isset($_SESSION['delete']))
                                    {
                                        echo  $_SESSION['delete']; //display a session message if set
                                        unset( $_SESSION['delete']); //remove session message
                                    }
                                   
                                    if(isset($_SESSION['no-category-found']))
                                    {
                                        echo  $_SESSION['no-category-found']; //display a session message if set
                                        unset( $_SESSION['no-category-founde']); //remove session message
                                    }
                                    
                                    if(isset($_SESSION['update']))
                                    {
                                        echo  $_SESSION['update']; //display a session message if set
                                        unset( $_SESSION['update']); //remove session message
                                    }
                                   

                                    if(isset($_SESSION['upload']))
                                    {
                                        echo  $_SESSION['upload']; //display a session message if set
                                        unset( $_SESSION['upload']); //remove session message
                                    }
                                    
                                    
                                    if(isset($_SESSION['failed-remove']))
                                    {
                                        echo  $_SESSION['failed-remove']; //display a session message if set
                                        unset( $_SESSION['failed-remove']); //remove session message
                                    }

                                    
                                  ?>
                                  <br><br>

                    <!--Button to Add admin-->

                <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/";?>admin/add-category.php" class="btn-primary">Add category</a>

                </br> </br> </br>

            <table class="tbl_full">

            
                    <tr>

                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                //query to get all categories from database
                    $sql= "SELECT * FROM tbl_category";

                    //execute query
                    $res = mysqli_query($link, $sql);

                    //counts rows
                    $count = mysqli_num_rows($res);

                    //creat serial number variable and assign value as 1
                    $sn=1;

                    //chcek whehter we have data in database or not
                    if($count>0)
                    {
                        //have data in database
                        //get the data and display
                        while($row= mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                                <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php 
                                                //check whether image name is avilable or not
                                                if($image_name!= "")
                                                {
                                                    //display image
                                                    ?>

                                                    <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/";?>images/category/<?php echo $image_name;?>" width="100px" >

                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "Image not added";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                        
                                            <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/"; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/"; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                        
                                        </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                    //don"t have data 
                        ?>
                                <tr>
                                    <td colspan="6" >No category added</td>
                                </tr>
                        <?php

                    }
                
                ?>

                

                

                </table>

                </div>

            </div>

<?php include('partials/footer.php'); ?>