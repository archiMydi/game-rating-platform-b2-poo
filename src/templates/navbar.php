<!--NAVBAR-->
<nav>
    <h3><a href='index.php'>Game Rating Platform</a></h3>
    <ul class="navbar">
        <li><a href="index.php">Jeux</a></li>
        <li><a href="user_list.php">Users</a></li>
        <li><a href="recommandation.php">Recommandations</a></li>
        <li>
            <?php
            if (isset($_SESSION['user'])) {
                echo "<p><a class='no-padding-a' href='src/templates/logout.php'>Log out</a></p>";
                echo "</li><li><p><a class='no-padding-a' href='account.php'>Account</a></p>";
            } else {
                echo "<p onclick='showLoginForm()'>Login</p>";
            }
            ?>
        </li>
    </ul>
</nav>