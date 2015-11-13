<?php
class FilmLijst { 
   public function createFilm($titel, $duurtijd) {
        
        if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)){
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "") 
                 or die ('Could not connect');
        $sql = "insert into films (titel, duurtijd) values ( :titel   , :duurtijd  )" ;
        //$filmTitel = $_POST["titel"];
        //$filmTijd = $_POST["duurtijd"];
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":titel", $titel);
        $stmt->bindParam(":duurtijd", $duurtijd);
      
         
        $stmt->execute(); 
        echo $sql;
        $laatsteId = $dbh->lastInsertId(); 
        $dbh = null;
        print($laatsteId);
        }else {
            print "fout";
        
    }
   }
    
    public function getLijst() { 
       
         $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "") 
                 or die ('Could not connect'); 
        
        $resultSet =("select titel, duurtijd from films"); 
        $stmt = $dbh->prepare($resultSet);
        $stmt->execute(); 
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array(); 
        foreach ($resultSet as $rij) { 
            $film = $rij["titel"] . ", " . $rij["duurtijd"]; 
           array_push($lijst, $film); 
            
        } 
        $dbh = null;
        $stmt = null;
        return $lijst; 
        
    } 
    // Nog geen insert in database
    //
    //
    //
    
   
    //array(':titel' => $filmTitel, ':duurtijd' => $filmTijd)
    } 
$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] == "new") {
	$filmlijst->createFilm($_POST["titel"], $_POST["duurtijd"]);
}
?>









<!DOCTYPE HTML> 
<html> 
    <head> 
        <meta charset=utf-8> 
        <title>gegevensOphalen</title> 
    </head>
<body> 
    <h1>Alle films</h1>
      <?php 
        $pl = new FilmLijst(); 
        $tab = $pl->getLijst(); 
        ?> 
        <ul> 
            <?php 
            foreach ($tab as $films) {
                print("<li>" . $films . "</li>"); } 
                ?> 
            </ul>
    
    
    <h1>Film toevoegen</h1>
    <form action="FilmsForm.php?action=new" method="post">
        <label>Titel  : 
        <input type="text" name="titel" value="" maxlength="50" />
        </label><br>  
         <label>Duurtijd: 
         <input type="text" name="duurtijd" value="" maxlength="30" /> minuten
         </label><br> <br>
         <input type="submit" value="Toevoegen" />
    </form> 
</body> 
</html>


