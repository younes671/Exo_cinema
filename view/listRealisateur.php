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
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des Realisateurs";
$titre_secondaire = "Liste des realisateurs";
$content = ob_get_clean();
require "view/Template.php";