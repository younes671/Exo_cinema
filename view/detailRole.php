<?php  ob_start(); 
$role = $requete->fetch();
$acteurs = $acteur->fetchAll();
?>
<h2><?= "Nom role : " . $role["nom_role"] ?></h1>
<?php
foreach($acteurs as $acteur) 
{
    echo "<h2>Acteur : " . $acteur["prenom"] . " " . $acteur["nom"] . "</h2>",
    "<h2>Dans le film : " . $acteur["titre"] . "</h2>";
}


$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/Template.php";
?>