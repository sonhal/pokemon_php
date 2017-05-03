<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="newcss.css">
        <meta charset="UTF-8">
        <title>Kamp oppsett</title>
    </head>
    <body>
        
        <div class="head">
            <img src="Pokeball.png" alt="Pokeball" style="width:80px;height:70px;">
            <h1>Kamp mellom to Pokemon mestere!</h1>
            
        </div>
        
        <div class="meny">
            
                <a href="index.php" class="knapp">Registrer</a>
                <a href="vis_lag.php" class="knapp">Teams</a>
                
                <a href="stage.php" class="knapp">Match</a>
            
            
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            Skriv inn filnavnet:<br />
            <input type="file" size="20" name="file" />
            <input type="submit" name="knapp" value="Upload"/>
            
        </form>
        
        <?php
        
        if(isset($_POST['knapp']) && $_FILES['file']['size'] > 0)
              {
            
            $db1 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db1){
                    die("Feil i databasetilkobling:".$db1->connect_error);
                }
            
            
            
                   $fileName = $_FILES['file']['name'];
                   $tmpName  = $_FILES['file']['tmp_name'];
                   $fileSize = $_FILES['file']['size'];
                   $fileType = $_FILES['file']['type'];

                $fp = fopen($tmpName, 'r');
                 $content = fread($fp, filesize($tmpName));
                 $content2 = addslashes($content);
                      fclose($fp);

          

               include 'library/config.php';
                 include 'library/opendb.php';

               $query = "INSERT INTO images (name, size, type, content ) ".
                   "VALUES ('$fileName', '$fileSize', '$fileType', '$content2')";

               
                       } 
        
        ?>
        
        
        <?php
        session_start();
        if($_SESSION['valid'] == false){
            header("Location: index.php");
            
            exit;
        }
        
       
        ?>
        
        
        
     
        
        
        <div class="chooser">
            
            <form action="" method="post">
                
                <select name="round">
                     <option value="">velg runde...</option>
                     <?php
                     
                     $dbr = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$dbr){
                    die("Feil i databasetilkobling:".$dbr->connect_error);
                }
                 $queryround = "Select * from trainer;";
                 $resultround = $dbr->query($queryround); 
                 $rowrounds = (mysqli_num_rows($resultround))/2;
                 
                 if($rowrounds == ""){
                     echo "tom row";
                 }
                 
                 
                 for($i = 0; $i < $rowrounds; $i++){
                 echo "<option value=".$i.">runde: ".$i."</option>";
                 
                 }
                 
                  if(!$resultround){
                    echo "Spørringen ble ikke utført";
                }
                     
                     
                     ?>
                    </select>
            <?php
            
            $db1 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db1){
                    die("Feil i databasetilkobling:".$db1->connect_error);
                }
                 $queryChoose = "Select ID,FName,LName from trainer;";
                 $resultChoose = $db1->query($queryChoose); 
                 
                  if(!$resultChoose){
                    echo "Spørringen ble ikke utført";
                }
                function drop_down($resultChoose){
                    
                    while($rowChoose = mysqli_fetch_object($resultChoose)){
                    $output = "<option value =".$rowChoose->ID.">".$rowChoose->FName." ".$rowChoose->LName."</option>";
                    return $output;
                       }
                   
                }
                
                
                    
                
               
                $db1->close(); 
 
?>
                    
           
            
            
              <select name="formPlayer1">
                  <option value="">velg spiller 1...</option>
                    <?php 
                    
                    for($i = 0; $i <= mysqli_num_rows($resultChoose);){
                   echo drop_down($resultChoose);
                   $i++;
                    }
                    ?>
                </select>
            
              <select name="formPlayer2">
                    <option value="">velg spiller 2...</option>
                    
                    
                    <?php
            $db2 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db2){
                    die("Feil i databasetilkobling:".$db2->connect_error);
                }
                 $queryChoose2 = "Select ID,FName,LName from trainer;";
                 $resultChoose2 = $db2->query($queryChoose2); 
                 
                  if(!$resultChoose2){
                    echo "Spørringen ble ikke utført";
                }
                function drop_down2($resultChoose2){
                    
                    while($rowChoose2 = mysqli_fetch_object($resultChoose2)){
                    $output2 = "<option value =".$rowChoose2->ID.">".$rowChoose2->FName." ".$rowChoose2->LName."</option>";
                    return $output2;
                       }
                   
                }
                
                $db2->close();
                        
                
                
               
            
                    
                    for($i = 0; $i <= mysqli_num_rows($resultChoose2);){
                   echo drop_down2($resultChoose2);
                   $i++;
                    }
                    ?>
                </select>
                
                
                 <select name="formStage">
                <option value="">velg stadium...</option>
                
                <?php
            $dbS = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$dbS){
                    die("Feil i databasetilkobling:".$dbS->connect_error);
                }
                 $queryChooseS = "Select Type from stage;";
                 $resultChooseS = $dbS->query($queryChooseS); 
                 
                  if(!$resultChooseS){
                    echo "Spørringen ble ikke utført";
                }
                function drop_downS($resultChooseS){
                    
                    while($rowChooseS = mysqli_fetch_object($resultChooseS)){
                    $outputS = "<option value =".$rowChooseS->Type.">".$rowChooseS->Type." ".$rowChooseS->Adress."</option>";
                    return $outputS;
                       }
                   
                }
                
                 $dbS->close();
                        
                
                
               
            
                    
                    for($i = 0; $i <= mysqli_num_rows($resultChooseS);){
                   echo drop_downS($resultChooseS);
                   $i++;
                    }
                    
                    ?>
                
            </select>
            
            <?php 
              $dbG = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$dbG){
                    die("Feil i databasetilkobling:".$dbG->connect_error);
                }
            
              if(isset($_POST['submit']))
                    {
                     
                     $player1 = $_POST['formPlayer1'];
                     $player2 = $_POST['formPlayer2'];
                     $stage = $_POST['formStage'];
                     
                     if($player1 == $player2){
                         die("choose different trainers!");
                         
                     }
                     
                    $sqlLike="Select Player1,Player2 from game where Player1 = '$player1' and Player2 = '$player2' or Player1 = '$player2' and Player2 = '$player1';";
                    $resultLike = $dbG->query($sqlLike);
                    
                    $rowLike = $resultLike->fetch_object();
                    if(!is_null($rowLike)){
                        die("Player have already played");
                    }
                     
                    $sqlG ="insert into game (Player1,Player2,Stage) value ('$player1','$player2','$stage');";
                    $resultG = $dbG->query($sqlG);
                            
                    if(!$resultG){
                        echo "match gjekk ikkje gjennom";
                    }
                    
                   $sqlR = "Select * from trainer where ID = '$player1';";
                   $sqlL = "Select * from trainer where ID = '$player2';";
                    
                   
                   $result = $dbG->query($sqlR);
                   $resultP2= $dbG->query($sqlL);
                   
                    if(!$result){
                    echo "Spørringen ble ikke utført";
                            }
                
                
                  
                    }  
                   
                    
               
           
              $dbG->close();
            ?>
                <button type="submit" name="submit" value="submit">fight</button>
</form>
        </div>
        
        <section class="leftStage">
              <?php
              if(isset($_POST['submit'])){
              
                   $player1 = $_POST['formPlayer1'];
                   $player2 = $_POST['formPlayer2'];
                   
                     
                     
                   $db2 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db2){
                    die("Feil i databasetilkobling:".$db2->connect_error);
                }
                 $queryPlayer1 = "Select ID,FName,LName,HomeAdd,Age,PhoneNr from trainer where ID ='$player1';";
                 $resultPlayer1 = $db2->query($queryPlayer1); 
                 
                  if(!$resultPlayer1){
                    echo "Spørringen ble ikke utført";
                }
                  
                  
                  
                  $rowP1 = $resultPlayer1->fetch_object();
                    
                        
                       
                
                       
               echo "<li style = 'border: solid black 2px; width: 100%;margin-top: 5px;'>"."ID nr: " .$rowP1->ID.", Navn: ".$rowP1->FName.", Adresse: ".$rowP1->HomeAdd.", Alder: ".$rowP1->Age.", Tlf nr: ".$rowP1->PhoneNr."</li>";
               $sql1 = "Select * from pokemon where Owner = ".$rowP1->ID."";
               $resultP1 = $db2->query($sql1);
               while($rowP1 = $resultP1->fetch_object()){
                   
                  echo "<li style = 'border: solid black 2px; width: 50%;margin-top: 2px;'>"."Nr: ".$rowP1->NrOrder." Navn: ".$rowP1->Name."</li>";
                            
                   }
                  echo "<br />";
              }
           ?>
        </section>
        
        
        
        <section class="rightStage">
              <?php
                     
              
              
              
              
              
              
              if(isset($_POST['submit'])){
              
                   $player1 = $_POST['formPlayer1'];
                   $player2 = $_POST['formPlayer2'];
                   
                     
                     
                   $db2 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db2){
                    die("Feil i databasetilkobling:".$db2->connect_error);
                }
                 $queryPlayer2 = "Select ID,FName,LName,HomeAdd,Age,PhoneNr from trainer where ID ='$player2';";
                 $resultPlayer2 = $db2->query($queryPlayer2); 
                 
                  if(!$resultPlayer2){
                    echo "Spørringen ble ikke utført";
                }
                  
                  
                  
                  $rowP1 = $resultPlayer2->fetch_object();
                    
                        
                       
                
                       
               echo "<li style = 'border: solid black 2px; width: 100%;margin-top: 5px;'>"."ID nr: " .$rowP1->ID.", Navn: ".$rowP1->FName.", Adresse: ".$rowP1->HomeAdd.", Alder: ".$rowP1->Age.", Tlf nr: ".$rowP1->PhoneNr."</li>";
               $sql1 = "Select * from pokemon where Owner = ".$rowP1->ID."";
               $resultP2 = $db2->query($sql1);
               while($rowP1 = $resultP2->fetch_object()){
                   
                  echo "<li style = 'border: solid black 2px; width: 50%;margin-top: 2px;'>"."Nr: ".$rowP1->NrOrder." Navn: ".$rowP1->Name."</li>";
                            
                   }
                  echo "<br />";
              }
    
        ?>
        </section>
        
        
        <div class="bottom">
            
            
            
            
            
            <?php
              
                
                if(isset($_POST['submit'])){
                    
                    $dbW = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$dbW){
                    die("Feil i databasetilkobling:".$dbW->connect_error);
                }
                
              
                    
                     $player1 = $_POST['formPlayer1'];
                     $player2 = $_POST['formPlayer2'];
                     $stage =   $_POST['formStage'];
                     $round = $_POST['round'];
                     
                  $sqlStage = "Select * from stage where Type = '$stage'";
                  $resultStage = $dbW->query($sqlStage);
           
                  if(!$resultStage){
                      echo "kunne ikke hente sql";
                  }
                    
                  $rowStage = $resultStage->fetch_object();
                  
                   echo "<h2 style= text-align:center;font:helvetica;> Location: ".$rowStage->Adress." Type: ".$rowStage->Type."</h2><br /><br />";
                
                   
                   
                   
                   
                   
                  $winner =  rand(0,1);
                  $winner2 =  rand(0,1);
                  $winner3 =  rand(0,1);
                      
                      $pokeWinner = array($winner,$winner2,$winner3);
                      
                      $i++;
                  
                  if(array_sum($pokeWinner) >= 2){
                      $playerWinner = $player1;
                  }
                  elseif(array_sum($pokeWinner) < 2){
                     $playerWinner = $player2;
                  }
                  
                  else{
                      echo "Feil i henting av vinner";
                  }
                   $sqlShowWinner = "Select * from trainer where ID = '$playerWinner';";
                   $resultShowWinner = $dbW->query($sqlShowWinner);
                   $rowShowWinner = $resultShowWinner->fetch_object();
                  
                  echo "<h3 style=text-align:center;>Winner is: ".$rowShowWinner->FName."</h3>";
                  
                  
                  $sqlWinner = "update game set Winner = '$playerWinner' where Player1 ='$player1' And Player2 = '$player2';";
                  
                  
                  
                  
                  
                  $resultWinner = $dbW->query($sqlWinner);
                 
                  $sqltournyWinner = "Insert into tourny (winner,player1,player2,Adress,round) value ('$playerWinner','$player1','$player2','$stage','$round');";
                   $result_tourny = $dbW->query($sqltournyWinner);
                   
                   if($dbW->affected_rows>0){
                       echo "ok";
                   }
                   
                  else{
                      echo "mas";
                  }
                 
                  
                  for($i = 1; $i <= 3;){
                  $sqlRed ="Select * from pokemon where Owner ='$player1' and NrOrder = '$i';";
                  $sqlBlue = "Select * from pokemon where Owner ='$player2' and NrOrder = '$i';";
                  
                  
                  $resultBlue = $dbW->query($sqlBlue);
                  $resultRed = $dbW->query($sqlRed);
                  
                  
                  if(!$resultRed){
                    echo "Spørringen ble ikke utført for Red ".$i." <br />";
                }
                  
                
                  if(!$resultBlue){
                    echo "Spørringen ble ikke utført for Blue".$i." <br />";
                }
                  
                  $rowRed = $resultRed->fetch_object();
                  $rowBlue = $resultBlue->fetch_object();
                  
                  if($pokeWinner[$i-1] == 1){
                      $winnerName = $rowRed->Name;
                  }
                  elseif($pokeWinner[$i-1] == 0){
                      $winnerName = $rowBlue->Name;
                  }
                  else {
                      $winnerName = " Kunne ikkje hente Vinner";
                  }
                  
                 echo "<li style = text-align:center; text-decoration: none;>"."Fight nr: ".$i." ".$rowRed->Name." Versus ".$rowBlue->Name."<br /> Winner is: ".$winnerName."<br /> <br /> "."</li>";
                 $i ++;
                }
                }
            
            
            
            
            
            
           
            ?>
    </body>
</html>
