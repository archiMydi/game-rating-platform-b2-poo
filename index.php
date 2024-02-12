<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        error_reporting(E_ALL); ini_set("display_errors", 1);
        include("src/classes/User.php");
        $test = new User(); // ajouter paramètres
        if($test->checkMDP("password")) {

            echo "C'est bon";

        }
        else {

            echo "Faux";

        }
    ?>
</body>
</html>