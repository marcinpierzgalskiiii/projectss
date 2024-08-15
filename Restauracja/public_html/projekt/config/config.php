<?php

    if(file_exists($config_file)){
      if(is_writable($config_file)){
        $step = 1;
        form_install_1();
      } else {
        echo "<p>Zmień uprawnienia do pliku <code>".$config_file."</code><br>np. <code>chmod o+w ".$config_file."</code></p>";
        echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
      }
    }else{
      echo "<p>Stwórz plik <code>".$config_file."</code><br>np. <code>touch ".$config_file."</code></p>";
      echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
    }


?>

<?php


        $file=fopen($config_file,"w");
        $config = "<?php
        \$host=\"".$_POST['host']."\";
        \$user=\"".$_POST['user']."\";
        \$password=\"".$_POST['passwd']."\";
        \$dbname=\"".$_POST['dbname']."\";
        \$prefix=\"".$_POST['prefix']."\";
        \$link = mysqli_connect(\$host, \$user, \$password, \$dbname);\n";
          if (!fwrite($file, $config)) { 
              print "Nie mogę zapisać do pliku ($file)"; 
              exit; 
          } 
          echo "<p>Krok 2 zakończony: \n";
          echo "Plik konfiguracyjny utworzony</p>"; 
            
          fclose($file); 

?>