<?php

    /**
     * Affiche la liste des pages
     * 
     * @param int $page      Numéros de la page
     * @param int $sql       Nombre de pages
     * 
     */
    function setPageList(int $page, int $nb) {

        if($nb < 6) {
            for($i = 1; $i <= $nb; $i++) {
                if($i != $page) {
                    echo "<a href='?page=$i'><button class='innactif'>$i</button></a>";
                }
                else {
                    echo "<a href='?page=$i'><button class='actif'>$i</button></a>";
                }
            }
        }
        else {
            //Affichage début
            if($page != 1) {
                echo "<a href='?page=1'><button class='innactif'>1</button></a>";
            }
            else {
                echo "<a href='?page=1'><button class='actif'>1</button></a>";
                echo "<a href='?page=2'><button class='innactif'>2</button></a>";
            }

            if($page != 2) {
                if($page != 1 && $page != 3) {
                    echo "<a><button class='innactif'>...</button></a>";
                }
                else {

                }
            }
            else {
                echo "<a href='?page=2'><button class='actif'>2</button></a>";
                echo "<a href='?page=3'><button class='innactif'>3</button></a>";
            }

            //Affichage centre
            if($page > 2 && $page < $nb - 1) {
                if($page-1 < $nb && $page-1 > 1) {

                    $page_pre = $page - 1;
                    echo "<a href='?page=$page_pre'><button class='innactif'>$page_pre</button></a>";

                }
                if($page < $nb && $page > 1) {

                    echo "<a href='?page=$page'><button class='actif'>$page</button></a>";

                }
                if($page+1 < $nb && $page+1 > 1) {

                    $page_post = $page + 1;
                    echo "<a href='?page=$page_post'><button class='innactif'>$page_post</button></a>";

                }
            }

            //Affichage fin
            if($page != $nb-1) {
                if($page != $nb && $page != $nb-2) {
                    echo "<a><button class='innactif'>...</button></a>";
                }
                else {}
            }
            else {

                $nb_ = $nb - 1;
                $_nb = $nb - 2;
                echo "<a href='?page=$_nb'><button class='innactif'>$_nb</button></a>";
                echo "<a href='?page=$nb_'><button class='actif'>$nb_</button></a>";

            }

            if($page != $nb) {
                echo "<a href='?page=$nb'><button class='innactif'>$nb</button></a>";
            }
            else {
                $nb_ = $nb - 1;
                echo "<a href='?page=$nb_'><button class='innactif'>$nb_</button></a>";
                echo "<a href='?page=$nb'><button class='actif'>$nb</button></a>";
            }

        }

    }

    /**
     * Affiche une page spécifique de jeux
     * 
     * @param int $page      Numéros de la page à afficher
     * 
     */
    function getPage(int $page) {
        $page = $_GET['page'] ?? 1;
        include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/database.php");
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
            </article>
            ';

            }
            echo "</section><br>";
            
            setPageList($page, $nb);

        }
    }

    /**
     * Affiche une page spécifique avec des jeux sélectionner
     * 
     * @param int $page      Numéros de la page à afficher
     * @param string $sql       Requête de selection des jeux
     * @param string $sql_max   Requête permettant de récupérer le nombre de jeu selectionner
     * 
     */
    function getSQLPage(int $page, string $sql, string $sql_max) {
        $page = $_GET['page'] ?? 1;
        include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/database.php");
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
            setPageList($page, $nb);
        }
    }
?>