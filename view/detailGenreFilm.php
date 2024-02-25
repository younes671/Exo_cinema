<?php  ob_start(); 
$genre = $requete->fetch();
$films = $film->fetchAll();
?>
<h2><?= "Genre film : " .$genre["libelle"] ?></h2>
<?php
foreach($films as $film) 
{
    echo "<h2>Nom du Film : " . $film["titre"] . "</h2>";
}


$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/Template.php";
?>