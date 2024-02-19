<?php
include ("src/templates/database.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Game Rating</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./static/css/style.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <script src='./js/jquery.min.js'></script> <!-- lien vers JQuery -->
</head>

<body id="body-game-list">
    <main>
        <aside id="menu-aside">
            <h3>Genres</h3>
            <p onclick="">Genre 1</p>
            <p onclick="">Genre 2</p>
            <p onclick="">Genre 3</p>
        </aside>

        <section id="main-section">
            <section id="second-header">
                <section id="search">
                    <input type="search" id="input-search">
                    <button type="button" onclick=""><i class="material-icons" id="icon_search">search</i></button>
                </section>

                <section id="filtre">
                    <label for="filtre">Trier par</label>
                    <select name="filtre" id="select-filtre">
                        <option value="pertinence" onclick="">Pertinence</option>
                        <option value="alphabetique" onclick="">Par ordre alphabétique</option>
                    </select>
                </section>
            </section>



            <section id="game-section">

            </section>


            <section id="details-game-section">
                <article class="gameFiche">
                    <h2>Game Name</h2>
                    <section class="galery">
                        <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                    </section>

                    <section class="details-game-info">
                        <section class="details-game-description">
                            <h3>Description</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, veniam eum facilis voluptatum aut debitis, animi ipsam pariatur accusamus culpa voluptatibus unde sequi, recusandae reprehenderit dignissimos totam dolor fugit dicta.</p>
                        </section>
                        <section class="details-game-genre">
                            <h3>Genres</h3>
                            <ul>
                                <li>Genre 1</li>
                                <li>Genre 2</li>
                            </ul>
                        </section>
                    </section>

                    <section class="recommandation">
                        <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                        <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                        <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                    </section>

                    <section class="user-appreciation">
                        <svg width="960" height="500"></svg>
                    </section>
                </article>
            </section>
        </section>

    </main>

    
    <script>
       let list_all_games = <?php getGamesForFrontend(); // appelle la fonction php GetAllGames()
        ?>; //ajoute variable list_all_games dans index.js
        console.log('launched GetAllGames');
    </script>
    <script src='./src/scripts/index.js'></script>
    
</body>

</html>