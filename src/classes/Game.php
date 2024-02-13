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
        return $this->name;
    }

    public function getGameInfos() {
        return $this->infos;
    }

    public function getVisuel() {
        return $this->visuel;
    }
}

?>