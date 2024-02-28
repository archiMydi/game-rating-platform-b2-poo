<?php
include($_SERVER['DOCUMENT_ROOT'] . "/src/templates/database.php");

function getRatingGameAllUsers() {
    
}
$criterionGameplay = 0;
$criterionGraphics = 0;
$criterionMusic = 0;

$ratingGamesUser =  getRatingGame(282, 2);
// var_dump($ratingGamesUser);
$tabRatingGameplay = $ratingGamesUser[1];
$tabRatingGraphics = $ratingGamesUser[2];
$tabRatingMusic = $ratingGamesUser[3];

// var_dump($tabRatingGameplay[1]);
// var_dump($tabRatingGraphics);
// var_dump($tabRatingMusic);

// for($i = 1; $i <= count($tabRatingGameplay); $i++) {
//     $criterionGameplay += $tabRatingGameplay[$i];
// };
// var_dump($criterionGameplay);

function ratingCriterion($tabRating, $criterion) {
    for($i = 1; $i <= count($tabRating); $i++) {
        $criterion += $tabRating[$i];
    };
    var_dump($criterion);
}

ratingCriterion($tabRatingGameplay, $criterionGameplay);
ratingCriterion($tabRatingGraphics, $criterionGraphics);
ratingCriterion($tabRatingMusic, $criterionMusic);

//Récupérer l'id du jeu dans la fonction
//Fonction pour chaque utilisateur
//Fonction pour chaque critère


// $gamesUsers2 = getRatedGame(2);
// var_dump($gamesUsers2);
//Le user 2 a bien noté des jeux.
//282 -> GTA V [Exemple]
//User 2 = GTA V [gameplay = 5; graphics = 5; music = 4]


//INFO FUNCTION UTILISÉE
// function getRatingGame(int $id_game, int $id_user, bool $name = true, bool $normalise = false): array
// {

//     global $conn;

//     $list = array();

//     $sql = "SELECT c.id id_c, c.name nom, r.value note FROM `rating` r JOIN criterion c ON r.criterion_id = c.id WHERE game_id = $id_game AND user_id = $id_user";

//     if ($normalise) {
//         $sql = "SELECT c.id id_c, c.name nom, r.value-2.5 note FROM `rating` r JOIN criterion c ON r.criterion_id = c.id WHERE game_id = $id_game AND user_id = $id_user;";
//     }

//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $tab = $stmt->fetchAll();
//     if (count($tab) > 0) {

//         foreach ($tab as $elm) {

//             if ($name) {
//                 $list[$elm['id_c']] = [$elm['nom'], $elm['note']];
//             } else {
//                 $list[$elm['id_c']] = $elm['note'];
//             }
//         }
//     }

//     return $list;
// }


?>
