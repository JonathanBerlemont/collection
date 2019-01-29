<?php
    while ($donnees = $requete->fetch()) {
        echo '
        <div class="carousel-item">
        <a href="./img/musique/'.$donnees['titre'].'" target="_blank"><img src="./img/musique/'.$donnees["titre"].'.jpg" alt="" class="d-block w-100"></a>
        </div>
        ';
    }
?>