<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Login</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>
    </head>
    <body>
        <form method="POST" action="#">
            <label>Pseudo</label>
            <input type="text" name="pseudo" required>
            <label>Adresse Email</label>
            <input type="text" name="email" required>
            <label>Password</label>
            <input type="password" name="pwd" required>
            <input type="submit" Value="Valider">
        </form>
        <?php
            $pseudo = $_POST['pseudo'] ?? null;
            $email = $_POST['email'] ?? null;
            $mdp = $_POST['pwd'] ?? null;
            
            if($pseudo != null && $email != null && $mdp != null) {
            
                include_once($_SERVER['DOCUMENT_ROOT']."/src/templates/database.php");
            
                $err = registerNewUser($pseudo, $mdp, $email);
                if ($err == 1) {
                    echo "Ce pseudo est déjà utilisé";
                }
                else if ($err == 2) {
                    echo "Cette adresse email est déjà utilisé";
                }
                else if ($err == 3) {
                    echo "Nous rencontrons un problème, merci de réessayer plus tard";
                }
                else {
                    echo "Connexion réussi !";
                    $_SESSION['user'] = getUserByPseudo($pseudo);
                }
            }
        ?>
    </body>
</html>