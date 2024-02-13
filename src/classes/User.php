<?php

class user {

    private int $id; // = 1;
    private String $pseudo; // = "enzo";
    private String $email; // = "enzo.guillemet@my-digital-school.org";
    //Description, pp, jeux pref -> add BDD
    private String $description; // = "rien";
    private String $avatar; // = "rien";
    private int $jeu_fav; // = 3;

    public function __construct($pseudo, $mdp, $conn) {
        $this->pseudo = $pseudo;
        $sql = "SELECT * FROM user WHERE pseudo = '$this->pseudo' AND password = '$mdp'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $stmt->fetchAll();
        if ($result > 0) {
            $this->id = $tab[0]['id'];
            $this->email = $tab[0]['email'];
        }
    }

    function getPseudo() {

        return $this->pseudo;

    }

    function getEmail() {

        return $this->email;

    }

    function checkMDP($mdp, $conn) {

        // encryptage du mot de passe avec l'algorithme BCRYPT, 
        // crée une chaîne de 60 caractères
        $mdp_crypt = password_hash($mdp, PASSWORD_BCRYPT);

        // Check connection
        if($conn != null) {
            $sql = "SELECT * FROM user WHERE pseudo = '$this->pseudo' AND password = '$mdp'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $tab = $stmt->fetchAll();
            if ($result > 0) {
                // output data of each row
                return true;

            } else {
                return false;
            }

        }
        else {

            echo "Null";

        }

        //return md5($mdp) == $mdp_db;

    }

    function hasRated($game, $criterion) {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;

    }

    public function GetRatedGames() {
        // renvoie la liste des jeux notés

        /* paramètres nécéssaires :
        - ratings où user = pseudo
        ObjectUser.GetRatedGames -> SELECT * FROM RATING r WHERE
         r.user_id = ObjectUser.id
        */ 
        return;
    }

}
?>