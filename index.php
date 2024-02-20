<?php
include("src/templates/database.php");
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
    <!-- Chart.js doc:https://www.chartjs.org/docs/latest/charts/radar.html -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="body-game-list">
    <?php include("src/templates/navbar.php"); ?>
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
                    <input type="search" id="input-search" onkeyup="searchGame()">
                    <button type="button" onclick="searchGame()"><i class="material-icons" id="icon_search">search</i></button>
                </section>

                <section id="filtre">
                    <label for="select-filtre">Trier par</label>
                    <select name="filtre" id="select-filtre">
                        <option value="pertinence" onclick="">Pertinence</option>
                        <option value="alphabetique" onclick="filtreASC()">Par ordre alphabétique</option>
                    </select>
                    <button type="button" onclick="filtreASC()">TEST FILTRE</button>
                </section>
            </section>



            <section id="game-section">

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

                    <button type="submit">Noter</button>
                </form>

            </section>

        </section>

    </main>


    <script>
        // récupère les informations de chaque jeu
       let list_all_games = <?php getInfosForFrontend('SELECT * FROM game;'); // appelle la fonction php GetInfosForFrontend() (database.php)
        ?>; //ajoute variable list_all_games dans index.js
        console.log('launched GetInfosForFrontend');
        // récupère la liste des genres
        let list_all_genres = <?php getInfosForFrontend('SELECT * FROM gender;'); 
        ?>
        let list_categories = <?php getInfosForFrontend('SELECT * FROM category;'); 
        ?>
    </script>
    <script src='./src/scripts/index.js'></script>

</body>

</html>