<?php  ob_start(); ?>
<h1>Ajouter un role</h1>

<form class="form" action="index.php?action=addRole" method="post">
                <div class="mb-3">
                    <label for="disabledTextInput" class="label">Nom du role</label>
                    <input type="text"  class="form-control" name="nom_role">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
        </form>

<?php

$titre = "Ajouter role";
$titre_secondaire = "Ajouter role";
$content = ob_get_clean();
require "view/Template.php";