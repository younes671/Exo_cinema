<?php  ob_start(); ?>
<h1>Ajouter un film</h1>

<form action="index.php?action=addFilm" method="post">
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
                <select name="realisateurs" id="realisateurs" class="form-control" required>
                    <?php foreach($req_list->fetchAll() as $realisateur):?>
                    <option value="<?= $realisateur['id_realisateur']?>"><?= $realisateur['prenom'] . " " . $realisateur['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</form>

<?php
        



$titre = "Ajouter film";
$titre_secondaire = "Ajouter film";
$content = ob_get_clean();
require "view/Template.php";