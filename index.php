<?php
include($_SERVER['DOCUMENT_ROOT']."/src/templates/database.php");
include($_SERVER['DOCUMENT_ROOT']."/src/templates/init.php");
?>

<!DOCTYPE html>
<html>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/templates/html_head.php';
htmlHead('Game Rating'); ?>

<body id="body-game-list">
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/src/templates/navbar.php"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/src/templates/login.php"); ?>

    <main>
        <aside id="menu-aside">
            <h3>Genres</h3>

        </aside>

        <section id="main-section">
            <section id="second-header">
                <h1 style="color: white;">Rechercher un nouveau jeu à noter</h1><br>
                <section id="search">
                    <form id='search-form' action="#" method="GET">
                        <input type="search" name='src' id="input-search" onkeyup="searchGame()">
                        <button type="submit" form="search-form" onclick="searchGame()"><i class="material-icons" id="icon_search">search</i></button>
                    </form>
                </section>

                <section id="filtre">
                    <label for="select-filtre">Trier par</label>
                    <select name="filtre" id="select-filtre">
                        <option value="pertinence" onclick="">Pertinence</option>
                        <option value="alphabetique" onclick="filtreASC()">Par ordre alphabétique</option>
                    </select>
                </section>
            </section>



            <section id="global-game-section">
                <?php

                include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/pagination.php");
                $src = $_GET['src'] ?? null;
                if($src == null) {
                    getPage(1);
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
                <span onclick="closeElement('rating-section')">x</span>
                <form id="rating-form">

                    <h3>Rating Gameplay</h3>
                    <section class="rating" id="rating-gameplay">
                        <section class="rating-container">

                            <input type="radio" name="stars-g" id="st5-g" data-rating="5">
                            <label for="st5-g">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Excellent"></div>
                            </label>

                            <input type="radio" name="stars-g" id="st4-g" data-rating="4">
                            <label for="st4-g">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Bon"></div>
                            </label>

                            <input type="radio" name="stars-g" id="st3-g" data-rating="3">
                            <label for="st3-g">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="OK"></div>
                            </label>

                            <input type="radio" name="stars-g" id="st2-g" data-rating="2">
                            <label for="st2-g">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Mauvais"></div>
                            </label>

                            <input type="radio" name="stars-g" id="st1-g" data-rating="1">
                            <label for="st1-g">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Terrible"></div>
                            </label>

                        </section>
                    </section>

                    <h3>Rating Graphisme</h3>
                    <section class="rating" id="rating-graphisme">
                        <section class="rating-container">

                            <input type="radio" name="stars-gr" id="st5-gr" data-rating="5">
                            <label for="st5-gr">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Excellent"></div>
                            </label>

                            <input type="radio" name="stars-gr" id="st4-gr" data-rating="4">
                            <label for="st4-gr">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Bon"></div>
                            </label>

                            <input type="radio" name="stars-gr" id="st3-gr" data-rating="3">
                            <label for="st3-gr">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="OK"></div>
                            </label>

                            <input type="radio" name="stars-gr" id="st2-gr" data-rating="2">
                            <label for="st2-gr">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Mauvais"></div>
                            </label>

                            <input type="radio" name="stars-gr" id="st1-gr" data-rating="1">
                            <label for="st1-gr">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Terrible"></div>
                            </label>

                        </section>
                    </section>

                    <h3>Rating Sound Design</h3>
                    <section class="rating" id="rating-sound-design">
                        <section class="rating-container">

                            <input type="radio" name="stars-sd" id="st5-sd" data-rating="5">
                            <label for="st5-sd">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Excellent"></div>
                            </label>

                            <input type="radio" name="stars-sd" id="st4-sd" data-rating="4">
                            <label for="st4-sd">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Bon"></div>
                            </label>

                            <input type="radio" name="stars-sd" id="st3-sd" data-rating="3">
                            <label for="st3-sd">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="OK"></div>
                            </label>

                            <input type="radio" name="stars-sd" id="st2-sd" data-rating="2">
                            <label for="st2-sd">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Mauvais"></div>
                            </label>

                            <input type="radio" name="stars-sd" id="st1-sd" data-rating="1">
                            <label for="st1-sd">
                                <div class="star-stroke">
                                    <div class="star-fill"></div>
                                </div>
                                <div class="label-description" data-content="Terrible"></div>
                            </label>

                        </section>
                    </section>

                    <button class="cta" type="submit">Noter</button>
                </form>

            </section>

        </section>


    </main>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/src/templates/footer.php");
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

</body>

</html>