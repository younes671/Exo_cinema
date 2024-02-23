<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>ACTEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $acteur){ ?>
        <tr>
            <td><?= $acteur['nomPrenom'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/Template.php";