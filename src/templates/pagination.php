<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Pagination</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>
    </head>
    <body>
        <?php
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
                echo "<h1>Page $page</h1>";
                foreach($list as $game) {

                    echo "<br><h3>".$game->getName()."</h3>";

                }
                echo "<br>";
                for($i = 1; $i <= $nb; $i++) {
                    if($i != $page) {
                        echo "<br><a href='?page=$i'>Page $i</a>";
                    }
                }
            }
        ?>
    </body>
</html>