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
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            
            body {
                width:800px;
                margin:auto;
            }
        </style>
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
        <a href="secure.php" class="knapp">admin side</a>
        
        
        
    </div>
        
       <form action="" method="post" onsubmit="return email('username')">
                <label for="username">Brukernavn:</label>
                <input id="username" name="username" type="text" value="" required="" />
                 <label for="password">Passord:</label>
                 <input id="password" name="password" type="password" value="" required=""/> 
                    
                 <input type="submit" name ="Oppdater" value="Login" />
       </form>
        
        <script type= "text/javascript">
            function good_name(){
                riktig = /^[a-zA-ZøæåØÆÅ .\- ]*$/;
                OK = riktig.test(document.skjema.navn.value);
                if(!OK){
                    return false;
                }
                else {
                    return true;
                }
               
             function email(email) {
                 re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
}
            }
  
        </script>
        
        <?php
          session_start();
         if(isset($_POST["Oppdater"]))
        {
             $db= new mysqli("localhost","root","","pokemon_tournament");
             
        if(!$db)
        {
            die("Kunne ikke knytte til databasen".$db->connect_error);
        }
            $lagreuser = ($_POST["username"]);
            $lagrepass = ($_POST["password"]);
        
            $sql = "Select salt from login where username = '$lagreuser'";
            $result = $db->query($sql);
            $row = $result->fetch_object();
            
             if(!$result){
                echo "ingen salt";
            }
            $salt = $row->salt;
            
            $hash = hash("sha1", $salt.$lagrepass);
        
            echo $hash."<br />";
           
            $sql2 = "select * from login where username='$lagreuser' and password='$hash';";
            $result2 = $db->query($sql2);
            $row2 = $result2->fetch_object();
            
            if($db->affected_rows>0){
                
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $lagreuser;
                  
                  header("Location: secure.php");
            
                  exit;
            }
 else {
     
    echo "feil passord";
 }
            
        }
        ?>
    </body>
</html>
