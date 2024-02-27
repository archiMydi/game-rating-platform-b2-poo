<?php

include_once("src/templates/database.php");

class game
{
    private int $id;
    private $name;
    private $infos;
    private $visuel;
    private int $metacritic;
    private array $listGender; 
    private array $listGallery;

    /**
     * Création d'un nouvel objet game
     * 
     * @param int $id               Identifiant du jeu
     * @param string $name          Nom du jeu
     * @param string $infos         Informations du jeu
     * @param string $visuel        URL du visuel du jeu
     * @param int $metacritic       Note metacritic du jeu
     * @param array $listGender     Liste des genres du jeu
     * @param array $listGallery    Liste des images de la galerie
     *
     */
    public function __construct($id, $name, $infos, $visuel, $metacritic, $listGender, $listGallery) {
        $this->id = $id;
        $this->name = $name;
        $this->infos = $infos;
        $this->visuel = $visuel;
        $this->metacritic = $metacritic;
        $this->listGender = $listGender;
        $this->listGallery = $listGallery;
    }

    /**
     * Récupère le nom du jeu
     *
     * @return string Retourne le nom
     */
    public function getName(): string
    {
        // renvoie le nom du jeu
        return $this->name;
    }

    /**
     * Récupère l'identifiant du jeu
     *
     * @return int Retourne l'identifiant
     */
    function getID(): int
    {

        return $this->id;
    }

    /**
     * Récupère les informations du jeu
     *
     * @return string Retourne les informations
     */
    public function getGameInfos(): string
    {
        // renvoie les infos du jeu
        return $this->infos;
    }

    /**
     * Récupère l'URL du visuel du jeu
     *
     * @return string Retourne l'URL
     */
    public function getVisuel(): string
    {
        // renvoie l'image principale du jeu
        return $this->visuel;
    }

    public function getMetacritic() : int {
        // retourne note du jeu
        return $this->metacritic;
    }

    /**
     * Récupère la liste des utilisateurs ayant notés ce jeu
     *
     * @return ?array Retourne la liste ou false si aucun utilisateur a noté le jeu
     */
    public function getRatingUsers(): ?array
    {
        // renvoie la liste des users ayant notés un jeu

        // requête récupérant la liste des jeux notés par l'utilisateur
        $sql = 'SELECT u.pseudo FROM rating r 
        INNER JOIN user u ON u.id = r.user_id
        WHERE r.game_id = ' . $this->id . ' GROUP BY u.pseudo;';

        // appelle une fonction pour récupérer les données dans database.php
        $result = getInfosFromDatabase($sql);

        return $result;
    }

    /**
 * Transmet en base de données les données d'un objet de la classe game
 * 
 */
    public function sendNewGameToDatabase() {
        // renvoie la liste des users ayant notés un jeu

        // requête récupérant la liste des jeux notés par l'utilisateur
        $sql_post_game = 'INSERT INTO game(name, visuel, infos, metacritic) VALUES (
            '.$this->name.', '.$this->visuel.', '.$this->infos.', '.$this->metacritic.' 
        );';

        // appelle une fonction dans database.php
        // pour envoyer les données dans la database
        sendDataToDatabase($sql_post_game);

        // récupérer l'id du jeu
        $sql_get_id = 'SELECT id FROM game WHERE visuel = '.$this->visuel.';';
        $game_id = getInfosFromDatabase($sql_get_id);

        $gender_id_array = array();

        // récupérer chaque genre
        foreach ($this->listGender as $x) {
            $sql_get_gender = 'SELECT id FROM gender WHERE name = '.$x.';';
            $gender_id = getInfosFromDatabase($sql_get_gender); // retourne un tableau de longueur 0 ou 1
            if (sizeof($gender_id) > 0) {
                array_push($gender_id_array, $gender_id[0]); // ajoute l'id du genre dans le tableau
            }
            else { // si la requête renvoie un résultat vide, insérer le nouveau genre dans la table gender
                $sql_insert_gender = 'INSERT INTO gender (name) VALUES ('.$x.')';
                sendDataToDatabase($sql_insert_gender);
                // puis ajouter le genre dans le tableau de la liste des genres d'un jeu
                $sql_get_insert_gender_id = 'SELECT id FROM gender WHERE name = '.$x.';';
                $gender_id = getInfosFromDatabase($sql_get_insert_gender_id);
                array_push($gender_id_array, $gender_id[0]);
            }
          }

        // insérer les genres dans la table catégorie (table de liaison entre jeux et genres)
        foreach ($gender_id_array as $y) {
            $sql_insert_into_category = 'INSERT INTO category (game_id, gender_id) 
            VALUES ('.$game_id.', '.$y.')';
            sendDataToDatabase($sql_insert_into_category);
        }

        // insérer les images dans la table galerie
        foreach ($this->listGallery as $z) {
            $sql_insert_into_gallery = 'INSERT INTO category (game_id, url) 
            VALUES ('.$game_id.', '.$z.')';
            sendDataToDatabase($sql_insert_into_gallery);
        }

    }


    public static function getTop10()
    {
        $sql = 'SELECT * FROM game
        ORDER BY name ASC
        LIMIT 10;';

        $top10 = getInfosFromDatabase($sql);
        return json_encode($top10);
    }
}