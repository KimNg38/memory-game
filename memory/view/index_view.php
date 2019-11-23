
<?php
require('model/model.php'); // les requêtes dans la base de donnée
require("controller/controller.php"); // les fonctions

?>

<section id="main">
    <div id="contenu"> 
        <div id="container"> 
            <div id="btnPlay"><button class="btn" href="#">Jouer</button></div> <!-- affiche le bouton -->
            <div id="bestTimeList">
              <h4>Top 10 des meilleurs temps</h4>
              <!-- On récupère les 10 derniers temps par ordre décroissant de la table resultat -->
              <?php
              $req = listBestTime();
              $num_of_rows = $req->rowCount() ;
              // si la requête retourne au moins une ligne de résultat, on affiche un tableau
              if($num_of_rows != 0) {
                while ($data = $req->fetch()) //On affiche chaque entrée une à une 
                {
                  // transforme le temps seconde en minute et seconde
                  $arrayMinSec = secToMinSec($data['gamePlayTime']);

                  $min = $arrayMinSec["min"];
                  $sec = $arrayMinSec["sec"];
                  
                  echo "<span>" . $data['gameDate'] . " en ". $min .":" . $sec . " min." . "</span>";
                }
              }
              else // si la requête ne retourne rien, on écrit un message
              {
                echo "<h4>pas de résultat!</h4>";
              }  

               $req->closeCursor(); // Termine le traitement de la requête

              ?>
            </div>
            <!-- affiche les cartes de memory -->
            <div id="gameCard" class="gameCardClass"></div>
        </div>
    </div>
</section>