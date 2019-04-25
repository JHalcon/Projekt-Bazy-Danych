<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">

  <title></title>
  <style>
    td {padding:4px;}
    #drugi{

      background-color:grey;
     
    }
    h3{
      margin-bottom:10px;
    }
    select{

      margin-bottom:12px;
    }
  </style>
</head>

<body>
<?php
    require("./tajne.php");
    if(isset($_POST['wynik'])){ 
      $sql="insert into wyniki values('',".$_POST['idsr'].",".$_POST['wzr'].",'".$_POST['date']."','".$_POST['uwagi']."',".$_POST['idlab'].")";

      // echo $sql;
       $result = $conn->query($sql);
       if ($result) {
        echo "<h2 class='text-center' style='color:red'>Dodano wynik!</h2>";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
       
        
        }
      }
    ?>
    <div class="container-fluid" id="drugi">
        <h2 class="text-center" >PANEL LABORANTA</h2>
        <hr>
      </div>
  <div class="container">
    <div class="row" id="panel-ch">
      
     
    <div id="ppow" class="container col-12">
      <h2 class="text-center">Dodawanie wyniku</h2>
      </h2>
      <h3>Wybierz konkretny siew</h3>
      <form action="laborant.php" method="POST">
        <select name='sianie_rej'>
          <?php      
                              
                              $sql = "SELECT * FROM sianie_rejestr";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idsr'].">".$row["idsr"].".".$row['opis'] . "</option>";
                                
                              }
                              ?>
        </select>
        <input type="submit" value="Zatwierdź wybór" name="wyb_siania">
      </form>
      <?php
      global $idsr;
    echo "Laborant odpowiedzialny za zbieranie wyników: ";
   
   
    if(isset($_POST['wyb_siania'])){ 
      $sql = "SELECT sianie_rejestr.idsr, sianie_rejestr.opis, podpowierzchnie.nazwa,rosliny.nazwa_r, cykle.idc FROM sianie_rejestr INNER JOIN podpowierzchnie ON 
      sianie_rejestr.idpp = podpowierzchnie.idpp INNER JOIN rosliny ON sianie_rejestr.idr = rosliny.idr INNER JOIN cykle ON sianie_rejestr.idc = cykle.idc where sianie_rejestr.idsr = ".$_POST['sianie_rej'] ;
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $sql2 = "SELECT laboranci_rejestr.idlab from laboranci_rejestr JOIN powierzchnie ON laboranci_rejestr.idpow = powierzchnie.idpow JOIN podpowierzchnie ON podpowierzchnie.idpow = powierzchnie.idpow WHERE podpowierzchnie.nazwa LIKE '".$row['nazwa']."'";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc();
      echo $row2['idlab'];
     echo "<div id='form_2'><form method='POST' action=''><table border='2'><tr><td>Siew</td><td>Podpowierzchnia</td><td>Roslina</td><td>Cykl</td><td>Wynik pomiaru</td><td>data</td></td><td>Uwagi</td><td>Dodaj wynik</td></tr>
     <tr><td>".$row['idsr'].".".$row['opis']."</td><td>".$row['nazwa']."</td><td>".$row['nazwa_r']."<td>".$row['idc']."</td><td><input type='number' name='wzr'></td>
     <td><input type='date' name='date'></td><td><input type='text' name='uwagi'></td><td><input type='submit' name='wynik'></td></tr>
     
     
     
     </table>
     <input name='idsr' value='".$row['idsr']."'type='hidden'>
     <input name='idlab' value='".$row2['idlab']."'type='hidden'>
              </form>  </div>";
                          
                          //$idsr = $row['idsr'];
                         // echo $idsr;
                          
                           }
                           //global $idsr;
                           
                          
    
    

    ?>
    </div>
  </div>
  </div>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>
</body>

</html>