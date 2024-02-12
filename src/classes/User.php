<?php

class User {

    private int $id = 1;
    private String $pseudo = "enzo";
    private String $email = "enzo.guillemet@my-digital-school.org";
    //Description, pp, jeux pref -> add BDD
    private String $description = "rien";
    private String $avatar = "rien";
    private int $jeu_fav = 3;

    function getPseudo() {

        return $this->pseudo;

    }

    function getEmail() {

        return $this->email;

    }

    function checkMDP($mdp, $conn) {

        $mdp_crypt = $mdp;

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