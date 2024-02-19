<?php
include_once("src/templates/database.php");
    session_start();
    if($_SESSION['user'] == null) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ajouter un jeu</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        $user = $_SESSION['user'];
        echo "<a href='account.php'>
                Retour
            </a>";
        $list_game = $user->getNotRatedGame();
        foreach($list_game as $game) {

            $id_g = $game[0];
            $name_g = $game[1];

            echo "<h4>
                    $name_g
                </h4><br>";
            echo "<a href='rate_game.php?id_g=$id_g&new=true'>
                    <button>
                        Noter ce jeu
                    </button>
                </a>";

        }
    ?>
</body>
</html>