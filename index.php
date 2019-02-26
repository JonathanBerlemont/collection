<?php
    session_start();

    //Connecte la db
    include './src/php/index/db_connect.php';

    //Incrémente le compteur
    include './src/php/compteur.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mes Comics</title>

        <link rel="stylesheet" href="./public/css/index.css">

        <link rel="icon" href="./public/img/icon.png">
    </head>

	<body class="shadow">
        <!--Bar de navigation-->
        <?php include './src/php/navbar.php' ?>
        
        <!--Titre-->
        <section id="titre"><h1 class="text-center mt-4 py-3 bg-dark text-light"><strong>COMICS</strong></h1></section>
        
        <h3 class="text-center">C'est la <?php echo $compteur ?>ème visite de ce site</h3>

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
                        //Print le carousel
                        include './src/php/index/print_carousel.php';
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
                //Va chercher les comics dans la db
                include './src/php/index/get_comics.php';
            ?>

            <div class="row w-75 mx-auto">
                <?php
                //Print les comics
                    include './src/php/index/print_comics.php';
                ?>
            </div>
        </section>

        <script src="./node_modules/jquery/dist/jquery.js"></script>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
	</body>
</html> 