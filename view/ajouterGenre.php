<?php  ob_start(); ?>
<h1>Ajouter un genre</h1>

<form class="form" action="index.php?action=addGenre" method="post">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Libellé</label>
                    <input type="text"  class="form-control" name="libelle">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
        </form>

<?php

$titre = "Ajouter genre";
$titre_secondaire = "Ajouter genre";
$content = ob_get_clean();
require "view/Template.php";