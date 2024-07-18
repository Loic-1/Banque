<?php

require_once 'Compte.php';
require_once 'Titulaire.php';

$titulaire = new Titulaire("Jean", "Jakob", "01/01/1900", "Strasbourg");

$compte = new Compte("A", 300, "Euros", $titulaire);
$compte2 = new Compte("B", 600, "Dollars", $titulaire);

$titulaire->afficherComptes();
$titulaire->âge();

echo "<br>Débiter 200 Euros: <br>";
$compte->afficherInfos();
$compte->débiter(200);
$compte->afficherInfos();

echo "<br>Créditer 200 Euros: <br>";
$compte->afficherInfos();
$compte->créditer(200);
$compte->afficherInfos();

// echo "<br>Transférer 300 Euros vers Dollars(erreur): <br>";/*On peut pas transférer entre 2 devises différentes*/
// $compte->afficherInfos();
// $compte2->afficherInfos();
// $compte->transférer($compte2, 300);
// $compte->afficherInfos();
// $compte2->afficherInfos();

echo "<br>Transférer 300 Dollars: <br>";
$compte3 = new Compte("C", 600, "Dollars", $titulaire);
$compte2->afficherInfos();
$compte3->afficherInfos();
$compte2->transférer($compte3, 300);
$compte2->afficherInfos();
$compte3->afficherInfos();