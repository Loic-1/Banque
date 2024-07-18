<?php

class Titulaire
{
    private string $_nom;

    private string $_prenom;

    private string $_dateNaissance;

    private string $_ville;

    private array $_comptes;

    public function __construct(string $nom, string $prenom, string $dateNaissance, string $ville)
    {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_dateNaissance = $dateNaissance;
        $this->_ville = $ville;
        $this->_comptes = [];
    }

    public function getNom() : string
    {
        return $this->_nom;
    }

    public function getprenom() : string
    {
        return $this->_prenom;
    }

    public function getDateNaissance() : string
    {
        return $this->_dateNaissance;
    }

    public function getVille() : string
    {
        return $this->_ville;
    }

    public function getComptes() : array
    {
        return $this->_comptes;
    }

    public function âge() //https://www.php.net/manual/en/datetime.formats.php#datetime.formats.date
    {
        $aujourdhui = new DateTime();
        $anniversaire = new DateTime($this->_dateNaissance);
        $âge = $aujourdhui->diff($anniversaire)->y; //echo $date1->diff($date2)->y;
        echo "<br>$this->_nom $this->_prenom a $âge ans.<br>";
    }

    public function ajouterCompte(Compte $compte)
    {
        array_push($this->_comptes, $compte);
    }

    public function afficherComptes()
    {
        echo "Comptes de " . $this->_nom . " " . $this->_prenom . ": <br>";
        foreach ($this->_comptes as $compte) {
            echo $compte;
        }
    }

    public function __toString() : string
    {
        $date = new DateTime($this->_dateNaissance);
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE
        );
        $dateNaissance = $formatter->format($date);
        return "$this->_nom $this->_prenom, né le $dateNaissance à $this->_ville";
    }
}
