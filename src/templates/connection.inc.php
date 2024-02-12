<?php

//A déplacer à la racine du projet une fois rempli
//Ne pas envoyer sur le github une fois rempli

$servername = "mysql2.ouiheberg.com";
$port = "3306";
$username = "u3377_NwoQzma0Jn";
$password = "5jvxEBJ@jRNLcZlCYMj.d3Hs";
$dbname = "s3377_jadenn";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
