<?php  ob_start(); ?>
<h1>Ajouter un film</h1>

<form class="form" action="index.php?action=addFilm" method="post">
                    <label for="disabledTextInput" class="label">Titre du film</label>
                <div class="mb-3">
                    <input type="text"  class="form-control" name="titre">
                </div>
                    <label for="disabledTextInput" class="label">Année de sortie</label>
                <div class="mb-3">
                    <input type="number"  class="form-control" name="annee_sortie">
                </div>
                    <label for="disabledTextInput" class="label">Durée du film en minutes</label>
                <div class="mb-3">
                    <input type="number"  class="form-control" name="duree">
                </div>
                    <label for="disabledTextInput" class="label">Affiche</label>
                <div class="mb-3">
                    <input type="text"  class="form-control" name="affiche">
                </div>
                    <label for="disabledTextInput" class="label">Synopsis</label>
                <div class="mb-3">
                    <textarea type="text"  class="form-control" name="synopsis"></textarea>
                </div>
                    <label for="disabledTextInput" class="label">Note du film</label>
                <div class="mb-3">
                    <input type="number"  class="form-control" name="note">
                </div>
                    <label class="label" for="realisateurs">Choisissez un réalisateur :</label>
                <select class="mb-3-1" name="realisateurs" id="realisateurs" class="form-control" required>
                    <?php foreach($req_list->fetchAll() as $realisateur):?>
                    <option value="<?= $realisateur['id_realisateur']?>"><?= $realisateur['prenom'] . " " . $realisateur['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div>
                <legend class="label" for="checkbox">Genre :</legend>
                    <?php foreach($req_genre->fetchAll() as $genre): ?>
                        <label class="label" for="checkbox"><?= $genre['libelle'] ?></label>
                    <input type="checkbox" id="checkbox" name="option" value="">
                    <?php endforeach; ?>
                </div>
        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</form>

<?php
        



$titre = "Ajouter film";
$titre_secondaire = "Ajouter film";
$content = ob_get_clean();
require "view/Template.php";