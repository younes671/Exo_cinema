<?php  ob_start(); ?>
<?php $films = $info_film->fetchAll();?>
<h1>Modifier  un film</h1>
<?php $id_film = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<form class="form" action="index.php?action=modifyFilm" method="post">
        <?php foreach($films as $film) { ?>
                <input type="hidden" name="id_film" value="<?= $id_film ?>">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Titre</label>
                    <input type="text"  class="form-control" name="titre" placeholder="<?= $film['titre'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Année de sortie</label>
                    <input type="number"  class="form-control" name="annee_sortie" placeholder="<?= $film['annee_sortie'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Durée en minutes</label>
                    <input type="number"  class="form-control" name="duree" placeholder="<?= $film['duree'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Affiche du film</label>
                    <input type="text"  class="form-control" name="affiche" placeholder="<?= $film['affiche'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Synopsis</label>
                    <input type="text"  class="form-control" name="synopsis" placeholder="<?= $film['synopsis'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Note</label>
                    <input type="number"  class="form-control" name="note" placeholder="<?= $film['note'] ?>">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Realisateur</label>
                    <input type="text"  class="form-control" name="realisateur" placeholder="<?= $film['prenom'] ." " . $film['nom'] ?>">
                </div>
         <?php } ?>

            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
        </form>

<?php
        



$titre = "Modifier film";
$titre_secondaire = "Modifier film";
$content = ob_get_clean();
require "view/Template.php";