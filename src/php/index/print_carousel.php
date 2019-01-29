<?php
    while ($donnees = $requete->fetch()) {
        echo '
        <div class="carousel-item">
        <a href="./img/comics/'.$donnees["serie"].$donnees["numero"].'" target="_blank"><img src="./img/comics/'.$donnees["serie"].$donnees["numero"].'" alt="" class="d-block w-100"></a>
        </div>
        ';
    }
?>