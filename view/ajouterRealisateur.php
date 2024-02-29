<?php  ob_start(); ?>
<h1>Ajouter un realisateur</h1>

<form class="form" action="index.php?action=addRealisateur" method="post">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Nom</label>
                    <input type="text"  class="form-control" name="nom">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Prénom</label>
                    <input type="text"  class="form-control" name="prenom">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Sexe</label>
                    <input type="text"  class="form-control" name="sexe">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Date de naissance</label>
                    <input type="date"  class="form-control" name="date_naissance">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
        </form>

<?php

$titre = "Ajouter realisateur";
$titre_secondaire = "Ajouter realisateur";
$info = "ajoute un réalisateur";
$content = ob_get_clean();
require "view/Template.php";