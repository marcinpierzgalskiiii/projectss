<?php include('partials/menu.php'); ?>

          <!--Main  Content Start-->
          <div class="main-content">
                    <div class="wrapper">
                      <h1>Manage </h1>
                          </br> 

                        <?php 
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];    //displaying session message 
                            unset($_SESSION['add']); //removing session message
                        }

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];    //displaying session message 
                            unset($_SESSION['delete']); //removing session message
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];    //displaying session message 
                            unset($_SESSION['update']); //removing session message
                        }

                        if(isset($_SESSION['user-not-found']))
                        {
                            echo $_SESSION['user-not-found'];    //displaying session message 
                            unset($_SESSION['user-not-found']); //removing session message
                        }

                        if(isset($_SESSION['password-not-match']))
                        {
                            echo $_SESSION['password-not-match'];    //displaying session message 
                            unset($_SESSION['password-not-match']); //removing session message
                        }

                        if(isset($_SESSION['change-password']))
                        {
                            echo $_SESSION['change-password'];    //displaying session message 
                            unset($_SESSION['change-password']); //removing session message
                        }






                        ?>
                          </br></br></br>
                      <!--Button to Add admin-->

                      <a href="add-admin.php" class="btn-primary">Add admin</a>

                          </br> </br> </br>

                        <table class="tbl_full">

                        
                              <tr>

                              <th>Serial Number</th>
                              <th>Full Name</th>
                              <th>Usename</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                            //query to get all admin 
                             $sql = "SELECT * FROM `tbl_admin`";
                             //execute the query
                             //echo $link;
                             $result = mysqli_query($link, $sql);
                             //echo mysqli_error($link);
                             
                             //check whether the query is executed or not
                             if($result)
                             {
                              //counts rows to check we have data in database or not
                              $count = mysqli_num_rows($result); //function to get all the rows in database

                              //creat serial number variable and assign value as 1
                                $sn=1;

//echo $count;
                              //check the numbers of rows
                              if($count>0)
                               {
                                //we have data in database
                                while($rows = mysqli_fetch_assoc($result))
                                    {
                                      //to get all data from database


                                      //get individual data
                                      $id = $rows['id'];
                                      $full_name= $rows['full_name'];
                                      $username = $rows['username'];

                                      //display the values in our table 
                                      ?>
                                                <tr>
                                          <td><?php echo $sn++;?></td>
                                          <td><?php echo $full_name; ?></td>
                                          <td><?php echo $username; ?></td>
                                          <td>

                                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update admin</a>
                                        <a href="<?php echo "http://www.manticore.uni.lodz.pl/~acdc000/projekt2/"; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>

                                          </td>
                                        </tr>
                                      <?php
                                    }
                                }
                                  else {
                                  //we do not have data in database
                                  }
                                  mysqli_close($link);

                             }

                             ?>

                          

                          </table>
                   </div>
                 
            </div>
          <!--Main  Content End-->

<?php include('partials/footer.php'); ?>