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
        <title>Pokemon Tournament</title>
        
         <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        
        <div class="head">
            
            <img src="Pokeball.png" alt="Pokeball" style="width:80px;height:70px;">
            <h1>Pokemon Match Webpage</h1>
     
            
            
        </div>
    <div class="meny">
        
        <a href="index.php" class="knapp">Registrer</a>
        <a href="vis_lag.php" class="knapp">Teams</a>
        <a href="stage.php" class="knapp">Match</a>
        <a href="login.php" class="knapp">Admin login</a>
        
        
        
    </div>
        
        
        <div class="section">
            
            
        </div>
         <?php
         session_start();
         $_SESSION['valid'] = false;
        
         if(isset($_POST["Oppdater"]))
        {
             $db= new mysqli("localhost","root","","pokemon_tournament");
             
        if(!$db)
        {
            die("Kunne ikke knytte til databasen".$db->connect_error);
        }
             
            $lagreFornavn = $_POST["first_name"];
            $lagreEtternavn = $_POST["last_name"];
            $lagreAddresse = $_POST["address"];
            $lagreAlder = $_POST["alder"];
            $lagreTlf = $_POST["phone_number"];
            
            $pokeName1 = $_POST["name1"];
            $pokeType1 = $_POST["type1"];
            $pokeName2 = $_POST["name2"];
            $pokeType2 = $_POST["type2"];
            $pokeName3 = $_POST["name3"];
            $pokeType3 = $_POST["type3"];
            
            $pokeCount1 = 1;
            $pokeCount2 = 2;
            $pokeCount3 = 3;
            
            $check = array($lagreAddresse,$lagreAlder,$lagreEtternavn,$lagreFornavn,$lagreTlf,$pokeName1,$pokeName2,$pokeName3,$pokeType1,$pokeType2,$pokeType3);
            for($i = 0; $i <= count($check);){
                if($check[$i] == ""){
                  die ("Please fill out ALL");
                    
                  }
                
                elseif(!$check[$i] == "") {
                    break;
                }
                $i++;
            }
        
            
       /*   if($lagreFornavn == "" || $lagreEtternavn == ""){
              echo "Requires Name";
              
          }
          elseif($pokeName1 || $pokeName2 || $pokeName3 == ""){
              echo "Requires Pokemons";
          } 
           else
           { */
           for($i = 1; $i < 3;$i++){
               if($i == 1){
                   $sql = "insert into trainer (FName, LName, HomeAdd, Age, PhoneNr) values ( '$lagreFornavn','$lagreEtternavn','$lagreAddresse','$lagreAlder','$lagreTlf')";
                   $resultat = $db->query($sql);
                   
                    if(!$resultat){
                echo "ingen entry for trainer";
            }
            elseif($db->affected_rows>0)
            {
                echo "Trener oppdatert OK <br/>";
            }
            else 
                {
                echo "Feil oppstod";
                 }
               }
               elseif($i == 2){
                   $sql2= "(SELECT trainer.ID FROM trainer WHERE trainer.FName = ''$lagreFornavn'')";
                   $sql = " insert into pokemon (Type, Name, NrOrder, Owner) value ('$pokeType1','$pokeName1','$pokeCount1',(SELECT trainer.ID FROM trainer WHERE trainer.FName = '$lagreFornavn' AND LName ='$lagreEtternavn')),('$pokeType2','$pokeName2','$pokeCount2',(SELECT trainer.ID FROM trainer WHERE trainer.FName = '$lagreFornavn' AND LName = '$lagreEtternavn')),('$pokeType3','$pokeName3','$pokeCount3',(SELECT trainer.ID FROM trainer WHERE trainer.FName = '$lagreFornavn' AND LName = '$lagreEtternavn'));";
                   $resultat = $db->query($sql);
                   
                    if(!$resultat){
                echo "ingen entry for pokemon";
            }
            elseif($db->affected_rows>0)
            {
                echo "Pokemon oppdatert OK <br/>";
            }
            else 
                {
                echo "Feil oppstod";
                 }
                 
                 
                // $sql3="insert into pokemon (Owner) value (SELECT ID FROM trainer WHERE FName = ''$lagreFornavn'')";
               } 
           } 
            $db->close();
           }
            
                 
              
     //   }
        ?>
        
        
        
        <section class="left">
            
            <h1>Pokemon Trener</h1>
            <form action="" method="post" id="1">
                <label for="first_name">Fornavn:</label>
                    <input id="first_name" name="first_name" type="text" value=""/>
                <label for="last_name">Etternavn:</label>
                    <input id="last_name" name="last_name" type="text" value=""/>
                <label for="address">Adresse:</label>
                    <input id="address" name="address" type="text" value=""/>
                <label for="phone_number">Telefonnummer:</label>
                <input id="phone_number" name="phone_number" type="text" value=""/>
                 <label for="alder">Alder:</label>
                 <input id="alder" name="alder" type="text" value=""/>
                 
                 <input type="submit" name ="Oppdater" value="Meld på!"/>
                 
            </form>
        
        </section>
            
            <section class="right">
         
                
                    
                     <h1>Pokemon</h1>
            <form action="" method="post">
                <h3>Pokemon nr 1:</h3>
                <label for="type">Type:</label>
                    <input id="type1" name="type1" type="text" value="" form="1"/>
                <label for="name">Navn:</label>
                    <input id="name1" name="name1" type="text" value="" form="1"/>
                    
                    <br/>
                    
                 <h3>Pokemon nr 2:</h3>   
                <label for="type2">Type:</label>
                    <input id="type2" name="type2" type="text" value="" form="1"/>
                <label for="name2">Navn:</label>
                <input id="name2" name="name2" type="text" value="" form="1"/>
                
                   <br/>
                
                <h3>Pokemon nr 3:</h3>
                <label for="type3">Type:</label>
                    <input id="type3" name="type3" type="text" value="" form="1"/>
                <label for="name3">Navn:</label>
                <input id="name3" name="name3" type="text" value="" form="1"/>
                    
            </form>   
                
                
                
             <?php
             /*
             if(isset($_POST["OppdaterPokemon"])){
                 $db = new mysqli("localhost", "root","", "pokemon_tournament");
                 
               if(!$db){
                   die( "could not connect to host");
               }
                 
            $pokeName = $_POST["name"];
            $pokeType = $_POST["type"];
            $pokeNr = $_POST["place"];
            $pokeOwner = $_POST["owner"];
            
            $sql = "insert into pokemon (Type, Name, NrOrder, Owner) value ('$pokeType','$pokeName','$pokeNr','$pokeOwner');";
            
            $resultat = $db->query($sql);
            
            if(!$resultat){
                echo "ingen entrys";
            }
            elseif($db->affected_rows > 0){
              echo  "Pokemon Oppdatert";
             }
            else{
                echo "feil oppstod";
            }
            $db->close();
            }
            */ 
             ?>
             
             
             
             
                 
              
             
             
             
         </section>
        
    </body>
</html>
