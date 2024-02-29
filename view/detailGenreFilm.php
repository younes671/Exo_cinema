<?php  ob_start(); 
$genre = $requete->fetch();
$films = $film->fetchAll();
?>
<h2><?= "Genre film : " .$genre["libelle"] ?></h2>
<?php
if($films)
{
    foreach($films as $film) 
    {
            echo "<h2>Nom du Film : " . $film["titre"] . "</h2>";
    }
}else{
    echo "<h2>Il n'y a aucun film de ce genre</h2>";
}


$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$info = "Informations sur le genre du film";
$content = ob_get_clean();
require "view/Template.php";
?>