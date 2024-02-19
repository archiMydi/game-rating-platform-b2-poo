<?php

if (sizeof($_GET) > 0) {
    $id = $_GET['id'];
    $pseudo = $_GET['pseudo'];
    $avatar = $_GET['avatar'];
    $description = $_GET['description'];
    $favGame = $_GET['favGame'];

    echo "<div class='modal'>
            <div class='modal-content'>
                <div class='modal-left'>
                    <div class='modal-infos'>
                        <img class='profile-picture' src='$avatar' alt='$pseudo's profile picture'/>
                        <p class='pseudo'>$pseudo</p>
                    </div>
                    <p class='catch-phrase'>$description</p>
                    <p class='fav-game'>$favGame</p>";
    include('./follow_button.php');

    echo "</div>
            <div class='modal-right'>
                <p>$pseudo a noté ces jeux récemment</p>
                <img class='last-rated-games' src='https://placehold.co/250x150' alt='$pseudo 's illustration'/>
                <img class='last-rated-games' src='https://placehold.co/250x150' alt='$pseudo s illustration'/>
                <img class='last-rated-games' src='https://placehold.co/250x150' alt='$pseudo s illustration'/>
            </div>
        </div>
    </div>";
}
