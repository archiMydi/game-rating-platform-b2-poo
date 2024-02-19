<?php
include_once 'src/classes/User.php';
$userListJSON = User::getUserListJSON($conn);
?>
<html>
<?php include_once 'src/templates/html_head.php';
htmlHead('Utilisateurs'); ?>

<body id='user-list-page'>
    <?php include_once 'src/templates/user_details.php'; ?>

    <section class='user-list-container'>

    </section>
    <script>
        let db_users = <?php echo $userListJSON; ?>
    </script>

    <script src='static/js/user_list.js'></script>
</body>

</html>