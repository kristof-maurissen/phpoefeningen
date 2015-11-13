<?php 
//interfaces.php 
/*interface Omvang { 
    public function getGrootte(); 
    
}*/ 
class Persoon //implements Omvang 
{ 
    private $lengte; 
    public function __construct($lengte) { 
        $this->lengte = $lengte; 
        
    } 
   public function getGrootte() { 
        return $this->lengte;
   }
    }

class Oppervlakte //implements Omvang 
    { 
    private $breedte; 
    private $lengte; 
    public function __construct($breedte, $lengte) { 
        $this->breedte = $breedte; 
        $this->lengte = $lengte; 
        
    } 
    public function getGrootte() { 
        return $this->lengte * $this->breedte; 
        
    } 
    
    } 
    ?> <!DOCTYPE HTML> 
    <html> 
        <head> 
            <meta charset=utf-8> 
            <title>Interfaces</title> 
        </head> 
        <body> 
            <h1> 
                <?php 
                $p = new Persoon(190); 
                print($p->getGrootte() . "<br />"); 
                $o = new Oppervlakte(20, 30); 
                print($o->getGrootte()); 
                ?> 
            </h1> 
        </body> 
    </html>

