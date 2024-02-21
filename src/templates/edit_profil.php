<?php
include_once("src/templates/database.php");
    session_start();
    if($_SESSION['user'] == null) {
        header("Location: login.php");
    }

    $user = $_SESSION['user'];
    $desc = $_POST['desc'] ?? null;
    $avatar = $_POST['avatar'] ?? null;

    if($desc != null || $avatar != null) {

        $err = updateUser($user->getID(), $avatar, $desc);

        if($err == 1) {
            echo "Nous rencontrons un problème, merci de réessayer plus tard";
        }
        else {
            header("Location: account.php");
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Note</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <a href="account.php">Retour</a>
    <form method="POST" action="#">
        <?php

            echo "<label for='desc'>Description</label><br>";
            echo "<input name='desc' type='text' value='".$user->getDescription()."' required>";
            echo "<br><br><label for='avatar'>URL de l'avatar</label><br>";
            echo "<input name='avatar' type='text' value='".$user->getAvatar()."' required>";

        ?>
        <input type="submit" Value="Valider">
    </form>
</body>
</html>