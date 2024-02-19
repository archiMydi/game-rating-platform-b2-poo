<?php

include_once("src/templates/database.php");

class game {
    private int $id;
    private $name;
    private $infos;
    private $visuel;
    public function __construct($id, $name, $infos, $visuel) {
        $this->id = $id;
        $this->name = $name;
        $this->infos = $infos;
        $this->visuel = $visuel;
    }

    public function getName() {
        // renvoie le nom du jeu
        return $this->name;
    }

    public function getGameInfos() {
        // renvoie les infos du jeu
        return $this->infos;
    }

    public function getVisuel() {
        // renvoie l'image principale du jeu
        return $this->visuel;
    }


    public function GetRatingUsers() {
        // renvoie la liste des users ayant notés un jeu

        // requête récupérant la liste des jeux notés par l'utilisateur
        $sql = 'SELECT u.pseudo FROM rating r 
        INNER JOIN user u ON u.id = r.user_id
        WHERE r.game_id = '.$this->id.' GROUP BY u.pseudo;';

        // appelle une fonction pour récupérer les données dans database.php
        $result = getInfosFromDatabase($sql);

        return $result;

    }
}

?>