<?php  ob_start(); ?>
<h1>Ajouter un casting</h1>

<?php $castingData = $req_casting->fetchAll(); ?>

<form action="index.php?action=addCasting" method="post">

                <select name="id_film" id="id_film" class="form-control" required>
                    <?php foreach($castingData as $cast): ?>
                        <option value="<?= $cast['id_film'] ?>"><?= $cast['titre'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="id_acteur" id="id_acteur" class="form-control" required>
                    <?php foreach($castingData as $cast): ?>
                        <option value="<?= $cast['id_acteur'] ?>"><?= $cast['prenom'] . " " . $cast['nom'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="id_role" id="id_role" class="form-control" required>
                    <?php foreach($castingData as $cast): ?>
                        <option value="<?= $cast['id_role'] ?>"><?= $cast['nom_role'] ?></option>
                    <?php endforeach; ?>
                </select>

        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</form>

<?php
        



$titre = "Ajouter casting";
$titre_secondaire = "Ajouter casting";
$content = ob_get_clean();
require "view/Template.php";