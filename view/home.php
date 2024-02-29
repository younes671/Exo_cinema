<?php  ob_start(); 
$films = $requete->fetchAll();?>

<section class="nouveaute">
        <div class="titre-nouveaute">
            <p>NOUVEAUTÉ</p>
        </div>
            <div class="slider-container slider-1">
                <div class="slider">
                    <?php foreach($films as $film){ ?>
                        <p><img class="image1" src="<?= $film["affiche"] ?>" alt="seven"></p>
                        <?php } ?>
                        <p><img class="image1" src="<?= $film["affiche"] ?>" alt="Affiche film"></p>
                        <p><img class="image1" src="<?= $film["affiche"] ?>" alt="Affiche film"></p>
                        <p><img class="image1" src="<?= $film["affiche"] ?>" alt="Affiche film"></p>
                        <p><img class="image1" src="<?= $film["affiche"] ?>" alt="Affiche film"></p>
                    </div>
          </div>
    </section>
    <section class="aLaUne">
        <div class="titre-aLaUne">
            <p>À LA UNE</p>
        </div>
        <!-- <div class="affiche"> -->
                    <div class="affiche-aLaUne">
                <?php foreach($films as $film){ ?>
                    <p><img class="image2" src="<?= $film["affiche"] ?>" alt="affiche film" ></p>
                    <?php } ?>
                <!-- </div> -->
                <!-- <div class="affiche">
                    <p><img class="image2" src="<?= $film["affiche"] ?>" alt="affiche film"></p>
                </div>
                <div class="affiche">
                    <p><img class="image2" src="<?= $film["affiche"] ?>" alt="affiche film"></p>
                </div>
                <div class="affiche">
                    <p><img class="image2" src="<?= $film["affiche"] ?>" alt="affiche film"></p>
                </div> -->
          </div>
    </section>
    <!-- <section class="sortieDeLaSemaine">
        <div class="titre-sortieDeLaSemaine">
            <p>Sortie de la semaine</p>
        </div>
        <div class="listeFilm">
            <div class="listeFilmTitre">
                <p>Seven : Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div class="listeFilmTitre">
                <p>Seven : Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div class="listeFilmTitre">
                <p>Seven : Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div class="listeFilmTitre">
                <p>Seven : Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div class="listeFilmTitre">
                <p>Seven : Lorem ipsum dolor sit amet consectetur</p>
            </div>

        </div>
    </section> -->

    <?php
$titre = "Home";
$titre_secondaire = "Home";
$info = "affiche la page d'accueil du site";
$content = ob_get_clean();
require "view/Template.php";