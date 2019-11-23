<?php
// Chargement des classes

// retourne les meilleurs temps
function listBestTime()
{
    $BestTimeWinner = new BestTimeWinner(); // Création d'un objet
    $BestTime = $BestTimeWinner->getBestResult(); // Appel d'une fonction de cet objet
    return $BestTime;
}

// insère le temps de jeu dans la base de données
function addBestTime($timeToWin)
{
    $BestTimeWinner = new BestTimeWinner(); // Création d'un objet
    $affectedLines = $BestTimeWinner->postResult($timeToWin); // Appel d'une fonction de cet objet

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le temps !');
    }
    else {
        header('Location:../index.php');
    }
}

// transforme les secondes en minutes seconde dans un tableau
function secToMinSec($timeInSec)
{
    $min = intval(($timeInSec % 3600) / 60);
    $min = sprintf("%02d", $min); // formate le chiffre sur 2 caractères en mettant 0 
    $sec = intval((($timeInSec % 3600) % 60));
    $sec = sprintf("%02d", $sec);
    
    $tabTime = [
    "min" => $min,
    "sec" => $sec
    ];

    return $tabTime;
}