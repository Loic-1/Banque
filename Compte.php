<?php

require 'Titulaire.php';

class Compte
{
    private string $_libelle;

    private int $_soldeInitial;

    private string $_devise;

    private Titulaire $_titulaire;

    public function __construct(string $libelle, int $soldeInitial, string $devise, Titulaire $titulaire)
    {
        $this->_libelle = $libelle;
        $this->_soldeInitial = $soldeInitial;
        $this->_devise = $devise;
        $this->_titulaire = $titulaire;
        $titulaire->ajouterCompte($this); //pas besoin de rajouter un compte manuellement on met juste $titulaire en dernier parametre
    }

    public function getlibelle() : string
    {
        return $this->_libelle;
    }

    public function getSoldeInitial() : int
    {
        return $this->_soldeInitial;
    }

    public function getDevise() : string
    {
        return $this->_devise;
    }

    public function getTitulaire() : Titulaire
    {
        return $this->_titulaire;
    }

    public function créditer(int $montant)
    {
        $this->_soldeInitial += $montant;
    }

    public function débiter(int $montant)
    {
        if ($montant > $this->_soldeInitial) {
            throw new Exception("PAs assez d'argent.");
        } else {
            $this->_soldeInitial -= $montant;
        }
    }

    public function transférer(Compte $compte, int $montant)
    { //on transfère de $this vers un autre compte
        if ($this->_devise != $compte->getDevise()) {
            throw new Exception("Devises différentes.");
        }
        if ($montant > $this->_soldeInitial) {
            throw new Exception("Pas assez d'argent");
        } else {
            $this->débiter($montant);
            $compte->créditer($montant);
        }
    }

    public function afficherInfos()
    {
        echo "<br>Infos compte $this->_libelle: <br>Solde: $this->_soldeInitial $this->_devise<br>Titulaire: $this->_titulaire<br>";
    }

    public function __toString() : string
    {
        return "<br>Libellé: $this->_libelle<br>Solde: $this->_soldeInitial $this->_devise<br>"; // Titulaire: $this->_titulaire<br>
    }
}
