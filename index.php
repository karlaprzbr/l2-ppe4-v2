<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");
?>

<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main" class="index">
            <div class="homeHeader">
                <h1>VOUS NE VOUS EN SERVEZ PLUS ?<br>VENDEZ-LE !</h1>
            </div>
            <img src="img/home.jpeg" alt="" class="banniere">
        </div>

    </body>
</html>
