<?php include('../partials-front/menu.php');?>


      <!--food search starts -->
      <section class="food-search text-center">
        <div class="container">
            
          <?php 
          //get the search keyword
          $search = mysqli_real_escape_string($link, $_POST['search']);
        
          ?>

            <h2><span style="color: white">Foods on Your Search</span> <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
     <!--food search ends -->


   <div class="braek">
    
   </div>

    <!--food menu starts -->
    <section class="food-menu ">
        <div class="container"> 
            <h2 class="text-center"> Foods</h2>

            <?php 
            
            

              //sql query to get food based on search keyword
              $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

              //execute the query
              $res = mysqli_query($link, $sql);

              $count = mysqli_num_rows($res);

              //check whether food available or not 
              if($count>0)
              {
                //food available
                while($row = mysqli_fetch_assoc($res))
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
                        //check whether image name is available or not

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
                              <a  href="order" class="btn btn-primary " ><span style="color:black">Order</span></a >
                          </div>
                            
                    </div>

                  <?php

                }
                   
              } 
              else
              {
                //food  not available
                echo "<center>food not found</center>";
              }
            ?>

                    <div class="clearfix"></div>

                
        </div>
    </section> 
     <!--food menu  ends -->

     <?php include('../partials-front/footer.php');?>