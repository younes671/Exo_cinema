<?php  ob_start(); ?>
<?php $roles = $info_role->fetchAll();?>
<h1>Modifier un role</h1>

<?php $id_role = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyRole" method="post">
        <?php foreach($roles as $role) { ?>
                <input type="hidden" name="id_role" value="<?= $id_role ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Role</label>
                    <input type="text"  class="form-control" name="nom_role" placeholder="<?= $role['nom_role'] ?>">
                </div>
        <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>

<?php

$titre = "Modifier role";
$info = "met à jour informations role d'un acteur";
$titre_secondaire = "Modifier role";
$content = ob_get_clean();
require "view/Template.php";