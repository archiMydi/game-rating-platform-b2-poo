<div class='login-modal'>
    <div class='login-modal-content'>
        <h1>Welcome Back</h1>
        <p>Please login to your account</p>
        <form method="POST" action="#">
            <input type="text" placeholder="Username or Email" name="id" required>
            <input type="password" placeholder="Password" name="pwd" required>
            <input type="submit" Value="Submit">
        </form>
        <p>You don't have an account yet ? <a href="./signup.php">Sign up</a></p>
    </div>
</div>

<?php
$id = $_POST['id'] ?? null;
$mdp = $_POST['pwd'] ?? null;

if ($id != null && $mdp != null) {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/src/templates/database.php");

    $user = getUser($id, $mdp);

    if ($user != null) {
        $_SESSION['user'] = $user;
        header('Location: account.php');
    } else {

        echo "Identifiant ou mot de passe invalide";
    }
}

?>