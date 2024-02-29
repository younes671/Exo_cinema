<?php 
    namespace Controller;
    use Model\Connect;

    class HomeController
    {

        public function listFilm()
        {
           
                $pdo = Connect::seConnecter();
                $requete = $pdo->query("SELECT DISTINCT affiche
                                            FROM film LIMIT 4;");
                
            
                require 'view/home.php';
        }
    }