<?php

include_once('connection.inc.php');
include_once('src/classes/User.php');
$conn = null;
try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

function getInfosUser(String $sql) : user {

    global $conn;

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if ($result > 0) {
        return new user($tab[0]['id'], $tab[0]['pseudo'], $tab[0]['email'], $tab[0]['description'], $tab[0]['avatar'], $tab[0]['jeu_fav']);
    }

}

/**
 * Récupère un utilisateur avec son id
 *
 * @param string     $id     Identifiant du compte
 *
 * @return user      retourne l'utilisateur sous forme d'objet user
 */
function getUserById(int $id) : user {
    global $conn;
    $sql = "SELECT * FROM user WHERE id = '$id'";
    return getInfosUser($sql);
}

/**
 * Récupère un utilisateur avec son pseudo
 *
 * @param string     $pseudo     Pseudo du compte
 *
 * @return user      retourne l'utilisateur sous forme d'objet user
 */
function getUserByPseudo(String $pseudo) : user {

    global $conn;
    $sql = "SELECT * FROM user WHERE pseudo = '$pseudo'";
    return getInfosUser($sql);

}

/**
 * Récupère un utilisateur avec son adresse e-mail
 *
 * @param string     $email     Adresse e-mail du compte
 *
 * @return user      retourne l'utilisateur sous forme d'objet user
 */
function getUserByEmail(String $email) : user {

    global $conn;
    $sql = "SELECT * FROM user WHERE email = '$email'";
    return getInfosUser($sql);

}

/**
 * Récupère le mot de passe d'un utilisateur
 *
 * @param user     $user    Utilisateur
 *
 * @return string  retourne le mot de passe
 */
function getMDP(user $user) : String {
    $id = $user->getID();
    global $conn;
    $sql = "SELECT password FROM user WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if ($result > 0) {
        return $tab[0]['password'];
    }
    else {

        return null;

    }

}

/**
 * Enregistre un nouvel utilisateur à la base de données
 *
 * @param string     $pseudo    Pseudo du compte
 * @param string     $mdp       Mot de passe du compte
 * @param string     $email     Adresse e-mail du compte
 *
 * @return int Resultat -> 1: le pseudo existe déjà; 2: le mail existe déjà; 3: erreur de BDD; 0: pas de problèmes
 */
function registerNewUser(string $pseudo, string $mdp, string $email) : int {

    global $conn;
    $sql = "SELECT * FROM user WHERE pseudo = '$pseudo'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        echo $tab[0]['pseudo'];
        return 1;

    }
    else {

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $stmt->fetchAll();
        if (count($tab) > 0) {

            return 2;

        }
        else {

            try{
                $sql = "INSERT INTO user (pseudo, email, password) VALUES ('$pseudo', '$email', '$mdp')";
                $conn->exec($sql);
                return 0;
            }
            catch (PDOException $e) {

                echo $e->getMessage();
                return 3;

            }

        }

    }

}



// fonction fourre-tout pour récupérer des informations de la base de données
// prend une commande SQL en paramètre (pour les autres fichiers php)
function getInfosFromDatabase(String $sql) {

    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $result; // retourne un tuple d'informations

}

?>