<?php  ob_start(); ?>
<h1>Modifier un realisateur</h1>

<?php $id_realisateur = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form action="index.php?action=modifyRealisateur" method="post">
                <input type="text" name="id_realisateur" value="<?= $id_realisateur ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Nom</label>
                    <input type="text"  class="form-control" name="nom">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Prénom</label>
                    <input type="text"  class="form-control" name="prenom">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Sexe</label>
                    <input type="text"  class="form-control" name="sexe">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Date de naissance</label>
                    <input type="date"  class="form-control" name="date_naissance">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
        </form>

<?php

$titre = "Modifier realisateur";
$titre_secondaire = "Modifier realisateur";
$content = ob_get_clean();
require "view/Template.php";