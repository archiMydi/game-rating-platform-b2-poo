<?php

include_once('connection.inc.php');
include_once('src/classes/User.php');
include_once('src/classes/Game.php');
$conn = null;
$nb_jeu_par_page = 3;
try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8", $username, $password);
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
function getInfosUser(String $sql): ?user
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        return new user($tab[0]['id'], $tab[0]['pseudo'], $tab[0]['email'], $tab[0]['description'], $tab[0]['avatar'], $tab[0]['jeu_fav']);
    } else {
        return null;
    }
}


/**
 * Permet de récupérer la liste des utilisateurs au format JSON
 *
 * @param     $conn    Connexion à la base de données
 *
 * @return ?string Renvoie une liste JSON ou 'false' en cas d'erreur
 */

function getUserListJSON($conn): ?string //Récupérer la liste des users
{
    try {
        $stmt = $conn->query("SELECT id, pseudo, jeu_fav, description, avatar FROM user");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $userTable = array(); // Tableau pour stocker les utilisateurs

        foreach ($rows as $row) {
            // Création d'un objet utilisateur
            $user = array(
                'id' => $row['id'],
                'pseudo' => $row['pseudo'],
                'favGame' => $row['jeu_fav'],
                'catchPhrase' => $row['description'],
                'pictureSRC' => $row['avatar']
            );

            // Ajout de l'utilisateur au tableau
            $userTable[] = $user;
        }

        return json_encode($userTable, JSON_UNESCAPED_UNICODE);
    } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    }
}




/**
 * Récupère les informations d'un jeu s'il existe
 *
 * @param string     $sql Requête SQL
 *
 * @return game      Retourne le jeu sous forme d'objet game ou null s'il n'existe pas
 */
function getInfosGame(String $sql): ?game
{

    global $conn;

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        return new game($tab[0]['id'], $tab[0]['name'], $tab[0]['infos'], $tab[0]['visuel']);
    } else {
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
function getUserById(int $id): user
{
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
function getUser(string $id, string $mdp): ?user
{
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
function getUserByPseudo(String $pseudo): user
{

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
function getUserByEmail(String $email): user
{

    global $conn;
    $sql = "SELECT * FROM user WHERE email = '$email'";
    return getInfosUser($sql);
}

/**
 * Récupère un jeu avec son identifiant
 *
 * @param int     $id     Identifiant du jeu
 *
 * @return ?game      Retourne le jeu sous forme d'objet game
 */
function getGameById(int $id): ?game
{

    global $conn;
    $sql = "SELECT * FROM game WHERE id = '$id'";
    return getInfosGame($sql);
}

/**
 * Récupère un jeu avec son nom
 *
 * @param string     $name     Nom du jeu
 *
 * @return ?game      Retourne le jeu sous forme d'objet game
 */
function getGameByName(string $name): ?game
{

    global $conn;
    $sql = "SELECT * FROM game WHERE name = '$name'";
    return getInfosGame($sql);
}

/**
 * Récupère le mot de passe d'un utilisateur
 *
 * @param user     $user    Utilisateur
 *
 * @return string  retourne le mot de passe
 */
function getMDP(user $user): String
{
    $id = $user->getID();
    global $conn;
    $sql = "SELECT password FROM user WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if ($result > 0) {
        return $tab[0]['password'];
    } else {

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
function registerNewUser(string $pseudo, string $mdp, string $email): int
{

    global $conn;
    $sql = "SELECT * FROM user WHERE pseudo = '$pseudo'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {
        return 1;
    } else {

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $stmt->fetchAll();
        if (count($tab) > 0) {

            return 2;
        } else {

            try {
                $sql = "INSERT INTO user (pseudo, email, password) VALUES ('$pseudo', '$email', '$mdp');";
                $conn->exec($sql);
                return 0;
            } catch (PDOException $e) {

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
function insertRating(int $id_user, int $id_game, array $notes): int
{

    global $conn;

    $sql = 'INSERT INTO rating (criterion_id, game_id, user_id, value) VALUES ';
    $i = 0;

    foreach ($notes as $id => $note) {

        if ($i + 1 === count($notes)) {
            $sql .= "($id, $id_game, $id_user, $note)";
        } else {
            $sql .= "($id, $id_game, $id_user, $note),";
            $i++;
        }
    }

    try {
        $conn->exec($sql);
        return 0;
    } catch (PDOException $e) {

        echo $e->getMessage();
        return 1;
    }
}

/**
 * Met à jour une note pour un jeu
 *
 * @param int     $id_user   Identifiant de l'utilisateur
 * @param int     $id_game   Identifiant du jeu
 * @param array     $notes     Liste des notes
 *
 * @return int Resultat -> 1: erreur de BDD; 0: pas de problèmes
 */
function updateRating(int $id_user, int $id_game, array $notes): int
{

    global $conn;

    $sql = "";

    foreach ($notes as $id => $note) {

        if (checkRated($id, $id_game, $id_user)) {

            $sql .= "UPDATE rating SET value = $note WHERE criterion_id = $id AND game_id = $id_game AND user_id = $id_user;";
        } else {

            $sql .= "INSERT INTO rating (criterion_id, game_id, user_id, value) VALUES ($id, $id_game, $id_user, $note);";
        }
    }

    try {
        $conn->exec($sql);
        return 0;
    } catch (PDOException $e) {

        echo $e->getMessage();
        return 1;
    }
}

/**
 * Met à jour un utilisateur
 *
 * @param int     $id_user   Identifiant de l'utilisateur
 * @param int     $id_game   Identifiant du jeu
 * @param array     $notes     Liste des notes
 *
 * @return int Resultat -> 1: erreur de BDD; 0: pas de problèmes
 */
function updateUser(int $id_user, string $new_avatar, string $new_desc): int
{

    global $conn;

    $sql = "UPDATE user SET avatar = '$new_avatar', description = '$new_desc' WHERE id = $id_user;";

    try {
        $conn->exec($sql);
        $_SESSION['user'] = getUserById($id_user);
        return 0;
    } catch (PDOException $e) {

        echo $e->getMessage();
        return 1;
    }
}

/**
 * Vérifie si un critère d'un jeu a bien été noter par un utilisateur
 * 
 * @param int    $id_criterion  Identifiant du critère
 * @param int    $id_game       Identifiant du jeu
 * @param int    $id_user       Identifiant de l'utilisateur
 *
 * @return bool
 */
function checkRated(int $id_criterion, int $id_game, int $id_user): bool
{

    global $conn;

    $sql = "SELECT * FROM rating WHERE game_id = $id_game AND user_id = $id_user AND criterion_id = $id_criterion";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        return true;
    } else {

        return false;
    }
}

/**
 * Vérifie si un jeu a bien été noter par un utilisateur
 * 
 * @param int    $id_game       Identifiant du jeu
 * @param int    $id_user       Identifiant de l'utilisateur
 *
 * @return bool
 */
function checkRatingGame(int $id_game, int $id_user): bool
{

    global $conn;

    $sql = "SELECT * FROM rating WHERE game_id = $id_game AND user_id = $id_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        return true;
    } else {

        return false;
    }
}

/**
 * Calcule le nombre de pages requis pour afficher la totalité des jeux
 *
 * @return ?int Nombre de pages
 */
function getMaxPages(): ?int
{

    global $conn;
    global $nb_jeu_par_page;

    $sql = "SELECT COUNT(*) nb FROM game";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        $nb = $tab[0]['nb'];
        $reste = $nb % $nb_jeu_par_page;
        $reste = $nb_jeu_par_page - $reste;
        $nb += $reste;
        $nb = $nb / $nb_jeu_par_page;

        if ($reste == $nb_jeu_par_page) {
            $nb -= 1;
        }

        return $nb;
    } else {

        return null;
    }
}

/**
 * Calcule le nombre de pages requis pour afficher la totalité des jeux
 *
 * @return ?int Nombre de pages
 */
function getSQLMaxPages($sql): ?int
{

    global $conn;
    global $nb_jeu_par_page;

    //$sql = "SELECT COUNT(*) nb FROM game";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        $nb = $tab[0]['nb'];
        $reste = $nb % $nb_jeu_par_page;
        $reste = $nb_jeu_par_page - $reste;
        $nb += $reste;
        $nb = $nb / $nb_jeu_par_page;

        if ($reste == $nb_jeu_par_page) {
            $nb -= 1;
        }

        return $nb;
    } else {

        return null;
    }
}

/**
 * Récupère les jeux sur une page spécifique
 *
 * @param int     $page   Numéro de la page
 *
 * @return array[game] Liste des jeux
 */
function getGamesInPage(int $page): ?array
{

    global $conn;
    global $nb_jeu_par_page;

    $list = array();
    $id_min = ($page - 1) * $nb_jeu_par_page;

    $sql = "SELECT * FROM game ORDER BY id LIMIT $nb_jeu_par_page OFFSET $id_min;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $game_) {
            $game = new game($game_['id'], $game_['name'], $game_['infos'], $game_['visuel']);
            array_push($list, $game);
        }

        return $list;
    } else {

        return null;
    }
}

/**
 * Récupère les jeux avec une requête sur une page spécifique
 *
 * @param int     $page   Numéro de la page
 * @param         $sql    Requête pour la selection de jeu
 *
 * @return array[game] Liste des jeux
 */
function getSpecificGamesInPage(int $page, $sql): ?array
{

    global $conn;
    global $nb_jeu_par_page;

    $list = array();
    $id_min = ($page - 1) * $nb_jeu_par_page;

    //$sql = "SELECT * FROM game ORDER BY id LIMIT $nb_jeu_par_page OFFSET $id_min;";
    $sql .= " ORDER BY id LIMIT $nb_jeu_par_page OFFSET $id_min;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $game_) {
            $game = new game($game_['id'], $game_['name'], $game_['infos'], $game_['visuel']);
            array_push($list, $game);
        }

        return $list;
    } else {

        return null;
    }
}

/**
 * Récupère toutes les notes d'un utilisateur
 * 
 * @param int    $id_user       Identifiant de l'utilisateur
 *
 * @return array Retourne une liste de jeux (liste[id jeu] = [id critere => [nom, note]])
 */
function getAllRatedGame(int $id_user): array
{

    $rated_games = getRatedGame($id_user);
    $list = array();

    foreach ($rated_games as $game) {

        $list[$game->getID()] = getRatingGame($game->getID(), $id_user);
    }

    return $list;
}

/**
 * Récupère les notes d'un jeu, données par un utilisateur
 * 
 * @param int    $id_game       Identifiant du jeu
 * @param int    $id_user       Identifiant de l'utilisateur
 *
 * @return array Retourne une liste de jeux (liste[id critere] = [nom, note])
 */
function getRatingGame(int $id_game, int $id_user): array
{

    global $conn;

    $list = array();

    $sql = "SELECT c.id id_c, c.name nom, r.value note FROM `rating` r JOIN criterion c ON r.criterion_id = c.id WHERE game_id = $id_game AND user_id = $id_user";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $elm) {

            $list[$elm['id_c']] = [$elm['nom'], $elm['note']];
        }
    }

    return $list;
}

/**
 * Récupère la liste des jeux noter par un utilisateur
 * 
 * @param int    $id_user       Identifiant de l'utilisateur
 *
 * @return array[game] Retourne une liste de jeux
 */
function getRatedGame($id_user): array
{

    global $conn;

    $list = array();

    $sql = "SELECT game.name name, game.id id, game.infos infos, game.visuel visuel FROM rating JOIN game ON rating.game_id = game.id WHERE user_id = $id_user GROUP BY game_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $elm) {

            $game = new game($elm['id'], $elm['name'], $elm['infos'], $elm['visuel']);
            array_push($list, $game);
        }
    }

    return $list;
}

/**
 * Récupère la liste des critères de notation enregistrer
 *
 * @return array Liste des critères : liste[<id>] = [<nom>]
 */
function getListCriterion(): array
{

    $list = array();
    global $conn;

    $sql = 'SELECT * FROM criterion';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $elm) {

            $list[$elm['id']] = $elm['name'];
        }
    }

    return $list;
}

// fonction récupérant liste de jeux pour backend
/**
 * Récupère la liste de tous les jeux
 *
 * @return array[game] Renvoie la liste des jeux
 */
function getAllGames(): array
{
    // récupère les informations de chaque jeu
    $sql = 'SELECT * FROM game;';
    //Sélection  des informations en base de données
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll();
    $liste = array();
    foreach ($tab as $game) {

        $game_obj = new game($game['id'], $game['name'], $game['infos'], $game['visuel']);
        array_push($liste, $game_obj);
    }

    return $liste;
}

/** getInfosForFrontend
 * fonction récupérant liste d'informations probenant de ka base de données pour front-end au format Json
 * paramètre $sql : requête sql (format string)
 * renvoie un objet json contenant les informations de la requête sql passée en paramêtre*/
function getInfosForFrontend($sql)
{
    // $sql = 'SELECT * FROM game;'; // $sql utilisable en paramètre ?
    //Sélection  des informations en base de données
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $stmt->fetchAll(); // convertir en json
    echo json_encode($tab);
}

// getAllgenres non référencée dans le code (non utilisée)
function getAllGenres()
{
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
function getInfosFromDatabase(String $sql)
{

    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $request = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result; // retourne un tuple d'informations

}
