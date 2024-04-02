<?php //fichier //animation/index.php

//on ajoute la config du site
include ('config/settings.php');


//on cree la requete
$readQuotes = $sql->prepare('SELECT * FROM quotes ORDER BY content ASC');

//on execute la requete
$readQuotes->execute();


// TEST : A SUPPRIMER PLUS TARD
// flash_in('success', 'ça marche !');
// flash_in('error', 'raté !');
// flash_in('warning', 'bof');

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
        <h1>Les citations</h1>
        <p>Dans la base, il y a
            <?php echo $readQuotes->rowCount(); ?> citations
        </p>
        <ul>
            <?php
            //on cree une boucle qui tourne tant qu'il reste des resultats non lus dans le requete
            while ($data = $readQuotes->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <li>
                    <?php
                    //var_dump($data);
                    ?>
                    <blockquote>
                        <?php echo $data['content']; ?>
                        <cite>
                            <?php echo $data['author']; ?>
                        </cite>
                    </blockquote>
                </li>
                <?php
            }
            ?>
        </ul>
    </main>
</body>

</html>