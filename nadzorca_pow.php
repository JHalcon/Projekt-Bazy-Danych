<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Hello, world!</title>
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
    </style>
  </head>
  <body>
    <?php
    require("./tajne.php");
    if(isset($_POST['podpow'])){ 


      $sql="select count(nazwa) from podpowierzchnie where nazwa='".$_POST["nazwa_pp"]."' AND podpowierzchnie.idpow = ".$_POST['powierzchnia'];
      $result = $conn->query($sql);
      $row = $result->fetch_array();
        //echo $row[0];
        if($row[0]>0)
          {echo "<h2 class='text-center' style='color:red'>Wpis istnieje!</h2>";}
else{
      $sql2="insert into podpowierzchnie values('','".$_POST["nazwa_pp"]."',".$_POST["powierzchnia"].",".$_POST["rozmiar_pp"].")";

       //echo $sql;
       $result = $conn->query($sql2);
       if ($result) {
        echo "<h2 class='text-center' style='color:red'>Dodano podpowierzchnię!</h2>";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
     } 

     if(isset($_POST['pow'])){ 
      $sql="select count(nazwa) from powierzchnie where nazwa='".$_POST["nazwa_p"]."'";
      $result = $conn->query($sql);
      $row = $result->fetch_array();
        //echo $row[0];
        if($row[0]>0)
          {echo "<h2 class='text-center' style='color:red'>Wpis istnieje</h2>";}

       else{
      $sql="insert into powierzchnie values('','".$_POST["nazwa_p"]."',".$_POST["rozmiar_p"].")";
       //echo $sql;
       $result = $conn->query($sql);
       if ($result) {
        echo "<h2 class='text-center' style='color:red'>Dodano powierzchnię!</h2>";
        //$sql2="insert into laboranci_rejestr values('','".$_POST["laborant"]."',".$_POST["rozmiar_p"].")";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
     }
    } 



    ?>
              <div  class="conteiner-fluid col-12" id="drugi">
                        <h2 class="text-center">PANEL NADZORCY</h2>
                      
    </div>     
    <div class="container">
        <div class="row" id="panel-ch">
        <div id="ppow" class="col-12 komponenty">
        <h2 class="text-center">Dodawanie powierzchni</h2>
        </h2>

        <form action="nadzorca_pow.php" method="POST">
        <table border="2">
        <tr><td>Nazwa powierzchni</td><td>rozmiar w m^2</td><td>Zatwierdź</td></tr>
<tr>

                              
  <td><input type="text" name="nazwa_p"></td>
  
  
  <td><input type="numer" name="rozmiar_p"></td>
  <td><input type="submit" name="pow" value="dodaj powierzchnie"></td></tr>
</table> 
Wybierz laboranta dla powierzchni: 
<select name="laborant" id="l"><?php 
                              
                              $sql = "SELECT idlab, imie FROM laboranci";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idlab'].">".$row["idlab"].".".$row['imie'] . "</option>";
                                
                              }
                             
                              ?>
                              
                            </select>
</form>
     
          
      
                           
        </div>




        <div id="ppow" class="col-12 komponenty">
        <h2 class="text-center">Dodawanie podpowierzchni</h2>
        </h2>

        <form action="nadzorca_pow.php" method="POST">
        <table border="2">
        <tr><td>Powierzchnia</td><td>Nazwa podpowierzchni</td><td>rozmiar w m^2</td><td>Zatwierdź</td></tr>
<tr><td><select name="powierzchnia"><?php 
                              require("./tajne.php");
                              $sql = "SELECT idpow, nazwa FROM powierzchnie";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()){
                              echo "<option value=".$row['idpow'].">".$row["idpow"].".".$row['nazwa'] . "</option>";
                                
                              }
                             
                              ?>
                              
                            </select></td>

                  
                              
                              
  <td><input type="text" name="nazwa_pp"></td>
  
  
  <td><input type="numer" name="rozmiar_pp"></td>
  <td><input type="submit" name="podpow" value="dodaj podpowierzchnie"></td></tr>
</table> 
</form>
     
          
      
                           
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