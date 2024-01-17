<?php

class jeux {

    // constructeur : automatise la construction de classe
    public function __construct(
        public string $nom,
        public string $genre,
        public int $id,
        public array $vecteur) 
        {

        }
    }

?>;