<?php  ob_start(); 
$acteur = $requete->fetch();
$playActeurs = $reqPlay->fetchAll();
?>
<h1><?= $acteur["prenom"] . " " . $acteur["nom"] . "<br>Sexe : "
    . $acteur["sexe"] . "<br>Né le : " . date("d-m-Y", strtotime($acteur['date_naissance']));?></h1>
<?php
foreach($playActeurs as $playActeur) 
{
    echo "<h2>A jouer dans le film : " . $playActeur["titre"] . "<br>Dans le role de : " . $playActeur["nom_role"] . "</h2>";
}
?>

















<?php


$titre = "Détails Acteurs";
$titre_secondaire = "Détails Acteurs";
$content = ob_get_clean();
require "view/Template.php";