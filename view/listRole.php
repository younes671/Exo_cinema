<?php  ob_start(); ?>
<?php $requetes = $requete->fetchAll();?> 



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> roles</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>ROLES</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requetes as $role){ ?>
        <tr>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=deleteRole&id=<?= $role['id_role'] ?>'><button class='btn btn-danger btn-sm' type='button'>Supprimer role</button></a></td>
            <td><a href="index.php?action=detailRole&id=<?= $role['id_role']?>"><?= $role['nom_role'] ?></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=modifyRole&id=<?= $role['id_role'] ?>'><button class='btn btn-primary btn-sm' type='button'>Modifier role</button></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a class="link" style='text-decoration:none'class='link-light' href='index.php?action=addRole&id=<?= $role['id_role'] ?>'><button class='btn btn-success btn-sm' type='button'>Ajouter role</button></a>
<?php
$titre = "Liste des Roles";
$titre_secondaire = "Liste des roles";
$info = "affiche la liste complète des roles des acteurs";
$content = ob_get_clean();
require "view/Template.php";