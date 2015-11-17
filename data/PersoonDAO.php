

<?php 
//data/PersoonDAO.php 
require_once("entities/Persoon.php"); 
class PersoonDAO { 
    public function getAll() { 
        $lijst = array(); 
        array_push($lijst, new Persoon("Peeters", "Bram")); 
        array_push($lijst, new Persoon("Van Dessel", "Rudy")); 
        array_push($lijst, new Persoon("Vereecken", "Marie")); 
        array_push($lijst, new Persoon("Maes", "Eveline")); 
        return $lijst; 
        
    } 
    
    }

