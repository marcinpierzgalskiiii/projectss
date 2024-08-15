<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Order</h1>

                          

                    

                        </br> </br> </br>

                        <?php

                                if(isset($_SESSION['update']))
                                {
                                    echo  $_SESSION['update']; //display a session message if set
                                    unset( $_SESSION['update']); //remove session message
                                }
                        
                       
                        ?>
                        <br><br>

                    <table class="tbl_full">

                    
                        <tr>

                            <th>SN&nbsp;</th>
                            <th>Food&nbsp;</th>
                            <th>Price&nbsp;&nbsp;</th>
                            <th>Quant</th>
                            <th>Total&nbsp;&nbsp;&nbsp;</th>
                            <th>Order date</th>
                            <th>Status&nbsp;&nbsp; </th>
                            <th> name </th>
                            <th> contact&nbsp;&nbsp; </th>
                            <th> email &nbsp;</th>
                            <th> addres </th>
                            <th>Actions </th>
                        </tr>

                        <?php
                        
                        //get all orders from database
                        $sql = "SELECT * FROM tbl_order ";

                        //execute the query
                        $res = mysqli_query($link, $sql);

                        //counts the rows
                        $count = mysqli_num_rows($res);
                        
                        //create a serial number and set its initial value as 1
                        $sn =1;

                        if($count>0)
                        {
                            //order available
                            while($row= mysqli_fetch_assoc($res))
                            {
                                //get all the order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_addres = $row['customer_addres'];

                                ?>
                                     <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $food;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $quantity;?></td>
                                        <td><?php echo $total;?></td>
                                        <td><?php echo $order_date;?></td>
                                        <td><?php echo $status;?></td>
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_contact;?></td>
                                        <td><?php echo $customer_email;?></td>
                                        <td><?php echo $customer_addres;?></td>
                                        

                                        <td>

                                    
                                        <a href="<?php echo  "http://www.manticore.uni.lodz.pl/~acdc000/";?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update order</a>
                                        

                                        </td>
                                    </tr>
                                <?php

                            }
                        }
                        else
                        {
                            //order not available
                            echo "<tr><td colspan= '12'>order not available</td></tr>";
                        }
                        ?>

                        


                        </table>

    </div>

</div>

<?php include('partials/footer.php'); ?>