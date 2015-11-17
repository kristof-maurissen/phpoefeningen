<?php
class Film { 
    private $id;
    private $titel;
    private $duurtijd;
    
    
    public function __construct ($id,$titel,$duurtijd){
        $this->id = $id;
        $this->titel= $titel;
        $this->duurtijd = $duurtijd;
      
        
        
    }
    public function getId() {
        return $this->id;
    }
    public function getTitel() {
        return $this->titel;
    }
    public function getDuurtijd() {
        return $this->duurtijd; 
    }
    public function setTitel($titel){
        $this->titel =($titel);
    }
    public function setDuurtijd($duurtijd){
        $this->duurtijd = ($duurtijd);
    }
    
}
    class FilmLijst {
   public function createFilm($titel, $duurtijd) {
        
        if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)){
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "") 
                 or die ('Could not connect');
        $sql = "insert into films (titel, duurtijd) values ( :titel   , :duurtijd  )" ;
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":titel", $titel);
        $stmt->bindParam(":duurtijd", $duurtijd);
        $stmt->execute();
        $dbh = null;
        }else {
            print "fout";
        
    }
   }
    
  public function getLijst() { 
       
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "") 
                 or die ('Could not connect'); 
        $sql =("select id, titel, duurtijd from films");
        $resultSet = $dbh->query($sql);
        $stmt = $dbh->prepare($sql);
        $lijst = array();
        $stmt->execute(); 
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultSet as $rij) { 
            $films = new Film($rij["id"],$rij["titel"],$rij["duurtijd"]); 
            array_push($lijst, $films);   
        } 
       $dbh = null;
       return $lijst; 
    }
    public function getFilmById($id){
        $sql = ("select titel, duurtijd from films where id = :id");
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $film = new Film($id, $rij["titel"], $rij["duurtijd"]);
        $dbh = null;
        return $film;
    } public function deleteFilm($id) {
		$sql = ("delete from films where id = :id");
                
                $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "");
		$stmt = $dbh->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
		$dbh = null;
                $stmt = null;
	}
    public function updateFilm ($films){
       print_r ($films);
        $sql =("update films set titel = :titel, duurtijd = :duurtijd where id = :id");
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $resultSet = $stmt->execute(array( 
            ':id' => $films->getId(), 
            ':titel' => $films->getTitel(), 
            ':duurtijd' => $films->getDuurtijd()));
        $stmt->execute();
        $dbh = null;
    }
   
    
   
    }
  
$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] == "new") {
	$filmlijst->createFilm($_POST["titel"], $_POST["duurtijd"]);
        }
if 
    (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $filmLijst2 = new FilmLijst();
    $filmLijst2->deleteFilm($_GET["id"]);
        }
$updated= false;
if (isset($_GET["action"]) && $_GET["action"] == "bewerk"){
    
    $film = new Film($_GET["id"], $_GET["titel"], $_GET["duurtijd"]);
    $filmLijst = new FilmLijst();
    $filmLijst->updateFilm($film);
    $updated = true;
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
        
        $tab = $filmlijst->getLijst();
       
        ?> 
        <ul> 
            <?php 
            foreach ($tab as $films) {
                //$filmId = $films->getId();
                ?>
            <li>
		<?php print($films->getTitel());?>
		(<?php print($films->getDuurtijd());?> min)
		<a href="FilmsForm.php?action=delete&id=<?php print($films->getId());?>">
		<img src="images/delete.png"></a>
	    </li>
            <li>
                 <a href="FilmsForm.php?action=bewerk&id=<?php print($films->getId());?>">
		Bewerken</a>
            </li>
				<?php
			}
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
    <h1>Film bewerken</h1>
    <?php
    if ($updated == true){
        print("Record bijgewerkt");
    }else{
        print ("Niet bijgewerkt");
    }
    $filmLijst = new FilmLijst();
    $film = $filmLijst->getFilmById($_GET["id"]);
    ?>
    
    <form action="FilmsForm.php?action=bewerk&id="<?php print($_GET["id"]);?> method="post">
        Titel: <input type="text" name="titel" value="<?php print($film->getTitel()); ?>" /><br />
        <br />
        Duurtijd: <input type="text" name="duurtijd" value="<?php print ($film->getDuurtijd()); ?>"/> Min<br />
        <input type="submit" value="Opslaan" />
    </form>
    <a href="FilmsForm.php">Terug naar start</a>
</body> 
</html>


