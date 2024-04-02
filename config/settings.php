<?php //fichier : animation/config/settings.php

//on demarre la session
session_start();


/************
 * DATABASE *
 * **********/
define('SQL_HOST', 'localhost');
define('SQL_USER', 'root');
define('SQL_PASS', ''); // 'root' pour mac, '' pour windows
define('SQL_DBNAME', 'b1b_animation');


try {
    //on utilise les constantes pour se connecter à la base
    $sql = new PDO('mysql:dbname=' . SQL_DBNAME . ';charset=utf8;host=' . SQL_HOST, SQL_USER, SQL_PASS);

} catch (Exception $e) {
    //si ça a planté, on arrête tout et on écrit le message
    die('Erreur : ' . $e->getMessage());
}



/************
 * DATABASE *
 * **********/
// on ajoute le fichier qui contient nos fonctions
require ('functions.php');
