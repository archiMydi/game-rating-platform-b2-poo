<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include($_SERVER['DOCUMENT_ROOT'] . "/src/classes/Rating.php");

/**
 * Défini le dernier utilisateur mis-à-jour
 *
 * @param int   $uid - Identifiant de l'utilisateur
 *
 */
function setLastUserCheck($uid)
{

    $folder = __DIR__ . "/";
    $file = "last.txt";

    $myfile = fopen($folder . $file, "w") or die("Unable to open file !");
    fwrite($myfile, $uid);
}

/**
 * Récupère le dernier utilisateur mis-à-jour
 *
 * @return string Identifiant du dernier utilisateur mis-à-jour
 *
 */
function getLastUserCheck(): string
{

    $folder = __DIR__ . "/";
    $file = "last.txt";

    $myfile = fopen($folder . $file, "r") or die("Unable to open file !");
    return fread($myfile, filesize(__DIR__ . "/" . "last.txt"));
}

function cosSimilarity($u, $v)
{
    // Calcul du produit scalaire des deux vecteurs
    $scalarProduct = 0;
    for ($i = 0; $i < count($u); $i++) {
        $uValues = array_values($u[$i]);
        $vValues = array_values($v[$i]);
        for ($j = 0; $j < count($uValues); $j++) {
            $scalarProduct += $uValues[$j] * $vValues[$j];
        }
    }

    // Calcul des normes des vecteurs
    $norm1 = sqrt(array_reduce($u, function ($acc, $val) {
        // Calcul de la somme des carrés des éléments du vecteur
        $sum = 0;
        foreach ($val as $element) {
            $sum += $element * $element;
        }
        return $acc + $sum;
    }, 0));

    $norm2 = sqrt(array_reduce($v, function ($acc, $val) {
        // Calcul de la somme des carrés des éléments du vecteur
        $sum = 0;
        foreach ($val as $element) {
            $sum += $element * $element;
        }
        return $acc + $sum;
    }, 0));

    if ($norm1 == 0 || $norm2 == 0) {
        return 0;
    }
    // Calcul de la similarité cosinus
    $similarity = $scalarProduct / ($norm1 * $norm2);

    // Retourne la similarité cosinus calculée
    return $similarity;
}


function getUsers($nb_user)
{

    $id_debut = getLastUserCheck();

    $list = array();

    global $conn;

    $sql = "SELECT * FROM user WHERE id > $id_debut ORDER BY id LIMIT $nb_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    $id = 0;
    if (count($tab) > 0) {

        foreach ($tab as $user) {
            $id = $user['id'];
            $list[$id] = Rating::getUserVector($id);
        }

        if ($id == getLastUserID()) {
            $id = 0;
        }

        setLastUserCheck($id);

        return $list;
    } else {
        $id = 0;
        setLastUserCheck($id);
        return null;
    }
}

$data = getUsers(1700);


// Similarité de profils entre plusieurs users
function calculateUserSimilarity($data)
{
    $user_similarity = [];

    // Chaque paire de user
    foreach ($data as $user1_id => $user1_data) {
        foreach ($data as $user2_id => $user2_data) {
            // Eviter de comparer user avec lui-même
            if ($user1_id != $user2_id) {
                // Jeux notés à la fois par les deux users
                $common_games = array_intersect_key($user1_data, $user2_data);

                // Filtrer les données pour ne conserver que les jeux en commun
                $user1_notes = array_intersect_key($user1_data, $common_games);
                $user2_notes = array_intersect_key($user2_data, $common_games);

                //Passage d'un tableau clé => valeur
                $user1_notes = array_values($user1_notes);
                $user2_notes = array_values($user2_notes);

                // Calcul de similarité
                $similarity = cosSimilarity($user1_notes, $user2_notes);

                $user_similarity["$user1_id-$user2_id"] = $similarity;
            }
        }
    }

    var_export($user_similarity);
}

calculateUserSimilarity($data);



function saveData($uid, $dataToSave)
{
    // $bigArray = getUsers(0, 5);
    // $userNotedGames = $bigArray[$uid];

    // $folder = "/home/xjeypbqy/poo-denis/user-profiles/";
    // $file = $uid . ".json";

    // $jsonFile = fopen($folder . $file, "w") or die("Unable to open file !");
    // fwrite($jsonFile, '{');

    // $jsonFile = fopen($folder . $file, "a") or die("Unable to open file !");

    // $json = "['uid': $uid, 'comparedUid': $u->id, 'similarity': " . cosSimilarity([1, 1], [1, 1]) . "]";
    // fwrite($jsonFile, $json);

    // fwrite($jsonFile, '}');
}
