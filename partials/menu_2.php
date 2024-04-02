<?php //fichier: animation/partials/menu.php

//on récupère l'adresse du fichier en cours
$filePath = $_SERVER['PHP_SELF'];

//on découpe selon le slash
$tPath = explode('/', $filePath);

//on récupère la dernière case du tableau
$file = array_pop($tPath);

var_dump($file);

?>
<header>
    <h1><a href="index.php"><i class="fa-solid fa-film"></i> Animation</h1>
</header>

<nav>
    <a href="index.php" class="<?= ($file == 'index.php') ? 'active' : '' ?>"><i class="fa-solid fa-house"
            aria-hidden="true"></i>
        Accueil</a>
    <a href="movies.php" class="<?= ($file == 'movies.php' || $file == 'movieinfo.php') ? 'active' : '' ?>"><i
            class="fa-solid fa-film" aria-hidden="true"></i> Les Films</a>
    <a href="addmovie.php" class="<?= ($file == 'addmovie.php') ? 'active' : '' ?>"><i class="fa-solid fa-plus"
            aria-hidden="true"></i>
        Ajouter un film</a>
</nav>

<div class="messages">
    <?php flash_out(); ?>
</div>