
<?php

require("model.php"); // les requêtes dans la base de donnée
require("../controller/controller.php"); // les fonctions

// vérifie que la valeur existe et n'est pas vide
if(isset($_POST['playTimeValue']) && !empty($_POST['playTimeValue'])){ 
    // appel de la fonction qui ajoute le temps en BD  
    addBestTime(htmlspecialchars($_POST["playTimeValue"]));
}
else{
    throw new Exception("la valeur playTimeValue n'existe pas"); // sinon envoie une exception
}

?>                          