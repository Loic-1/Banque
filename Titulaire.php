<?php

class Titulaire
{
    private $_nom;

    private $_prénom;

    private $_dateNaissance;

    private $_ville;

    private $_comptes;

    public function __construct($nom, $prénom, $dateNaissance, $ville)
    {
        $this->_nom = $nom;
        $this->_prénom = $prénom;
        $this->_dateNaissance = $dateNaissance;
        $this->_ville = $ville;
        $this->_comptes = [];
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function getPrénom()
    {
        return $this->_prénom;
    }

    public function getDateNaissance()
    {
        return $this->_dateNaissance;
    }

    public function getVille()
    {
        return $this->_ville;
    }

    public function getComptes()
    {
        return $this->_comptes;
    }

    public function âge() //https://www.php.net/manual/en/datetime.formats.php#datetime.formats.date
    {
        $aujourdhui = new DateTime();
        $anniversaire = new DateTime($this->_dateNaissance);
        $âge = $aujourdhui->diff($anniversaire)->y; //echo $date1->diff($date2)->y;
        echo "<br>$this->_nom $this->_prénom a $âge ans.<br>";
    }

    public function ajouterCompte($compte)
    {
        array_push($this->_comptes, $compte);
    }

    public function afficherComptes()
    {
        echo "Comptes de " . $this->_nom . " " . $this->_prénom . ": <br>";
        foreach ($this->_comptes as $compte) {
            echo $compte;
        }
    }

    public function __toString()
    {
        $date = new DateTime($this->_dateNaissance);
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE
        );
        $dateNaissance = $formatter->format($date);
        return "$this->_nom $this->_prénom, né le $dateNaissance à $this->_ville";
    }
}
