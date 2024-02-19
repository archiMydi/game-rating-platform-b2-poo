<?php
include("src/templates/connection.inc.php");

class User
{

    private int $id; // = 1;
    private String $pseudo; // = "enzo";
    private String $email; // = "enzo.guillemet@my-digital-school.org";
    //Description, pp, jeux pref -> add BDD
    private String $description; // = "rien";
    private String $avatar; // = "rien";
    private int $jeu_fav; // = 3;

    public function __construct($id, $pseudo, $email, $description, $avatar, $jeu_fav)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->description = $description;
        $this->avatar = $avatar;
        $this->jeu_fav = $jeu_fav;
    }

    function getPseudo()
    {

        return $this->pseudo;
    }

    function getEmail()
    {

        return $this->email;
    }

    function checkMDP($mdp)
    {

        // encryptage du mot de passe avec l'algorithme BCRYPT, 
        // crée une chaîne de 60 caractères
        $mdp_crypt = password_hash($mdp, PASSWORD_BCRYPT);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT mdp FROM user WHERE pseudo = $this->pseudo AND mdp = $mdp_crypt";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            if ($row = $result->fetch_assoc()) {
                return true;
            } else {
                return false;
            }
            $conn->close();
        } else {

            echo "Null";
        }

        //return md5($mdp) == $mdp_db;

    }

    function hasRated($game, $criterion)
    {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;
    }
}
