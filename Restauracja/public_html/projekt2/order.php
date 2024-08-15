
      <?php include('partials-front/menu.php');?>


        <?php 
        
        //check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //get the food id and details of the selected food
            $food_id = $_GET['food_id'];
            
            //get the detail of the selected food
            $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

            //execute the query
            $res = mysqli_query($link, $sql);

            //count the rows
            $count = mysqli_num_rows($res);

            //check whether data is available or not
            if( $count==1)
            {
                //have data
                //get data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
             // food not available
             //redirect to home page
             header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"); 
            }

        }
        else 
        {
         //redirect to home page   
         header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"); 
        }

        ?>

    <!-- fOOD search -->
    <section  class="background-for-order">
     
        
        <div class="container">
            
            <h2 class="text-center text-white"> Form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    

                    <div class="food-menu-img">
                        <?php 
                        
                        //check whether the image is available or not
                        if( $image_name=="")
                        {
                            //image not available
                            echo "image not available";
                        }
                        else
                        {
                            //image is available
                            ?>
                                <img src="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php
                        }

                        ?>
                       
                    </div>
    
                    <div class="food-menu-description">
                        <h3><?php echo $title;?></h3>

                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price;?></p>
                        <input type="hidden" name ="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder=" Name and Surename" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder=" 984322091" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder=" foodgmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder=" Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-order">
                </fieldset>

            </form>

            <?php
            
                    //cheecked whether the submit button is clicked or not 
                    if(isset($_POST['submit']))
                    {
                        //get all the detail from form 

                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $quantity = $_POST['quantity']; 
                        
                        $total =  $price * $quantity;
                                
                      
                        
                        //order date
                        $order_date = date("Y-m-d H:i:s");

                        $status = "order"; //order, on delivery, delivered, cancelled

                        $customer_name =$_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_addres = $_POST['address'];


                        //save the order in database
                        //create sql to save the data

                        $sql2 = "INSERT INTO tbl_order SET
                            food = '$food',
                            price = '$price',
                            quantity = '$quantity',
                            total = '$total',
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_addres = '$customer_addres'
                        ";
                        //echo $sql2; die();

                            //execute the query
                            $res2= mysqli_query($link, $sql2);

                            //check whether query executed successfully or not
                                if($res2==true)
                                {
                                    //query executed and order saved
                                    
                                    $_SESSION['order-food'] = "<center>Food oreded successfully</center>";
                                 
                                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/");
                                }
                                else
                                {
                                 //fail to save order
                                 $_SESSION['order-food'] = "<center>Fail to order food</center> ";
                                 header("location:http://www.manticore.uni.lodz.pl/~acdc000/projekt2/");

                                }
                       
                    }
            ?>

        </div>
    </section>
    <!-- fOOD sarch Ends  -->

    <?php include('partials-front/footer.php');?>