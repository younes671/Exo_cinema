<?php  ob_start(); 

$acteur = $requete->fetchAll();

foreach($acteur as $act) 
{
    echo $act["prenom"] . " " . $act["nom"] . " dans le role de " . $act["nom_role"] . "<br>";
}





















$titre = "Détails Acteurs";
$titre_secondaire = "Détails Acteurs";
$content = ob_get_clean();
require "view/Template.php";