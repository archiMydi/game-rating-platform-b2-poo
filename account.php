<?php
include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/src/templates/init.php");
if ($_SESSION['user'] == null) {
    header("Location: index.php");
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/src/templates/html_head.php';
htmlHead('Game Rating'); 
include($_SERVER['DOCUMENT_ROOT']."/src/templates/rate_game.php");
    $id_g = $_GET['id_g'] ?? -1;
    if($id_g != -1) {
        checkRatingForm(false, $id_g, $user, "account.php?id_g=$id_g");
    }
    include($_SERVER['DOCUMENT_ROOT']."/src/templates/navbar.php"); 
    include($_SERVER['DOCUMENT_ROOT']."/src/templates/login.php");
?>
<script>
        // récupère les informations de chaque jeu
        let list_all_games = <?php
                                getInfosForFrontend('SELECT g.*, json_arrayagg(ge.name) AS gender
        FROM game g, category c, gender ge
        WHERE g.id = c.game_id 
        AND c.gender_id = ge.id
        GROUP BY g.name 
        ORDER BY g.id;'); 
        ?>;
        let list_all_genders = <?php 
        getInfosForFrontend('SELECT * FROM gender;'); 
        ?>;
    </script>
<script src='src/scripts/index.js'></script>
<body id="body-game-list">

    <main>

        <section id="main-section">
            <section id="user-section">
                <?php
                    echo "<h2>Bienvenue ".$user->getPseudo()."</h2>";
                ?>
            </section>
            <section id="second-header">
                <h1 style="color: white;">Rechercher un nouveau jeu à noter</h1><br>
                <section id="search">
                    <form id='search-form' action="#" method="GET">
                        <input type="search" name='src' id="input-search" onkeyup="searchGame()">
                        <button type="submit" form="search-form" onclick="searchGame()"><i class="material-icons" id="icon_search">search</i></button>
                    </form>
                </section>
            </section>



            <section id="global-game-section">
                <?php
                include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/pagination.php");
                $src = $_GET['src'] ?? null;
                if($src == null) {
                    echo "<h1>Jeux déjà notés</h1><br>";
                    $sql = "SELECT * FROM game JOIN rating r ON game.id = r.game_id WHERE r.user_id = ".$user->getID()." GROUP BY r.game_id, r.user_id";
                    //getSpecificGamesInPage(1, $sql);
                    $sql_max = "SELECT r.user_id, COUNT(r.user_id) nb FROM game JOIN rating r ON game.id = r.game_id WHERE r.user_id = 1 AND r.criterion_id = 1;";
                    getSQLPage(1, $sql, $sql_max);
                }
                else {
                    $sql = "SELECT * FROM game WHERE name LIKE '%$src%'";
                    //getSpecificGamesInPage(1, $sql);
                    $sql_max = "SELECT COUNT(*) nb FROM game WHERE name LIKE '%$src%'";
                    getSQLPage(1, $sql, $sql_max);
                }

                ?>
            </section>


            <section id="details-game-section">

            </section>

            <section id="rating-section">
                <?php
                    if($id_g != -1) {
                        $game = getGameById($id_g);
                        $list = getRatingGame($id_g, $user->getID());
                        $notes = "[";
                        foreach($list as $elm) {
                            if($elm != end($list)) {
                                $notes .= $elm[1].", ";
                            }
                            else {
                                $notes .= $elm[1]."]";
                            }
                        }
                        echo '<script>showGameDetails("'.$game->getName().'", '.$id_g.', "'.$game->getVisuel().'", "'.$game->getGameInfos().'",'.$notes.')</script>';
                        setRatingForm(false, $user, $id_g, "account.php?id_g=$id_g");
                    }
                ?>
            </section>

        </section>

    </main>

</body>

</html>