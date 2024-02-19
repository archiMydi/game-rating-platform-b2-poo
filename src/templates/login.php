<?php
    session_start();
    session_destroy();
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
            <label>Pseudo ou Adresse Email</label>
            <input type="text" name="id" required>
            <label>Password</label>
            <input type="password" name="pwd" required>
            <input type="submit" Value="Valider">
        </form>
        <?php
            $id = $_POST['id'] ?? null;
            $mdp = $_POST['pwd'] ?? null;
            
            if($id != null && $mdp != null) {
           
                include_once("src/templates/database.php");
           
                $user = getUser($id, $mdp);
        
                if($user != null) {
            
                    $_SESSION['user'] = $user;
                    header('Location: account.php');
            
                }
                else {
            
                    echo "Identifiant ou mot de passe invalide";
            
                }
            }
        ?>
    </body>
</html>