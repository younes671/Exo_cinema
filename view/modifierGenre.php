<?php  ob_start(); ?>
<?php $genres = $info_genre->fetchAll();?>
<h1>Modifier un genre</h1>

<?php $id_genre = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyGenre" method="post">
        <?php foreach($genres as $genre) { ?>
                <input type="hidden" name="id_genre" value="<?= $id_genre ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Genre</label>
                    <input type="text"  class="form-control" name="libelle" placeholder="<?= $genre['libelle'] ?>">
                </div>
        <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>

<?php

$titre = "Modifier genre";
$titre_secondaire = "Modifier genre";
$content = ob_get_clean();
require "view/Template.php";