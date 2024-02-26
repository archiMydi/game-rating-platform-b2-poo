<?php

include_once("src/templates/database.php");

class game
{
    private int $id;
    private $name;
    private $infos;
    private $visuel;

    /**
     * Création d'un nouvel objet game
     * 
     * @param int $id               Identifiant du jeu
     * @param string $name          Nom du jeu
     * @param string $infos         Informations du jeu
     * @param string $visuel        URL du visuel du jeu
     *
     */
    public function __construct($id, $name, $infos, $visuel)
    {
        $this->id = $id;
        $this->name = $name;
        $this->infos = $infos;
        $this->visuel = $visuel;
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

    public static function getTop10()
    {
        $sql = 'SELECT * FROM game
        ORDER BY name ASC
        LIMIT 10;';

        $top10 = getInfosFromDatabase($sql);
        return json_encode($top10);
    }
}
