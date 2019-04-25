<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Nadzorca sianie</title>
    <style>
    .conteiner{
    }
    #drugi{
background-color:grey;
height:50px;
margin-bottom:30px;


    }
    select{

      margin-top:10px;
    }
    .komponenty{
border-bottom:2px solid grey;

    }
    table{

      margin:20px;
      margin-left:auto;
      margin-right:auto;
    }
    h2{
      margin:10px;
    }
    td{

      padding:7px;
    }
    </style>
  </head>
  <body>
    <?php
    require("./tajne.php");
    if(isset($_POST['ros'])){ 
      $sql="select count(nazwa_r) from rosliny where nazwa_r='".$_POST["nazwa_r"]."'";
      $result = $conn->query($sql);
      $row = $result->fetch_array();
        //echo $row[0];
        if($row[0]>0)
          {echo "<h2 class='text-center' style='color:red'>Wpis istnieje</h2>";}

else{

      $sql="insert into rosliny values('','".$_POST["nazwa_r"]."')";

      
       $result = $conn->query($sql);
       if ($result) {
        echo "<h2 class='text-center' style='color:red'>Dodano roślinę!</h2>";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
     } 

     if(isset($_POST['nawozz'])){ 
       //echo $_POST["nazwa_n"];
      $sql="select count(nazwa) from nawozy where nazwa='".$_POST['nazwa_n']."'";
      $result = $conn->query($sql);
      $row = $result->fetch_array();
        //echo $row[0];
        if($row[0]>0)
          {echo "<h2 class='text-center' style='color:red'>Wpis istnieje</h2>";}
else{
      $sql="insert into nawozy values('','".$_POST["nazwa_n"]."')";

       $result = $conn->query($sql);
       if ($result) {
        echo "<h2 class='text-center' style='color:red'>Dodano nawóz!</h2>";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
     } 
    
     if(isset($_POST['dodaj_sianie'])){ 
      
    //echo $selectedOption."\n";
 //echo $_POST['ck'];
 $sql = "INSERT INTO sianie_rejestr values('',".$_POST['pod'].",".$_POST['roslina'].",".$_POST['ck'].",'".$_POST['opis']."')";
 $result = $conn->query($sql);
 $idsr = $conn->insert_id;
 foreach ($_POST['nawoz'] as $Naw){
  $sql2 = "INSERT INTO nawozy_rejestr values('',".$idsr.",".$Naw.")";
  $conn->query($sql2);
  //echo $sql2;
 }
 //echo $idsr;
 if ($result) {
  echo "<h2 class='text-center' style='color:red'>Posiano rosline!</h2>";
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
} 


 //$sql2 = "INSERT INTO nawozy_rejestr values('',".$_POST['pod'].",".$_POST['roslina'].",".$_POST['ck'].",'".$_POST['opis']."')";
    ?>
              <div  class="conteiner-fluid col-12" id="drugi">
                        <h2 class="text-center">PANEL NADZORCY</h2>
                      
    </div>     
    <div class="container">
        <div class="row" id="panel-ch">
        <div id="ppow" class="col-12 komponenty">
        <h2 class="text-center">Dodawanie rosliny</h2>
        </h2>

        <form action="nadzorca_sia.php" method="POST">
        <table border="2">
        <tr><td>Nazwa rosliny</td><td>Zatwierdź</td></tr>
<tr>

                              
  <td><input type="textarea" name="nazwa_r"></td>
  <td><input type="submit" name="ros" value="dodaj rosline"></td></tr>
</table> 
</form>
             
        </div>
        <div id="nawoz" class="col-12 komponenty">
        <h2 class="text-center">Dodawanie nawozu</h2>
        </h2>

        <form action="nadzorca_sia.php" method="POST">
        <table border="2">
        <tr><td>Nazwa nawozu</td><td>Zatwierdź</td></tr>
<tr>

                  
                              
                              
  <td><input type="text" name="nazwa_n"></td>
  <td><input type="submit" name="nawozz" value="Dodaj nawóz"></td></tr>
</table> 
</form>
        </div>
        <div id="nawozenie" class="col-12 komponenty">
        <h2 class="text-center">Zasiej roślnę na podpowierzchni</h2>
        </h2>
        <h3>Wybierz podpowierzchnię i cykl</h3>
      <form action="nadzorca_sia.php" method="POST">
      <select name="cykl">
          <?php      
                              $sql = "SELECT * FROM cykle";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idc'].">".$row["idc"].".".$row['opis'] . "</option>";
                                
                              }
                              ?>
        </select>
        <input type="submit" value="Zatwierdź wybór" name="wyb_cyklu">

</form>
 <?php
 global $c;
    if(isset($_POST['wyb_cyklu'])){ 
echo "<form action='nadzorca_sia.php' method='POST'>

<select name='pod'>";
  
                      $sql  = "SELECT podpowierzchnie.idpp, nazwa FROM podpowierzchnie where idpp NOT IN (SELECT idpp from sianie_rejestr  where idc =".$_POST['cykl']. ")";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()){
                      echo "<option value=".$row['idpp'].">".$row["idpp"].".".$row['nazwa'] . "</option>";
                        
                      }
                      
echo "</select><input type='submit' value='Zatwierdź wybór' name='wyb_pp'>

<input name='ck' value='".$_POST['cykl']."'type='hidden'>

<input name='napp' value='".$_POST['nazwa']."'type='hidden'>
</form>";


                    }
    if(isset($_POST['wyb_pp'])){ 
      
     echo "<div id='form_2'><form method='POST' action=''><table border='2'>
     <tr><td>Podpowierzchnia</td><td>Roslina</td><td>Nawóz</td><td>Cykl</td><td>Opis</td></td><td>Dodaj wynik</td></tr>
     <tr><td>".$_POST['pod'].".".$_POST['napp']."<td><select name='roslina'>";
     $sql = "SELECT * FROM rosliny";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idr'].">".$row["idr"].".".$row['nazwa_r'] . "</option>";
                                
                              }
     
     
     
     echo"</select></td>
     <td><select name='nawoz[]' multiple='multiple' size='2'>";
     $sql = "SELECT * FROM nawozy";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idn'].">".$row["idn"].".".$row['nazwa'] . "</option>";
                              }
     echo "</select></td>
     <td>".$_POST['ck'];
     /*<select name='cykl'>";
     $sql = "SELECT * FROM cykle";
     $result = $conn->query($sql);
     while ($row = $result->fetch_assoc()){
     echo "<option value=".$row['idc'].">".$row["idc"].".".$row['opis'] . "</option>"; 
     }
     echo "</select>";*/
     echo "</td><td><input type='text' name='opis'></td>
     <td><input type='submit' name='dodaj_sianie'></td></tr>
     
     
     
     </table>
     <input name='ck' value='".$_POST['ck']."'type='hidden'>
     <input name='pod' value='".$_POST['pod']."'type='hidden'>
              </form>  </div> ";
                   }
    ?>
             
        </div>
        
    </div>



  </div>
<script>
//document.getElementById("podpow").addEventListener;

</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>