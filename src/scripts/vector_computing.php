<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>POC ALGO OOP</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <h1>Pour tester la similarité :</h1>
    <ul>
        <li>
            <h4>Distance euclidienne entre deux vecteurs</h4>
            <ul>
                <li class="function">euclideanDistance(games[X].vector, games[Y].vector)</li><br>
                <li class="function">euclideanDistance(users[X].preferences, users[Y].preferences)</li><br>
                <li class="function">euclideanDistance(users[X].preferences, games[Y].vector)</li>
            </ul>
        </li>
        <br>
        <li>
            <h4>Similarité cosinus entre deux vecteurs</h4>
            <ul>
                <li class="function2">cosinusSimilarity(games[X].vector, games[Y].vector)</li><br>
                <li class="function2">cosinusSimilarity(users[X].preferences, users[Y].preferences)</li><br>
                <li class="function2">cosinusSimilarity(users[X].preferences, games[Y].vector)</li>
            </ul>
        </li>
    </ul>
    <h4>! Indications et bonnes pratiques !<br><br>

        Pour la distance euclidienne :<br><br>

        - Cette méthode retourne en sortie une donnée brute (un nombre) mais c'est à nous de déterminer la limite acceptable entre similarité et dissimilarité<br>
        - Par exemple si la distance euclidienne entre deux vecteurs de jeux est égale à 4.5, c'est à nous de définir si l'on considère ces vecteurs comme similaires ou non<br>
        Pour répondre à cette interrogation, il faudra qu'on effectue des tests en fonction de nos préférences à nous et qu'on essaye de se faire recommander des jeux<br>
        que l'on apprécie afin de déterminer une valeur sueuil.<br><br>

        Pour la similarité cosinus :<br><br>

        - L'avantage de cette méthode est que son résultat n'est pas soumis à l'interprétation<br>
        - (1) c'est exactement similaire<br><br>

        - (0) ils n'ont aucune similarité et sont donc susceptibles de ne pas plaire aux mêmes types de joueurs<br><br>

        - (-1) diamétralement opposés et visent donc des publics complètement différents, cela peut également indiquer des points forts ou faibles exactement inverses<br>
        dans chaque critère (étant donné que nous ne laissons pas la possibilité de mettre des notes négatives, cela ne devrait en théorie pas arriver dans notre cas)<br><br>

        Pour la combinaison linéaire de ces deux méthodes :<br>
        PAS ENCORE ESSAYÉ

    </h4>
    <style>
        .function {
            color: green;
        }

        .function2 {
            color: red;
        }
    </style>
</body>

</html>

<?php
// Proof of concept algorithme de recommandation de jeux en leurs attribuant chacun un vecteur représentant
// 3 notes (Gameplay, Graphismes, Scénario) pouvant aller de 0 à 5

// Les vecteurs sont représentés par des array de notes fictives

$games = [
    ["title" => "Jeu A", "vector" => [4, 3, 5]],
    ["title" => "Jeu B", "vector" => [3, 4, 2]],
    ["title" => "Jeu C", "vector" => [5, 2, 4]],
    ["title" => "Jeu D", "vector" => [2, 5, 3]],
    ["title" => "Jeu E", "vector" => [4, 4, 4]]
];

$users = [
    ["name" => "User 1", "preferences" => [5, 3, 5]],
    ["name" => "User 2", "preferences" => [3, 5, 4]],
    ["name" => "User 3", "preferences" => [4, 4, 3]]
];

// Fonction pour calculer la distance euclidienne entre deux vecteurs
function euclideanDistance($vector1, $vector2)
{
    // Initialisation de la variable pour stocker la somme des carrés des différences
    $sumSquaredDistances = 0;

    // Parcours de chaque composante des vecteurs
    for ($i = 0; $i < count($vector1); $i++) {
        // Calcul de la différence entre les composantes des deux vecteurs, puis élévation au carré
        $squaredDifference = pow($vector1[$i] - $vector2[$i], 2);

        // Ajout du carré de la différence à la somme
        $sumSquaredDistances += $squaredDifference;
    }

    // Calcul de la racine carrée de la somme des carrés des différences
    $distance = sqrt($sumSquaredDistances);

    // Retourne la distance euclidienne calculée
    return $distance;
}

function cosinusSimilarity($vector1, $vector2)
{
    // Calcul du produit scalaire des deux vecteurs
    $scalarProduct = 0;
    for ($i = 0; $i < count($vector1); $i++) {
        $scalarProduct += $vector1[$i] * $vector2[$i];
    }

    // Calcul des normes des vecteurs
    $norm1 = sqrt(array_reduce($vector1, function ($acc, $val) {
        return $acc + pow($val, 2);
    }, 0));
    $norm2 = sqrt(array_reduce($vector2, function ($acc, $val) {
        return $acc + pow($val, 2);
    }, 0));

    // Calcul de la similarité cosinus
    $similarity = $scalarProduct / ($norm1 * $norm2);

    // Retourne la similarité cosinus calculée
    return $similarity;
}

echo "Distance euclidienne entre le jeu A et le jeu B : " . euclideanDistance($games[0]["vector"], $games[1]["vector"]) . "<br>";
echo "Similarité cosinus entre le jeu A et le jeu B : " . cosinusSimilarity($games[0]["vector"], $games[1]["vector"]) . "<br>";
?>