<?php
    session_start();

    try {
        $db = new PDO('mysql:host=localhost;dbname=mes_comics;charset=utf8','root','');
    } catch(Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mes Comics</title>

        <link rel="stylesheet" href="./public/css/index.css">

        <link rel="icon" href="./img/icon.png">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    </head>

	<body class="shadow">
        <!--Bar de navigation-->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Ma collection</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Comics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./music.php">Musique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Romans</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!--Titre-->
        <section id="titre"><h1 class="text-center mt-4 py-3 bg-dark text-light"><strong>COMICS</strong></h1></section>

        <!--CAROUSEL-->
        <section id="carousel" class="my-5 bg-dark">
            <?php
                $requete = $db->query('SELECT serie, numero
                                        FROM comics
                                        LIMIT 10
                                        ');
            ?>
            <div id="carouselExampleSlidesOnly" class="carousel slide mx-auto" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="text-center text-light spiderman" style="margin-top: 50px; font-size: 50px">Bienvenue</p>
                    </div>
                    <?php
                        while ($donnees = $requete->fetch()) {
                            echo '
                            <div class="carousel-item">
                            <a href="./img/comics/'.$donnees["serie"].$donnees["numero"].'" target="_blank"><img src="./img/comics/'.$donnees["serie"].$donnees["numero"].'" alt="" class="d-block w-100"></a>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>
        
        <!--TEST AFFICHAGE COMICS-->
        <section id="comics">
            <!--Différentes categories d information-->           
            <form class="mx-auto border rounded border-secondary mb-5 p-3 text-center" style="max-width:400px" method="get"> 

                <div class="row">
                    <div class="col-12 col-sm-6"> <!--Dropdown pour les categories d information-->
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Displayed Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <label class="dropdown-item"><input type="checkbox" name="auteur" value="auteurs" <?php echo (isset($_GET['auteur'])) ? 'checked' : null ;?> >Auteurs</label>
                                <label class="dropdown-item"><input type="checkbox" name="dessinateur" value="dessinateur" <?php echo (isset($_GET['dessinateur'])) ? 'checked' : null ;?> >Dessinateurs</label>
                                <label class="dropdown-item"><input type="checkbox" name="cover" value="cover" <?php echo (isset($_GET['cover'])) ? 'checked' : null ;?> >Cover Artist</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <!--Dropdown pour le hero-->
                        <div class="dropdown mt-3 mt-sm-0">
                            <button class="btn btn-danger dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hero/Equipe
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <label class="dropdown-item"><input type="checkbox" name="auteur" value="spiderman" <?php echo (isset($_GET['spiderman'])) ? 'checked' : null ;?> >Spider-Man</label>
                                <label class="dropdown-item"><input type="checkbox" name="dessinateur" value="venom" <?php echo (isset($_GET['venom'])) ? 'checked' : null ;?> >Venom</label>
                            </div>
                        </div>
                    </div>
                </div>
               
                <button type="submit" value="submit" class="mt-3 btn btn-primary text-light">OK</button>
            </form>
            
        
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


            <div class="row w-75 mx-auto">
                <?php
                    while ($donnees = $requete->fetch()) {
                        echo '
                        <div class="col text-center mb-5">
                            
                            <div class="comicBackground"></div>
                            <div class="comicContenu text-light pt-3">
                                <strong class="text-danger spiderman">'
                                .$donnees['serie']
                                .'</strong><br/>

                                <p class="titre" style="height:20px">'
                                .$donnees['titre']
                                .'<p> 

                                <a href="./img/comics/'.$donnees["serie"].$donnees["numero"].'" target="_blank"><img src="./img/comics/'.$donnees["serie"].$donnees["numero"].'" alt="" style="width:150px"></a><br/>';

                                if(isset($_GET['auteur'])){ //Verifie que la checkbox a été checkée
                                    echo '<p><strong>Auteurs:</strong><br/>';
                                    for ($i = 1; $i <= 5; $i++){ //Echo chaque auteurs si la colonne ne contient pas de valeur null
                                        echo (isset($donnees['auteur_'.$i])) ? $donnees['auteur_'.$i].'<br/>' : null ;
                                    }
                                    echo '</p>';}
                                
                                if(isset($_GET['dessinateur'])){ //Verifie que la checkbox a été checkée
                                    echo '<p><strong>Dessinateurs:</strong><br/>';
                                    for ($i = 1; $i <= 6; $i++){ //Echo chaque auteurs si la colonne ne contient pas de valeur null
                                        echo (isset($donnees['dessinateur_'.$i])) ? $donnees['dessinateur_'.$i].'<br/>' : null ;
                                    }
                                    echo '</p>';}

                                if(isset($_GET['cover'])){ //Verifie que la checkbox a été checkée
                                    echo (isset($donnees['cover'])) ? '<p><strong>Cover:</strong><br/>'.$donnees['cover'].'<br/>' : null ;} //Echo le cover artist si la colonne n'est pas null
                            echo '</div>
                            </div>
                        
                        
                        ';
                    }
                ?>
                
            </div>
        </section>
	</body>
</html> 