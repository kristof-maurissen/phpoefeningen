<?php 
//moduleLijst.php 
class ModuleLijst { 
    public function getLijst() {
        
    $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "");
        
    $sql = "select naam, prijs from modules where prijs >= :minimum 
     and prijs <= :maximum order by prijs"; 
    $stmt = $dbh->prepare($sql);
    $mini= $_GET["minimum"];
    $maxi= $_GET["maximum"];
   /* $stmt->bindParam(":minimum", $mini);
    $stmt->bindParam(":maximum", $maxi);*/
    $stmt->execute(array(":minimum" => $mini, ":maximum" => $maxi )); 
    $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
    $lijst= array();
    foreach ($resultSet as $rij) { 
    $module = $rij["naam"] . ", " . $rij["prijs"]; 
    array_push($lijst, $module);
    } 
    $stmt = null;
    $dbh = null; 
    return $lijst; 
    
    }
}
