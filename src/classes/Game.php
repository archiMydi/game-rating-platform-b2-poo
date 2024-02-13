<?php

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
        // renvoie la liste des USERS ayant notés un jeu

        // possibilité de récupérer un vecteur ratings dans user 
        // (nécéssite d'abord l'implémentation de la fonction GetRatedGames dans user)
        return;
    }
}

?>