<?php
include_once("src/templates/database.php");
    session_start();
    if($_SESSION['user'] == null) {
        header("Location: login.php");
    }

    $user = $_SESSION['user'];
    $id_g = $_GET['id_g'];
    $new = $_GET['new'] ?? false;

    if($new !== true && $new !== false) {
        $new = false;
    }

    $list = array();

    $criterion = getListCriterion();
    foreach($criterion as $id => $name) {

        $note = $_POST[$id] ?? null;
        if($note != null) {

            $list[$id] = $note;

        }
        else {
            break;
        }


    }

    if(count($list) > 0) {

        if($new) {

            $err = insertRating($user->getID(), $id_g, $list);

            if($err == 1) {
                echo "Nous rencontrons un problème, merci de réessayer plus tard";
            }
            else {
                header("Location: account.php");
            }

        }
        else {

            $err = updateRating($user->getID(), $id_g, $list);

            if($err == 1) {
                echo "Nous rencontrons un problème, merci de réessayer plus tard";
            }
            else {
                header("Location: account.php");
            }

        }

    }
    else {
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

            if($new) {

                $criterion = getListCriterion();
                foreach($criterion as $id => $name) {
                    
                    echo "<label for='$id'>$name</label>
                        <br>
                        <input name='$id' type='radio' value='0' required>0
                        <br>
                        <input name='$id' type='radio' value='1' required>1
                        <br>
                        <input name='$id' type='radio' value='2' required>2
                        <br>
                        <input name='$id' type='radio' value='3' required>3
                        <br>
                        <input name='$id' type='radio' value='4' required>4
                        <br>
                        <input name='$id' type='radio' value='5' required>5
                        <br><br>";

                }

            }
            else {

                $list_c = getListCriterion();
                $criterion = getRatingGame($id_g, $user->getID());
                foreach($criterion as $id => $elm) {
                    unset($list_c[$id]);
                    $nom = $elm[0];
                    $note = $elm[1];
                    echo "<label for='$id'>$nom</label><br>";
                    echo "<input name='$id' type='radio' value='0' required";
                    if($note == 0) {
                        echo " checked";
                    }
                    echo ">0<br><input name='$id' type='radio' value='1' required";
                    if($note == 1) {
                        echo " checked";
                    }
                    echo ">1<br><input name='$id' type='radio' value='2' required";
                    if($note == 2) {
                        echo " checked";
                    }
                    echo ">2<br><input name='$id' type='radio' value='3' required";
                    if($note == 3) {
                        echo " checked";
                    }
                    echo ">3<br><input name='$id' type='radio' value='4' required";
                    if($note == 4) {
                        echo " checked";
                    }
                    echo ">4<br><input name='$id' type='radio' value='5' required";
                    if($note == 5) {
                        echo " checked";
                    }
                    echo ">5<br><br>";

                }

                if(count($list_c) > 0) {

                    foreach($list_c as $id => $nom) {

                        echo "<label for='$id'>$nom</label><br>
                        <input name='$id' type='radio' value='0' required>0
                        <br>
                        <input name='$id' type='radio' value='1' required>1
                        <br>
                        <input name='$id' type='radio' value='2' required>2
                        <br>
                        <input name='$id' type='radio' value='3' required>3
                        <br>
                        <input name='$id' type='radio' value='4' required>4
                        <br>
                        <input name='$id' type='radio' value='5' required>5
                        <br><br>";

                    }

                }

            }

        ?>
        <input type="submit" Value="Valider">
    </form>
</body>
</html>