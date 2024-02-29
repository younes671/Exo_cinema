<?php  
    ob_start(); 
    $film = $requete->fetch();
    $casting = $reqCasting->fetchAll();
?>



<h1><?= $film["titre"] ?></h1>
<h1>Année de sortie :  <?= $film["annee_sortie"] ?></h1>
<h3>Durée : <?= $film["duree"] ?>min</h3>
<h2>Affiche : </h2><div class="affiche-film"><section class="descritpion-affiche"><img class="affiche-image" src="<?= $film["affiche"] ?>" alt="affiche casino royale"></section></div> 
<h2>Synopsis :</h2> <p class="description"><?= $film["synopsis"] ?></p>
<h3>Note : <?= $film["note"] ?></h3>
<h3>Réalisateur : <?= $film["prenom"] . " " . $film["nom"] ?></h3>

<h2>Casting : </h2>
<?php foreach($casting as $cast) 
{
    echo "<h3>" . $cast["prenom"] . " " . $cast["nom"] . "</h3> <p class='description'>dans le role de :<h3>" . $cast["nom_role"] . "</h3></p>";
}



$titre = "Détail d'un film";
$titre_secondaire = "Détail d'un film";
$content = ob_get_clean();
require "view/Template.php";