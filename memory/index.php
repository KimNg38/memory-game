<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Jeu Memory</title>
        <!-- feuille de style -->
        <link rel="stylesheet" href="public/css/styles.min.css" />
    </head>
    <body>
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>
        <!-- Javascript -->
        <script src="public/js/memory.js"></script>

        <?php
        require("view/header.php"); // l'entête
        require('view/index_view.php'); // le corps 
        require("view/footer.php"); // le pied de page
        ?> 
    </body>
</html>