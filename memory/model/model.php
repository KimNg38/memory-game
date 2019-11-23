
<?php
// gère la connexion à la base de donnée
class ConnexionDb
{
    // connexion à la base de donnée
    function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=memory;charset=utf8', 'root', '');
        return $db;
    }
}
// gère les fonctions liées au temps de jeu
class BestTimeWinner extends ConnexionDb
{
    
    // récupère les 10 meilleurs temps enregistrés.
    function getBestResult()
    {
        // Connexion à la base de données via PDO avec un paramètre à la fin pour activer les erreurs
        try
        {
           $ConnexionDb = new ConnexionDb(); // Création d'un objet ConnexionDB
           $bdd = $ConnexionDb->dbConnect(); // Appel de la fonction dbConnect 
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage()); // on arrête l'exécution de la page en affichant un message décrivant l'erreur
        }
        // execute la requete
        $req = $bdd->query("SELECT gamePlayTime, DATE_FORMAT(gameDate,'%d/%m/%Y %T') as gameDate FROM game ORDER BY gamePlayTime asc LIMIT 0, 10");

        return $req;
    }

    // insère le temps réalisé lors qu'un jeu est gagné
    function postResult($gamePlayTime)
    {
        $db = $this->dbConnect();
        // prépare la requete d'insert
        $comments = $db->prepare('INSERT INTO game(gamePlayTime,gameDate) VALUES(?, ?)');
        // execute la requete avec les paramètres
        $affectedLines = $comments->execute(array($gamePlayTime,date("Y-m-d H:i:s")));
        // la fonction returne true si cela s'est bien passé sinon elle retourne false
        return $affectedLines;
    }

}

?>
