<html>
<?php include_once 'src/templates/html_head.php';
htmlHead('Utilisateurs'); ?>

<body id='user-list-page'>
    <section class='user-list-container'>

    </section>
    <script>
        let db_users = <?php include_once 'src/scripts/users_to_js.php'; ?>
    </script>

    <script src='static/js/user_list.js'></script>
</body>

</html>