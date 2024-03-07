<?php  ob_start(); ?>
<?php $realisateurs = $info_realisateur->fetchAll();?>
<h1>Modifier un realisateur</h1>

<?php $id_realisateur = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyRealisateur" method="post">
        <?php foreach($realisateurs as $realisateur) { ?>
                <input type="hidden" name="id_realisateur" value="<?= $id_realisateur ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Prénom</label>
                    <input type="text"  class="form-control" name="nom" placeholder="<?= $realisateur['prenom'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Nom</label>
                    <input type="text"  class="form-control" name="prenom" placeholder="<?= $realisateur['nom'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Sexe</label>
                    <input type="text"  class="form-control" name="sexe" placeholder="<?= $realisateur['sexe'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Date de naissance</label>
                    <input type="date"  class="form-control" name="date_naissance" placeholder="<?= $realisateur['date_naissance'] ?>">
                </div>
        <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>

<?php

$titre = "Modifier realisateur";
$titre_secondaire = "Modifier realisateur";
$info = "met à jour informations réalisateur";
$content = ob_get_clean();
require "view/Template.php";


