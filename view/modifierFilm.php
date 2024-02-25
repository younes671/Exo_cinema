<?php  ob_start(); ?>
<h1>Modifier  un film</h1>
<?php $id_film = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form action="index.php?action=modifyFilm" method="post">
                <input type="hidden" name="id_film" value="<?= $id_film ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Titre du film</label>
                    <input type="text"  class="form-control" name="titre">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Année de sortie</label>
                    <input type="number"  class="form-control" name="annee_sortie">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Durée du film en minutes</label>
                    <input type="number"  class="form-control" name="duree">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Affiche</label>
                    <input type="text"  class="form-control" name="affiche">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Synopsis</label>
                    <input type="text"  class="form-control" name="synopsis">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Note du film</label>
                    <input type="number"  class="form-control" name="note">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Réalisateur</label>
                    <input type="number"  class="form-control" name="realisateur">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
        </form>

<?php
        



$titre = "Modifier film";
$titre_secondaire = "Modifier film";
$content = ob_get_clean();
require "view/Template.php";