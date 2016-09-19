<!--
Web Programming Term Project
Team name: Web Apes
Team members: Ashley Baik, John Chiao, Yongquan Tan, Yuchen Yuan
This is common.php, the common things to show search result.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Midnight Munchies</title>
        <meta charset = "utf-8" />
        <link href = "css/bootstrap.min.css" type = "text/css" rel = "stylesheet" />
        <link href = "css/food.css" type = "text/css" rel = "stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Raleway:200italic,300' rel='stylesheet' type='text/css'>
    </head>

    <body class="container">
    <div class="background-image text-center"></div>
    <div class="content text-center">

        <?php
        /* Check input */
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = '';
        } // if

        if (isset($_GET['ingredients'])) {
            $ingredients = $_GET['ingredients']; // array of ingredients input
            $ingStr = ''; // string that has all non-empty ingredients separated by commas
            for ($i = 0; $i < count($ingredients); $i++) {
                if (!empty($ingredients[$i])) {
                    $ingStr .= $ingredients[$i] . ',';
                } // if
            } // for
            $ingStr = rtrim($ingStr, ',');
            $ingredients = explode(',', $ingStr); // array of ingredients without repeating empty entry
        } else {
            $ingStr = $ingredients = NULL;
        } // if

        if (empty($type) && empty($ingStr)) {
            echo '<h3 class="error">Error: Empty request! <br>Please specify a type, Sweet or Savory, or enter at least 1 ingredient. <br>The page will be redirected to the front page in 5 seconds!</h3>';
            header('refresh:5; url=index.php');
        } // if
        ?>
