<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update order</h1>
            <br><br>

            <?php 
            
            //check whether id is set or not 
            if(isset($_GET['id']))
            {
                //get the order details
                $id = $_GET['id'];

                //get all other detailsbased on this id

                $sql = "SELECT  * FROM tbl_order WHERE id =$id";

                $res = mysqli_query($link, $sql);

                $count = mysqli_num_rows($res);

                if( $count==1)
                {
                    //detail avilable
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_addres = $row['customer_addres'];
                }
                else
                {
                    //detail not  avilable   
                    
                    //redirect to manage oredr page
                    header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-order.php");
                }
            }
            else 
            {
               //redirect to manage order page 
               header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-order.php");
            }
            ?>

            <form action="" method="POST" >
                <table class="tbl-30">
                    <tr>
                        <td>Food name</td>
                        <td><?php echo $food;?></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>$<?php echo $price;?></td>

                    </tr>

                    <tr>
                            <td>quantity</td>
                            <td>
                                <input type="number" name="quantity" value="<?php echo $quantity;?>">
                            </td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status" >
                                <option <?php if($status=="order") {echo "selected";}?> value="order">order</option>
                                <option <?php if($status=="on delivery") {echo "selected";}?> value="on delivery">on delivery</option>
                                <option <?php if($status=="delivered") {echo "selected";}?> value="delivered">delivered</option>
                                <option <?php if($status=="cancelled") {echo "selected";}?> value="cancelled">cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer name</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer contact</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer email</td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer addres</td>
                        <td>
                            <textarea name="customer_addres"  cols="22" rows="5"><?php echo $customer_addres;?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan=2>
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="price" value="<?php echo $price;?>">
                            <input type="submit" name= "submit" value="Update order" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

                <?php
                
                if(isset($_POST['submit']))
                {
                    //get all the value from form 
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total =  $price * $quantity;

                    $status = $_POST['status'];

                    $customer_name =$_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_addres = $_POST['customer_addres'];

                    //update the value
                    $sql2 = "UPDATE tbl_order SET
                            
                            quantity = '$quantity',
                            total = '$total',
                            
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_addres = '$customer_addres'
                            WHERE id =$id
                        ";

                        $res2= mysqli_query($link, $sql2);
                        //echo $sql2; die();

                        if($res2==true)
                        {
                            //update
                            
                            $_SESSION['update'] = "<center> oreder update successfully</center>";
                         
                            header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-order.php");
                        }
                        else
                        {
                         //fail to supdate
                         $_SESSION['update'] = "<center>Fail to update order</center> ";
                         header("location:http://www.manticore.uni.lodz.pl/~acdc000/admin/manage-order.php");

                        }


                    
                }
                ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>