<?php

    /**
     * Affiche une page précise de jeu
     *
     * @param int $page Numéros de la page
     */
    function getPage(int $page) {
        $page = $_GET['page'] ?? 1;
        include_once(__DIR__."src/templates/database.php");
        $nb = getMaxPages();
        if($page < 1) {
            $page = 1;
        }
        else if($page > $nb) {
            $page = $nb;
        }
        $list = getGamesInPage($page);
        if($list != null) {
            echo "<h1>Page $page</h1><br><section id='game-section'>";
            foreach($list as $game) {
                $id = $game->getID();
                $name = $game->getName();
                $desc = $game->getGameInfos();
                $visu = $game->getVisuel();
                $name = str_replace("'", "#%7!8$9%#", $name);
                $desc = str_replace("'", "#%7!8$9%#", $desc);
                $show = "showGameDetails('".$name."',".$game->getID().", '$visu', '".$desc."', [3, 3, 3])";
                echo '<article class="game" onclick="'.$show.'">
                <p>'.$game->getName().'</p>
                <img class="game-img" src="'.$visu.'" alt="'.$visu.'"/>
            </article>';

            }
            echo "</section><br>";
            for($i = 1; $i <= $nb; $i++) {
                if($i != $page) {
                    echo "<a href='?page=$i'><button class='innactif'>$i</button></a>";
                }
                else {
                    echo "<a href='?page=$i'><button class='actif'>$i</button></a>";
                }
            }
        }
    }

    /**
     * Affiche une page précise de jeu avec une requête spécifique
     *
     * @param string $sql Requête permettant de récupérer les jeux
     * @param string $sql Requête permettant d'avoir le nombre maximum de jeu (colonne renommer obligatoirement en nb)
     */
    function getSQLPage($page, $sql, $sql_max) {
        $page = $_GET['page'] ?? 1;
        include_once("src/templates/database.php");
        //$sql_max = "SELECT r.user_id, COUNT(r.user_id) nb FROM game JOIN rating r ON game.id = r.game_id WHERE r.user_id = 1 AND r.criterion_id = 1;";
        $nb = getSQLMaxPages($sql_max);
        if($page < 1) {
            $page = 1;
        }
        else if($page > $nb) {
            $page = $nb;
        }
        $list = getSpecificGamesInPage($page, $sql);
        if($list != null) {
            echo "<h1>Page $page</h1><br><section id='game-section'>";
            foreach($list as $game) {
                $id = $game->getID();
                $name = $game->getName();
                $desc = $game->getGameInfos();
                $visu = $game->getVisuel();
                $name = str_replace("'", "#%7!8$9%#", $name);
                $desc = str_replace("'", "#%7!8$9%#", $desc);
                //$show = "showGameDetails('".$name."',".$game->getID().", '$visu', '".$desc."')";
                //echo '<article class="game" onclick="'.$show.'">
                //<p>'.$game->getName().'</p>
                //<img class="game-img" src="'.$visu.'" alt="'.$visu.'"/>
            //</article>';
                echo '<a href="?id_g='.$id.'"><article class="game">
                <p>'.$game->getName().'</p>
                <img class="game-img" src="'.$visu.'" alt="'.$visu.'"/>
            </article></a>';

            }
            echo "</section><br>";
            for($i = 1; $i <= $nb; $i++) {
                if($i != $page) {
                    echo "<a href='?page=$i'><button class='innactif'>$i</button></a>";
                }
                else {
                    echo "<a href='?page=$i'><button class='actif'>$i</button></a>";
                }
            }
        }
    }
?>