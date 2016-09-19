<!--
Web Programming Term Project
Team name: Web Apes
Team members: Ashley Baik, John Chiao, Yongquan Tan, Yuchen Yuan
This is search.php, the page that shows search results for recipes.
-->

<?php include 'common.php'; ?>

<div id="results">
    <h2 class="recipe">Results for <?php echo $type ?> food<?php
        if (!empty($ingStr)) {
            echo ' with ingredient(s) ';
            for ($i = 0; $i < count($ingredients); $i++) {
                if (count($ingredients) == 1) {
                    echo $ingredients[$i];
                } else if ($i != count($ingredients) - 1) {
                    echo $ingredients[$i] . ', ';
                } else {
                    echo 'and ' . $ingredients[$i] . ': ';
                } // if
            } // for
        } // if
        ?>
    </h2>


    <?php
    $API_KEY = 'bb752a9ec4d07f7d8ed00174305228d3'; // food2fork API key

    /* Search recipes that include ingredients requested */
    $searchQuery = $type . ','; // search query including sweet/savory type
    for ($i = 0; $i < count($ingredients); $i++) {
        $searchQuery .= $ingredients[$i] . ',';
    } // for
    $searchQuery = rtrim($searchQuery, ',');

    $search = file_get_contents('http://food2fork.com/api/search?key=' . $API_KEY . '&q=' . $searchQuery);
    $searchData = json_decode($search);

    $recipesCount = $searchData->count; // max 30
    $recipesSearch = $searchData->recipes; // array of recipes
    $recipesId = array();
    for ($i = 0; $i < count($recipesSearch); $i++) {
        array_push($recipesId, $recipesSearch[$i]->recipe_id);
    } // for


    /* Get each complete recipe from "$recipes" list and show */
    $recipes = array_pad(array(), count($recipesSearch), '');
    for ($i = 0; $i < count($recipesId); $i++) {
        $getRecipe = file_get_contents('http://food2fork.com/api/get?key=' . $API_KEY . '&rId=' . $recipesId[$i]);
        $getRecipeData = json_decode($getRecipe);
        $recipe = $getRecipeData->recipe;

        $recipes[$i] = array(
            'rid' => $recipe->recipe_id,
            'title' => $recipe->title,
            'publisher' => $recipe->publisher,
            'publisherurl' => $recipe->publisher_url, // base url of the publisher
            'sourceurl' => $recipe->source_url, // original url of the recipe on the publisher's site
            'f2furl' => $recipe->f2f_url, // url of the recipe on Food2Fork.com
            'imageurl' => $recipe->image_url,
            'socialrank' => $recipe->social_rank,
            'ingredients' => $recipe->ingredients,
        );


        /* Show result */
        $output = '<div class="recipe">';
        $output .= '<h2><a href="'.$recipes[$i]['sourceurl']. '">' . $recipes[$i]['title'] . '</a></h2>';
        $output .= '<img src="' . $recipes[$i]['imageurl'] . '" alt = "' . $recipes[$i]['title'] . '" />';
        $output .= '<h4>Ingredients:</h4><ul class="list-group">';
        for ($j = 0; $j < count($recipes[$i]['ingredients']); $j++) {
            $output .= '<li class="list-group-item">' . $recipes[$i]['ingredients'][$j] . '</li>';
        } // for
        $output .= '</ul></div><br>';

        echo $output;
    } // for

    include 'bottom.html';
    ?>