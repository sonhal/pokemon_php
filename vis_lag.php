<!DOCTYPE html>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="newcss.css">
        <meta charset="UTF-8">
        <title>Pokemon Tournament</title>
        <style>
          
            .leftL{
                margin-top: 5px;
                width:45%;
                padding-left:2.5%;
                display: inline-block;
                float: left;
                height: 100%;
                border-right: 1px solid #aaa;
            }
            
            .rightR{
                margin-top: 5px;
                width:45%;
                padding-left:2.5%;
                display: inline-block;
                float: right;
             
                height: 100%;
            }
            
            li {
                
            }
            
        </style>
    </head>
    <body>
        <div class="head">
        <img src="Pokeball.png" alt="Pokeball" style="width:80px;height:70px;">
        <h1>Pokemon matchups</h1>
        </div>
        
        <div class="meny">
            
                <a href="index.php" class="knapp">Registrer</a>
                <a href="vis_lag.php" class="knapp">Teams</a>

                <a href="stage.php" class="knapp">Match</a>
            
            
        </div>
        
        <div class ="section">
            
        </div>
        
        
        <section class="leftL">
            <h3>Registered matches: </h3>
        <?php
        
         $db = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db){
                    die("Feil i databasetilkobling:".$db->connect_error);
                }
                
                  
                $query = "select * From trainer;";
                          
                                               
                        
                $result = $db->query($query);
                
                if(!$result){
                    echo "Spørringen ble ikke utført";
                }
                else{
                    //while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $counter = 0;
                    $head = 0;
                    while($row = $result->fetch_object()){
                        //echo "<li>".$row["id"]." ".$row["first_name"]." ".$row["last_name"].", ".$row["phone_number"]."</li>";
                       
                       
                        
                       if($counter %2 == 0){
                          
                          echo "<br />"."<br />"."<br />";
                          echo "match nr: ".$head += 1;
                       }
                        echo "<li style = 'border: solid black 2px; width: 80%;margin-top: 5px;'>" .$row->ID." Name: ".$row->FName.", Address: ".$row->HomeAdd.", Age: ".$row->Age.", Phone nr: ".$row->PhoneNr."</li>";
                        $sql = "Select * from pokemon where Owner = ".$row->ID."";
                         $result2 = $db->query($sql);
                        while($row = $result2->fetch_object()){
                            echo "<li style = 'border: solid black 2px; width: 80%;margin-top: 2px;'>"."Nr: ".$row->NrOrder." Navn: ".$row->Name." Type: ".$row->Type."</li>";
                            
                        }
                        echo "<br />";
                       $counter++;
                }
                }
                
               
               
                
                
               
                
                
           
                $db->close();
        
        
        
        ?>
            
        </section>
        
        <section class="rightR">
            <h3>Completed matches: </h3>
            <?php
               echo "<br />"."<br />"."<br />"."<br />";
             
         $db2 = new mysqli("localhost", "root", "", "pokemon_tournament");
                if(!$db2){
                    die("Feil i databasetilkobling:".$db2->connect_error);
                }
                
                  
                $query2 = "select * From game;";
                          
                                               
                        
                $result2 = $db2->query($query2);
                
                if(!$result2){
                    echo "Spørringen ble ikke utført";
                }
                else{
                    
                    
                    
                    while($row2 = $result2->fetch_object()){
                        $sqlGet = " Select ID,FName,Age From trainer where ID = '$row2->Player1';";
                        $sqlGet2 = " Select ID,FName,Age From trainer where ID = '$row2->Player2';";
                        $sqlGetWinner = " Select * From trainer where ID = '$row2->Winner';";
                        
                        $resultFinal1 = $db2->query($sqlGet);
                        $rowFinal1 = $resultFinal1->fetch_object();
                        
                        $resultFinal2 = $db2->query($sqlGet2);
                        $rowFinal2 = $resultFinal2->fetch_object();
                        
                        $resultFinalWinner = $db2->query($sqlGetWinner);
                        $rowFinalWinner = $resultFinalWinner->fetch_object();
                        
                        echo "<li style = 'border: solid black 2px; width: 80%; margin-top: 2px;'>Player 1: ".$rowFinal1->ID." ".$rowFinal1->FName."<br /><br /> Player 2: ".$rowFinal2->ID." ".$rowFinal2->FName."<br /><br /><b> Winner: ".$rowFinalWinner->ID." ".$rowFinalWinner->FName." ".$rowFinalWinner->LName."</b></li><br />";
                    }
                    
                    
                    
                }
                
            ?>
        </section>
    </body>
</html>







