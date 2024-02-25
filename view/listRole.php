<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> roles</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>ROLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $role){ ?>
        <tr>
            <td><a href="index.php?action=detailRole&id=<?= $role['id_role']?>"><?= $role['nom_role'] ?></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des Roles";
$titre_secondaire = "Liste des roles";
$content = ob_get_clean();
require "view/Template.php";