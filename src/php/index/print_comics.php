<?php
while ($donnees = $requete->fetch()) {
    echo '
    <div class="col text-center mb-5">
    <div class="affichageComics">
    <div class="comicBackground"></div>
    <div class="comicContenu text-light py-3">
    <strong class="text-danger spiderman">'
    .$donnees['serie']
    .'</strong><br/>
    
    <p class="titre" style="height:20px">'
    .$donnees['titre']
    .'<p> 
    
    <a href="./img/comics/'.$donnees["serie"].$donnees["numero"].'" target="_blank"><img src="./img/comics/'.$donnees["serie"].$donnees["numero"].'" alt="" style="width:150px"></a><br/>';
    
    //Auteurs
    if(isset($_GET['auteur'])){ //Verifie que la checkbox a été checkée
        echo '<p><strong>Auteurs:</strong><br/>';
        for ($i = 1; $i <= 5; $i++){ //Echo chaque auteurs si la colonne ne contient pas de valeur null
            echo (isset($donnees['auteur_'.$i])) ? $donnees['auteur_'.$i].'<br/>' : null ;
        }
        echo '</p>';}
        
        //Dessinateurs
        if(isset($_GET['dessinateur'])){ //Verifie que la checkbox a été checkée
            echo '<p><strong>Dessinateurs:</strong><br/>';
            for ($i = 1; $i <= 6; $i++){ //Echo chaque auteurs si la colonne ne contient pas de valeur null
                echo (isset($donnees['dessinateur_'.$i])) ? $donnees['dessinateur_'.$i].'<br/>' : null ;
            }
            echo '</p>';}
            
            
            //Cover Artist
            if(isset($_GET['cover'])){ //Verifie que la checkbox a été checkée
                echo (isset($donnees['cover'])) ? '<p><strong>Cover:</strong><br/>'.$donnees['cover'].'<br/>' : null ;} //Echo le cover artist si la colonne n'est pas null
                echo '</div>
                </div>
                </div>
                ';
            }
?>