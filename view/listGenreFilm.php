<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> genres</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>LIBELLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $genreFilm){ ?>
        <tr>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=deleteGenre&id=<?= $genreFilm['id_genre'] ?>'><button class='btn btn-danger btn-sm' type='button'>Supprimer genre</button></a></td>
            <td><a href="index.php?action=detailGenreFilm&id=<?= $genreFilm["id_genre"]?>"><?= $genreFilm['libelle'] ?></a></td>
            <td><a style='text-decoration:none'class='link-light' href='index.php?action=modifyGenre&id=<?= $genreFilm['id_genre'] ?>'><button class='btn btn-primary btn-sm' type='button'>Modifier genre</button></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a class="link" style='text-decoration:none'class='link-light' href='index.php?action=addGenre&id=<?= $genreFilm['id_genre'] ?>'><button class='btn btn-success btn-sm' type='button'>Ajouter genre</button></a>
<?php
$titre = "Genre Film";
$titre_secondaire = "Liste genre film";
$info = "affiche la liste complète des genres de films";
$content = ob_get_clean();
require "view/Template.php";