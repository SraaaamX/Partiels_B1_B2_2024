<?php //fichier //animation/addmovie.php

//on ajoute la config du site
include ('config/settings.php');

//si on a reçu un formulaire
if (!empty($_POST)) {

    //on initialise les erreurs
    $error = false;

    //on supprime tous les espaces en trop (en debut ou fin de chaine)
    $_POST = array_map('trim', $_POST);

    //si le titre est vide
    if (empty($_POST['t'])) {

        //on cree un message d'erreur
        flash_in('error', 'Le titre est obligatoire');
        //on enregistre une erreur
        $error = true;
    } //fin titre

    //si on a eu une erreur
    if ($error) {
        // echo 'ça a planté';
        //on redirige vers le form
        redirect('addmovie.php');
    } else { //sinon
        echo 'ça marche';

        //pour les champs non obligatoires, si un champ est vide, on le remplace par null
        if (empty($_POST['d'])) {
            $_POST['d'] = null;
        }

        if (empty($_POST['s'])) {
            $_POST['s'] = null;
        }

        if (empty($_POST['r'])) {
            $_POST['r'] = null;
        }
        //on prepare la requete d'ajout
        $new = $sql->prepare('INSERT INTO movies (title, director, synopsis, releasedate) VALUES (:ti, :di, :sy, :re)');
        //on l'execute avec les bonnes données
        $new->execute([':ti' => $_POST['t'], ':di' => $_POST['d'], ':sy' => $_POST['s'], ':re' => $_POST['r']]);
        //on cree un message de confirmation
        flash_in('success', 'Le film a été ajouté');
        //on redirige vers la fiche du film qu'on vient de créer
        redirect('movieinfo.php?id=' . $sql->lastInsertId());
    }//fin test

    var_dump($_POST);
} //fin formulaire


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('partials/head.php'); ?>
    <title>Animation</title>
</head>

<body>
    <?php
    include ('partials/menu.php');
    ?>
    <main>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">

            <h1>Ajouter un film</h1>

            <p>
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="t" placeholder="Ex: Avatar">
            </p>
            <p>
                <label for="realisateur">Réalisateur</label>
                <input type="text" id="realisateur" name="d" placeholder="Ex: James Cameron">
            </p>
            <p>
                <label for="synopsis">Synopsis</label>
                <textarea id="synopsis" name="s"></textarea>
            </p>
            <p>
                <label for="sortie">Date de sortie</label>
                <input type="date" id="sortie" name="r">
            </p>
            <p>
                <button type="submit">Envoyer</button>
            </p>
        </form>
    </main>
</body>

</html>