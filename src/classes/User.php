class User {

    private String $pseudo;
    private String $email;

    function getPseudo() {

        return $pseudo;

    }

    function getEmail() {

        return $email;

    }

    function checkMDP($mdp) {

        $mdp_db;

        return md5($mdp) == $mdp_db;

    }

    function hasRated(Game game, String criterion) {

        $rated = false;

        //Test si le joueur a déjà voté

        return $rated;

    }

}