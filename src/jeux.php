<?php

class Jeux {
    private string $nom;
    private string $genre;
    protected int $id;
    public array $vecteur;
    // constructeur : automatise la construction de classe
    public function __construct($nom, $genre, $id, $vecteur) 
        {
            $this->nom = $nom;
            $this->genre = $genre;
            $this->id = $id;
            $this->vecteur = $vecteur;
        }
    }

?>;