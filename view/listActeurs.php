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
            <td><a href="index.php?action=detailActeur&id=<?= $acteur["id_acteur"]?>"><?= $acteur['prenom'] . " " . $acteur['nom'] ?></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=deleteActeur&id=<?= $acteur['id_acteur'] ?>'><button class='btn btn-danger btn-sm' type='button'>Supprimer Acteur</button></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=modifyActeur&id=<?= $acteur['id_acteur'] ?>'><button class='btn btn-primary btn-sm' type='button'>Modifier Acteur</button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a style='text-decoration:none'class='link-light' href='index.php?action=formAddActeur&id=<?= $acteur['id_acteur'] ?>'><button class='btn btn-success btn-sm' type='button'>Ajouter Acteur</button></a>

<?php
$titre = "Liste des Acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/Template.php";