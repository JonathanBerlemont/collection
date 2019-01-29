<?php
//Construction de ma query (car nombre de genres/groupes variable)
if (isset($_GET['genres'])){
    $genres = $_GET['genres'];
}
if (isset($_GET['bands'])){
    $bands = $_GET['bands'];
}


//Subquery pour chercher les groupes
$subquery = ('musique');
if (isset($bands) && sizeof($bands) != 0){
    $subquery = ('SELECT * FROM musique');
    $i=0;
    foreach($bands as $band){
        if ($i>0){
            $subquery = $subquery.(' OR groupe = "'.$band.'"');
        } else {
            $subquery = $subquery.(' WHERE groupe = "'.$band.'"');
            $i++;
        }
    }
}


//Ajout de la subquery à la query principale
if ($subquery != 'musique'){
    $query = ('SELECT * FROM ('.$subquery.') AS bands');
} else {
    $query = ('SELECT * FROM musique');
}


//Query pour chercher les genres à partir des groupes
if (isset($genres) && sizeof($genres) != 0){
    $i=0;
    foreach($genres as $genre){
        if ($i>0){
            $query = $query.(' OR genre = "'.$genre.'"');
        } else {
            $query = $query.(' WHERE genre = "'.$genre.'"');
            $i++;
        }
    }
} 
$query = $query.(' ORDER BY groupe, annee DESC');


//execution de ma query 
$requete = $db->query($query);
?>