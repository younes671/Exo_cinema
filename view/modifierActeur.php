<?php  ob_start(); ?>
<h1>Modifier  un acteur</h1>
<?php $id_acteur = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyActeur" method="post">
                <input type="hidden" name="id_acteur" value="<?= $id_acteur ?>">
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
        



$titre = "Modifier Acteur";
$titre_secondaire = "Modifier Acteur";
$content = ob_get_clean();
require "view/Template.php";