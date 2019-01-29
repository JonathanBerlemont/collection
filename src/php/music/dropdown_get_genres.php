<?php 
    $requete = $db->query('SELECT DISTINCT genre
                            FROM musique
                            ');
    while ($donnees = $requete->fetch()) {
        echo '<label class="dropdown-item">';
        echo '<input type="checkbox" name="genres[]" value="'.$donnees['genre'].'"';
        echo ((isset($_GET['genres']) && in_array($donnees['genre'], $_GET['genres']))) ? 'checked' : null ; 
        echo '>'.$donnees['genre'];
        echo '</label>';
    }
?>