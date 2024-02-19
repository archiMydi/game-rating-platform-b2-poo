<?php

include_once("src/templates/database.php");

class user {

    private int $id; // = 1;
    private String $pseudo; // = "enzo";
    private String $email; // = "enzo.guillemet@my-digital-school.org";
    //Description, pp, jeux pref -> add BDD
    private String $description; // = "rien";
    private String $avatar; // = "rien";
    private int $jeu_fav; // = 3;

    public function __construct($id, $pseudo, $email, $description, $avatar, $jeu_fav) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        if($description != null) {
            $this->description = $description;
        }
        if($avatar != null) {
            $this->avatar = $avatar;
        }
        if($jeu_fav != null) {
            $this->jeu_fav = $jeu_fav;
        }
    }

    function getPseudo() {

        return $this->pseudo;

    }

    function getEmail() {

        return $this->email;

    }

    function getID() {

        return $this->id;

    }

    function getDescription() {
        return $this->description;
    }

    function checkMDP($mdp) {

        global $conn;

        // encryptage du mot de passe avec l'algorithme BCRYPT, 
        // crée une chaîne de 60 caractères
        $mdp_crypt = password_hash($mdp, PASSWORD_BCRYPT);

        if($mdp == getMDP($this)) {

            return true;

        }
        else {

            return false;

        }

        //return md5($mdp) == $mdp_db;

    }

    function hasRated($game, $criterion) {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;

    }

    function hasRatedGame($id_game) {

        return checkRatingGame($id_game, $this->id);

    }

    function getRatedGame() : array {

        return getRatedGame($this->id);

    }

    function getNotRatedGame() : array {

        $games_r = GetAllGames();
        $games = array();
        $ratedGame = getRatedGame($this->id);

        foreach($games_r as $game) {

            $game_elm = [$game['id'], $game['name']];

            if(!in_array($game_elm, $ratedGame)) {

                array_push($games, $game_elm);

            }

        }

        return $games;

    }

}
?>