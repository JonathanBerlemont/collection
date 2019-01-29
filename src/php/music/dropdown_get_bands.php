<?php 
    $requete = $db->query('SELECT DISTINCT groupe
                            FROM musique
                            ');
    while ($donnees = $requete->fetch()) {
        echo'<label class="dropdown-item">';
        echo'<input type="checkbox" name="bands[]" value="'.$donnees['groupe'].'"'; 
        echo ((isset($_GET['bands']) && in_array($donnees['groupe'], $_GET['bands']))) ? 'checked' : null ;
        echo '>'.$donnees['groupe'];
        echo '</label>';
    }
?>