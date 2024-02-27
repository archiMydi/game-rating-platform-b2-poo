<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//$folder = "/home/xjeypbqy/poo-denis/user-profiles/";
//$file = $uid . ".json";

//$myfile = fopen($folder . $file, "a") or die("Unable to open file !");
//$json = "{['uid': N,'cosResult': X],['uid': N+1, 'cosResult': Y]}";
//fwrite($myfile, $txt);

include($_SERVER['DOCUMENT_ROOT']."/src/classes/Rating.php");

function cosSimilarity($u, $v)
{
    // Calcul du produit scalaire des deux vecteurs
    $scalarProduct = 0;
    for ($i = 0; $i < count($u); $i++) {
        $scalarProduct += $u[$i] * $v[$i];
    }

    // Calcul des normes des vecteurs
    $norm1 = sqrt(array_reduce($u, function ($acc, $val) {
        return $acc + pow($val, 2);
    }, 0));
    $norm2 = sqrt(array_reduce($v, function ($acc, $val) {
        return $acc + pow($val, 2);
    }, 0));

    // Calcul de la similarité cosinus
    $similarity = $scalarProduct / ($norm1 * $norm2);

    // Retourne la similarité cosinus calculée
    return $similarity;
}

function getUsers($id_debut, $nb_user)
{

    $list = array();

    global $conn;

    $sql = "SELECT * FROM user WHERE id > $id_debut ORDER BY id LIMIT $nb_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tab = $stmt->fetchAll();
    if (count($tab) > 0) {

        foreach ($tab as $user) {
            $id = $user['id'];
            $list[$id] = Rating::getUserVector($id);
        }

        return $list;
    } else {

        return null;
    }
}

var_dump(getUsers(0, 5));

function saveData($uid)
{
    $folder = "/home/xjeypbqy/poo-denis/user-profiles/";
    $file = $uid . ".json";

    $jsonFile = fopen($folder . $file, "w") or die("Unable to open file !");
    fwrite($jsonFile, '{');

    $jsonFile = fopen($folder . $file, "a") or die("Unable to open file !");

    // foreach ($array as $u) {
    //     if ($u->id != $uid) {
    //         $json = "['uid': $uid, 'comparedUid': $u->id, 'similarity': " . cosSimilarity($vecteurU1, $u->$vecteur) . "]";
    //         fwrite($jsonFile, $json);
    //     }
    // }

    fwrite($jsonFile, '}');
}

/*

- Les infos et la connexion à la DB
- Un fichier txt qui stocke le dernier UID traité
- Une boucle qui reprend au dernier UID traité et en traite 10 à partir de ce dernier, elle doit repartir du début
- Une fonction qui construit le JSON et qui l'écrit dans le fichier destiné au current user : uid.json
- Déterminer en faisant des tests le seuil de similarité acceptable dans le contexte de notre appli


*/