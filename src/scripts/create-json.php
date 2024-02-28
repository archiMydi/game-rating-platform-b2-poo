<?php
/**
 * Fonction appelant l'API, page de 1 à 50
 * Appel de la fonction insertData pour traiter les données
 */
function getRawgApiData()
{
    for($page = 1; $page <= 50; $page++) {
        $url = 'https://api.rawg.io/api/games?key=8bfd7a86de0c43139aae5337a6a07d88&page='. $page;
        $data = file_get_contents($url);
        $rawgData = json_decode($data, true);
        insertData($rawgData, $page); 
    };
};

/**
 * Traitement des données, en entrée un fichier de data et le numéro de la page (de l'API)
 * Création de fichier data(numéro de page).json contenant les données des jeux ($gamesData)
 * Appel de la fonction dataGame dans le foreach
 */
function insertData($data, $page)
{
    $gamesData = array();

    $results = $data["results"];
    // echo $results;
    
    foreach ($results as $element) {
        $gamesData[] = dataGame($element);
    };
    // var_dump($gamesData);
    
    $jsonData = json_encode($gamesData);

    $file = './data'. $page .'.json';
    file_put_contents($file, $jsonData);

    $fileContent = file_get_contents('./data'. $page .'.json');

    // //echo "Petit test accès data.json : " . $fileContent;
};

/**
 * Traitement des données d'un seul jeu. Récupération des données : name, background_image, genres, images, short_screenshots, tags, metacritic.
 */
function dataGame($game)
{
    $name = $game["name"];
    $visuel = $game["background_image"];
    $genres = array_map(function ($genre) {
        return $genre["name"];
    }, $game["genres"]);
    $galery = array_map(function ($screen) {
        return $screen["image"];
    }, $game["short_screenshots"]);
    $tags = array_map(function ($tag) {
        return $tag["name"];
    }, $game["tags"]);
    $metacritic = $game["metacritic"];

    return [
        "name" => $name,
        "visuel" => $visuel,
        "genres" => $genres,
        "galery" => $galery,
        "tags" => $tags,
        "metacritic" => $metacritic
    ];
}