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

    </head>

	<body class="shadow">
        <!--Bar de navigation-->
        <?php include './src/php/navbar.php' ?>

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
                        //Affichage des différentes images du carousel
                        include './src/php/music/print_carousel.php';
                    ?>
                </div>
            </div>
        </section>
        <!--AFFICHAGE ALBUMS-->
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
                                    //Affichage des différents groupes
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
                                    //Affichage des différents genres
                                    include './src/php/music/dropdown_get_genres.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <button id="btn-reset" class=" mt-3 btn btn-dark">Reset</button>
                <button type="submit" class="mt-3 btn btn-dark text-light">OK</button>
            </form>
        
            <?php
                //Query pour recupérer les albums
                include './src/php/music/get_albums.php'
            ?>

            <div class="row w-75 mx-auto">
                <?php
                    //affichage du resultat de la query
                    include './src/php/music/print_albums.php'
                ?>
                
            </div>
        </section>

        <script src="./src/js/music.js" type="module"></script>
        <script src="./node_modules/jquery/dist/jquery.js"></script>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
	</body>
</html> 