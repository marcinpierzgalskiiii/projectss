<?php include('partials-front/menu.php');?>


<?php
//check whether the id is passed or not
if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];

    //get the category title based on category id
    $sql= "SELECT title FROM tbl_category WHERE id =$category_id";

    //execute the query
    $res = mysqli_query($link, $sql);


    //get the value from database
    $row = mysqli_fetch_assoc($res);

    //get the title
    $category_title = $row['title'];


}
else
{
 //category not passed 
 //redirect to home page  
 header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"); 
 
}


?>


   <!-- fOOD search  Start -->
   <section class="food-search text-center">
        <div class="container">
            
            <h2><span style="color: white">Foods on</span> <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD search  end -->


    <!--categories ends -->

      <!--food menu starts -->
      <section class="food-menu ">
        <div class="container"> 
            <h2 class="text-center"> Foods</h2>

            <?php 
            // sql query to get foods based on selected category 
            $sql3 = "SELECT * FROM tbl_food WHERE category_id = $category_id ";

            //executed the query
            $res3 = mysqli_query($link, $sql3);

            $count3 = mysqli_num_rows($res3);

            //check whether food is available or not
            if($count3>0)
            {
              //food is available
              while($row3 = mysqli_fetch_assoc($res3))
              {
                $id = $row3['id'];
                $title = $row3['title'];
                $price = $row3['price'];
                $description = $row3['description'];
                $image_name = $row3['image_name'];
                ?>

                <?php

              }

            }
            else
            {
              //food is not available
              echo "food is not available";
            }


            ?>
                                      <div class="food-menu-box">
                                      <div class="food-menu-img">
                                    <?php 
                                    
                                    //check whether the image is available or not
                                        if($image_name=="")
                                        {
                                          //image not available
                                          echo"image not available";
                                        }
                                        else
                                        {
                                           //image available
                                           ?>
                                              <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                           <?php
                                        }
                                    ?>
                                      
                                  </div>
                                      <div class="food-menu-description">
                                          <h4><?php echo $title;?></h4>
                                      
                                            <p class="food-price">$<?php echo $price;?></p>
                                            <p class="food-detail">
                                                <?php echo  $description; ?>
                                            </p>
                                          </br>
                                            <a  href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary " ><span style="color:black">Order</span></a >
                                        </div>
                                        
                                </div>
            <?php 
            
            
            ?>

               

                    <div class="clearfix"></div>

                
        </div>
    </section> 
     <!--food menu  ends -->

    

    
    <?php include('partials-front/footer.php');?>