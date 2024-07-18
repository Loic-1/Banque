<?php

require 'Titulaire.php';

class Compte
{
    private $_libellé;

    private $_soldeInitial;

    private $_devise;

    private $_titulaire;

    public function __construct($libellé, $soldeInitial, $devise, $titulaire)
    {
        $this->_libellé = $libellé;
        $this->_soldeInitial = $soldeInitial;
        $this->_devise = $devise;
        $this->_titulaire = $titulaire;
        $titulaire->ajouterCompte($this); //pas besoin de rajouter un compte manuellement on met juste $titulaire en dernier parametre
    }

    public function getLibellé()
    {
        return $this->_libellé;
    }

    public function getSoldeInitial()
    {
        return $this->_soldeInitial;
    }

    public function getDevise()
    {
        return $this->_devise;
    }

    public function getTitulaire()
    {
        return $this->_titulaire;
    }

    public function créditer($montant)
    {
        $this->_soldeInitial += $montant;
    }

    public function débiter($montant)
    {
        if ($montant > $this->_soldeInitial) {
            throw new Exception("PAs assez d'argent.");
        } else {
            $this->_soldeInitial -= $montant;
        }
    }

    public function transférer($compte, $montant)
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
        echo "<br>Infos compte $this->_libellé: <br>Solde: $this->_soldeInitial $this->_devise<br>Titulaire: $this->_titulaire<br>";
    }

    public function __toString()
    {
        return "<br>Libellé: $this->_libellé<br>Solde: $this->_soldeInitial $this->_devise<br>"; // Titulaire: $this->_titulaire<br>
    }
}
