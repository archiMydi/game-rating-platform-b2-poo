<?php
include_once("src/templates/database.php");
require_once("src/templates/init.php");
if ($_SESSION['user'] == null) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<?php include('src/templates/html_head.php');
htmlHead('Compte'); ?>

<body>
    <?php include 'src/templates/navbar.php'; ?>
    <?php
    $user = $_SESSION['user'];
    echo "<h2>
                Bienvenue " . $user->getPseudo() . " !
            </h2>
            <a href='edit_profil.php'>
                <button>
                    Modifier le profil
                </button>
            </a>
            <a href='src/templates/logout.php'>
                <button>
                    Déconnexion
                </button>
            </a>
            <a href='add_game.php'>
                <button>
                    Noter un nouveau jeu
                </button>
            </a>";
    $list_game = $user->getRatedGame();
    foreach ($list_game as $game) {

        $id_g = $game->getID();
        $name_g = $game->getName();

        echo "<h4>$name_g</h4><br>
                <a href='rate_game.php?id_g=$id_g'>
                    <button>
                        Modifier la note
                    </button>
                </a>";
    }
    ?>
</body>

</html>