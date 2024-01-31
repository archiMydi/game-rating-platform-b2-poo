<?php

class User {
    private string $pseudo;
    private string $mdp;
    private array $deja_note;
    protected $id;
    public array $vecteur;
    // constructeur : automatise la construction de classe
    public function __construct($pseudo, $mdp, $deja_note, $id, $vecteur) 
        {
            $this->pseudo = $pseudo;
            $this->mdp = $mdp;
            $this->deja_note = $deja_note;
            $this->id = $id;
            $this->vecteur = $vecteur;
        }
    }

?>;