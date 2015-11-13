<?php
//cursistenEnMedewerkers.php 
class Persoon {
    private $familieNaam;
    private $voorNaam;
    
    public function getVollNaam (){
        return $this->voorNaam . " , " . $this->familieNaam; 
    }
    public function setVoornaam ($voorNaam){
        $this->voorNaam = $voorNaam;
    }
    public function setFamilienaam ($familieNaam){
        $this->familieNaam = $familieNaam;
    }
    
}

class Cursist extends Persoon {
    private $aantalCursussen;
    public function __construct ($voorNaam, $familieNaam, $aantalcursussen){
        parent::setVoornaam($voorNaam);
        parent::setFamilienaam($familieNaam);
        $this->aantalCursussen = $aantalcursussen;
}
    public function getAantalcursussen (){
        return $this->aantalCursussen;
    }
    public function setAantalcursussen ($aantalCursussen) {
        $this->aantalCursussen = $aantalCursussen;
    }
    
}
class Medewerker extends Persoon {
    private $aantalCursisten;
    public function __construct ($voorNaam, $familieNaam, $aantalCursisten){
        parent::setVoornaam($voorNaam);
        parent::setFamilienaam($familieNaam);
        $this->aantalCursisten = $aantalCursisten;
        
    }
    public function getAantalcursisten (){
        return $this->aantalCursisten;
    }
    public function setAantalcursisten($aantalCursisten){
        $this->aantalCursisten = $aantalCursisten;
    }
    
}



$cursist = new Cursist("Peeters", "Jan", 3); 
$medewerker = new Medewerker("Janssens", "Tom", 8); 
?> 
<!DOCTYPE HTML> 
<html> 
    <head> 
        <meta charset=utf-8> 
        <title>Cursisten en medewerkers</title> 
    </head> 
    <body> 
        <h1>Namen</h1> 
        <ul>
            <li><?php print($cursist->getVollNaam() . " volgt " .
                    $cursist->getAantalcursussen() . " cursus(sen)");?>
            </li> 
            <li><?php print($medewerker->getVollNaam() . " begeleidt " . 
                    $medewerker->getAantalcursisten() . " cursist(en)");?>
                        </li> 
                        </ul> 
                        </body> 
                        </html>