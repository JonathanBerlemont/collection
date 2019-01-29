<?php
    //Ouverture du fichier de comptage des visites
    $fichier = fopen("compteur.txt", "r");
    $compteur = fgets($fichier);
    fclose($fichier);

    //Si la personne est venue il y a moins d'un jour, le cookie existera car sa durée de vie est de 1 jour.
    //On passe donc toute cette phase d'incrément du cookie
    if (!isset($_COOKIE['count_timer'])){
        //La personne est venue il y a plus d'un jour (car le cookie n'existe plus) 
        //=> incrémentation
        $compteur = (intval($compteur)) + 1;
        $fichier = fopen("compteur.txt", "w");
        fputs($fichier, strval($compteur));
        fclose($fichier);

        //création du cookie et durée de vie mise sur 1 jour
        setcookie('count_timer', time(), (time()+(3600*24)));
    }
?>