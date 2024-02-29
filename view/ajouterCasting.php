<?php  ob_start(); ?>
<h1>Ajouter un casting</h1>

<?php 
$castingFilm = $req_casting_film->fetchAll(); 
$castingActeur = $req_casting_acteur->fetchAll(); 
$castingRole = $req_casting_role->fetchAll(); 

?>

<form class="form" action="index.php?action=addCasting" method="post">

    <label  class="label">Choisissez un film</label>
                <select class="select" name="id_film" id="id_film" class="form-control" required>
                    <?php foreach($castingFilm as $cast): ?>
                        <option value="<?= $cast['id_film'] ?>"><?= $cast['titre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label  class="label">Choisissez un acteur</label>
                <select class="select" name="id_acteur" id="id_acteur" class="form-control" required>
                    <?php foreach($castingActeur as $cast): ?>
                        <option value="<?= $cast['id_acteur'] ?>"><?= $cast['prenom'] . " " . $cast['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label  class="label">Choisissez un role</label>
                <select class="select" name="id_role" id="id_role" class="form-control" required>
                    <?php foreach($castingRole as $cast): ?>
                        <option value="<?= $cast['id_role'] ?>"><?= $cast['nom_role'] ?></option>
                    <?php endforeach; ?>
                </select>

        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</form>

<?php
        



$titre = "Ajouter casting";
$titre_secondaire = "Ajouter casting";
$info = "ajoute un casting";
$content = ob_get_clean();
require "view/Template.php";