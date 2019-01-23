<?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=ma_musique;charset=utf8','root','');
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
        <title>Ma Musique</title>

        <link rel="stylesheet" href="./public/css/music.css">

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
                        while ($donnees = $requete->fetch()) {
                            echo '
                            <div class="carousel-item">
                            <a href="./img/musique/'.$donnees['titre'].'" target="_blank"><img src="./img/musique/'.$donnees["titre"].'.jpg" alt="" class="d-block w-100"></a>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>

        <!--TEST AFFICHAGE COMICS-->
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
                                <label class="dropdown-item"><input type="checkbox" name="bands[]" value="Judas Priest" <?php echo ((isset($_GET['bands']) && in_array('Judas Priest', $_GET['bands']))) ? 'checked' : null ;?> >Judas Priest</label>
                                <label class="dropdown-item"><input type="checkbox" name="bands[]" value="Paradise Lost" <?php echo ((isset($_GET['bands']) && in_array('Paradise Lost', $_GET['bands']))) ? 'checked' : null ;?> >Paradise Lost</label>
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
                                <label class="dropdown-item"><input type="checkbox" name="genres[]" value="Doom Metal" <?php echo ((isset($_GET['genres']) && in_array('Doom Metal', $_GET['genres']))) ? 'checked' : null ;?> >Doom</label>
                                <label class="dropdown-item"><input type="checkbox" name="genres[]" value="Gothic Metal" <?php echo ((isset($_GET['genres']) && in_array('Gothic Metal', $_GET['genres']))) ? 'checked' : null ;?> >Gothic</label>
                                <label class="dropdown-item"><input type="checkbox" name="genres[]" value="Heavy Metal" <?php echo ((isset($_GET['genres']) && in_array('Heavy Metal', $_GET['genres']))) ? 'checked' : null ;?> >Heavy</label>
                            </div>
                        </div>
                    </div>
                </div>
               
                <button type="submit" value="submit" class="mt-3 btn btn-dark text-light">OK</button>
            </form>

        
            <?php
                //Construction de ma query (car nombre de genres/groupes variable)
                if (isset($_GET['genres'])){
                    $genres = $_GET['genres'];
                }
                if (isset($_GET['bands'])){
                    $bands = $_GET['bands'];
                }


                //Subquery pour chercher les groupes
                $subquery = ('musique');
                if (isset($bands) && sizeof($bands) != 0){
                    $subquery = ('SELECT * FROM musique');
                    $i=0;
                    foreach($bands as $band){
                        if ($i>0){
                            $subquery = $subquery.(' OR groupe = "'.$band.'"');
                        } else {
                            $subquery = $subquery.(' WHERE groupe = "'.$band.'"');
                            $i++;
                        }
                    }
                }


                //Ajout de la subquery à la query principale
                if ($subquery != 'musique'){
                    $query = ('SELECT * FROM ('.$subquery.') AS bands');
                } else {
                    $query = ('SELECT * FROM musique');
                }
                

                //Query pour chercher les genres à partir des groupes
                if (isset($genres) && sizeof($genres) != 0){
                    $i=0;
                    foreach($genres as $genre){
                        if ($i>0){
                            $query = $query.(' OR genre = "'.$genre.'"');
                        } else {
                            $query = $query.(' WHERE genre = "'.$genre.'"');
                            $i++;
                        }
                    }
                } 
                $query = $query.(' ORDER BY groupe, annee DESC');
                
                
                //execution de ma query 
                print_r($_GET);
                echo '<br/>';
                print_r($query);
                $requete = $db->query($query);
                
            ?>

            <div class="row w-75 mx-auto">
                <?php
                    //affichache du resultat de la query
                    while ($donnees = $requete->fetch()) {
                        echo '
                            <div class="col text-center mb-5">
                                <img src="./img/logo/'.$donnees['groupe'].'_LOGO.png" alt="" style="width:150px;">
                                <p style="height:30px">'.$donnees['titre'].'</p>
                                <a href="./img/musique/'.$donnees['titre'].'" target="_blank"><img src="./img/musique/'.$donnees['titre'].'.jpg" style="width:200px;height:200px"></a><br/>
                                <p style="height:5px;">'.$donnees['annee'].'</p> 
                                <p>'.$donnees['genre'].'</p> 
                            </div>';
                    }
                ?>
                
            </div>
        </section>
	</body>
</html> 