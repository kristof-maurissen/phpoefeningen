<?php
class Thermometer {
    
    private $temperatuur ;
    
    public function __construct($temperatuur){
        $this->temperatuur = $temperatuur ;
    }
    
    public function verhoog ($aantalgraden) {
        $this->temperatuur += $aantalgraden;
    }
    public function verlaag ($aantalgraden){
        $this->temperatuur -= $aantalgraden;
    }
    public function getTemperatuur () {
        
        return $this->temperatuur;
    }
}


			$therm = new Thermometer(20);
			$therm->verhoog(20);
			print($therm->getTemperatuur() . "<br>");
			$therm->verlaag(5);
			print($therm->getTemperatuur() . "<br>");
			
