<?php  ob_start(); ?>

<section class="nouveaute">
        <div class="titre-nouveaute">
            <p>NOUVEAUTÉ</p>
        </div>
            <div class="slider-container slider-1">
                <div class="slider">
                        <p><img class="image1" src="public/img/seven.png" alt="seven"></p>
                        <p><img class="image1" src="public/img/ronin.png" alt="ronin"></p>
                        <p><img class="image1" src="public/img/hitman.png" alt="hitman"></p>
                        <p><img class="image1" src="public/img/after-earth-affiche-film.jpg" alt="after-earth"></p>
                        <p><img class="image1" src="public/img/seven.png" alt="seven"></p>
                </div>
          </div>
    </section>
    <section class="aLaUne">
        <div class="titre-aLaUne">
            <p>À LA UNE</p>
        </div>
        <div class="affiche-aLaUne">
                <div class="affiche">
                    <p><img class="image2" src="public/img/seven.png" alt="seven"></p>
                </div>
                <div class="affiche">
                    <p><img class="image2" src="public/img/ronin.png" alt="ronin"></p>
                </div>
                <div class="affiche">
                    <p><img class="image2" src="public/img/hitman.png" alt="hitman"></p>
                </div>
                <div class="affiche">
                    <p><img class="image2" src="public/img/after-earth-affiche-film.jpg" alt="after-earth"></p>
                </div>
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
$content = ob_get_clean();
require "view/Template.php";