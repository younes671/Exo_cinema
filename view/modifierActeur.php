<?php  ob_start(); ?>
<?php $acteurs = $info_acteur->fetchAll();?>
<h1>Modifier  un acteur</h1>
<?php $id_acteur = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyActeur" method="post">
        <?php foreach($acteurs as $acteur) { ?>
                <input type="hidden" name="id_acteur" value="<?= $id_acteur ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Prénom</label>
                    <input type="text"  class="form-control" name="nom" placeholder="<?= $acteur['prenom'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Nom</label>
                    <input type="text"  class="form-control" name="prenom" placeholder="<?= $acteur['nom'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Sexe</label>
                    <input type="text"  class="form-control" name="sexe" placeholder="<?= $acteur['sexe'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Date de naissance</label>
                    <input type="date"  class="form-control" name="date_naissance" placeholder="<?= $acteur['date_naissance'] ?>">
                </div>
        <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>

<?php
        



$titre = "Modifier Acteur";
$titre_secondaire = "Modifier Acteur";
$content = ob_get_clean();
require "view/Template.php";