<?php
while ($donnees = $requete->fetch()) {
    echo '
    <div class="col text-center mb-5 album">
    <div style="width:180px;height:100px;margin:auto;"><img src="./public/img/logo/'.$donnees['groupe'].'_LOGO.png" alt="" style="width:100%;"></div>
    <p style="height:35px">'.$donnees['titre'].'</p>
    <a href="./public/img/musique/'.$donnees['titre'].'" target="_blank"><img src="./public/img/musique/'.$donnees['titre'].'.jpg" style="width:200px;height:200px"></a><br/>
    <p style="height:5px;">'.$donnees['annee'].'</p>
    <p>'.$donnees['genre'].'</p> 
    </div>';
}
?>