<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//$folder = "/home/xjeypbqy/poo-denis/user-profiles/";
//$file = $uid . ".json";

$myfile = fopen($folder . $file, "a") or die("Unable to open file !");
$json = "{['uid': N,'cosResult': X],['uid': N+1, 'cosResult': Y]}";
fwrite($myfile, $txt);



function cosSimilarity($vector1, $vector2)
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



/*

- Les infos et la connexion à la DB
- Un fichier txt qui stocke le dernier UID traité
- Une boucle qui reprend au dernier UID traité et en traite 10 à partir de ce dernier, elle doit repartir du début
- Une fonction qui construit le JSON et qui l'écrit dans le fichier destiné au current user : uid.json
- Déterminer en faisant des tests le seuil de similarité acceptable dans le contexte de notre appli


*/