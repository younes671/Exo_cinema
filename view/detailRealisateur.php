<?php  ob_start(); 
$realisateur = $requete->fetch();
$realisationFilms = $realisation->fetchAll();
?>
<h1><?= $realisateur["prenom"] . " " . $realisateur["nom"] . "<br>Sexe : "
    . $realisateur["sexe"] . "<br>Né le : " . date("d-m-Y", strtotime($realisateur['date_naissance']));?></h1>
<?php
foreach($realisationFilms as $realisationFilm) 
{
    echo "<h2>Film réalisé : " . $realisationFilm["titre"] . " en " . $realisationFilm["annee_sortie"] . "</h2>";
}





$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/Template.php";