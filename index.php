<?php
    ob_start();
    use Controller\FilmController;
    use Controller\ActeurController;
    use Controller\RealisateurController;
    use Controller\GenreController;
    use Controller\RoleController;
    use Controller\CastingController;
    use Controller\HomeController;

    spl_autoload_register(function($class_name){
        include  $class_name . '.php';
    });

    $ctrlFilm = new FilmController();
    $ctrlActeur = new ActeurController();
    $ctrlRealisateur = new RealisateurController();
    $ctrlGenre = new GenreController();
    $ctrlRole = new RoleController();
    $ctrlCasting = new CastingController();
    $ctrlHome = new HomeController();

    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if(isset($_GET["action"]))
    {
        switch($_GET["action"])
        {
            case "listFilms" : $ctrlFilm->listFilms(); break;
            case "listActeurs" : $ctrlActeur->listActeurs(); break;
            case "listRealisateur" : $ctrlRealisateur->listRealisateur(); break;
            case "listGenreFilm" : $ctrlGenre->listGenreFilm(); break;
            case "listRole" : $ctrlRole->listRole(); break;
            case "detailFilm" : $ctrlFilm->detailFilm($id); break;
            case "detailActeur" : $ctrlActeur->detailActeur($id); break;
            case "detailRealisateur" : $ctrlRealisateur->detailRealisateur($id); break;
            case "detailGenreFilm" : $ctrlGenre->detailGenreFilm($id); break;
            case "detailRole" : $ctrlRole->detailRole($id); break;
            case "addFilm" : $ctrlFilm->addFilm(); break;
            case "deleteFilm" : $ctrlFilm->deleteFilm($id); break;
            case "modifyFilm" : $ctrlFilm->modifyFilm(); break;
            case "addActeur" : $ctrlActeur->addActeur(); break;
            case "deleteActeur" : $ctrlActeur->deleteActeur($id); break;
            case "modifyActeur" : $ctrlActeur->modifyActeur(); break;
            case "addRealisateur" : $ctrlRealisateur->addRealisateur(); break;
            case "deleteRealisateur" : $ctrlRealisateur->deleteRealisateur($id); break;
            case "modifyRealisateur" : $ctrlRealisateur->modifyRealisateur($id); break;
            case "addGenre" : $ctrlGenre->addGenre(); break;
            case "modifyGenre" : $ctrlGenre->modifyGenre($id); break;
            case "deleteGenre" : $ctrlGenre->deleteGenre($id); break;
            case "addRole" : $ctrlRole->addRole(); break;
            case "modifyRole" : $ctrlRole->modifyRole($id); break;
            case "deleteRole" : $ctrlRole->deleteRole($id); break;
            case "addCasting" : $ctrlCasting->addCasting(); break;
        }
    } else {
        $ctrlHome->home();
    }
?>


