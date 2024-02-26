<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> realisateurs</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>REALISATEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $realisateur){ ?>
        <tr>
            <td><a href="index.php?action=detailRealisateur&id=<?= $realisateur["id_realisateur"]?>"><?= $realisateur['prenom'] ." " . $realisateur['nom'] ?></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=deleteRealisateur&id=<?= $realisateur['id_realisateur'] ?>'><button class='btn btn-danger btn-sm' type='button'>Supprimer Realisateur</button></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=modifyRealisateur&id=<?= $realisateur['id_personne'] ?>'><button class='btn btn-primary btn-sm' type='button'>Modifier Realisateur</button></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a style='text-decoration:none'class='link-light' href='index.php?action=addRealisateur&id=<?= $realisateur['id_realisateur'] ?>'><button class='btn btn-success btn-sm' type='button'>Ajouter Realisateur</button></a>

<?php
$titre = "Liste des Realisateurs";
$titre_secondaire = "Liste des realisateurs";
$content = ob_get_clean();
require "view/Template.php";