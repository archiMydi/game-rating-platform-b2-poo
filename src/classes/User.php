<?php

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
        $this->description = $description;
        $this->avatar = $avatar;
        $this->jeu_fav = $jeu_fav;
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
            $sql = "SELECT * FROM user WHERE pseudo = '$this->pseudo' AND password = '$mdp_crypt'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if ($result > 0) {
                // output data of each row
                return true;
                
            } else {
                return false;
            }
            $conn->close();

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

}
?>