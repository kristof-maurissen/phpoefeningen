<?php

abstract class Rekening {
    private $rekeningNr ;
    private  $saldo = 0;
    private $omschrijving;
    
   public function getSaldo() {
      return $this->saldo;  
   } 
   
   public function Stort($bedrag){
       $this->saldo = $this->saldo+$bedrag ;
            
   }
   public function setRekeningNr($rekeningNr){
       $this->rekeningNr = $rekeningNr;
       
   }
   
   public function VoerIntrestDoor() {
           
   }
}
 class Spaarrekening extends Rekening{
     private static $intrest = 0.03;
     
    public function __contruct ($rekeningNr, $omschrijving) {
       parent::setRekeningNr($rekeningNr);
       
   } 
    public function getOmschriving(){
        return ("Kortetermijnrekening");
    }
   public function VoerIntrestDoor(){
       parent::stort (parent::getSaldo() * self::$intrest);
 }
}
class Zichtrekening extends Rekening{
    private static $intrest = 0.025;
     public function __contruct ($rekeningNr) {
       parent::setRekeningNr($rekeningNr);
       
   }
   public function getOmschriving(){
        return ("Langetermijnrekening");
    }
  
   public function VoerIntrestDoor(){
       parent::stort (parent::getSaldo() * self::$intrest);
 }
    
}
?>
<!DOCTYPE HTML> 
<html> 
<head> 
<meta charset=utf-8> 
        <title>Rekeningnummers</title> 
        </head> 
        <body> 
        <h1> 
        <?php $rek = new Zichtrekening("091-0122401-16");
                print ($rek->getOmschriving() . "<br />");
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
                $rek->stort(200); 
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
                $rek->voerIntrestDoor();
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
                $rek = new Spaarrekening("091-0122401-16"); 
                print ($rek->getOmschriving() . "<br />");
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
                $rek->stort(100); 
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
                $rek->voerIntrestDoor();
                print("Het saldo is: " .$rek->getSaldo() . "<br />"); 
?> 
</h1> 
</body> 
</html>