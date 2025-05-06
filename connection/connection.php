<?php

$servername = 'localhost'; // variable qui contient le nom du serveur
$bdd= 'biblio'; // variable qui contient le nom de la base de données
$username = 'root'; // variable qui contient nom utilisateur
$password = ''; // variable qui contient mot de passe 

try
{
    $pdo = new PDO("mysql:host=$servername;dbname=$bdd;charset=utf8" , $username, $password);
    
}

    /* on capture les exeptions si une exeption est lancée et on affiche * les informations relatives ) celle-ci */


    catch(PDOException $e)
    {
        echo "Erreur : " . $e ->getMessage();  
    }

?>