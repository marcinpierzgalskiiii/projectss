<?php include('../partials-front/menu-user.php');?>


      <!--food search starts -->
    <section class="food-search ">
        <div class="container"> 
              
            <form action="">
                <input type="search" name ="search" placeholder="Searcg for food..">
               <input type="submit" name="submit" value="Search"class="btn btn-primary"> 
            </form>
        </div>
    </section> 
     <!--food search ends -->


     <!--categories starts -->
    <section class="categories">
        <div class="container"> 
            <h2 class="text-center"> Categories</h2>

            <?php 
            
            //Dispaly all the cateories that are active

            //sql query
            $sql = "SELECT * FROM tbl_category WHERE active='YES'";

            //execute the query
                $res = mysqli_query($link, $sql);

                //count the rows 
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
                                      echo "Category not found";
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
             echo "Category not found";
            }
            ?>

            

                      <div class="clearfix"></div>
               

        </div>
    </section> 
    <!--categories ends -->

    

    
    <?php include('../partials-front/footer.php');?>