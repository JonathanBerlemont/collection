<?php
    //connection à la db
    include './src/php/music/db_connect.php';

    //incrémentation du compteur
    include './src/php/compteur.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ma Musique</title>

        <link rel="stylesheet" href="./public/css/music.css">

        <link rel="icon" href="./public/img/icon.png">

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
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Comics</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Musique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Romans</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!--Titre-->
        <section id="titre"><h1 class="text-center mt-4 py-3 bg-dark text-light"><strong>MUSIQUE</strong></h1></section>

        <h3 class="text-center">C'est la <?php echo $compteur?>ème visites de ce site</h3>

        <!--CAROUSEL-->
        <section id="carousel" class="my-5 bg-dark">
            <?php
                $requete = $db->query('SELECT titre
                                        FROM musique
                                        LIMIT 10
                                        ');
            ?>
            <div id="carouselExampleSlidesOnly" class="carousel slide mx-auto" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="text-center text-light maiden" style="margin-top: 50px; font-size: 50px">Bienvenue</p>
                    </div>
                    <?php
                        include './src/php/music/print_carousel.php';
                    ?>
                </div>
            </div>
        </section>
        <!--TEST AFFICHAGE ALBUMS-->
        <section id="album">
            <!--Filters-->           
            <form class="mx-auto border rounded border-secondary mb-5 p-3 text-center" style="max-width:400px;" method="get"> 

                <div class="row">
                    <div class="col-12 col-sm-6"> 
                        <!--Dropdown pour les groupes-->
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Groupes
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php 
                                    include './src/php/music/dropdown_get_bands.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <!--Dropdown pour les genres-->
                        <div class="dropdown mt-3 mt-sm-0">
                            <button class="btn btn-danger dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Genres
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php 
                                    include './src/php/music/dropdown_get_genres.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
               
                <button type="submit" value="submit" class="mt-3 btn btn-dark text-light">OK</button>
            </form>

        
            <?php
                include './src/php/music/get_albums.php'
                
            ?>

            <div class="row w-75 mx-auto">
                <?php
                    //affichage du resultat de la query
                    include './src/php/music/print_albums.php'
                ?>
                
            </div>
        </section>
	</body>
</html> 