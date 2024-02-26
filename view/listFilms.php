<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $film){ ?>
        <tr>
            <td><a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>"><?= $film['titre'] ?></a></td>
            <td><?= $film['annee_sortie'] ?></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=deleteFilm&id=<?= $film['id_film'] ?>'><button class='btn btn-danger btn-sm' type='button'>Supprimer film</button></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=modifyFilm&id=<?= $film['id_film'] ?>'><button class='btn btn-primary btn-sm' type='button'>Modifier film</button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a style='text-decoration:none'class='link-light' href='index.php?action=addFilm&id=<?= $film['id_film'] ?>'><button class='btn btn-success btn-sm' type='button'>Ajouter film</button></a>

<?php
$titre = "Liste des Films";
$titre_secondaire = "Liste des films";
$content = ob_get_clean();
require "view/Template.php";