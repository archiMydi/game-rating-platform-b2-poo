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

/**
 * Récupère les informations d'un utilisateur s'il existe
 *
 * @param string     $sql Requête SQL
 *
 * @return user      retourne l'utilisateur sous forme d'objet user ou null s'il n'existe pas
 */
function getInfosUser(String $sql) : ?user {

    global $conn;

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        return new user($tab[0]['id'], $tab[0]['pseudo'], $tab[0]['email'], $tab[0]['description'], $tab[0]['avatar'], $tab[0]['jeu_fav']);
    }
    else {
        return null;
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
 * Récupère un utilisateur avec son pseudo / son adresse email et son mot de passe
 *
 * @param string     $id     Pseudo ou adresse email
 * @param string     $mdp    Mot de passe
 *
 * @return user      retourne l'utilisateur sous forme d'objet user ou null s'il n'existe pas
 */
function getUser(string $id, string $mdp) : ?user {
    global $conn;
    $sql = "SELECT * FROM user WHERE (pseudo = '$id' OR email = '$id') AND password = '$mdp'";
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
                $sql = "INSERT INTO user (pseudo, email, password) VALUES ('$pseudo', '$email', '$mdp');";
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

/**
 * Enregistre une note pour un jeu
 *
 * @param int     $id_user   Identifiant de l'utilisateur
 * @param int     $id_game   Identifiant du jeu
 * @param array     $notes     Liste des notes
 *
 * @return int Resultat -> 1: erreur de BDD; 0: pas de problèmes
 */
function insertRating(int $id_user, int $id_game, array $notes) : int {

    global $conn;

    $sql = 'INSERT INTO rating (criterion_id, game_id, user_id, value) VALUES ';
    $i = 0;

    foreach($notes as $id => $note) {

        if($i+1 === count($notes)) {
            $sql .= "($id, $id_game, $id_user, $note)";
        }
        else {
            $sql .= "($id, $id_game, $id_user, $note),";
            $i++;
        }

    }

    try{
        $conn->exec($sql);
        return 0;
    }
    catch (PDOException $e) {

        echo $e->getMessage();
        return 1;

    }

}

/**
 * Enregistre une note pour un jeu
 *
 * @param int     $id_user   Identifiant de l'utilisateur
 * @param int     $id_game   Identifiant du jeu
 * @param array     $notes     Liste des notes
 *
 * @return int Resultat -> 1: erreur de BDD; 0: pas de problèmes
 */
function updateRating(int $id_user, int $id_game, array $notes) : int {

    global $conn;

    $sql = "";

    foreach($notes as $id => $note) {

        if(checkRated($id, $id_game, $id_user)) {

            $sql .= "UPDATE rating SET value = $note WHERE criterion_id = $id AND game_id = $id_game AND user_id = $id_user;";

        }
        else {

            $sql .= "INSERT INTO rating (criterion_id, game_id, user_id, value) VALUES ($id, $id_game, $id_user, $note);";

        }

    }

    try{
        $conn->exec($sql);
        return 0;
    }
    catch (PDOException $e) {

        echo $e->getMessage();
        return 1;

    }

}

function checkRated(int $id_criterion, int $id_game, int $id_user) : bool {

    global $conn;

    $sql = "SELECT * FROM rating WHERE game_id = $id_game AND user_id = $id_user AND criterion_id = $id_criterion";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        return true;

    }
    else {

        return false;

    }

}

function checkRatingGame(int $id_game, int $id_user) : bool {

    global $conn;

    $sql = "SELECT * FROM rating WHERE game_id = $id_game AND user_id = $id_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        return true;

    }
    else {

        return false;

    }

}

function getRatingGame($id_game, $id_user) {

    global $conn;

    $list = array();

    $sql = "SELECT c.id id_c, c.name nom, r.value note FROM `rating` r JOIN criterion c ON r.criterion_id = c.id WHERE game_id = $id_game AND user_id = $id_user";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        
        foreach($tab as $elm) {

            $list[$elm['id_c']] = [$elm['nom'], $elm['note']];

        }

    }

    return $list;

}

function getRatedGame($id_user) : array {

    global $conn;

    $list = array();

    $sql = "SELECT game.name name, game.id id FROM rating JOIN game ON rating.game_id = game.id WHERE user_id = $id_user GROUP BY game_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        
        foreach($tab as $elm) {

            array_push($list, [$elm['id'], $elm['name']]);

        }

    }

    return $list;

}

/**
 * Récupère la liste des critères de notation enregistrer
 *
 * @return array Liste des critères : liste[<id>] = [<nom>]
 */
function getListCriterion() : array {

    $list = array();
    global $conn;

    $sql = 'SELECT * FROM criterion';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        
        foreach($tab as $elm) {

            $list[$elm['id']] = $elm['name'];

        }

    }

    return $list;

}

// fonction récupérant liste de jeux pour backend
function getAllGames() : array {
    // récupère les informations de chaque jeu
    $sql = 'SELECT * FROM game;';
    //Sélection  des informations en base de données
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    
    return $tab;
}

// fonction récupérant liste de jeux pour front-end au format Json
function getGamesForFrontend() {
    // récupère les informations de chaque jeu
    $sql = 'SELECT * FROM game;';
    //Sélection  des informations en base de données
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll(); // convertir en json
    echo $tab;
}

function getAllGenres() {
    // récupère la liste de tous les genres (sans doublons)
    $sql = 'SELECT genre FROM game GROUP BY genre;';
    //Sélection  des informations en base de données
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $request = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;

}


// fonction fourre-tout pour récupérer des informations de la base de données
// prend une commande SQL en paramètre (pour les autres fichiers php)
function getInfosFromDatabase(String $sql) {

    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $request = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result; // retourne un tuple d'informations

}

?>