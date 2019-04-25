<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Nadzorca wyniki</title>
    <style>
    .conteiner{
    }
    #drugi{
background-color:grey;
height:50px;
margin-bottom:30px;


    }
    .komponenty{
border-bottom:2px solid grey;

    }
    table{

      margin:20px;
      margin-left:auto;
      margin-right:auto;
    }
    #l{

      margin-bottom:20px;
    }
    select{

      margin-bottom:40px;
    }
    h3{
      margin-bottom:40px; 
    }
    td{
      padding:7px;
    }
    </style>
  </head>
  <body>
    <?php
    require("./tajne.php");
    
    ?>
              <div  class="conteiner-fluid col-12" id="drugi">
                        <h2 class="text-center">PANEL NADZORCY</h2>
                      
    </div>     
    <div class="container">
        <div class="row" id="panel-ch">
      



        <div id="ppow" class="col-12 komponenty">
        <h2 class="text-center">Sprawdź wyniki</h2>
        </h2>

        <form action="nadzorca_wyniki.php" method="POST">
        <select name="wy">
        <option value='1'>1.Pokaż wyniki z całego cyklu</option>
        <option value='2'>2.Pokaż wyniki z danego siewu</option>

        </select>
        <input type="submit" value="Zatwierdź wybór" name="wyb_wyniku">


        </form>
     <?php
if(isset($_POST['wyb_wyniku'])){ 
 $pom = $_POST['wy'];
if($pom==1){
  echo "<h3>Wybierz cykl</h3>
  <form action='nadzorca_wyniki.php' method='POST'>
  <select name='cykl'>";
                          $sql = "SELECT * FROM cykle";
                          $result = $conn->query($sql);
                          while ($row = $result->fetch_assoc()){
                          echo "<option value=".$row['idc'].">".$row["idc"].".".$row['opis'] . "</option>";
                            
                          }
                    
   echo "</select>
    <input type='submit' value='Zatwierdź wybór' name='wycyklu'>

</form>";



                        }
                          else {
                            if($pom==2){
                              echo "<h3>Wybierz siew</h3>
                              <form action='nadzorca_wyniki.php' method='POST'>
                              <select name='siew'>";
                                                      $sql = "SELECT * FROM sianie_rejestr";
                                                      $result = $conn->query($sql);
                                                      while ($row = $result->fetch_assoc()){
                                                      echo "<option value=".$row['idsr'].">".$row["idsr"].".".$row['opis'] . "</option>";
                                                        
                                                      }
                                                
                               echo "</select>
                                <input type='submit' value='Zatwierdź wybór' name='wysiania'>
                            
                            </form>";
                            
                            
                            
                                                    }


                          }
                        }
                        
/*
$sql = "SELECT * from wyniki join sianie_rejestr on wyniki.idsr = sienie_rejestr.idsr where sienie_rejestr.idc = ".$_POST['cykl'];
$result = $conn->query($sql);
echo $sql;
echo "<table border='2'>";
while ($row = $result->fetch_assoc()){
  echo "<tr><td>".$row['idw']."</td><td>".$row["opis"]."</td><td>".$row['idsr']."</td></tr>";
    
  }
  echo "</table>";*/
  if(isset($_POST['wycyklu'])){
    echo "<h3 class='text-center'>Wyniki z cyklu ".$_POST['cykl']."</h3>";
  
$sql = "SELECT wyniki.idw, sianie_rejestr.opis, sianie_rejestr.idsr, podpowierzchnie.nazwa, rosliny.nazwa_r, wyniki.wzrost, wyniki.uwagi, wyniki.idlab from wyniki join sianie_rejestr on wyniki.idsr = sianie_rejestr.idsr join podpowierzchnie on sianie_rejestr.idpp = podpowierzchnie.idpp
join rosliny on sianie_rejestr.idr = rosliny.idr where  sianie_rejestr.idc = ".$_POST['cykl'];

$result = $conn->query($sql);
//echo $sql;
echo "<table border='2'>";
echo "<tr><td>ID wyniku</td><td>Nazwa i numer siewu</td><td>Podpowierzchnia</td><td>Roślina</td><td>Wynik</td><td>Uwagi</td><td>ID laboranta</td></tr>";
while ($row = $result->fetch_assoc()){
  echo "<tr><td>".$row['idw']."</td><td>".$row['idsr'].".".$row["opis"]."</td><td>".$row['nazwa']."</td><td>".$row['nazwa_r']."</td><td>".$row['wzrost']."</td><td>".$row['uwagi']."</td><td>".$row['idlab']."</td></tr>";
    
  }
  echo "</table>";
  }
       

  if(isset($_POST['wysiania'])){
    echo "<h3 class='text-center'>Wyniki z siania ".$_POST['siew']."</h3>";
    $sql = "SELECT wyniki.idw, sianie_rejestr.opis, sianie_rejestr.idsr, podpowierzchnie.nazwa, rosliny.nazwa_r, wyniki.wzrost, wyniki.uwagi, wyniki.idlab from wyniki join sianie_rejestr on wyniki.idsr = sianie_rejestr.idsr join podpowierzchnie on sianie_rejestr.idpp = podpowierzchnie.idpp
    join rosliny on sianie_rejestr.idr = rosliny.idr where sianie_rejestr.idsr = ".$_POST['siew'];
$result = $conn->query($sql);
//echo $sql;
echo "<table border='2'>";
echo "<tr><td>ID wyniku</td><td>Nazwa i numer siewu</td><td>Podpowierzchnia</td><td>Roślina</td><td>Wynik</td><td>Uwagi</td><td>ID laboranta</td></tr>";
while ($row = $result->fetch_assoc()){
  echo "<tr><td>".$row['idw']."</td><td>".$row['idsr'].".".$row["opis"]."</td><td>".$row['nazwa']."</td><td>".$row['nazwa_r']."</td><td>".$row['wzrost']."</td><td>".$row['uwagi']."</td><td>".$row['idlab']."</td></tr>";
  echo "</table>";
  }
}

?>
          
      
                           
        </div>
        
    </div>



  </div>
<script>

</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>