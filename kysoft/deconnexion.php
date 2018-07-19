<!DOCTYPE html>
<?php

session_start();
$_SESSION = array();
session_unset();

?>

<html>
    <head>
        <title>Déconnexion</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Deconnexion effectuée</h1>
        <p>Vous avez été déconnecté avec succès.</p>
        <a href="accueil.php">Fermer</a>
    </body>
</html>