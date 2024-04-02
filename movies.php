<?php //fichier //animation/movies.php

//on ajoute la config du site
include ('config/settings.php');

//var_dump($_POST);

//si on a reçu le formulaire
if (!empty($_POST)) {

    //on prepare la requete de suppression avec l'id
    $delete = $sql->prepare('DELETE FROM movies WHERE id = :i');

    //on l'execute
    $delete->execute([':i' => $_POST['id']]);

    //message succes
    flash_in('success', 'Le film a bien été supprimé');

    //redirection / recharger
    redirect($_SERVER['PHP_SELF']);
}

//on cree la requete
$readMovies = $sql->prepare('SELECT * FROM movies LEFT JOIN ( SELECT movie_id, COUNT(*) AS nbPerso FROM people GROUP BY movie_id) AS tabletemporaire ON tabletemporaire.movie_id = movies.id ORDER BY title');

//on execute la requete
$readMovies->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('partials/head.php'); ?>
    <title>Animation - Liste des films</title>
</head>

<body>
    <?php
    include ('partials/menu.php');
    ?>
    <main>
        <h1>Liste des films</h1>
        <p>Dans la base, il y a
            <?php echo $readMovies->rowCount(); ?> films
        </p>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Réalisateur</th>
                    <th>Date de sortie</th>
                    <th>Nombre de personnages</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //si on a zéro lignes dans la base
                if ($readMovies->rowCount() == 0) {
                    echo '<tr><td colspan="3" class="empty">Aucun film</td></tr>';
                } else {
                    //on cree une boucle qui tourne tant qu'il reste des resultats non lus dans le requete
                    while ($data = $readMovies->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <?php
                        //var_dump($data);
                        ?>
                        <tr>
                            <td><a href="movieinfo.php?id=<?= $data['id'] ?>">
                                    <?= $data['title'] ?>
                                </a>
                            </td>
                            <td>
                                <?= $data['director'] ?>
                            </td>
                            <td>
                                <?= dateFR($data['releasedate']) ?>
                            </td>
                            <td>
                                <?= $data['nbPerso'] ?>
                            </td>
                            <td>
                                <form class="delete" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <button type="submit" class="button" name="deletemovie">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>