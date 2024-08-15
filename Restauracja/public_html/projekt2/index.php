  
  
  <?php 
    ob_start();


    session_start();
         if(file_exists('config/constants.php')) include('config/constants.php');
         else echo "error";
         ini_set( 'display_errors', 'On' );
         error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
    
    
if(file_exists('partials-front/menu.php')) include('partials-front/menu.php');
else echo "error";




?>


      <!--food search starts -->
    <section class="food-search ">
        <div class="container"> 
              
            <form action="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>food-search.php"  method="POST">
                <input type="search" name ="search" placeholder="Searcg for food.." required>
                <input type="submit" name="submit" value="Search"class="btn btn-primary"> 
            </form>
        </div>
    </section> 
     <!--food search ends -->
                  <?php 
                    if(isset($_SESSION['order-food']))
                    {
                        echo  $_SESSION['order-food']; 
                        unset( $_SESSION['order-food']);
                    }
                  ?>

     <!--categories starts -->
    <section class="categories">
        <div class="container"> 
            <h2 class="text-center"> Categories</h2>

            <?php 
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='YES' AND featured='YES'  ";
      
            
            //execute the query
            $res = mysqli_query($link, $sql);

            //count the rows to check whether the category is available or not
            $count = mysqli_num_rows($res);
            

            if( $count > 0 )
            {
              //categoreis avaiable
              while($row = mysqli_fetch_assoc($res))
                {
                  //get the values
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];

                  ?>

                      <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/";?>category-foods.php?category_id=<?php echo $id;?>">

                          <div class="box-3 float-container">

                            <?php 
                                if($image_name=="")
                                {
                                  echo "Image not available";
                                }
                                else 
                                {
                                  //Image available
                                  ?>
                                    <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>images/category/<?php echo $image_name;?>"   class="img-responsive-for-categories"  >
                                  <?php
                                }
                            ?>

                            

                              <h3 class="float-text text-purple"><?php echo $title; ?></h3>
                          </div> 
                      </a> 

                  <?php
                  
                  
                }
            }
            else
            {
             //categories not  avaiable
             echo "Categoreis not added";
            }
            ?>

             
            <div class="clearfix"></div>
        </div>
    </section> 
    <!--categories ends -->

    <!--food menu starts -->
    <section class="food-menu ">
        <div class="container"> 
            <h2 class="text-center"> Foods</h2>

            <?php 
            
            //getting food from database that active and featured

            $sql2 = "SELECT * FROM tbl_food WHERE active='YES' AND featured='YES'";

            //execute the query
            $res2 = mysqli_query($link, $sql2);

            //count the rows 
                 $count2 = mysqli_num_rows($res2);

                 //check whether food available or not
                 if($count2>0)
                 {
                    //food available
                    while($row = mysqli_fetch_assoc($res2))
                    {
                      //get all the values
                             $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $image_name = $row['image_name'];
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


                    }
                 }
                 else
                 {
                  //food not available
                  echo "food not available";
                 }

            ?>

               

                    <div class="clearfix"></div>

                
        </div>
    </section> 
     <!--food menu  ends -->

     <?php include('partials-front/footer.php');?>



    