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

    public function getGame() {
        $tab_game = array($this->visuel, $this->name, $this->infos);
        return $tab_game;
    }

    public function getGameForList() {
        $tab_game = array($this->visuel, $this->name);
        return $tab_game;
    }

    public function getVisuel() {
        return $this->visuel;
    }
}

?>