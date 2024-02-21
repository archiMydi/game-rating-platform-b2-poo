<?php
    function getPage($page) {
        $page = $_GET['page'] ?? 1;
        include_once("src/templates/database.php");
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
                $show = "showGameDetails('".$game->getName()."')";

                echo '<article class="game" onclick="'.$show.'">
                <p>'.$game->getName().'</p>
                <img class="game-img" src="img/gameVisual.jpeg" alt="img/gameVisual.jpeg"/>
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
?>