<?php
    ob_start();
    use Controller\CinemaController;
    use Controller\HomeController;

    spl_autoload_register(function($class_name){
        include $class_name . '.php';
    });

    $ctrlCinema = new CinemaController();
    $ctrlHome= new HomeController();

    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if(isset($_GET["action"]))
    {
        switch($_GET["action"])
        {
            case "listFilms" : $ctrlCinema->listFilms(); break;
            case "listActeurs" : $ctrlCinema->listActeurs(); break;
            case "listRealisateur" : $ctrlCinema->listRealisateur(); break;
            case "listGenreFilm" : $ctrlCinema->listGenreFilm(); break;
            case "listRole" : $ctrlCinema->listRole(); break;
            case "detailFilm" : $ctrlCinema->detailFilm($id); break;
            case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        }
    } else {
        $ctrlHome->home();
    }
?>


