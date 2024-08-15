<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Food</h1>

                    </br> </br>

                             <?php 
                                    if(isset($_SESSION['upload-food']))
                                    {
                                        echo  $_SESSION['upload-food']; //display a session message if set
                                        unset( $_SESSION['upload-food']); //remove session message
                                    }

                                ?>

             <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>admin/add-food.php" class="btn-primary">Add food</a>

                </br> </br> </br>

                <?php
                
                if(isset($_SESSION['add']))
                {
                     echo  $_SESSION['add']; 
                     unset( $_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                     echo  $_SESSION['delete']; 
                     unset( $_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                     echo  $_SESSION['upload']; 
                     unset( $_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorized']))
                {
                     echo  $_SESSION['unauthorized']; 
                     unset( $_SESSION['unauthorized']);
                }
                
                if(isset($_SESSION['failed-remove']))
                {
                     echo  $_SESSION['failed-remove']; 
                     unset( $_SESSION['failed-remove']);
                }
                
                if(isset($_SESSION['update']))
                {
                     echo  $_SESSION['update']; 
                     unset( $_SESSION['update']);
                }

                if(isset($_SESSION['remove']))
                {
                     echo  $_SESSION['remove']; 
                     unset( $_SESSION['remove']);
                }
                
                ?>

            <table class="tbl_full">

            
                    <tr>

                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                    <?php
                    $sql = "SELECT * FROM tbl_food";

                    //execute query
                    $res = mysqli_query($link, $sql);

                    //count rows to check whether have foof or not
                    $count = mysqli_num_rows($res);

                     //creat serial number variable and assign value as 1
                     $sn=1;

                    if($count>0)
                    {
                        //have food in database
                        while($row= mysqli_fetch_assoc($res))
                        {
                            //get the value from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td>$<?php echo $price;?></td>

                                    <td>
                                         <?php 
                                                //check whether image name is avilable or not
                                                if($image_name!= "")
                                                {
                                                    //display image
                                                    ?>

                                                    <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>images/food/<?php echo $image_name;?>" width="100px" >

                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "Image not added";
                                                }
                                            ?>

                                    </td>

                                    <td><?php echo $featured;?> </td>
                                    <td><?php echo $active;?> </td>
                                    <td>

                                
                                    <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update food</a>                                                             <!--past before <AND image_name=<?php echo $image_name;?> "-->
                                    <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>admin/delete-food.php?id=<?php echo $id;?>& image_name=<?php  echo $image_name; ?>" class="btn-danger">Delete food</a>

                                    </td>
                                </tr>
                            <?php
                            
                        }
                    }
                    else
                    {
                        //food not added to database
                        echo"<tr> <td colspan='7'> Food not added yet </td> </tr>";
                    }
                    ?>
               

                

                </table>

    </div>

</div>

<?php include('partials/footer.php'); ?>