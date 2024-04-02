<?php //fichier : config/functions.php


/*
on cree une fonction qui prend en parametre une date au format informatique 'YYY-MM-DD' et qui nous la transforme au format 'DD/MM/AAAA'
*/
function dateFR($in)
{
    //si la date d'entrée n'est pas vide
    if (!empty($in)) {

        //on cree un objet temporel initialisé avec la date donnée
        $d = new DateTime($in);

        //on retourne cette date au format souhaité
        return $d->format('d/m/Y');
    }
}

function hour($in)
{
    //si l'heure d'entrée n'est pas vide
    if (!empty($in)) {

        //on cree un objet temporel initialisé avec l'heure donnée
        $d = new DateTime($in);

        //on retourne cette heure au format souhaité
        //Exemple 1h34
        return $d->format('G\hi');
    }
}

//fonction qui redirige vers l'emplaement choisi et coupe toutes les instructions suivantes
function redirect($destination)
{
    //redirection
    header('Location: ' . $destination);
    //stop toute autre instruction
    exit();
}

//fonction uqi nous donne le chemoin complet pour afficher le poster OU l'image par défaut si le poster est vide.
function posterSrc($in)
{
    if (empty($in)) {
        return 'img/moviedefault.jpg';
    } else {
        return 'data/' . $in;
    }
}


// Fonction qui ajoute un message en mémoire avec son type
function flash_in($type, $content)
{
    // Si le tableau des messages n'existe pas en mémoire,
    if (!isset($_SESSION['messages'])) {
        // on le crée
        $_SESSION['messages'] = [];
    } //fin test

    // On ajoute le message et son type dans le tableau
    array_push($_SESSION['messages'], [$type, $content]);
}

//fonction qui affiche tous les messages en memoire, et les supprime
function flash_out()
{

    //si le tableau n'est pas vide
    if (!empty($_SESSION['messages'])) {

        //pour chaque case du tableau
        foreach ($_SESSION['messages'] as $m) {

            $icon = 'circle-exclamation';

            //si le type est error
            if ($m[0] == 'error') {
                $icon = 'circle-xmark';
            } elseif ($m[0] == 'success') {
                $icon = 'circle-check';
            }

            //on cree un paragraphe avec le bon texte (et le bon style)
            echo '<p class="alert ' . $m[0] . '"><i class="fa-solid fa-' . $icon . '"></i> ' . $m[1] . '<i class="fa-solid fa-xmark close"></i></p>';

        }//fin de la boucle

    }//fin du test

    //on vide les messages (on les remplace par un tableau vide)
    $_SESSION['messages'] = [];
}