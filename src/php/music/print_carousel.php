<?php
    while ($donnees = $requete->fetch()) {
        echo '
        <div class="carousel-item">
        <a href="./public/img/musique/'.$donnees['titre'].'" target="_blank"><img src="./public/img/musique/'.$donnees["titre"].'.jpg" alt="" class="d-block w-100"></a>
        </div>
        ';
    }
?>