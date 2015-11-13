<?php
include_once 'moduleLijst.php';

?>
<!DOCTYPE HTML> 
<html> 
    <head> 
        <meta charset=utf-8> 
        <title>gegevensOphalen</title> 
    </head>
<body> 
    <h1>Resultaat</h1>
      <?php 
        $pl = new ModuleLijst(); 
        $tab = $pl->getLijst(); 
        ?> 
        <ul> 
            <?php 
            foreach ($tab as $module) {
                print("<li>" . $module . "</li>"); } 
                ?> 
            </ul>
</body> 
</html>

