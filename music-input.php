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
    <title>Ajout d'albums</title>

    <link rel="stylesheet" href="./public/css/music-input.css">
</head>
<body>
    
    <h1>Music Input</h1>

    <form action="upload_album.php" method="post" enctype="multipart/form-data">
        <table>
            <tr><td>Image Cover</td><td><input type="file" name="cover" id="cover"></td></tr>
            <tr><td>Band</td><td><input type="text" name="band" id="band"></td></tr>
            <tr><td>Genre</td><td><input type="text" name="genre" id="genre"></td></tr>
            <tr><td>Year</td><td><input type="number" name="year" id="year"></td></tr>
        </table>

        <button type="submit">Submit</button>
    </form>

    <?php echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>"; ?>

    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>