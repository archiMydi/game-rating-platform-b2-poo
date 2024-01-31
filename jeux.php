<?php

class jeux {

    // constructeur : automatise la construction de classe
    public function __construct(
        private string $nom,
        private string $genre,
        protected int $id,
        public array $vecteur) 
        {

        }
    }

?>;