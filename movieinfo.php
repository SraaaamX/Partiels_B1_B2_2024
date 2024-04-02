<?php //fichier //animation/movieinfo.php

//on ajoute la config du site
include ('config/settings.php');

//si on a pas l'id dans l'url, 
if (empty ($_GET['id'])) {
    //on redirige tout de suite vers l'accueil
    redirect('movies.php');
}

//on cree une requete qui va chercher les infos du film dont on a l'id
$searchMovie = $sql->prepare('SELECT * FROM movies WHERE id = :i');

//on execute la requete en lui donnant la valeur de la psuedo variable
$searchMovie->execute([':i' => $_GET['id']]);

//si le résultat ne donne aucunes ligne
if ($searchMovie->rowCount() == 0) {
    //on retounre vers l'accueil
    redirect('movies.php');
} else {
    //sinon, on lit les infos
    $data = $searchMovie->fetch(PDO::FETCH_ASSOC);
}

//on cree une requette qui va chercher les personnages de ce film
$listPeople = $sql->prepare('SELECT * FROM people WHERE movie_id = :i ORDER BY name');

//on execute la requette
$listPeople->execute([':i' => $_GET['id']]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('partials/head.php'); ?>
    <title>Animation -
        <?= $data['title']; ?>
    </title>
</head>

<body>
    <?php
    include ('partials/menu.php');
    ?>
    <main>
        <h1>
            <?= $data['title']; ?>
        </h1>
        <p>
            <span class="label">Réalisateur</span>
            <?php
            if (empty ($data['director'])) {
                echo 'n.c.';
            } else {
                echo $data['director'];
            } ?>
        </p>
        <p>
            <span class="label">Synopsis</span>
            <?= (empty ($data['synopsis'])) ? 'n.c.' : $data['synopsis']; ?>
        </p>
        <p>
            <span class="label">Genre</span>
            <?= (empty ($data['genre'])) ? 'n.c.' : $data['genre']; ?>
        </p>
        <p>
            <span class="label">Durée</span>
            <?= (empty ($data['duration'])) ? 'n.c.' : hour($data['duration']); ?>
        </p>
        <p>
            <span class="label">Date de Sortie</span>
            <?= (empty ($data['releasedate'])) ? 'n.c.' : dateFR($data['releasedate']) ?>
        </p>
        <figure>
            <img src="<?= posterSrc($data['poster']) ?>">
        </figure>
        <h2>Les personnages</h2>
        <?php
        if ($listPeople->rowCount() == 0) { ?>
            <p class="unknow">Aucun personnage enregistré</p>
        <?php } else { ?>
            <ul class="listvisible">
                <?php while ($unPerso = $listPeople->fetch(PDO::FETCH_ASSOC)) { ?>
                    <li>
                        <?= $unPerso['name'] ?>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </main>
</body>

</html>