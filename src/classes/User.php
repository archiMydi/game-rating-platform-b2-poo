<?php
include("../../connection.inc.php");

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

    function checkMDP($mdp) {

        $mdp_crypt = $mdp;

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT mdp FROM user WHERE pseudo = $this->pseudo AND mdp = $mdp_crypt";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                return true;
            }
            else {
                return false;
            }
        } else {
            return false;
        }
        $conn->close();

        //return md5($mdp) == $mdp_db;

    }

    function hasRated($game, $criterion) {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;

    }

}
?>