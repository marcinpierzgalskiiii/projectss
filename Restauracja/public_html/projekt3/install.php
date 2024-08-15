<?php
if(file_exists('config/constants.php')) include('config/constants.php');
else echo "error";
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);


?>

<?php
//1. Krok 0


    $config_file = "config/constants.php";
 

    if(file_exists($config_file))
    {
        if(is_writable($config_file))
        {
          $step = 1;
          //form_install_1();
            
          
        }
         else 
        {
          echo "<p>Zmień uprawnienia do pliku <code>".$config_file."</code><br>np. <code>chmod o+w ".$config_file."</code></p>";
          echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
        }
    }
    else
    {
      echo "<p>Stwórz plik <code>".$config_file."</code><br>np. <code>touch ".$config_file."</code></p>";
      echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
    }


      ?>



 <!--2. Krok 1-->
 <form action="" method="POST" class="instaler">



      <fieldset>
          <legend>Instalator</legend>
          <div class="instaler-label">Nazwa lub adres serwera Host</div>
          <input type="text" name="host"  placeholder="localhost" class="input-responsive" required>

          <div class="instaler-label">Nazwa uzytkownika</div>
          <input type="text" name="user"  class="input-responsive" required>

          <div class="instaler-label">Hasło</div>
          <input type="password" name="password"  class="input-responsive" required>

          <div class="instaler-label">Nazwa bazy danych</div>
          <input type="text" name="dbname"  class="input-responsive" required>
          

          <input type="submit" name="Krok2" value="Krok 2" class="btn btn-order">
      </fieldset>

</form>

      <?php

if(isset($_POST['Krok2']))
{
      //3. Krok 2
      //wstawiłem swoje dane bo uzupełniał pustymi. 
            $file=fopen($config_file,"w");
            $config = "<?php
            \$host=\"".$_POST['host']."\";
            \$user=\"".$_POST['user']."\";
            \$password=\"".$_POST['password']."\";
            \$dbname=\"".$_POST['dbname']."\";
            
            \$link = mysqli_connect(\$host, \$user, \$password, \$dbname); 
       ?>\n";
     

           
           
              if (!fwrite($file, $config))
              { 
                  print "Nie mogę zapisać do pliku ($file)"; 
                  exit; 
              } 
            
            
                echo "<p>Krok 2 zakończony: \n";
                echo "Plik konfiguracyjny utworzony</p>"; 
                
                fclose($file); 
            
               
}   



            //4. Krok 3
            if (file_exists("sql/sql.php"))
            {
                  include("sql/sql.php");
                  echo "Tworzę tabele bazy: ".$dbname.".<br>\n";
                  mysqli_select_db($link, $dbname) or die(mysqli_error($link));
                 
                  for($i=0;$i<count($create);$i++)
                  {
                          echo "<p>".$i.". <code>".$create[$i]."</code></p>\n";
                          mysqli_query($link, $create[$i]);
                  }  
            }



                              //5. Krok 4
              if (file_exists("sql/insert.php")) 
              {
                include("sql/insert.php");
                echo "<p>Wstawiam dane do tabel bazy: ".$dbname.".</p>\n";
                mysqli_select_db($link, $dbname) or die(mysqli_error($link));
               
                for($i=0;$i<count($insert);$i++)
                {
                  echo "<p>".$i.". <code>".$insert[$i]."</code></p>\n";
                  mysqli_query($link, $insert[$i]);
                }
              }



        ?>

        <!--6. Krok 5-->
        <form action="" method="POST" class="instaler">



        <fieldset>
            <legend>Konto administratora</legend>

            <div class="instaler-label">Full name</div>
            <input type="text" name="full_name"  class="input-responsive" required>
            <div class="instaler-label">Login Administratora</div>

            <input type="text" name="username"  class="input-responsive" required>

            <div class="instaler-label">Haslo Administratora</div>
            <input type="password" name="passwordadmin"  class="input-responsive" required>

            

            
            

            <input type="submit" name="Krok6" value="Krok 6" class="btn btn-order">
        </fieldset>

        </form>

        <?php

                    
                    $full_name= $_POST['full_name'];
                    $usernameadmin= $_POST['username'];
                    $passwordadmin= $_POST['passwordadmin'];

                    $insertadmin[] =  "INSERT INTO tbl_admin(full_name, username, password)  VALUES ('$full_name','$usernameadmin','$passwordadmin');";
                          
                   

                        mysqli_select_db($link, $dbname) or die(mysqli_error($link));
                        for($j=0;$j<count($insertadmin);$j++)
                        {
                          echo "<p>".$j.". <code>".$insertadmin[$j]."</code></p>\n";
                          mysqli_query($link, $insertadmin[$j]);   
                        }
                         
                    
                    
                  ?>
                  <h3>Instalacja zakończona</h3>
                  <?php
          


          //9. Kontroler
          switch($step)
          {

              case 2:
              step2();
              break;

              case 3:
              step3();
              break;

              case 4:
              step4();
              break;

              case 5:
              step5();
              break;

              case 6:
              step6();
              break;

              case 7:
              step7();
              break;

              case 8:
              step8();
              break;

              case 9:
              step9();
              break;

              default:
              if(file_exists($config_file))
              {
                      if(is_writable($config_file))
                      {
                              $step = 1;
                              //form_install_1();
                      } else 
                      {
                          echo "<p>Zmień uprawnienia do pliku <code>".$config_file."</code><br>np. <code>chmod o+w ".$config_file."</code></p>";
                          echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
                      }
              }else
                  {
                      echo "<p>Stwórz plik <code>".$config_file."</code><br>np. <code>touch ".$config_file."</code></p>";
                      echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
                  }

              break;
          }
          ?>

          <?php
          if($dev == 1)
          {
            ini_set( 'display_errors', 'On' );
            error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
          }

      ?>




        











