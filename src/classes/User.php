<?php

include_once("src/templates/database.php");

class user {

    private int $id; // = 1;
    private String $pseudo; // = "enzo";
    private String $email; // = "enzo.guillemet@my-digital-school.org";
    //Description, pp, jeux pref -> add BDD
    private ?String $description = null; // = "rien";
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

    /**
     * Récupère le pseudo de l'utilisateur
     *
     * @return string Retourne le pseudo
     */
    function getPseudo() : string {

        return $this->pseudo;

    }

    /**
     * Récupère l'adresse email de l'utilisateur
     *
     * @return string Retourne l'adresse email
     */
    function getEmail() : string {

        return $this->email;

    }
    
    /**
     * Récupère l'identifiant de l'utilisateur
     *
     * @return int Retourne l'identifiant
     */
    function getID() : int {

        return $this->id;

    }

    /**
     * Récupère la description de l'utilisateur
     *
     * @return ?string Retourne la description (ou 'null' s'il n'y en a pas)
     */
    function getDescription() : ?string {
        return $this->description;
    }

    /**
     * Vérifie si le mot de passe rentrer est bon
     * 
     * @param string $mdp   Mot de passe rentrer (non crypté pour le moment)
     *
     * @return bool
     */
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

    /**
     * Vérifie si l'utilisateur a bien noté un critère spécifique d'un jeu
     * 
     * @param int $game         Identifiant du jeu
     * @param int $criterion    Identifiant du critère
     *
     * @return bool
     */
    function hasRated($game, $criterion) {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;

    }

    /**
     * Vérifie si l'utilisateur a bien noté un jeu spécifique
     * 
     * @param int $game    Identifiant du jeu
     *
     * @return bool
     */
    function hasRatedGame($id_game) {

        return checkRatingGame($id_game, $this->id);

    }

    /**
     * Récupère la liste des jeux noter par l'utilisateur
     *
     * @return array Retourne une liste de jeux ([id jeux, nom])
     */
    function getRatedGame() : array {

        return getRatedGame($this->id);

    }

    /**
     * Récupère la liste des jeux non noter par l'utilisateur
     *
     * @return array Retourne une liste de jeux ([id jeux, nom])
     */
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