<?php  
    ob_start(); 
    $film = $requete->fetch();
    $casting = $reqCasting->fetchAll();
?>

<h1><?= $film["titre"] . "<br><br>Année de sortie : " . $film["annee_sortie"] . "<br><br>Durée : " . $film["duree"] . " min<br><br> Affiche : " . $film["affiche"] . "<br><br>Synopsis : <br>" . $film["synopsis"] . "<br><br>Note : " . $film["note"] . " étoiles<br><br> Réalisateur : " . $film["prenom"] . " " . $film["nom"] . "<br>" ?></h1>
<h2>Casting : </h2>
<?php foreach($casting as $cast) 
{
    echo "<h3>" . $cast["prenom"] . " " . $cast["nom"] . " dans le role de " . $cast["nom_role"] . "</h3><br>";
}



$titre = "Détail d'un film";
$titre_secondaire = "Détail d'un film";
$content = ob_get_clean();
require "view/Template.php";