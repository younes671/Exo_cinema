<?php  ob_start(); ?>



<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?>films</p>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $genreFilm){ ?>
        <tr>
            <td><?= $genreFilm['libelle'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
$titre = "Genre Film";
$titre_secondaire = "Liste genre film";
$content = ob_get_clean();
require "view/Template.php";