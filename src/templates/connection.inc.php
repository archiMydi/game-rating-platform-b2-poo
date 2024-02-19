<?php

//A déplacer à la racine du projet une fois rempli
//Ne pas envoyer sur le github une fois rempli

$servername = "localhost";
$port = "port";
$username = "user";
$password = "password";
$dbname = "db name";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}