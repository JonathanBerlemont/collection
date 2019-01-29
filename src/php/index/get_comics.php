<?php
    $requete = $db->query('SELECT * 
                            FROM (
                                SELECT *
                                FROM comics
                                LEFT JOIN auteurs
                                ON comics.id = auteurs.comic_id
                            ) previous_query
                            LEFT JOIN dessinateurs
                            ON previous_query.id = dessinateurs.comic_id
                            
                            ');
?>