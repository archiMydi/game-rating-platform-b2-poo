<?php
function htmlHead($title)
{
    echo "<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>$title</title>
    <link rel='stylesheet' type='text/css' media='screen' href='static/css/style.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap' rel='stylesheet'>
</head>";
}
