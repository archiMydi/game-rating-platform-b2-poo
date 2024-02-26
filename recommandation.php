<?php
include 'src/templates/html_head.php';
include_once 'src/classes/Rating.php';
include_once 'src/classes/User.php';
include_once 'src/classes/Game.php';
require_once("src/templates/init.php");

htmlHead('Recommandations');

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $user = $_SESSION['user'];
    $uid = $user->getID();
    $isUser = true;
} else {
    $isUser = false;
    $uid = -1;
}

?>

<body class='reco-page'>
    <?php include 'src/templates/navbar.php'; ?>
    <?php include("src/templates/login.php"); ?>

    <script src='static/js/reco.js'></script>
    <section class='reco-section'>
        <?php constructRecoPage($uid, $isUser); ?>
    </section>
</body>

<?php

/**
 * Construit la page de recommandation selon le nombre de jeux déjà notés par current user
 *
 * @param int $uid l'id de current user
 *
 * @return void Aucun retour, simplement des echo de balises HTML sur la page (TOP 10 si pas assez de notes, recos sinon)
 */
function constructRecoPage($uid, $isUser)
{
    if ($isUser) {
        $userVector = Rating::getUserVector($uid);
    }

    if (isset($userVector) && (count($userVector) >= 10)) {
        echo "<h1>CES JEUX DEVRAIENT VOUS PLAIRE</h1>";
        $recos = Game::getTop10(); //À remplacer par la fonction qui retourne les recommandations pour current user
        echo "<script>displayReco($recos)</script>";
    } else {
        echo "<h1 class='reco-h1'>TOP 10 DES MEILLEURS JEUX</h1>
            <p>Voici le top des jeux les mieux notés par notre communauté. 
            Pour nous permettre de vous recommander des jeux personnellement, 
            veuillez remplir ce <strong><a href='start-form.php'>formulaire</a></strong>.";
        $top10 = Game::getTop10();
        echo "<script>displayReco($top10)</script>";
    }
}
?>