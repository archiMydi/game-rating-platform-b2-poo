<?php
function getRawgApiData()
{
    $url = 'https://api.rawg.io/api/games?key=8bfd7a86de0c43139aae5337a6a07d88&page_size=10000';
    $data = file_get_contents($url);
    $rawgData = json_decode($data, true);
    insertData($rawgData);
};

function insertData($data)
{
    $gamesData = [];

    $results = $data["results"];
    foreach ($results as $element) {
        $gamesData[] = dataGame($element);
    };

    $jsonData = json_encode($gamesData);

    $file = './data.json';
    file_put_contents($file, $jsonData);

    $fileContent = file_get_contents('data.json');

    echo "Petit test accès data.json" . $fileContent;
};

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